@extends('layouts.main')

@section('title', 'Meus Pontos')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Cabeçalho -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white">Meus Pontos</h1>
                    <p class="text-gray-400 mt-2">Acompanhe sua pontuação e resgate recompensas</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-400">Atualizado em</div>
                    <div class="text-white font-medium">{{ now()->format('d/m/Y H:i') }}</div>
                </div>
            </div>

            <!-- Grid Principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Coluna Esquerda - Saldo e Métricas -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Card de Saldo Principal -->
                    <div
                        class="bg-gradient-to-br from-emerald-900/50 to-teal-800/50 rounded-2xl p-6 border border-emerald-700/30">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-300">Saldo Disponível</h2>
                            <div class="w-8 h-8 bg-emerald-500/20 rounded-full flex items-center justify-center">
                                <i data-lucide="award" class="w-4 h-4 text-emerald-400"></i>
                            </div>
                        </div>

                        <div class="text-center py-4">
                            <div class="text-6xl font-bold text-emerald-400 mb-2">
                                {{ Auth::user()->cadastrado->pontos_disponiveis ?? 0 }}</div>
                            <p class="text-emerald-300 text-lg">pontos</p>
                        </div>

                        <div class="flex justify-between items-center mt-6 text-sm">
                            <div class="text-center">
                                <div class="text-gray-400">Total Ganho</div>
                                <div class="text-lime-300 font-semibold">
                                    {{ Auth::user()->cadastrado->pontuacao_total ?? 0 }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-gray-400">Pontos Gastos</div>
                                <div class="text-amber-300 font-semibold">
                                    {{ Auth::user()->cadastrado->pontuacao_gasta ?? 0 }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-gray-400">Coletas</div>
                                <div class="text-cyan-300 font-semibold">
                                    {{ Auth::user()->cadastrado->coletas_realizadas ?? 0 }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Ações Rápidas -->
                    <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700">
                        <h3 class="text-lg font-semibold text-white mb-4">Ações Rápidas</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <a href="{{ route('collects.create') }}"
                                class="group bg-slate-700/50 rounded-lg p-4 text-center border border-slate-600 hover:border-emerald-500 transition-all duration-200">
                                <div
                                    class="w-10 h-10 bg-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-2 group-hover:bg-emerald-500/30">
                                    <i data-lucide="plus" class="w-5 h-5 text-emerald-400"></i>
                                </div>
                                <span class="text-sm text-gray-300 group-hover:text-emerald-300">Nova Coleta</span>
                            </a>

                            <a href="{{ route('rewards.dashboard') }}"
                                class="group bg-slate-700/50 rounded-lg p-4 text-center border border-slate-600 hover:border-blue-500 transition-all duration-200">
                                <div
                                    class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center mx-auto mb-2 group-hover:bg-blue-500/30">
                                    <i data-lucide="gift" class="w-5 h-5 text-blue-400"></i>
                                </div>
                                <span class="text-sm text-gray-300 group-hover:text-blue-300">Recompensas</span>
                            </a>

                            <a href="{{ route('collect-points.dashboard') }}"
                                class="group bg-slate-700/50 rounded-lg p-4 text-center border border-slate-600 hover:border-cyan-500 transition-all duration-200">
                                <div
                                    class="w-10 h-10 bg-cyan-500/20 rounded-full flex items-center justify-center mx-auto mb-2 group-hover:bg-cyan-500/30">
                                    <i data-lucide="map-pin" class="w-5 h-5 text-cyan-400"></i>
                                </div>
                                <span class="text-sm text-gray-300 group-hover:text-cyan-300">Pontos de Coleta</span>
                            </a>

                            <a href="{{ route('ranking') }}"
                                class="group bg-slate-700/50 rounded-lg p-4 text-center border border-slate-600 hover:border-yellow-500 transition-all duration-200">
                                <div
                                    class="w-10 h-10 bg-yellow-500/20 rounded-full flex items-center justify-center mx-auto mb-2 group-hover:bg-yellow-500/30">
                                    <i data-lucide="trophy" class="w-5 h-5 text-yellow-400"></i>
                                </div>
                                <span class="text-sm text-gray-300 group-hover:text-yellow-300">Ranking</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Coluna Direita - Estatísticas e Progresso -->
                <div class="space-y-6">

                    <!-- Estatísticas -->
                    <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700">
                        <h3 class="text-lg font-semibold text-white mb-4">Estatísticas</h3>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-cyan-500/20 rounded-full flex items-center justify-center">
                                        <i data-lucide="recycle" class="w-5 h-5 text-cyan-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-400">Coletas Realizadas</p>
                                        <p class="text-lg font-semibold text-white">
                                            {{ Auth::user()->cadastrado->coletas_realizadas ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                                        <i data-lucide="shopping-bag" class="w-5 h-5 text-blue-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-400">Resgates Feitos</p>
                                        <p class="text-lg font-semibold text-white">
                                            {{ Auth::user()->cadastrado->resgates_count ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-purple-500/20 rounded-full flex items-center justify-center">
                                        <i data-lucide="bar-chart-3" class="w-5 h-5 text-purple-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-400">Média por Coleta</p>
                                        <p class="text-lg font-semibold text-white">
                                            @php
                                                $coletas = Auth::user()->cadastrado->coletas_realizadas ?? 0;
                                                $total = Auth::user()->cadastrado->pontuacao_total ?? 0;
                                                $media = $coletas > 0 ? round($total / $coletas, 1) : 0;
                                            @endphp
                                            {{ $media }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
