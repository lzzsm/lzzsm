<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Collect;
use Illuminate\Http\Request;
use App\Rules\MaterialCategoriaUnica;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    /**
     * Dashboard público para usuários
     */
    public function dashboard()
    {
        $materials = Material::where('ativo', true)
            ->orderBy('categoria', 'asc')
            ->get();

        return view('materials.dashboard', compact('materials'));
    }

    /**
     * Lista todos os materiais (admin) com busca e filtros
     */
    public function index(Request $request)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem acessar esta página.');
        }

        $query = Material::query();

        // Filtro de busca
        if ($request->filled('search')) {
            $search = $request->search;
            $fields = $request->get('fields', ['categoria', 'descricao']);

            $query->where(function ($q) use ($search, $fields) {
                if (in_array('categoria', $fields)) {
                    $q->orWhere('categoria', 'like', "%{$search}%");
                }
                if (in_array('descricao', $fields)) {
                    $q->orWhere('descricao', 'like', "%{$search}%");
                }
            });
        }

        // Filtro de status
        if ($request->filled('status')) {
            $query->where('ativo', $request->boolean('status'));
        }

        // Ordenação padrão por categoria
        $query->orderBy('categoria', 'asc');

        $materials = $query->paginate(12)->withQueryString();

        return view('materials.index', compact('materials'));
    }

    /**
     * Mostrar formulário de criação
     */
    public function create()
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem criar materiais.');
        }

        return view('materials.create');
    }

    /**
     * Salvar novo material
     */
    public function store(Request $request)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem criar materiais.');
        }

        $validated = $request->validate([
            'categoria' => [
                'required',
                'string',
                'max:100',
                new MaterialCategoriaUnica()
            ],
            'ponto_kg' => 'required|numeric|min:0',
            'descricao' => 'nullable|string'
        ]);

        Material::create([
            'categoria' => $validated['categoria'],
            'ponto_kg' => $validated['ponto_kg'],
            'descricao' => $validated['descricao'] ?? null,
            'ativo' => true
        ]);

        return redirect()->route('materials.index')
            ->with('success', 'Material criado com sucesso!');
    }

    /**
     * Mostrar detalhes do material
     */
    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }

    /**
     * Mostrar formulário de edição
     */
    public function edit(Material $material)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem editar materiais.');
        }

        return view('materials.edit', compact('material'));
    }

    /**
     * Atualizar material
     */
    public function update(Request $request, Material $material)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem atualizar materiais.');
        }

        $validated = $request->validate([
            'categoria' => [
                'required',
                'string',
                'max:100',
                new MaterialCategoriaUnica($material->id)
            ],
            'ponto_kg' => 'required|numeric|min:0',
            'descricao' => 'nullable|string',
            'ativo' => 'sometimes|boolean'
        ]);

        $material->update([
            'categoria' => $validated['categoria'],
            'ponto_kg' => $validated['ponto_kg'],
            'descricao' => $validated['descricao'] ?? null,
            'ativo' => $validated['ativo'] ?? $material->ativo
        ]);

        return redirect()->route('materials.index')
            ->with('success', 'Material atualizado com sucesso!');
    }

    /**
     * Excluir material (soft delete)
     */
    public function destroy(Material $material)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem excluir materiais.');
        }

        // Verifica se existem coletas agendadas com este material
        $coletasPendentes = Collect::whereHas('materials', function ($query) use ($material) {
            $query->where('material_id', $material->id);
        })
            ->where('status', 'agendada')
            ->count();

        if ($coletasPendentes > 0) {
            return redirect()->route('materials.index')
                ->with('warning', 'Não é possível excluir este material pois existem ' . $coletasPendentes . ' coleta(s) agendada(s) vinculada(s) a ele.');
        }

        // Soft delete
        $material->delete();

        return redirect()->route('materials.index')
            ->with('success', 'Material excluído com sucesso!');
    }
}
