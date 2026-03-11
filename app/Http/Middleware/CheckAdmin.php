<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta área.');
        }

        // Verifica se o usuário tem nível de permissão 'admin'
        if (Auth::user()->nivel_permissao !== 'admin') {
            // Se não for admin, redireciona com mensagem de erro
            return redirect()->route('home')->with('error', 'Acesso negado. Você não tem permissão de administrador.');
        }

        // Se for admin, continua com a requisição
        return $next($request);
    }
}
