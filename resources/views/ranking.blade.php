@extends('layouts.main')

@section('title', 'Ranking de Usuários')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Header -->
            <div class="mb-12 text-center">
                <h1
                    class="text-5xl font-black text-white mb-4 bg-gradient-to-r from-yellow-400 to-lime-400 bg-clip-text text-transparent">
                    <i data-lucide="trophy" class="w-12 h-12 inline mr-4"></i>
                    Ranking de Sustentabilidade
                </h1>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                    Compita e suba no ranking através de suas ações sustentáveis. Cada reciclagem conta!
                </p>
            </div>

            <!-- Estatísticas Expandidas -->
            <div class="mb-12 grid grid-cols-1 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                <div
                    class="bg-gradient-to-br from-gray-800 to-slate-900 rounded-2xl p-6 border border-gray-700 hover:border-lime-400/30 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-white">{{ $users->count() }}</p>
                            <p class="text-gray-400 text-sm mt-1">Competidores</p>
                        </div>
                        <i data-lucide="users" class="w-8 h-8 text-lime-400"></i>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-br from-gray-800 to-slate-900 rounded-2xl p-6 border border-gray-700 hover:border-yellow-400/30 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-white">{{ $users->max('cadastrado.pontuacao_total') ?? 0 }}
                            </p>
                            <p class="text-gray-400 text-sm mt-1">Recorde</p>
                        </div>
                        <i data-lucide="award" class="w-8 h-8 text-yellow-400"></i>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-br from-gray-800 to-slate-900 rounded-2xl p-6 border border-gray-700 hover:border-blue-400/30 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-white">
                                {{ number_format($users->avg('cadastrado.pontuacao_total') ?? 0, 0) }}</p>
                            <p class="text-gray-400 text-sm mt-1">Média</p>
                        </div>
                        <i data-lucide="activity" class="w-8 h-8 text-blue-400"></i>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-br from-gray-800 to-slate-900 rounded-2xl p-6 border border-gray-700 hover:border-green-400/30 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-white">{{ $users->sum('cadastrado.coletas_realizadas') ?? 0 }}
                            </p>
                            <p class="text-gray-400 text-sm mt-1">Total de Coletas</p>
                        </div>
                        <i data-lucide="recycle" class="w-8 h-8 text-green-400"></i>
                    </div>
                </div>
            </div>

            <!-- Seu Progresso (se usuário estiver logado) -->
            @auth
                @if (Auth::user()->nivel_permissao == 'cadastrado' && Auth::user()->cadastrado)
                    @php
                        $meuCadastrado = Auth::user()->cadastrado;
                        $minhaPontuacao = $meuCadastrado->pontuacao_total ?? 0;
                        $minhaPosicao =
                            $users->search(function ($user) {
                                return $user->id === Auth::user()->id;
                            }) + 1;
                        $totalUsuarios = $users->count();
                        $percentual =
                            $totalUsuarios > 0 ? (($totalUsuarios - $minhaPosicao + 1) / $totalUsuarios) * 100 : 0;
                    @endphp

                    <div class="mb-12 max-w-4xl mx-auto">
                        <div
                            class="bg-gradient-to-r from-lime-400/10 to-emerald-600/10 rounded-2xl p-6 border border-lime-400/30">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-xl font-bold text-white flex items-center">
                                    <i data-lucide="user" class="w-5 h-5 text-lime-400 mr-2"></i>
                                    Seu Desempenho
                                </h2>
                                <div class="text-lime-400 font-bold text-lg">
                                    {{ $minhaPosicao }}º Lugar
                                </div>
                            </div>

                            <div class="space-y-4">
                                <!-- Barra de Progresso -->
                                <div>
                                    <div class="flex justify-between text-sm text-gray-300 mb-2">
                                        <span>Seu posicionamento</span>
                                        <span>{{ number_format($percentual, 1) }}% ({{ $minhaPosicao }} de
                                            {{ $totalUsuarios }})</span>
                                    </div>
                                    <div class="w-full bg-gray-700 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-lime-400 to-emerald-600 h-3 rounded-full"
                                            style="width: {{ $percentual }}%"></div>
                                    </div>
                                </div>

                                <!-- Métricas Pessoais -->
                                <div class="grid grid-cols-3 gap-4 text-center">
                                    <div>
                                        <div class="text-2xl font-bold text-white">{{ $minhaPontuacao }}</div>
                                        <div class="text-xs text-gray-400">Pontos</div>
                                    </div>
                                    <div>
                                        <div class="text-2xl font-bold text-white">
                                            {{ $meuCadastrado->coletas_realizadas ?? 0 }}</div>
                                        <div class="text-xs text-gray-400">Coletas</div>
                                    </div>
                                    <div>
                                        <div class="text-2xl font-bold text-white">
                                            {{ $meuCadastrado->pontos_disponiveis ?? 0 }}</div>
                                        <div class="text-xs text-gray-400">Disponíveis</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth

            @if ($users->count() >= 3)
                <!-- Pódio Melhorado -->
                <div class="mb-12 max-w-6xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-white mb-2">Pódio dos Campeões</h2>
                        <p class="text-gray-400">Os maiores contribuidores para um planeta mais sustentável</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                        <!-- 2º Lugar -->
                        <div class="text-center">
                            <div class="relative">
                                <!-- Medalha -->
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-gray-400 to-slate-500 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-gray-400 shadow-lg">
                                    <i data-lucide="medal" class="w-10 h-10 text-slate-900"></i>
                                </div>

                                <!-- Card do Usuário -->
                                <div
                                    class="bg-gradient-to-br from-gray-800 to-slate-900 rounded-2xl p-6 border-2 border-gray-400/50 shadow-xl">
                                    <!-- Foto de Perfil -->
                                    @if($users[1]->profile_photo_path)
                                        <img src="{{ asset('storage/' . $users[1]->profile_photo_path) }}" 
                                             alt="{{ $users[1]->name }}"
                                             class="w-16 h-16 rounded-full object-cover mx-auto mb-4 shadow-inner border-2 border-gray-400">
                                    @else
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-gray-400 to-slate-500 rounded-full flex items-center justify-center text-white font-bold text-lg mx-auto mb-4 shadow-inner">
                                            {{ substr($users[1]->name, 0, 2) }}
                                        </div>
                                    @endif

                                    <h3 class="font-bold text-white text-lg mb-2 truncate">{{ $users[1]->name }}</h3>

                                    <div class="space-y-2">
                                        <div
                                            class="flex items-center justify-center space-x-2 bg-gray-700/50 rounded-lg py-2">
                                            <i data-lucide="star" class="w-4 h-4 text-yellow-400"></i>
                                            <span
                                                class="text-yellow-400 font-bold text-lg">{{ number_format($users[1]->cadastrado->pontuacao_total ?? 0) }}</span>
                                        </div>

                                        <div class="flex items-center justify-center space-x-2 text-sm text-gray-300">
                                            <i data-lucide="recycle" class="w-4 h-4 text-green-400"></i>
                                            <span>{{ $users[1]->cadastrado->coletas_realizadas ?? 0 }} coletas</span>
                                        </div>

                                        <div class="flex items-center justify-center space-x-2 text-xs text-gray-400">
                                            <i data-lucide="calendar" class="w-3 h-3"></i>
                                            <span>Desde {{ $users[1]->created_at->format('m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 1º Lugar -->
                        <div class="text-center -mt-8">
                            <div class="relative">
                                <!-- Medalha -->
                                <div
                                    class="w-32 h-32 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-yellow-400 shadow-2xl shadow-yellow-400/40">
                                    <i data-lucide="crown" class="w-12 h-12 text-slate-900"></i>
                                </div>

                                <!-- Card do Usuário -->
                                <div
                                    class="bg-gradient-to-br from-yellow-400/10 to-amber-500/10 rounded-2xl p-8 border-2 border-yellow-400/50 shadow-2xl">
                                    <!-- Foto de Perfil -->
                                    @if($users[0]->profile_photo_path)
                                        <img src="{{ asset('storage/' . $users[0]->profile_photo_path) }}" 
                                             alt="{{ $users[0]->name }}"
                                             class="w-20 h-20 rounded-full object-cover mx-auto mb-4 shadow-inner border-2 border-yellow-400">
                                    @else
                                        <div
                                            class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-full flex items-center justify-center text-slate-900 font-bold text-xl mx-auto mb-4 shadow-inner">
                                            {{ substr($users[0]->name, 0, 2) }}
                                        </div>
                                    @endif

                                    <h3 class="font-bold text-white text-xl mb-3 truncate">{{ $users[0]->name }}</h3>

                                    <div class="space-y-3">
                                        <div
                                            class="flex items-center justify-center space-x-3 bg-yellow-400/20 rounded-lg py-3">
                                            <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
                                            <span
                                                class="text-yellow-400 font-bold text-xl">{{ number_format($users[0]->cadastrado->pontuacao_total ?? 0) }}</span>
                                        </div>

                                        <div class="flex items-center justify-center space-x-2 text-sm text-gray-300">
                                            <i data-lucide="recycle" class="w-4 h-4 text-green-400"></i>
                                            <span class="font-medium">{{ $users[0]->cadastrado->coletas_realizadas ?? 0 }}
                                                coletas realizadas</span>
                                        </div>

                                        <div class="flex items-center justify-center space-x-2 text-xs text-gray-400">
                                            <i data-lucide="zap" class="w-3 h-3 text-yellow-400"></i>
                                            <span>Líder há
                                                {{ \Carbon\Carbon::parse($users[0]->created_at)->diffInDays(now()) }}
                                                dias</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3º Lugar -->
                        <div class="text-center">
                            <div class="relative">
                                <!-- Medalha -->
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-amber-600 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-amber-600 shadow-lg">
                                    <i data-lucide="medal" class="w-10 h-10 text-white"></i>
                                </div>

                                <!-- Card do Usuário -->
                                <div
                                    class="bg-gradient-to-br from-amber-600/10 to-orange-600/10 rounded-2xl p-6 border-2 border-amber-600/50 shadow-xl">
                                    <!-- Foto de Perfil -->
                                    @if($users[2]->profile_photo_path)
                                        <img src="{{ asset('storage/' . $users[2]->profile_photo_path) }}" 
                                             alt="{{ $users[2]->name }}"
                                             class="w-16 h-16 rounded-full object-cover mx-auto mb-4 shadow-inner border-2 border-amber-600">
                                    @else
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-amber-600 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-lg mx-auto mb-4 shadow-inner">
                                            {{ substr($users[2]->name, 0, 2) }}
                                        </div>
                                    @endif

                                    <h3 class="font-bold text-white text-lg mb-2 truncate">{{ $users[2]->name }}</h3>

                                    <div class="space-y-2">
                                        <div
                                            class="flex items-center justify-center space-x-2 bg-amber-600/20 rounded-lg py-2">
                                            <i data-lucide="star" class="w-4 h-4 text-yellow-400"></i>
                                            <span
                                                class="text-yellow-400 font-bold text-lg">{{ number_format($users[2]->cadastrado->pontuacao_total ?? 0) }}</span>
                                        </div>

                                        <div class="flex items-center justify-center space-x-2 text-sm text-gray-300">
                                            <i data-lucide="recycle" class="w-4 h-4 text-green-400"></i>
                                            <span>{{ $users[2]->cadastrado->coletas_realizadas ?? 0 }} coletas</span>
                                        </div>

                                        <div class="flex items-center justify-center space-x-2 text-xs text-gray-400">
                                            <i data-lucide="trending-up" class="w-3 h-3 text-orange-400"></i>
                                            <span>Em ascensão</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Ranking Completo -->
            <div class="max-w-6xl mx-auto">
                <!-- Header -->
                <div class="bg-gradient-to-r from-slate-800 to-gray-900 rounded-2xl p-6 border border-gray-700 mb-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-white flex items-center">
                                <i data-lucide="list-ordered" class="w-6 h-6 text-lime-400 mr-3"></i>
                                Classificação Completa
                            </h2>
                            <p class="text-gray-400 mt-1">Lista completa de todos os competidores</p>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="text-sm text-gray-400 bg-slate-700/50 px-3 py-2 rounded-lg">
                                <i data-lucide="filter" class="w-4 h-4 inline mr-2"></i>
                                {{ $users->count() }} competidores
                            </div>
                            <div class="text-sm text-gray-400 bg-slate-700/50 px-3 py-2 rounded-lg">
                                <i data-lucide="refresh-cw" class="w-4 h-4 inline mr-2"></i>
                                Atualizado agora
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lista de Ranking -->
                <div
                    class="bg-gradient-to-br from-gray-800 to-slate-900 rounded-2xl border border-gray-700 overflow-hidden shadow-2xl">
                    <!-- Cabeçalho da Tabela -->
                    <div
                        class="bg-slate-800/80 px-6 py-4 border-b border-gray-700 grid grid-cols-12 gap-4 text-sm text-gray-400 font-medium">
                        <div class="col-span-1 text-center">POS</div>
                        <div class="col-span-6">USUÁRIO</div>
                        <div class="col-span-2 text-center">COLETAS</div>
                        <div class="col-span-3 text-center">PONTUAÇÃO</div>
                    </div>

                    <!-- Lista de Usuários -->
                    <div class="divide-y divide-gray-700/30">
                        @foreach ($users as $index => $user)
                            @php
                                $posicao = $index + 1;
                                $pontuacao = $user->cadastrado->pontuacao_total ?? 0;
                                $coletas = $user->cadastrado->coletas_realizadas ?? 0;

                                // Classes para as posições
                                $positionClasses = [
                                    1 => 'from-yellow-400 to-amber-500 text-slate-900 border-yellow-400',
                                    2 => 'from-gray-400 to-slate-500 text-white border-gray-400',
                                    3 => 'from-amber-600 to-orange-600 text-white border-amber-600',
                                    'top10' => 'from-lime-400 to-emerald-600 text-white border-lime-400',
                                    'default' => 'from-gray-600 to-slate-700 text-gray-300 border-gray-600',
                                ];

                                $positionClass = $positionClasses['default'];
                                if ($posicao === 1) {
                                    $positionClass = $positionClasses[1];
                                } elseif ($posicao === 2) {
                                    $positionClass = $positionClasses[2];
                                } elseif ($posicao === 3) {
                                    $positionClass = $positionClasses[3];
                                } elseif ($posicao <= 10) {
                                    $positionClass = $positionClasses['top10'];
                                }

                                // Background do card
                                $cardBg = 'bg-gray-800/30';
                                if ($posicao <= 3) {
                                    $cardBg = 'bg-gradient-to-r from-slate-800/50 to-gray-900/50';
                                }
                                if (Auth::check() && Auth::user()->id === $user->id) {
                                    $cardBg = 'bg-lime-400/10 border-l-4 border-lime-400';
                                }
                            @endphp

                            <div class="{{ $cardBg }} transition-colors duration-200 hover:bg-gray-700/40">
                                <div class="px-6 py-4">
                                    <div class="grid grid-cols-12 gap-4 items-center">
                                        <!-- Posição -->
                                        <div class="col-span-1 flex justify-center">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-br {{ $positionClass }} rounded-full flex items-center justify-center text-sm font-bold border-2 shadow-lg">
                                                @if ($posicao <= 3)
                                                    <i data-lucide="crown" class="w-4 h-4"></i>
                                                @else
                                                    {{ $posicao }}º
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Informações do Usuário -->
                                        <div class="col-span-6">
                                            <div class="flex items-center space-x-4">
                                                <!-- Foto de Perfil -->
                                                @if($user->profile_photo_path)
                                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" 
                                                         alt="{{ $user->name }}"
                                                         class="w-14 h-14 rounded-full object-cover shadow-lg border-2 border-lime-400/50">
                                                @else
                                                    <div
                                                        class="w-14 h-14 bg-gradient-to-br from-lime-400 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                                        {{ substr($user->name, 0, 2) }}
                                                    </div>
                                                @endif
                                                
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center space-x-2 mb-1">
                                                        <h3 class="font-semibold text-white text-lg truncate">{{ $user->name }}</h3>
                                                        @if (Auth::check() && Auth::user()->id === $user->id)
                                                            <span
                                                                class="bg-lime-400 text-slate-900 px-2 py-1 rounded-full text-xs font-bold">VOCÊ</span>
                                                        @endif
                                                    </div>
                                                    <div class="flex items-center space-x-4 text-sm text-gray-400">
                                                        <div class="flex items-center space-x-1">
                                                            <i data-lucide="calendar" class="w-3 h-3"></i>
                                                            <span>Desde {{ $user->created_at->format('m/Y') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Coletas -->
                                        <div class="col-span-2 text-center">
                                            <div class="flex flex-col items-center">
                                                <div
                                                    class="flex items-center space-x-2 bg-green-400/10 rounded-lg px-3 py-2">
                                                    <i data-lucide="recycle" class="w-4 h-4 text-green-400"></i>
                                                    <span class="text-white font-bold">{{ $coletas }}</span>
                                                </div>
                                                <span class="text-xs text-gray-400 mt-1">coletas</span>
                                            </div>
                                        </div>

                                        <!-- Pontuação -->
                                        <div class="col-span-3 text-center">
                                            <div class="bg-yellow-400/10 rounded-lg p-3 border border-yellow-400/20">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <i data-lucide="star" class="w-5 h-5 text-yellow-400"></i>
                                                    <span
                                                        class="text-xl font-bold text-white">{{ number_format($pontuacao) }}</span>
                                                </div>
                                                <p class="text-xs text-gray-400 mt-1">pontos totais</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Footer -->
                    <div class="bg-slate-900/80 px-6 py-4 border-t border-gray-700">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-400 gap-2">
                            <div class="flex items-center space-x-4">
                                <span>Atualizado em
                                    {{ now()->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}</span>
                                <span class="hidden sm:block">•</span>
                                <span>{{ $users->count() }} competidores ativos</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i data-lucide="info" class="w-4 h-4"></i>
                                <span>Ranking atualizado automaticamente</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Legenda Expandida -->
                <div class="mt-8 bg-slate-800/50 rounded-2xl p-6 border border-gray-700">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                        <i data-lucide="help-circle" class="w-5 h-5 text-lime-400 mr-2"></i>
                        Como Funciona o Ranking?
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i data-lucide="crown" class="w-6 h-6 text-slate-900"></i>
                            </div>
                            <h4 class="font-semibold text-white mb-1">1º Lugar</h4>
                            <p class="text-sm text-gray-400">Maior pontuação</p>
                        </div>
                        <div class="text-center">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-gray-400 to-slate-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i data-lucide="medal" class="w-6 h-6 text-slate-900"></i>
                            </div>
                            <h4 class="font-semibold text-white mb-1">2º e 3º</h4>
                            <p class="text-sm text-gray-400">Próximos colocados</p>
                        </div>
                        <div class="text-center">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-lime-400 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i data-lucide="sparkles" class="w-6 h-6 text-white"></i>
                            </div>
                            <h4 class="font-semibold text-white mb-1">Top 10</h4>
                            <p class="text-sm text-gray-400">Elite da competição</p>
                        </div>
                        <div class="text-center">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-gray-600 to-slate-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i data-lucide="user" class="w-6 h-6 text-gray-300"></i>
                            </div>
                            <h4 class="font-semibold text-white mb-1">Demais</h4>
                            <p class="text-sm text-gray-400">Restante da competição</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection