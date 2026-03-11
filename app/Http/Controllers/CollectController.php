<?php

namespace App\Http\Controllers;

use App\Models\Collect;
use App\Models\CollectPoint;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CollectController extends Controller
{
    /**
     * Lista todas as coletas do usuário logado
     */
    public function myCollects(Request $request)
    {
        $user = Auth::user();

        if ($user->nivel_permissao !== 'cadastrado') {
            abort(403, 'Apenas usuários cadastrados podem acessar esta página.');
        }

        $query = Collect::where('cadastrado_id', $user->cadastrado->id)
            ->with([
                'collectPoint' => function ($query) {
                    $query->withTrashed();
                },
                'materials' => function ($query) {
                    $query->withTrashed();
                }
            ])
            ->latest();

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $collects = $query->paginate(10);

        return view('collects.my-collects', compact('collects'));
    }

    /**
     * Lista todas as coletas (admin)
     */
    public function index(Request $request)
    {
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem acessar esta página.');
        }

        $query = Collect::with([
            'cadastrado.user' => function ($query) {
                $query->withTrashed();
            },
            'collectPoint' => function ($query) {
                $query->withTrashed();
            },
            'materials' => function ($query) {
                $query->withTrashed();
            }
        ])
            ->latest();

        // Sistema de busca
        $searchTerm = $request->input('search', '');
        $searchFields = $request->input('fields', []);

        if ($searchTerm && !empty($searchFields)) {
            $query->where(function ($q) use ($searchTerm, $searchFields) {
                if (in_array('usuario', $searchFields)) {
                    $q->orWhereHas('cadastrado.user', function ($subQ) use ($searchTerm) {
                        $subQ->where('name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('email', 'like', '%' . $searchTerm . '%');
                    });
                }
                if (in_array('ponto', $searchFields)) {
                    $q->orWhereHas('collectPoint', function ($subQ) use ($searchTerm) {
                        $subQ->where('nome', 'like', '%' . $searchTerm . '%')
                            ->orWhere('cidade', 'like', '%' . $searchTerm . '%')
                            ->orWhere('estado', 'like', '%' . $searchTerm . '%');
                    });
                }
            });
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $collects = $query->paginate(15);

        return view('collects.index', compact('collects'));
    }

    /**
     * Mostra formulário para agendar coleta
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->nivel_permissao !== 'cadastrado') {
            abort(403, 'Apenas usuários cadastrados podem agendar coletas.');
        }

        $collectPoints = CollectPoint::all();
        $materials = Material::ativos()->get();

        return view('collects.create', compact('collectPoints', 'materials'));
    }

    /**
     * Salva nova coleta agendada
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->nivel_permissao !== 'cadastrado') {
            abort(403, 'Apenas usuários cadastrados podem agendar coletas.');
        }

        $validated = $request->validate([
            'collect_point_id' => 'required|exists:collect_points,id',
            'data' => 'required|date|after:now',
            'materiais' => 'required|array|min:1',
            'materiais.*.material_id' => 'required|exists:materials,id',
            'materiais.*.peso' => 'required|numeric|min:0.1',
            'observacoes' => 'nullable|string|max:500'
        ]);

        try {
            DB::transaction(function () use ($validated, $user) {
                // Calcula pontos totais
                $pontosGerados = 0;
                foreach ($validated['materiais'] as $materialData) {
                    $material = Material::find($materialData['material_id']);
                    $pontosGerados += $material->calcularPontos($materialData['peso']);
                }

                // Cria a coleta
                $collect = Collect::create([
                    'cadastrado_id' => $user->cadastrado->id,
                    'collect_point_id' => $validated['collect_point_id'],
                    'data' => $validated['data'],
                    'pontos_gerados' => $pontosGerados,
                    'observacoes' => $validated['observacoes'] ?? null,
                    'status' => 'agendada'
                ]);

                // Associa os materiais com pesos e pontos calculados
                foreach ($validated['materiais'] as $materialData) {
                    $material = Material::find($materialData['material_id']);
                    $pontosMaterial = $material->calcularPontos($materialData['peso']);

                    $collect->materials()->attach($material->id, [
                        'peso' => $materialData['peso'],
                        'pontos_calculados' => $pontosMaterial
                    ]);
                }
            });

            return redirect()->route('collects.my-collects')
                ->with('success', 'Coleta agendada com sucesso! Pontos serão creditados após a validação.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao agendar coleta. Tente novamente.')
                ->withInput();
        }
    }

    /**
     * Mostra detalhes de uma coleta específica
     */
    public function show(Collect $collect)
    {
        $user = Auth::user();

        // Verifica permissão
        if ($user->nivel_permissao === 'cadastrado' && $collect->cadastrado_id !== $user->cadastrado->id) {
            abort(403, 'Esta coleta não pertence a você.');
        }

        // Carrega relacionamentos com withTrashed() para incluir registros excluídos
        $collect->load([
            'cadastrado.user' => function ($query) {
                $query->withTrashed();
            },
            'collectPoint' => function ($query) {
                $query->withTrashed();
            },
            'materials' => function ($query) {
                $query->withTrashed();
            }
        ]);

        return view('collects.show', compact('collect'));
    }

    /**
     * Valida/confirma uma coleta (admin)
     */
    public function validateCollect(Request $request, Collect $collect)
    {
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem validar coletas.');
        }

        if ($collect->status !== 'agendada') {
            return redirect()->back()
                ->with('error', 'Esta coleta já foi processada.');
        }

        try {
            DB::transaction(function () use ($collect) {
                // Atualiza status e data de validação
                $collect->update([
                    'status' => 'realizada',
                    'data_validacao' => now()
                ]);

                // Adiciona pontos ao cadastrado
                $collect->cadastrado->increment('pontuacao_total', $collect->pontos_gerados);
                $collect->cadastrado->increment('coletas_realizadas');
            });

            return redirect()->route('collects.index')
                ->with('success', 'Coleta validada com sucesso! Pontos creditados ao usuário.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao validar coleta. Tente novamente.');
        }
    }

    /**
     * Cancela uma coleta
     */
    public function cancel(Collect $collect)
    {
        $user = Auth::user();

        // Verifica permissão
        if ($user->nivel_permissao === 'cadastrado' && $collect->cadastrado_id !== $user->cadastrado->id) {
            abort(403, 'Esta coleta não pertence a você.');
        }

        if ($collect->status !== 'agendada') {
            return redirect()->back()
                ->with('error', 'Esta coleta não pode ser cancelada.');
        }

        $collect->update([
            'status' => 'cancelada'
        ]);

        $redirectRoute = $user->nivel_permissao === 'admin'
            ? route('collects.index')
            : route('collects.my-collects');

        return redirect()->to($redirectRoute)
            ->with('success', 'Coleta cancelada com sucesso.');
    }
}
