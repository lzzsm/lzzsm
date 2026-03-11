<?php

namespace App\Http\Controllers;

use App\Models\CadastradoReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResgateController extends Controller
{
    /**
     * Lista todos os resgates do usuário
     */
    public function index()
    {
        // Verifica se é cadastrado
        if (Auth::user()->nivel_permissao !== "cadastrado") {
            abort(403, 'Apenas usuários cadastrados podem acessar esta página.');
        }

        $resgates = CadastradoReward::where('cadastrado_id', Auth::user()->cadastrado->id)
            ->with(['reward', 'cadastrado.user'])
            ->latest()
            ->paginate(12);

        return view('resgates.index', compact('resgates'));
    }

    /**
     * Exibe detalhes de um resgate específico
     */
    public function show(CadastradoReward $resgate)
    {
        $this->verificarAcesso($resgate);

        $resgate->load(['reward', 'cadastrado.user']);

        return view('resgates.show', compact('resgate'));
    }

    /**
     * Página para solicitar reembolso
     */
    public function reembolsarPage(CadastradoReward $resgate)
    {
        $this->verificarAcesso($resgate);

        // Verifica se pode ser reembolsado
        if (!$this->podeSerReembolsado($resgate)) {
            return redirect()->route('resgates.show', $resgate->id)
                ->with('error', 'Este resgate não pode ser reembolsado.');
        }

        return view('resgates.reembolso', compact('resgate'));
    }

    /**
     * Processa o reembolso de um resgate
     */
    public function reembolsar(Request $request, CadastradoReward $resgate)
    {
        $this->verificarAcesso($resgate);

        // Verifica se pode ser reembolsado
        if (!$this->podeSerReembolsado($resgate)) {
            return redirect()->route('resgates.show', $resgate->id)
                ->with('error', 'Este resgate não pode ser reembolsado.');
        }

        try {
            DB::transaction(function () use ($resgate) {
                // Devolver pontos ao cadastrado
                $resgate->cadastrado->decrement('pontuacao_gasta', $resgate->pontos_gastos);

                // Restaurar estoque da recompensa
                $resgate->reward->increment('qtd_disponivel');

                // Atualizar status para reembolsado
                $resgate->update([
                    'status' => 'reembolsado',
                    'data_reembolso' => now(),
                ]);
            });

            return redirect()->route('resgates.index')
                ->with('success', 'Reembolso realizado com sucesso! Seus pontos foram devolvidos.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao processar reembolso. Tente novamente.');
        }
    }

    // ===== MÉTODOS PRIVADOS AUXILIARES =====

    /**
     * Verifica se usuário pode acessar o resgate
     */
    private function verificarAcesso(CadastradoReward $resgate)
    {
        if (Auth::user()->nivel_permissao !== "cadastrado") {
            abort(403, 'Apenas usuários cadastrados podem acessar esta página.');
        }

        if ($resgate->cadastrado_id !== Auth::user()->cadastrado->id) {
            abort(403, 'Este resgate não pertence a você.');
        }
    }

    /**
     * Verifica se um resgate pode ser reembolsado
     * Apenas resgates pendentes que ainda não expiraram
     */
    private function podeSerReembolsado(CadastradoReward $resgate): bool
    {
        return $resgate->status == 'pendente' && $resgate->data_expiracao->isFuture();
    }

    /**
     * Lista todos os resgates (admin)
     */
    public function indexAdmin(Request $request)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== "admin") {
            abort(403, 'Apenas administradores podem acessar esta página.');
        }

        $query = CadastradoReward::with(['cadastrado.user', 'reward.empresa.user'])
            ->latest();

        // Sistema de busca
        $searchTerm = $request->input('search', '');
        $searchFields = $request->input('fields', []);

        if ($searchTerm && !empty($searchFields)) {
            $query->where(function ($q) use ($searchTerm, $searchFields) {
                if (in_array('codigo', $searchFields)) {
                    $q->orWhere('codigo_resgate', 'like', '%' . $searchTerm . '%');
                }
                if (in_array('usuario', $searchFields)) {
                    $q->orWhereHas('cadastrado.user', function ($subQ) use ($searchTerm) {
                        $subQ->where('name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('email', 'like', '%' . $searchTerm . '%');
                    });
                }
                if (in_array('empresa', $searchFields)) {
                    $q->orWhereHas('reward.empresa.user', function ($subQ) use ($searchTerm) {
                        $subQ->where('name', 'like', '%' . $searchTerm . '%');
                    });
                }
                if (in_array('recompensa', $searchFields)) {
                    $q->orWhereHas('reward', function ($subQ) use ($searchTerm) {
                        $subQ->where('titulo', 'like', '%' . $searchTerm . '%');
                    });
                }
            });
        }

        // Filtro por status
        if ($request->has('status') && $request->status != '') {
            $status = $request->status;

            if ($status === 'pendente') {
                $query->where('status', 'pendente')
                    ->where('data_expiracao', '>', now());
            } elseif ($status === 'expirado') {
                $query->where('status', 'pendente')
                    ->where('data_expiracao', '<=', now());
            } else {
                $query->where('status', $status);
            }
        }

        $resgates = $query->paginate(15);

        return view('resgates.index-admin', compact('resgates'));
    }

    /**
     * Exibe detalhes de um resgate específico (admin)
     */
    public function showAdmin(CadastradoReward $resgate)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== "admin") {
            abort(403, 'Apenas administradores podem acessar esta página.');
        }

        $resgate->load(['cadastrado.user', 'reward.empresa.user']);

        return view('resgates.show-admin', compact('resgate'));
    }

    public function reembolsarExpirados()
    {
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem executar esta ação.');
        }

        // Buscar resgates pendentes expirados
        $resgatesExpirados = CadastradoReward::with(['cadastrado.user', 'reward'])
            ->where('status', 'pendente')
            ->where('data_expiracao', '<=', now())
            ->get();

        $totalReembolsado = 0;
        $reembolsos = [];

        foreach ($resgatesExpirados as $resgate) {
            try {
                DB::transaction(function () use ($resgate, &$totalReembolsado, &$reembolsos) {
                    // Reembolsar pontos (decrementar pontuacao_gasta)
                    $resgate->cadastrado->decrement('pontuacao_gasta', $resgate->pontos_gastos);

                    // Atualizar status do resgate
                    $resgate->update(['status' => 'reembolsado']);

                    $totalReembolsado++;
                    $reembolsos[] = [
                        'usuario' => $resgate->cadastrado->user->name,
                        'recompensa' => $resgate->reward->titulo,
                        'pontos' => $resgate->pontos_gastos,
                        'data_expiracao' => $resgate->data_expiracao->format('d/m/Y')
                    ];
                });
            } catch (\Exception $e) {
                // Apenas continua para o próximo resgate em caso de erro
                continue;
            }
        }

        return redirect()->route('admin.resgates.index')
            ->with('success', "{$totalReembolsado} resgates expirados reembolsados com sucesso!")
            ->with('reembolsos', $reembolsos);
    }
}
