<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Cadastrado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Armazena um novo feedback
     */
    public function store(Request $request)
    {
        $request->validate(Feedback::rules());

        $user = Auth::user();

        // Verifica se o usuário é um cadastrado
        if (!$user->cadastrado) {
            return redirect()->route('home')
                ->with('error', 'Apenas usuários cadastrados podem enviar avaliações.');
        }

        // Verifica se já existe feedback para este cadastrado
        if (Feedback::where('cadastrado_id', $user->cadastrado->id)->exists()) {
            return redirect()->route('home')
                ->with('error', 'Você já enviou uma avaliação!');
        }

        Feedback::create([
            'cadastrado_id' => $user->cadastrado->id,
            'avaliacao' => $request->avaliacao,
            'conteudo' => $request->conteudo
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Avaliação enviada com sucesso!');
    }

    /**
     * Atualiza um feedback existente
     */
    public function update(Request $request, Feedback $feedback)
    {
        $user = Auth::user();

        // Verifica se o usuário é dono do feedback
        if (!$user->cadastrado || $feedback->cadastrado_id !== $user->cadastrado->id) {
            abort(403, 'Você só pode editar sua própria avaliação.');
        }

        $request->validate(Feedback::rules());

        $feedback->update([
            'avaliacao' => $request->avaliacao,
            'conteudo' => $request->conteudo
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Avaliação atualizada com sucesso!');
    }

    /**
     * Remove um feedback
     */
    public function destroy(Feedback $feedback)
    {
        $user = Auth::user();

        // Verifica se o usuário é dono do feedback
        if (!$user->cadastrado || $feedback->cadastrado_id !== $user->cadastrado->id) {
            abort(403, 'Você só pode excluir sua própria avaliação.');
        }

        $feedback->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Avaliação excluída com sucesso!');
    }

    // ===== MÉTODOS PARA ADMIN (APENAS VISUALIZAÇÃO) =====

    /**
     * Lista todos os feedbacks com filtros (apenas visualização)
     */
    public function index(Request $request)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem acessar esta página.');
        }

        $query = Feedback::with(['cadastrado.user'])
            ->latest();

        // Filtro por pesquisa
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('conteudo', 'like', "%{$search}%")
                    ->orWhereHas('cadastrado.user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Filtro por avaliação
        if ($request->has('avaliacao') && $request->avaliacao != '') {
            $query->where('avaliacao', $request->avaliacao);
        }

        $feedbacks = $query->paginate(15);

        // Usa os métodos do model para métricas
        $totalAvaliacoes = Feedback::count();
        $mediaAvaliacoes = Feedback::mediaAvaliacoes();

        // Contagem por avaliação para gráfico
        $contagemPorAvaliacao = [];
        for ($i = 1; $i <= 5; $i++) {
            $contagemPorAvaliacao[$i] = Feedback::where('avaliacao', $i)->count();
        }

        return view('feedbacks.index', compact(
            'feedbacks',
            'totalAvaliacoes',
            'mediaAvaliacoes',
            'contagemPorAvaliacao'
        ));
    }

    /**
     * Exibe detalhes de um feedback específico (apenas visualização)
     */
    public function show(Feedback $feedback)
    {
        // Verifica se é admin
        if (Auth::user()->nivel_permissao !== 'admin') {
            abort(403, 'Apenas administradores podem acessar esta página.');
        }

        $feedback->load(['cadastrado.user']);

        return view('feedbacks.show', compact('feedback'));
    }
}
