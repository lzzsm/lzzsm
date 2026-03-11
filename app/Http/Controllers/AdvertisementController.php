<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdvertisementController extends Controller
{
    /**
     * Exibe a "dashboard" pública com a lista de anúncios.
     * Mostra os anúncios mais recentes paginados (9 por página)
     */
    public function dashboard()
    {
        $advertisements = Advertisement::latest()->paginate(9);
        return view('advertisements.dashboard', compact('advertisements'));
    }

    /**
     * Exibe os detalhes de um anúncio específico.
     * Usa Route Model Binding para encontrar o anúncio automaticamente
     */
    public function show(Advertisement $advertisement)
    {
        return view('advertisements.show', compact('advertisement'));
    }

    /**
     * Exibe a tabela de gerenciamento para o admin.
     * Lista todos os anúncios paginados (10 por página)
     */
    public function index(Request $request)
    {
        $query = Advertisement::query();

        // Sistema de busca
        $searchTerm = $request->input('search', '');
        $searchFields = $request->input('fields', []);

        if ($searchTerm && !empty($searchFields)) {
            $query->where(function ($q) use ($searchTerm, $searchFields) {
                if (in_array('titulo', $searchFields)) {
                    $q->orWhere('titulo', 'like', '%' . $searchTerm . '%');
                }
                if (in_array('subtitulo', $searchFields)) {
                    $q->orWhere('subtitulo', 'like', '%' . $searchTerm . '%');
                }
                if (in_array('tipo', $searchFields)) {
                    $q->orWhere('tipo', 'like', '%' . $searchTerm . '%');
                }
            });
        }

        $advertisements = $query->latest()->paginate(10)->withQueryString();

        return view('advertisements.index', compact('advertisements'));
    }

    /**
     * Mostra o formulário para criar um novo anúncio.
     */
    public function create()
    {
        return view('advertisements.create');
    }

    /**
     * Armazena um novo anúncio no banco de dados.
     * Valida os dados, processa a imagem se existir e associa à empresa do usuário logado
     */
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:200',
            'subtitulo' => 'nullable|string|max:300',
            'conteudo' => 'required|string',
            'tipo' => [
                'required',
                'string',
                Rule::in(['Parceria', 'Evento', 'Comunicado', 'Promoção', 'Informativo']),
            ],
            'img_anuncio' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Obtém a empresa do usuário autenticado
        $empresa = Auth::user()->empresa;
        if (!$empresa) {
            return redirect()->back()->with('error', 'O usuário deve ser uma empresa.');
        }

        // Processa o upload da imagem se foi enviada
        if ($request->hasFile('img_anuncio')) {
            $path = $request->file('img_anuncio')->store('advertisements', 'public');
            $validatedData['img_anuncio'] = $path;
        }

        // Associa o anúncio à empresa
        $validatedData['empresa_id'] = $empresa->id;

        // Cria o anúncio no banco de dados
        Advertisement::create($validatedData);

        return redirect()->route('advertisements.my')->with('success', 'Anúncio criado com sucesso!');
    }

    /**
     * Mostra o formulário para editar um anúncio.
     */
    public function edit(Advertisement $advertisement)
    {
        return view('advertisements.edit', compact('advertisement'));
    }

    /**
     * Atualiza um anúncio no banco de dados.
     * Valida dados, gerencia imagem e redireciona baseado no tipo de usuário
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        // Validação dos dados (similar ao store)
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:200',
            'subtitulo' => 'nullable|string|max:300',
            'conteudo' => 'required|string',
            'tipo' => [
                'required',
                'string',
                Rule::in(['Parceria', 'Evento', 'Comunicado', 'Promoção', 'Informativo']),
            ],
            'img_anuncio' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Gerencia a substituição da imagem
        if ($request->hasFile('img_anuncio')) {
            // Remove a imagem antiga se existir
            if ($advertisement->img_anuncio) {
                Storage::disk('public')->delete($advertisement->img_anuncio);
            }
            // Faz upload da nova imagem
            $path = $request->file('img_anuncio')->store('advertisements', 'public');
            $validatedData['img_anuncio'] = $path;
        }

        // Atualiza o anúncio
        $advertisement->update($validatedData);

        // Redireciona baseado no tipo de usuário
        $user = Auth::user();
        if ($user->nivel_permissao == 'admin') {
            return redirect()->route('advertisements.index')->with('success', 'Anúncio atualizado com sucesso!');
        } elseif ($user->nivel_permissao == 'empresa') {
            return redirect()->route('advertisements.my')->with('success', 'Seu anúncio foi atualizado com sucesso!');
        } else {
            abort(403, 'Apenas empresas e administradores podem editar anúncios.');
        }
    }

    /**
     * Remove um anúncio do banco de dados.
     * Também remove a imagem associada se existir
     */
    public function destroy(Advertisement $advertisement)
    {
        $user = Auth::user();

        // Remove a imagem do storage se existir
        if ($advertisement->img_anuncio) {
            Storage::disk('public')->delete($advertisement->img_anuncio);
        }

        // Exclui o anúncio
        $advertisement->delete();

        if ($user->nivel_permissao == 'admin') {
            return redirect()->route('advertisements.index')->with('success', 'Anúncio removido com sucesso!');
        } elseif ($user->nivel_permissao == 'empresa') {
            return redirect()->route('advertisements.my')->with('success', 'Anúncio removido com sucesso!');
        } else {
            abort(403, 'Apenas empresas e administradores podem excluir anúncios.');
        }
    }

    /**
     * Exibe os anúncios da empresa do usuário logado.
     * Inclui funcionalidade de busca por múltiplos campos
     */
    public function myAdvertisements(Request $request)
    {
        $user = Auth::user();
        $empresa = $user->empresa;

        // Verifica se o usuário é uma empresa
        if (!$empresa) {
            abort(403, 'Somente empresas podem visualizar seus próprios anúncios.');
        }

        // Cria a query para obter os anúncios da empresa
        $query = $empresa->advertisements();

        // Obtém termos de busca e campos para pesquisar
        $searchTerm = $request->input('search', '');
        $searchFields = $request->input('fields', []);

        // Aplica filtros de busca se houver termo e campos selecionados
        if ($searchTerm && !empty($searchFields)) {
            $query->where(function ($q) use ($searchTerm, $searchFields) {
                foreach ($searchFields as $field) {
                    if (in_array($field, ['titulo', 'subtitulo', 'tipo'])) {
                        $q->orWhere($field, 'like', '%' . $searchTerm . '%');
                    }
                }
            });
        }

        // Finaliza a query com ordenação e paginação
        $advertisements = $query->latest()->paginate(12)->withQueryString();

        return view('advertisements.my-advertisements', compact('advertisements'));
    }
}
