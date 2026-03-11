<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CollectPoint;
use App\Models\Collect;
use Illuminate\Support\Facades\Auth;

class CollectPointController extends Controller
{
    /**
     * Regras de validação reutilizáveis
     */
    protected function getValidationRules()
    {
        return [
            'nome' => 'required|string|max:200',
            'rua' => 'required|string|max:300',
            'numero' => 'nullable|string|max:20',
            'cep' => 'required|regex:/^\d{5}-?\d{3}$/',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|size:2',
        ];
    }

    /**
     * Exibe a lista de pontos de coleta com sistema de busca
     */
    public function index(Request $request)
    {
        $query = CollectPoint::query();
        $searchTerm = $request->input('search', '');
        $searchFields = $request->input('fields', []);

        if ($searchTerm && !empty($searchFields)) {
            $query->where(function ($q) use ($searchTerm, $searchFields) {
                if (in_array('nome', $searchFields)) {
                    $q->orWhere('nome', 'like', '%' . $searchTerm . '%');
                }
                if (in_array('rua', $searchFields)) {
                    $q->orWhere('rua', 'like', '%' . $searchTerm . '%');
                }
                if (in_array('cidade', $searchFields)) {
                    $q->orWhere('cidade', 'like', '%' . $searchTerm . '%');
                }
                if (in_array('estado', $searchFields)) {
                    $q->orWhere('estado', 'like', '%' . $searchTerm . '%');
                }
            });
        }

        $collectPoints = $query->latest()->paginate(12)->withQueryString();

        return view('collect-points.index', compact('collectPoints'));
    }

    /**
     * Mostra o formulário para criar um novo ponto de coleta
     */
    public function create()
    {
        return view('collect-points.create');
    }

    /**
     * Armazena um novo ponto de coleta no banco de dados
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->getValidationRules());

        // Remove a máscara do CEP antes de salvar
        $validated['cep'] = preg_replace('/\D/', '', $validated['cep']);

        CollectPoint::create($validated);

        return redirect()->route('collect-points.index')
            ->with('success', 'Ponto de Coleta cadastrado com sucesso!');
    }

    /**
     * Exibe os detalhes de um ponto de coleta específico
     */
    public function show(CollectPoint $collectPoint)
    {
        return view('collect-points.show', compact('collectPoint'));
    }

    /**
     * Exibe o dashboard/mapa com todos os pontos de coleta
     */
    public function dashboard()
    {
        $points = CollectPoint::select(['id', 'nome', 'cidade', 'rua', 'numero', 'estado'])->get();

        return view('collect-points.dashboard', compact('points'));
    }

    /**
     * Mostra o formulário para editar um ponto de coleta existente
     */
    public function edit(CollectPoint $collectPoint)
    {
        return view('collect-points.edit', compact('collectPoint'));
    }

    /**
     * Atualiza um ponto de coleta no banco de dados
     */
    public function update(Request $request, CollectPoint $collectPoint)
    {
        $validated = $request->validate($this->getValidationRules());

        // Remove a máscara do CEP
        $validated['cep'] = preg_replace('/\D/', '', $validated['cep']);

        $collectPoint->update($validated);

        return redirect()->route('collect-points.index')
            ->with('success', 'Ponto de Coleta atualizado com sucesso!');
    }

    /**
     * Remove um ponto de coleta do banco de dados
     */
    public function destroy(CollectPoint $collectPoint)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem excluir pontos de coleta.');
        }

        // Verifica se existem coletas agendadas com este ponto de coleta
        $coletasPendentes = Collect::where('collect_point_id', $collectPoint->id)
            ->where('status', 'agendada')
            ->count();

        if ($coletasPendentes > 0) {
            return redirect()->route('collect-points.index')
                ->with('warning', 'Não é possível excluir este ponto de coleta pois existem ' . $coletasPendentes . ' coleta(s) agendada(s) vinculada(s) a ele.');
        }

        // Soft delete
        $collectPoint->delete();

        return redirect()->route('collect-points.index')
            ->with('success', 'Ponto de Coleta excluído com sucesso!');
    }
}
