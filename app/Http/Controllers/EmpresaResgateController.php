<?php

namespace App\Http\Controllers;

use App\Models\CadastradoReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmpresaResgateController extends Controller
{
    /**
     * Lista todos os resgates da empresa
     */
    public function index()
    {
        $empresa = Auth::user()->empresa;

        $resgates = $this->getResgatesDaEmpresa($empresa)
            ->latest()
            ->paginate(15);

        return view('empresas.resgates.index', compact('resgates'));
    }

    /**
     * Página de validação de código
     */
    public function validarPage()
    {
        $empresa = Auth::user()->empresa;

        $resgatesRecentes = $this->getResgatesDaEmpresa($empresa)
            ->latest()
            ->limit(5)
            ->get();

        return view('empresas.resgates.validar', compact('resgatesRecentes'));
    }

    /**
     * Valida um código de resgate
     */
    public function validarCodigo(Request $request)
    {
        $request->validate([
            'codigo_resgate' => 'required|string|size:10'
        ]);

        $empresa = Auth::user()->empresa;

        $resgate = CadastradoReward::where('codigo_resgate', $request->codigo_resgate)
            ->whereHas('reward', function ($query) use ($empresa) {
                $query->where('empresa_id', $empresa->id);
            })
            ->first();

        if (!$resgate) {
            return back()->with('error', 'Código inválido ou não pertence a esta empresa.');
        }

        // Verifica status do resgate
        if (!$this->podeSerUtilizado($resgate)) {
            return back()->with('error', $this->getMensagemStatus($resgate));
        }

        // Marcar como utilizado
        $resgate->update([
            'status' => 'utilizado',
            'data_utilizacao' => now()
        ]);

        return back()->with('success', 'Código validado com sucesso! Recompensa entregue ao usuário.');
    }

    /**
     * Reembolsa um resgate específico
     */
    public function reembolsar(CadastradoReward $resgate)
    {
        $empresa = Auth::user()->empresa;

        // Verifica se o resgate pertence à empresa
        if ($resgate->reward->empresa_id !== $empresa->id) {
            abort(403, 'Este resgate não pertence à sua empresa.');
        }

        // Verifica se pode ser reembolsado
        if (!$this->podeSerReembolsado($resgate)) {
            return back()->with('error', 'Este resgate não pode ser reembolsado.');
        }

        $this->processarReembolso($resgate);

        return back()->with('success', 'Resgate reembolsado com sucesso! Pontos devolvidos ao usuário.');
    }


    // ===== MÉTODOS PRIVADOS AUXILIARES =====

    /**
     * Query base para resgates da empresa
     */
    private function getResgatesDaEmpresa($empresa)
    {
        return CadastradoReward::whereHas('reward', function ($query) use ($empresa) {
            $query->where('empresa_id', $empresa->id);
        })->with(['cadastrado.user', 'reward']);
    }

    /**
     * Verifica se um resgate pode ser utilizado
     * Baseado no status e data de expiração
     */
    private function podeSerUtilizado(CadastradoReward $resgate): bool
    {
        // Só pode utilizar se status for 'pendente' e não estiver expirado
        return $resgate->status === 'pendente' && $resgate->data_expiracao->isFuture();
    }

    /**
     * Verifica se um resgate pode ser reembolsado
     * Apenas resgates pendentes que expiraram
     */
    private function podeSerReembolsado(CadastradoReward $resgate): bool
    {
        return $resgate->status == 'pendente' && $resgate->data_expiracao->isPast();
    }

    /**
     * Retorna mensagem de status para feedback
     */
    private function getMensagemStatus(CadastradoReward $resgate): string
    {
        return match($resgate->status) {
            'utilizado' => 'Este código já foi utilizado.',
            'reembolsado' => 'Este código foi reembolsado.',
            default => $resgate->data_expiracao?->isPast() 
                ? 'Este código expirou. Reembolso automático em processamento.'
                : 'Código indisponível.'
        };
    }

    /**
     * Processa o reembolso de um resgate
     * Devolve pontos e restaura estoque
     */
    private function processarReembolso(CadastradoReward $resgate)
    {
        DB::transaction(function () use ($resgate) {
            // Devolver pontos ao cadastrado (decrementa pontuacao_gasta)
            $resgate->cadastrado->decrement('pontuacao_gasta', $resgate->pontos_gastos);
            
            // Restaurar estoque da recompensa
            $resgate->reward->increment('qtd_disponivel');
            
            // Atualizar status e data
            $resgate->update([
                'status' => 'reembolsado',
                'data_reembolso' => now()
            ]);
        });
    }

    /**
     * Verifica status de um código (para API ou uso externo)
     */
    public function verificarStatus($codigoResgate)
    {
        $empresa = Auth::user()->empresa;

        $resgate = CadastradoReward::where('codigo_resgate', $codigoResgate)
            ->whereHas('reward', function ($query) use ($empresa) {
                $query->where('empresa_id', $empresa->id);
            })
            ->first();

        if (!$resgate) {
            return response()->json([
                'valido' => false,
                'mensagem' => 'Código não encontrado'
            ], 404);
        }

        return response()->json([
            'valido' => $this->podeSerUtilizado($resgate),
            'status' => $resgate->status,
            'expirado' => $resgate->data_expiracao?->isPast() ?? false,
            'tempo_restante' => $resgate->tempo_restante,
            'recompensa' => $resgate->reward->nome,
            'usuario' => $resgate->cadastrado->user->name
        ]);
    }
}