<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empresa;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Rules\Cnpj;
use App\Rules\Telefone;
use Illuminate\Validation\Rule;

class EmpresaController extends Controller
{
    /**
     * Regras de validação reutilizáveis
     */
    protected function getValidationRules($ignoreEmpresaId = null, $ignoreUserId = null)
    {
        $rules = [
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'email', 'max:254'],
            'cnpj' => ['required', 'string', 'size:14', new Cnpj],
            'telefone_comercial' => ['nullable', 'string', 'max:20', new Telefone],
            'descricao' => ['nullable', 'string'],
            'site' => ['nullable', 'url', 'max:1000'],
        ];

        // Aplica ignore rules se IDs foram fornecidos
        if ($ignoreUserId) {
            $rules['email'][] = Rule::unique('users')->ignore($ignoreUserId);
        } else {
            $rules['email'][] = 'unique:users,email';
            $rules['password'] = ['required', 'min:8', 'confirmed'];
        }

        if ($ignoreEmpresaId) {
            $rules['cnpj'][] = Rule::unique('empresas')->ignore($ignoreEmpresaId);
        } else {
            $rules['cnpj'][] = 'unique:empresas,cnpj';
            $rules['terms'] = ['accepted', 'required'];
        }

        return $rules;
    }

    /**
     * Exibe a lista de empresas com sistema de busca
     */
    public function index(Request $request)
    {
        $query = Empresa::with('user');
        $searchTerm = $request->input('search', '');
        $searchFields = $request->input('fields', []);

        if ($searchTerm && !empty($searchFields)) {
            $query->where(function ($q) use ($searchTerm, $searchFields) {
                $numericSearchTerm = preg_replace('/[^0-9]/', '', $searchTerm);

                if (in_array('name', $searchFields)) {
                    $q->orWhereHas('user', function ($subQ) use ($searchTerm) {
                        $subQ->where('name', 'like', '%' . $searchTerm . '%');
                    });
                }
                if (in_array('email', $searchFields)) {
                    $q->orWhereHas('user', function ($subQ) use ($searchTerm) {
                        $subQ->where('email', 'like', '%' . $searchTerm . '%');
                    });
                }
                if (in_array('cnpj', $searchFields) && !empty($numericSearchTerm)) {
                    $q->orWhere('cnpj', 'like', '%' . $numericSearchTerm . '%');
                }
                if (in_array('telefone', $searchFields) && !empty($numericSearchTerm)) {
                    $q->orWhere('telefone_comercial', 'like', '%' . $numericSearchTerm . '%');
                }
            });
        }

        $empresas = $query->latest()->paginate(12)->withQueryString();
        return view('empresas.index', compact('empresas'));
    }

    /**
     * Exibe o dashboard público com empresas
     */
    public function dashboard()
    {
        $empresas = Empresa::with('user')->latest()->paginate(9);
        return view('empresas.dashboard', compact('empresas'));
    }

    /**
     * Mostra o formulário de cadastro de nova empresa
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Armazena uma nova empresa no banco de dados
     */
    public function store(Request $request)
    {
        // Limpeza dos dados
        $request->merge([
            'cnpj' => preg_replace('/[^0-9]/', '', $request->cnpj),
            'telefone_comercial' => preg_replace('/[^0-9]/', '', $request->telefone_comercial),
        ]);

        // Validação
        $request->validate($this->getValidationRules());

        // Criação em transaction
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nivel_permissao' => 'empresa',
            ]);

            Empresa::create([
                'user_id' => $user->id,
                'cnpj' => $request->cnpj,
                'telefone_comercial' => $request->telefone_comercial,
                'descricao' => $request->descricao,
                'site' => $request->site,
            ]);
        });

        return redirect()->route('empresas.index')->with('success', 'Empresa cadastrada com sucesso!');
    }

    /**
     * Exibe os detalhes de uma empresa específica
     */
    public function show(Empresa $empresa)
    {
        $empresa->load('user');
        return view('empresas.show', compact('empresa'));
    }

    /**
     * Mostra o formulário para editar uma empresa
     */
    public function edit(Empresa $empresa)
    {
        $empresa->load('user');
        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Atualiza os dados básicos da empresa (acesso da própria empresa)
     */
    public function update(Request $request, Empresa $empresa)
    {
        // Verifica se o usuário tem permissão para editar esta empresa
        $user = auth()->guard()->user();
        if ($user->nivel_permissao === 'empresa' && $user->empresa->id !== $empresa->id) {
            abort(403, 'Você só pode editar os dados da sua própria empresa.');
        }

        // Validação simplificada para atualização
        $request->validate([
            'site' => 'nullable|string|max:1000',
            'telefone_comercial' => 'nullable|string|max:20',
            'descricao' => 'nullable|string',
        ]);

        // Limpa telefone se fornecido
        $updateData = [
            'site' => $request->input('site', ''),
            'descricao' => $request->input('descricao', ''),
        ];

        if ($request->has('telefone_comercial')) {
            $updateData['telefone_comercial'] = preg_replace('/[^0-9]/', '', $request->telefone_comercial);
        }

        $empresa->update($updateData);

        return redirect()->back()->with('success', 'Dados empresariais atualizados com sucesso!');
    }

    /**
     * Atualização completa da empresa feita pelo administrador
     */
    public function updateByAdmin(Request $request, Empresa $empresa) // Route Model Binding
    {
        // Limpeza dos dados
        $request->merge([
            'cnpj' => preg_replace('/[^0-9]/', '', $request->cnpj),
            'telefone_comercial' => preg_replace('/[^0-9]/', '', $request->telefone_comercial),
        ]);

        // Validação com ignore rules
        $request->validate($this->getValidationRules($empresa->id, $empresa->user->id));

        // Atualização em transaction
        DB::transaction(function () use ($request, $empresa) {
            $empresa->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $empresa->update([
                'cnpj' => $request->cnpj,
                'telefone_comercial' => $request->telefone_comercial,
                'descricao' => $request->descricao,
                'site' => $request->site,
            ]);
        });

        return redirect()->route('empresas.index')->with('success', 'Dados da empresa atualizados com sucesso!');
    }

    /**
     * Remove uma empresa e seu usuário associado
     */
    public function destroy(Empresa $empresa) // Route Model Binding
    {
        DB::transaction(function () use ($empresa) {
            // Deleta recompensas em massa (mais eficiente)
            Reward::where('empresa_id', $empresa->id)->delete();

            // Obtém o usuário antes de deletar a empresa
            $user = $empresa->user;

            // Deleta a empresa
            $empresa->delete();

            // Deleta o usuário associado
            if ($user) {
                $user->delete();
            }
        });

        return redirect()->route('empresas.index')->with('success', 'Empresa e suas recompensas associadas foram excluídas com sucesso!');
    }
}
