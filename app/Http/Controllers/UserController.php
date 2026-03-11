<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CadastradoReward;
use App\Models\Collect;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Rules\Cpf;

class UserController extends Controller
{
    /**
     * Atualiza o perfil do usuário logado
     * Gerencia nome, email e foto de perfil
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validação dos dados do formulário
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'email', 'max:254', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validate();

        // Atualiza a foto de perfil, se enviada
        if ($request->hasFile('photo')) {
            // Remove foto antiga se existir
            if ($user->profile_photo_path) {
                $this->deleteProfilePhoto($user);
            }

            // Faz upload da nova foto
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        // Se o email foi alterado e o usuário precisa verificar email
        if ($request->email !== $user->email && $user instanceof MustVerifyEmail) {
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->email_verified_at = null;
            $user->save();

            // Envia nova notificação de verificação
            $user->sendEmailVerificationNotification();

            return redirect()->back()->with('success', 'Perfil atualizado com sucesso! Verifique seu novo email.');
        } else {
            // Atualização normal (email não mudou)
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'profile_photo_path' => $user->profile_photo_path,
            ]);

            return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
        }
    }

    /**
     * Remove a foto de perfil do usuário logado
     */
    public function deletePhoto()
    {
        $user = Auth::user();

        // Remove a foto do storage
        $this->deleteProfilePhoto($user);

        // Limpa a referência no banco de dados
        $user->profile_photo_path = null;
        $user->save();

        return redirect()->back()->with('success', 'Foto de perfil removida com sucesso!');
    }

    /**
     * Método privado para deletar foto de perfil do storage
     */
    private function deleteProfilePhoto(User $user): void
    {
        if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }
    }

    // ===== MÉTODOS ADMIN =====

    /**
     * Lista todos os usuários cadastrados (para administradores)
     * Inclui sistema de busca avançada
     */
    public function index(Request $request)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem acessar esta página.');
        }

        // Filtra apenas usuários com permissão 'cadastrado'
        $query = User::with('cadastrado')->where('nivel_permissao', 'cadastrado');

        // ===== SISTEMA DE BUSCA AVANÇADA =====
        $searchTerm = $request->input('search', '');
        $searchFields = $request->input('fields', []);

        if ($searchTerm && !empty($searchFields)) {
            $query->where(function ($q) use ($searchTerm, $searchFields) {
                // Limpa caracteres não numéricos para busca de CPF
                $numericSearchTerm = preg_replace('/[^0-9]/', '', $searchTerm);

                // Busca por nome
                if (in_array('name', $searchFields)) {
                    $q->orWhere('name', 'like', '%' . $searchTerm . '%');
                }
                // Busca por email
                if (in_array('email', $searchFields)) {
                    $q->orWhere('email', 'like', '%' . $searchTerm . '%');
                }
                // Busca por CPF (apenas números)
                if (in_array('cpf', $searchFields) && !empty($numericSearchTerm)) {
                    $q->orWhereHas('cadastrado', function ($subQ) use ($numericSearchTerm) {
                        $subQ->where('cpf', 'like', '%' . $numericSearchTerm . '%');
                    });
                }
            });
        }

        $users = $query->latest()->paginate(12)->withQueryString();

        return view('users.index', compact('users'));
    }

    /**
     * Mostra o formulário para editar um usuário (admin)
     */
    public function edit(User $user)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem editar usuários.');
        }

        // Verifica se o usuário é do tipo cadastrado
        if ($user->nivel_permissao !== 'cadastrado') {
            abort(404, 'Usuário não encontrado.');
        }

        $user->load('cadastrado');

        return view('users.edit', compact('user'));
    }

    /**
     * Atualiza um usuário específico (admin)
     * Atualiza tanto dados do User quanto do Cadastrado
     */
    public function updateByAdmin(Request $request, User $user)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem atualizar usuários.');
        }

        // Verifica se o usuário é do tipo cadastrado
        if ($user->nivel_permissao !== 'cadastrado') {
            abort(404, 'Usuário não encontrado.');
        }

        // Limpa o CPF (remove caracteres não numéricos)
        $request->merge(['cpf' => preg_replace('/[^0-9]/', '', $request->cpf)]);

        // Validação dos dados
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'max:254', Rule::unique('users')->ignore($user->id)],
            'cpf' => [
                'required',
                'string',
                'size:11',
                Rule::unique('cadastrados')->ignore($user->cadastrado->id ?? null),
                new Cpf
            ],
        ]);

        // Atualização em transação para garantir consistência
        DB::transaction(function () use ($validated, $user) {
            // Atualiza dados básicos do usuário
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            // Atualiza CPF na tabela cadastrados
            $user->cadastrado->update(['cpf' => $validated['cpf']]);
        });

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove um usuário cadastrado (admin)
     * Deleta tanto o User quanto o registro em Cadastrado
     */
    public function destroy(User $user)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem excluir usuários.');
        }

        // Verifica se o usuário é do tipo cadastrado
        if ($user->nivel_permissao !== 'cadastrado') {
            abort(404, 'Usuário não encontrado.');
        }

        // Transação para garantir integridade dos dados
        DB::transaction(function () use ($user) {
            // Remove foto de perfil se existir
            if ($user->profile_photo_path) {
                $this->deleteProfilePhoto($user);
            }

            // Deleta o registro na tabela cadastrados primeiro
            $user->cadastrado?->delete();

            // Deleta o usuário
            $user->delete();
        });

        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }

    /**
     * Exibe detalhes de um usuário específico (admin)
     */
    public function show(User $user)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem visualizar detalhes de usuários.');
        }

        // Verifica se o usuário é do tipo cadastrado
        if ($user->nivel_permissao !== 'cadastrado') {
            abort(404, 'Usuário encontrado não é um usuário cadastrado.');
        }

        $user->load(['cadastrado', 'cadastrado.resgates.reward', 'cadastrado.feedback']);

        return view('users.show', compact('user'));
    }

    public function myPoints()
    {
        return view('users.my-points');
    }
}
