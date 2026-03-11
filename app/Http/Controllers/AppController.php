<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AppController extends Controller
{
    /**
     * Página inicial do aplicativo
     */
    public function home()
    {
        return view('home');
    }

    // ===== PÁGINAS LEGAIS =====

    /**
     * Política de Privacidade
     */
    public function privacyPolicy()
    {
        return view('legal.privacy-policy');
    }

    /**
     * Termos de Uso
     */
    public function terms()
    {
        return view('legal.terms');
    }

    // ===== SUPORTE AO USUÁRIO =====

    /**
     * Perguntas Frequentes (FAQ)
     */
    public function faq()
    {
        return view('support.faq');
    }

    /**
     * Central de Ajuda
     */
    public function support()
    {
        return view('support.help-center');
    }

    // ===== SOBRE A EMPRESA =====

    /**
     * Sobre Nós
     */
    public function about()
    {
        return view('company.about');
    }

    /**
     * Nosso Impacto
     */
    public function impact()
    {
        return view('company.impact');
    }

    /**
     * Nossa Missão
     */
    public function mission()
    {
        return view('company.mission');
    }

    // ===== INFORMAÇÕES DA EMPRESA =====

    /**
     * Sistema de Recompensas
     */
    public function rewards()
    {
        return view('company.info.rewards');
    }

    /**
     * Sistema de Pontuação
     */
    public function scoring()
    {
        return view('company.info.scoring');
    }

    /**
     * Parcerias
     */
    public function partnerships()
    {
        return view('company.info.partnerships');
    }

    /**
     * Coletas
     */
    public function collects()
    {
        return view('company.info.collects');
    }

    /**
     * Anúncios
     */
    public function advertisements()
    {
        return view('company.info.advertisements');
    }

    // ===== PÁGINAS INFORMATIVAS =====

    /**
     * Como Pontuar - Guia para usuários
     */
    public function howToScore()
    {
        return view('info-pages.how-to-score');
    }

    /**
     * Como Resgatar - Guia para usuários
     */
    public function howToRedeem()
    {
        return view('info-pages.how-to-redeem');
    }

    /**
     * Como Reciclar - Instruções de reciclagem
     */
    public function howToRecycle()
    {
        return view('info-pages.how-to-recycle');
    }


    /**
     * Jogos e Quizzes - Conteúdo interativo
     */
    public function gamesAndQuizzes()
    {
        return view('info-pages.games-and-quizzes');
    }

    /**
     * Nossos Parceiros - Empresas colaboradoras
     */
    public function ourPartners()
    {
        return view('info-pages.our-partners');
    }

    // ===== SISTEMA DE RANKING =====

    /**
     * Exibe o ranking de usuários baseado na pontuação
     * Ordena usuários cadastrados pela pontuação total (maior para menor)
     */
    public function ranking()
    {
        $users = User::where('users.nivel_permissao', 'cadastrado')
            ->whereHas('cadastrado')
            ->with(['cadastrado' => function ($query) {
                $query->select('id', 'user_id', 'pontuacao_total', 'coletas_realizadas');
            }])
            ->select('users.id', 'users.name', 'users.profile_photo_path', 'users.created_at') // ESPECIFICAR users.
            ->join('cadastrados', 'users.id', '=', 'cadastrados.user_id')
            ->orderBy('cadastrados.pontuacao_total', 'DESC')
            ->limit(100)
            ->get();

        return view('ranking', compact('users'));
    }
}
