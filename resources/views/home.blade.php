@extends('layouts.main')

@section('title', 'Perseph')

@section('content')

    <!-- Seção Hero -->
    <section class="relative h-screen flex items-center justify-center text-white overflow-hidden bg-cover bg-center"
        style="background-image: url('/img/hero_background.jpg');">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-emerald-900/70 to-transparent opacity-90"></div>
        <div class="relative z-10 text-center px-4 hero-content">
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight mb-6 hero-title drop-shadow-lg">
                @auth
                    @if (Auth::user()->nivel_permissao == 'cadastrado')
                        Bem-vindo de volta, {{ Auth::user()->name }}!
                    @elseif(Auth::user()->nivel_permissao == 'empresa')
                        Bem-vinda, {{ Auth::user()->empresa->user->name }}!
                    @else
                        Painel Administrativo
                    @endif
                @else
                    Transforme Lixo em Tesouro com <span class="text-lime-400">Perseph</span>
                @endauth
            </h1>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto mb-10 hero-subtitle opacity-0 transform translate-y-8">
                @auth
                    @if (Auth::user()->nivel_permissao == 'cadastrado')
                        Continue sua jornada sustentável! Recicle, acumule pontos e resgate recompensas exclusivas.
                    @elseif(Auth::user()->nivel_permissao == 'empresa')
                        Gerencie suas recompensas, anúncios e acompanhe o impacto da sua empresa no meio ambiente.
                    @else
                        Gerencie toda a plataforma, usuários, empresas e acompanhe métricas de sustentabilidade.
                    @endif
                @else
                    Gamifique sua reciclagem, acumule pontos e resgate recompensas incríveis.
                    Comece sua jornada sustentável hoje!
                @endauth
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6 hero-buttons opacity-0 transform translate-y-8">
                @auth
                    @if (Auth::user()->nivel_permissao == 'cadastrado')
                        <a href="{{ route('collect-points.dashboard') }}">
                            <button
                                class="bg-lime-500 text-slate-900 px-8 py-4 rounded-full text-lg font-bold hover:bg-lime-400 transition-all duration-300 shadow-lg hover:shadow-xl glowing-border">
                                <i data-lucide="map-pin" class="w-5 h-5 inline mr-2"></i>
                                Encontrar Pontos de Coleta
                            </button>
                        </a>
                        <a href="{{ route('rewards.dashboard') }}">
                            <button
                                class="bg-transparent border-2 border-lime-500 text-lime-400 px-8 py-4 rounded-full text-lg font-bold hover:bg-lime-500 hover:text-slate-900 transition-all duration-300 shadow-lg hover:shadow-xl glowing-border">
                                <i data-lucide="gift" class="w-5 h-5 inline mr-2"></i>
                                Ver Recompensas
                            </button>
                        </a>
                    @elseif(Auth::user()->nivel_permissao == 'empresa')
                        <a href="{{ route('rewards.create') }}">
                            <button
                                class="bg-lime-500 text-slate-900 px-8 py-4 rounded-full text-lg font-bold hover:bg-lime-400 transition-all duration-300 shadow-lg hover:shadow-xl glowing-border">
                                <i data-lucide="plus" class="w-5 h-5 inline mr-2"></i>
                                Criar Recompensa
                            </button>
                        </a>
                        <a href="{{ route('advertisements.create') }}">
                            <button
                                class="bg-transparent border-2 border-lime-500 text-lime-400 px-8 py-4 rounded-full text-lg font-bold hover:bg-lime-500 hover:text-slate-900 transition-all duration-300 shadow-lg hover:shadow-xl glowing-border">
                                <i data-lucide="megaphone" class="w-5 h-5 inline mr-2"></i>
                                Publicar Anúncio
                            </button>
                        </a>
                    @else
                        <a href="{{ route('users.index') }}">
                            <button
                                class="bg-lime-500 text-slate-900 px-8 py-4 rounded-full text-lg font-bold hover:bg-lime-400 transition-all duration-300 shadow-lg hover:shadow-xl glowing-border">
                                <i data-lucide="users" class="w-5 h-5 inline mr-2"></i>
                                Gerenciar Usuários
                            </button>
                        </a>
                        <a href="{{ route('empresas.index') }}">
                            <button
                                class="bg-transparent border-2 border-lime-500 text-lime-400 px-8 py-4 rounded-full text-lg font-bold hover:bg-lime-500 hover:text-slate-900 transition-all duration-300 shadow-lg hover:shadow-xl glowing-border">
                                <i data-lucide="building" class="w-5 h-5 inline mr-2"></i>
                                Gerenciar Empresas
                            </button>
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}">
                        <button
                            class="bg-lime-500 text-slate-900 px-8 py-4 rounded-full text-lg font-bold hover:bg-lime-400 transition-all duration-300 shadow-lg hover:shadow-xl glowing-border">
                            Começar a Reciclar
                        </button>
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Container principal para o conteúdo -->
    <div class="min-h-screen flex items-center justify-center py-20 px-4 bg-slate-900 relative z-10">
        <div class="max-w-6xl w-full">

            <!-- Seção Sobre a Plataforma -->
            <section class="text-center mb-20 px-4 fade-in-section">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-8">
                    O que é <span class="text-emerald-400">Perseph</span>?
                </h2>
                <p class="text-lg md:text-xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
                    Perseph é uma plataforma inovadora que transforma o ato de reciclar em uma experiência divertida e
                    recompensadora.
                    Através de um sistema de <span class="text-emerald-400 font-semibold">gamificação</span>, incentivamos a
                    coleta seletiva e oferecemos à você a uma variedade de <span
                        class="text-emerald-400 font-semibold">recompensas</span>,
                    contribuindo para um futuro mais <span class="text-emerald-400 font-semibold">sustentável</span>.
                </p>
            </section>

            @auth
                <!-- SEÇÕES ESPECÍFICAS POR TIPO DE USUÁRIO -->

                @if (Auth::user()->nivel_permissao == 'cadastrado')
                    <!-- DASHBOARD DO USUÁRIO CADASTRADO -->
                    <section class="mb-20">
                        <h2 class="text-3xl md:text-4xl font-bold text-white text-center mb-12">Seu Painel de Reciclagem</h2>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                            <!-- Estatísticas do Usuário -->
                            <div
                                class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                                <!-- Cabeçalho -->
                                <div class="text-center mb-6">
                                    <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                        <i data-lucide="bar-chart" class="w-5 h-5 mr-2 text-lime-400"></i>
                                        Suas Estatísticas
                                    </h3>
                                    <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                    </div>
                                </div>

                                <!-- Estatísticas -->
                                <div class="space-y-4">
                                    <div
                                        class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                        <span class="text-gray-300 text-sm">Pontos Totais:</span>
                                        <span
                                            class="text-lime-400 font-bold text-lg">{{ Auth::user()->cadastrado->pontuacao_total ?? 0 }}</span>
                                    </div>
                                    <div
                                        class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                        <span class="text-gray-300 text-sm">Pontos Disponíveis:</span>
                                        <span
                                            class="text-lime-400 font-bold text-lg">{{ Auth::user()->cadastrado->pontos_disponiveis ?? 0 }}</span>
                                    </div>
                                    <div
                                        class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                        <span class="text-gray-300 text-sm">Coletas Realizadas:</span>
                                        <span
                                            class="text-lime-400 font-bold text-lg">{{ Auth::user()->cadastrado->coletas_realizadas ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Recompensas Disponíveis -->
                            <div
                                class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                                <!-- Cabeçalho -->
                                <div class="text-center mb-6">
                                    <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                        <i data-lucide="award" class="w-5 h-5 mr-2 text-lime-400"></i>
                                        Recompensas Próximas
                                    </h3>
                                    <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                    </div>
                                </div>

                                <!-- Recompensas -->
                                <div class="space-y-3 mb-4">
                                    @php
                                        $recompensasProximas = \App\Models\Reward::where(
                                            'pontos_necessarios',
                                            '<=',
                                            Auth::user()->cadastrado->pontos_disponiveis ?? 0,
                                        )
                                            ->where('qtd_disponivel', '>', 0)
                                            ->limit(3)
                                            ->get();
                                    @endphp
                                    @forelse($recompensasProximas as $recompensa)
                                        <div
                                            class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                            <span class="text-gray-300 text-sm">{{ $recompensa->titulo }}</span>
                                            <span class="text-lime-400 text-sm font-bold">{{ $recompensa->pontos_necessarios }}
                                                pts</span>
                                        </div>
                                    @empty
                                        <p class="text-gray-400 text-sm text-center">Continue reciclando para desbloquear
                                            recompensas!</p>
                                    @endforelse
                                </div>

                                <!-- Link Ver Todas -->
                                <a href="{{ route('rewards.dashboard') }}"
                                    class="block text-center text-lime-400 hover:text-lime-300 transition-colors flex items-center justify-center group">
                                    Ver Todas as Recompensas
                                    <i data-lucide="arrow-right"
                                        class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>

                            <!-- Ações Rápidas -->
                            <div
                                class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                                <!-- Cabeçalho -->
                                <div class="text-center mb-6">
                                    <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                        <i data-lucide="zap" class="w-5 h-5 mr-2 text-lime-400"></i>
                                        Ações Rápidas
                                    </h3>
                                    <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                    </div>
                                </div>

                                <!-- Ações -->
                                <div class="space-y-3">
                                    <a href="{{ route('collect-points.dashboard') }}"
                                        class="block w-full bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-4 rounded-lg text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 flex items-center justify-center group">
                                        <i data-lucide="map-pin"
                                            class="w-4 h-4 mr-2 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                        Encontrar Pontos de Coleta
                                    </a>
                                    <a href="{{ route('ranking') }}"
                                        class="block w-full bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-4 rounded-lg text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 flex items-center justify-center group">
                                        <i data-lucide="trophy"
                                            class="w-4 h-4 mr-2 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                        Ver Ranking
                                    </a>
                                    <a href="{{ route('resgates.index') }}"
                                        class="block w-full bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-4 rounded-lg text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 flex items-center justify-center group">
                                        <i data-lucide="key"
                                            class="w-4 h-4 mr-2 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                        Meus Resgates
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif

                @if (Auth::user()->nivel_permissao == 'empresa')
                    <!-- DASHBOARD DA EMPRESA -->
                    <section class="mb-20">
                        <h2 class="text-3xl md:text-4xl font-bold text-white text-center mb-12">Painel da Empresa</h2>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                            <!-- Visão Geral -->
                            <div
                                class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                                <!-- Cabeçalho -->
                                <div class="text-center mb-6">
                                    <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                        <i data-lucide="trending-up" class="w-5 h-5 mr-2 text-lime-400"></i>
                                        Visão Geral
                                    </h3>
                                    <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                    </div>
                                </div>

                                <!-- Estatísticas -->
                                <div class="space-y-4">
                                    <div
                                        class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                        <span class="text-gray-300 text-sm">Recompensas Ativas:</span>
                                        <span
                                            class="text-lime-400 font-bold text-lg">{{ Auth::user()->empresa->rewards->count() }}</span>
                                    </div>
                                    <div
                                        class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                        <span class="text-gray-300 text-sm">Anúncios Publicados:</span>
                                        <span
                                            class="text-lime-400 font-bold text-lg">{{ Auth::user()->empresa->advertisements->count() }}</span>
                                    </div>
                                    <div
                                        class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                        <span class="text-gray-300 text-sm">Resgates Validados:</span>
                                        <span
                                            class="text-lime-400 font-bold text-lg">{{ Auth::user()->empresa->rewards->sum(function ($reward) {return $reward->resgates->where('status', 'utilizado')->count();}) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Gestão Rápida -->
                            <div
                                class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                                <!-- Cabeçalho -->
                                <div class="text-center mb-6">
                                    <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                        <i data-lucide="settings" class="w-5 h-5 mr-2 text-lime-400"></i>
                                        Gestão Rápida
                                    </h3>
                                    <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                    </div>
                                </div>

                                <!-- Ações -->
                                <div class="space-y-3">
                                    <a href="{{ route('rewards.create') }}"
                                        class="block w-full bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-4 rounded-lg text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 flex items-center justify-center group">
                                        <i data-lucide="plus"
                                            class="w-4 h-4 mr-2 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                        Nova Recompensa
                                    </a>
                                    <a href="{{ route('advertisements.create') }}"
                                        class="block w-full bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-4 rounded-lg text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 flex items-center justify-center group">
                                        <i data-lucide="megaphone"
                                            class="w-4 h-4 mr-2 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                        Novo Anúncio
                                    </a>
                                    <a href="{{ route('empresas.resgates.validar.page') }}"
                                        class="block w-full bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-4 rounded-lg text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 flex items-center justify-center group">
                                        <i data-lucide="key"
                                            class="w-4 h-4 mr-2 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                        Validar Resgates
                                    </a>
                                </div>
                            </div>

                            <!-- Recompensas Populares -->
                            <div
                                class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                                <!-- Cabeçalho -->
                                <div class="text-center mb-6">
                                    <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                        <i data-lucide="star" class="w-5 h-5 mr-2 text-lime-400"></i>
                                        Recompensas Populares
                                    </h3>
                                    <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                    </div>
                                </div>

                                <!-- Recompensas -->
                                <div class="space-y-3 mb-4">
                                    @php
                                        $recompensasPopulares = Auth::user()
                                            ->empresa->rewards()
                                            ->withCount('resgates')
                                            ->orderBy('resgates_count', 'desc')
                                            ->limit(3)
                                            ->get();
                                    @endphp
                                    @forelse($recompensasPopulares as $recompensa)
                                        <div
                                            class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                            <span
                                                class="text-gray-300 text-sm">{{ Str::limit($recompensa->titulo, 20) }}</span>
                                            <span class="text-lime-400 text-sm font-bold">{{ $recompensa->resgates_count }}
                                                resgates</span>
                                        </div>
                                    @empty
                                        <p class="text-gray-400 text-sm text-center">Crie recompensas para atrair usuários!</p>
                                    @endforelse
                                </div>

                                <!-- Link Gerenciar -->
                                <a href="{{ route('rewards.my') }}"
                                    class="block text-center text-lime-400 hover:text-lime-300 transition-colors flex items-center justify-center group">
                                    Gerenciar Recompensas
                                    <i data-lucide="arrow-right"
                                        class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </section>
                @endif

                @if (Auth::user()->nivel_permissao == 'admin')
                    <!-- DASHBOARD ADMINISTRATIVO -->
                    <section class="mb-20">
                        <h2 class="text-3xl md:text-4xl font-bold text-white text-center mb-12">Painel Administrativo</h2>

                        <!-- Métricas Gerais -->
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-12">
                            <!-- Usuários Cadastrados -->
                            <div
                                class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors text-center">
                                <div class="text-3xl font-bold text-lime-400 mb-2">
                                    {{ \App\Models\User::where('nivel_permissao', 'cadastrado')->count() }}
                                </div>
                                <div class="text-gray-300 flex items-center justify-center text-sm">
                                    <i data-lucide="users" class="w-4 h-4 mr-1"></i>
                                    Usuários Cadastrados
                                </div>
                            </div>

                            <!-- Empresas Parceiras -->
                            <div
                                class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors text-center">
                                <div class="text-3xl font-bold text-lime-400 mb-2">{{ \App\Models\Empresa::count() }}</div>
                                <div class="text-gray-300 flex items-center justify-center text-sm">
                                    <i data-lucide="building" class="w-4 h-4 mr-1"></i>
                                    Empresas Parceiras
                                </div>
                            </div>

                            <!-- Recompensas Ativas -->
                            <div
                                class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors text-center">
                                <div class="text-3xl font-bold text-lime-400 mb-2">{{ \App\Models\Reward::count() }}</div>
                                <div class="text-gray-300 flex items-center justify-center text-sm">
                                    <i data-lucide="award" class="w-4 h-4 mr-1"></i>
                                    Recompensas Ativas
                                </div>
                            </div>

                            <!-- Total de Resgates -->
                            <div
                                class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors text-center">
                                <div class="text-3xl font-bold text-lime-400 mb-2">{{ \App\Models\CadastradoReward::count() }}
                                </div>
                                <div class="text-gray-300 flex items-center justify-center text-sm">
                                    <i data-lucide="key" class="w-4 h-4 mr-1"></i>
                                    Total de Resgates
                                </div>
                            </div>
                        </div>

                        <!-- Ações de Administração -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Gestão de Usuários -->
                            <div
                                class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                                <!-- Cabeçalho -->
                                <div class="text-center mb-6">
                                    <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                        <i data-lucide="users" class="w-5 h-5 mr-2 text-lime-400"></i>
                                        Gestão de Usuários
                                    </h3>
                                    <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                    </div>
                                </div>

                                <!-- Ações -->
                                <div class="space-y-3">
                                    <a href="{{ route('users.index') }}"
                                        class="block w-full bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-4 rounded-lg text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 flex items-center justify-center group">
                                        <i data-lucide="user-check"
                                            class="w-4 h-4 mr-2 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                        Gerenciar Usuários Cadastrados
                                    </a>
                                    <a href="{{ route('empresas.index') }}"
                                        class="block w-full bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-4 rounded-lg text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 flex items-center justify-center group">
                                        <i data-lucide="briefcase"
                                            class="w-4 h-4 mr-2 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                        Gerenciar Empresas
                                    </a>
                                </div>
                            </div>

                            <!-- Configurações do Sistema -->
                            <div
                                class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                                <!-- Cabeçalho -->
                                <div class="text-center mb-6">
                                    <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                        <i data-lucide="settings" class="w-5 h-5 mr-2 text-lime-400"></i>
                                        Configurações do Sistema
                                    </h3>
                                    <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                    </div>
                                </div>

                                <!-- Ações -->
                                <div class="space-y-3">
                                    <a href="{{ route('materials.index') }}"
                                        class="block w-full bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-4 rounded-lg text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 flex items-center justify-center group">
                                        <i data-lucide="recycle"
                                            class="w-4 h-4 mr-2 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                        Gerenciar Materiais
                                    </a>
                                    <a href="{{ route('collect-points.index') }}"
                                        class="block w-full bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-4 rounded-lg text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 flex items-center justify-center group">
                                        <i data-lucide="map-pin"
                                            class="w-4 h-4 mr-2 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                        Gerenciar Pontos de Coleta
                                    </a>
                                    <a href="{{ route('feedbacks.index') }}"
                                        class="block w-full bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-4 rounded-lg text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 flex items-center justify-center group">
                                        <i data-lucide="message-square"
                                            class="w-4 h-4 mr-2 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                        Ver Feedbacks
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            @endauth

            <!-- Recursos Principais - Timeline (CONTEÚDO ORIGINAL) -->
            <section class="mb-20">
                <h3 class="text-3xl md:text-4xl font-bold text-white text-center mb-16">Recursos Principais</h3>

                <div class="relative">
                    <div
                        class="absolute left-1/2 transform -translate-x-1/2 w-1 bg-gradient-to-b from-emerald-900 via-teal-600 to-emerald-900 h-full timeline-line">
                    </div>

                    <!-- Item 1 - Coleta Inteligente -->
                    <div class="flex items-center mb-20 timeline-item" data-direction="right">
                        <div class="w-1/2 pr-8 text-right">
                            <div
                                class="bg-slate-800 rounded-2xl p-8 shadow-xl border border-gray-700 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 card-hover">
                                <h3 class="text-2xl font-bold text-white mb-4">Coleta Inteligente</h3>
                                <p class="text-gray-300 leading-relaxed mb-4">
                                    Agende coletas de materiais recicláveis de forma prática e eficiente.
                                    Nossa plataforma disponibiliza um mapa interativo para te ajudar a encontrar os pontos
                                    de coleta mais próximos.
                                </p>
                                <div class="flex justify-end">
                                    <div
                                        class="bg-gradient-to-r from-emerald-900 to-teal-600 text-white px-4 py-2 rounded-full text-sm font-semibold badge-glow">
                                        Sustentabilidade
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative z-10 flex items-center justify-center">
                            <div
                                class="w-20 h-20 bg-gradient-to-r from-green-950 via-emerald-900 to-green-800 rounded-full flex items-center justify-center shadow-lg ring-4 ring-teal-600 ring-opacity-30 circle-pulse">
                                <i data-lucide="map-pin" class="w-10 h-10 text-lime-300"></i>
                            </div>
                        </div>
                        <div class="w-1/2 pl-8"></div>
                    </div>

                    <!-- Item 2 - Sistema de Pontos -->
                    <div class="flex items-center mb-20 timeline-item" data-direction="left">
                        <div class="w-1/2 pr-8"></div>
                        <div class="relative z-10 flex items-center justify-center">
                            <div
                                class="w-20 h-20 bg-gradient-to-r from-green-950 via-emerald-900 to-green-800 rounded-full flex items-center justify-center shadow-lg ring-4 ring-teal-600 ring-opacity-30 circle-pulse">
                                <i data-lucide="sparkles" class="w-10 h-10 text-lime-300"></i>
                            </div>
                        </div>
                        <div class="w-1/2 pl-8">
                            <div
                                class="bg-slate-800 rounded-2xl p-8 shadow-xl border border-gray-700 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 card-hover">
                                <h3 class="text-2xl font-bold text-white mb-4">Sistema de Pontos</h3>
                                <p class="text-gray-300 leading-relaxed mb-4">
                                    Ganhe pontos a cada material reciclado. Quanto mais você recicla,
                                    mais pontos acumula para trocar por recompensas incríveis.
                                </p>
                                <div class="flex justify-start">
                                    <div
                                        class="bg-gradient-to-r from-emerald-900 to-teal-600 text-white px-4 py-2 rounded-full text-sm font-semibold badge-glow">
                                        Gamificação
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 - Recompensas Reais -->
                    <div class="flex items-center mb-20 timeline-item" data-direction="right">
                        <div class="w-1/2 pr-8 text-right">
                            <div
                                class="bg-slate-800 rounded-2xl p-8 shadow-xl border border-gray-700 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 card-hover">
                                <h3 class="text-2xl font-bold text-white mb-4">Recompensas Reais</h3>
                                <p class="text-gray-300 leading-relaxed mb-4">
                                    Troque seus pontos por produtos, descontos e benefícios em empresas parceiras.
                                    Sua consciência ambiental tem valor real.
                                </p>
                                <div class="flex justify-end">
                                    <div
                                        class="bg-gradient-to-r from-emerald-900 to-teal-600 text-white px-4 py-2 rounded-full text-sm font-semibold badge-glow">
                                        Benefícios
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative z-10 flex items-center justify-center">
                            <div
                                class="w-20 h-20 bg-gradient-to-r from-green-950 via-emerald-900 to-green-800 rounded-full flex items-center justify-center shadow-lg ring-4 ring-teal-600 ring-opacity-30 circle-pulse">
                                <i data-lucide="gift" class="w-10 h-10 text-lime-300"></i>
                            </div>
                        </div>
                        <div class="w-1/2 pl-8"></div>
                    </div>

                    <!-- Item 4 - Impacto Ambiental -->
                    <div class="flex items-center mb-20 timeline-item" data-direction="left">
                        <div class="w-1/2 pr-8"></div>
                        <div class="relative z-10 flex items-center justify-center">
                            <div
                                class="w-20 h-20 bg-gradient-to-r from-green-950 via-emerald-900 to-green-800 rounded-full flex items-center justify-center shadow-lg ring-4 ring-teal-600 ring-opacity-30 circle-pulse">
                                <i data-lucide="leaf" class="w-10 h-10 text-lime-300"></i>
                            </div>
                        </div>
                        <div class="w-1/2 pl-8">
                            <div
                                class="bg-slate-800 rounded-2xl p-8 shadow-xl border border-gray-700 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 card-hover">
                                <h3 class="text-2xl font-bold text-white mb-4">Impacto Ambiental</h3>
                                <p class="text-gray-300 leading-relaxed mb-4">
                                    Acompanhe o impacto positivo das suas ações no meio ambiente.
                                    Veja quantos recursos você ajudou a preservar e o CO₂ que evitou.
                                </p>
                                <div class="flex justify-start">
                                    <div
                                        class="bg-gradient-to-r from-emerald-900 to-teal-600 text-white px-4 py-2 rounded-full text-sm font-semibold badge-glow">
                                        Consciência
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Recursos Adicionais - Cards Grid (CONTEÚDO ORIGINAL) -->
            <section class="mb-20">
                <h3 class="text-3xl md:text-4xl font-bold text-white text-center mb-16">Recursos Adicionais</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Card 1 - Anúncios Sustentáveis -->
                    <div
                        class="bg-slate-800 rounded-xl p-6 shadow-lg border border-gray-700 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 additional-card">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-emerald-600 to-teal-500 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="megaphone" class="w-6 h-6 text-white"></i>
                        </div>
                        <h4 class="text-lg font-bold text-white mb-2">Anúncios Sustentáveis</h4>
                        <p class="text-gray-400 text-sm">Destaque sua marca em um espaço ecológico e engajado.
                        </p>
                    </div>

                    <!-- Card 2 - Parcerias Estratégicas -->
                    <div
                        class="bg-slate-800 rounded-xl p-6 shadow-lg border border-gray-700 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 additional-card">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-emerald-600 to-teal-500 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="heart-handshake" class="w-6 h-6 text-white"></i>
                        </div>
                        <h4 class="text-lg font-bold text-white mb-2">Parcerias Estratégicas</h4>
                        <p class="text-gray-400 text-sm">Colaboramos com empresas para expandir nossa rede de coleta.</p>
                    </div>

                    <!-- Card 3 - Educação Ambiental -->
                    <div
                        class="bg-slate-800 rounded-xl p-6 shadow-lg border border-gray-700 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 additional-card">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-emerald-600 to-teal-500 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="book-open-check" class="w-6 h-6 text-white"></i>
                        </div>
                        <h4 class="text-lg font-bold text-white mb-2">Educação Ambiental</h4>
                        <p class="text-gray-400 text-sm">Conteúdo educativo sobre reciclagem e sustentabilidade.</p>
                    </div>

                    <!-- Card 4 - Tecnologia e Inovação -->
                    <div
                        class="bg-slate-800 rounded-xl p-6 shadow-lg border border-gray-700 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 additional-card">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-emerald-600 to-teal-500 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="cpu" class="w-6 h-6 text-white"></i>
                        </div>
                        <h4 class="text-lg font-bold text-white mb-2">Tecnologia e Inovação</h4>
                        <p class="text-gray-400 text-sm">Tecnologias avançadas para otimizar coleta e recompensas.</p>
                    </div>
                </div>
            </section>

            @guest
                <!-- Seção Call-to-Action para Empresas Parceiras (CONTEÚDO ORIGINAL) -->
                <section class="mb-20 cta-section">
                    <div
                        class="relative bg-gradient-to-r from-emerald-900 via-teal-800 to-emerald-900 rounded-3xl p-12 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-lime-400/10 via-transparent to-emerald-600/10">
                        </div>
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-lime-400/5 rounded-full -translate-y-32 translate-x-32">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-48 h-48 bg-teal-400/5 rounded-full translate-y-24 -translate-x-24">
                        </div>

                        <div class="relative z-10 text-center">
                            <div class="mb-8">
                                <h3 class="text-4xl md:text-5xl font-bold text-white mb-4">
                                    Torne-se um <span class="text-lime-400">Parceiro</span>
                                </h3>
                                <p class="text-xl text-gray-200 max-w-3xl mx-auto leading-relaxed">
                                    Junte-se à causa sustentável! Conecte sua empresa ao Perseph e ofereça recompensas
                                    exclusivas
                                    para milhares de usuários engajados com a sustentabilidade.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                                <div class="text-center cta-benefit">
                                    <div
                                        class="w-16 h-16 bg-lime-400/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="eye" class="w-8 h-8 text-lime-400"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-white mb-2">Visibilidade Sustentável</h4>
                                    <p class="text-gray-300 text-sm">Destaque sua marca para um público consciente e engajado
                                    </p>
                                </div>

                                <div class="text-center cta-benefit">
                                    <div
                                        class="w-16 h-16 bg-lime-400/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="trending-up" class="w-8 h-8 text-lime-400"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-white mb-2">Crescimento de Vendas</h4>
                                    <p class="text-gray-300 text-sm">Aumente suas vendas através do nosso sistema de
                                        anúncios</p>
                                </div>

                                <div class="text-center cta-benefit">
                                    <div
                                        class="w-16 h-16 bg-lime-400/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="trees" class="w-8 h-8 text-lime-400"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-white mb-2">Impacto Positivo</h4>
                                    <p class="text-gray-300 text-sm">Contribua para um futuro mais sustentável e melhore sua
                                        imagem</p>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row justify-center gap-6">
                                <a href="mailto:l.melozi@aluno.ifsp.edu.br"
                                    class="bg-lime-500 text-slate-900 px-8 py-4 rounded-full text-lg font-bold hover:bg-lime-400 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 cta-button-primary">
                                    Quero ser Parceiro
                                </a>
                                <a href="{{ route('company.info.partnerships') }}"
                                    class="bg-transparent border-2 border-lime-400 text-lime-400 px-8 py-4 rounded-full text-lg font-bold hover:bg-lime-400 hover:text-slate-900 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 cta-button-secondary">
                                    Saiba Mais
                                </a>
                            </div>

                            <div class="mt-8 pt-8 border-t border-lime-400/20">
                                <p class="text-gray-300 text-sm">
                                    Dúvidas? Entre em contato:
                                    <a href="mailto:parcerias@perseph.com"
                                        class="text-lime-400 hover:text-lime-300 transition-colors">
                                        parcerias@perseph.com
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            @endguest

            @auth
                @if (Auth::user()->nivel_permissao == 'cadastrado')
                    @php
                        $meuFeedback = \App\Models\Feedback::where(
                            'cadastrado_id',
                            Auth::user()->cadastrado->id,
                        )->first();
                    @endphp

                    @if (!$meuFeedback)
                        <!-- Incluir componente de feedbacks -->
                        @include('components.feedback-section')
                    @endif
                @endif
            @endauth

        </div>
    </div>

@endsection
