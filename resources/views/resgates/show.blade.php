@extends('layouts.main')

@section('title', 'Detalhes do Resgate')

@section('content')

    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-5xl mx-auto">

                <!-- Botão Voltar -->
                <div class="flex justify-between items-center mb-8">
                    <a href="{{ route('resgates.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-lime-300 transition-colors group">
                        <i data-lucide="arrow-left"
                            class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:-translate-x-1"></i>
                        Voltar para Meus Resgates
                    </a>

                    <p class="text-sm text-gray-400">
                        Resgatado em {{ $resgate->created_at->format('d/m/Y \\à\\s H:i') }}
                    </p>
                </div>

                <!-- Conteúdo Principal -->
                <div
                    class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl shadow-2xl overflow-hidden border border-gray-700/30">

                    <!-- Header com Status -->
                    <div
                        class="bg-gradient-to-r from-{{ $resgate->status === 'pendente' && !$resgate->data_expiracao->isPast() ? 'lime' : ($resgate->status === 'utilizado' ? 'green' : 'red') }}-500/20 to-{{ $resgate->status === 'pendente' && !$resgate->data_expiracao->isPast() ? 'emerald' : ($resgate->status === 'utilizado' ? 'teal' : 'orange') }}-500/20 p-8 border-b border-gray-700/50">
                        <div class="text-center">
                            <div
                                class="inline-flex items-center px-4 py-2 bg-{{ $resgate->status === 'pendente' && !$resgate->data_expiracao->isPast() ? 'lime' : ($resgate->status === 'utilizado' ? 'green' : 'red') }}-500/10 rounded-2xl border border-{{ $resgate->status === 'pendente' ? 'lime' : ($resgate->status === 'utilizado' ? 'green' : 'red') }}-500/20 mb-4">
                                <i data-lucide="{{ $resgate->status === 'pendente' && !$resgate->data_expiracao->isPast() ? 'clock' : ($resgate->status === 'utilizado' ? 'check-circle' : 'x-circle') }}"
                                    class="w-6 h-6 text-{{ $resgate->status === 'pendente' && !$resgate->data_expiracao->isPast() ? 'lime' : ($resgate->status === 'utilizado' ? 'green' : 'red') }}-400 mr-2"></i>
                                <span
                                    class="text-{{ $resgate->status === 'pendente' && !$resgate->data_expiracao->isPast() ? 'lime' : ($resgate->status === 'utilizado' ? 'green' : 'red') }}-300 font-semibold">
                                    {{ $resgate->status === 'pendente' && $resgate->data_expiracao->isPast() ? 'Resgate Expirado' : ($resgate->status === 'pendente' && !$resgate->data_expiracao->isPast() ? 'Resgate Pendente' : 'Resgate ' . ucfirst($resgate->status)) }}
                                </span>
                            </div>
                            <h2 class="text-2xl font-bold text-white">Detalhes do Resgate</h2>
                            <p class="text-gray-400 mt-2">Código: <strong
                                    class="text-lime-300 text-xl">{{ $resgate->codigo_resgate }}</strong></p>
                        </div>
                    </div>

                    <div class="p-8">
                        <!-- Grid de Informações -->
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-8">

                            <!-- Informações do Resgate -->
                            <div>
                                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                                    <i data-lucide="receipt" class="w-6 h-6 text-blue-400 mr-3"></i>
                                    Informações do Resgate
                                </h3>

                                <div class="space-y-4">
                                    <!-- Código do Resgate -->
                                    <div
                                        class="flex items-center justify-between p-4 bg-gray-700/30 rounded-2xl border border-gray-600/30">
                                        <div class="flex items-center">
                                            <div class="p-2 bg-lime-500/10 rounded-lg mr-4">
                                                <i data-lucide="key" class="w-5 h-5 text-lime-400"></i>
                                            </div>
                                            <span class="text-gray-300 font-medium">Código do Resgate</span>
                                        </div>
                                        <span
                                            class="text-lime-400 font-bold text-lg font-mono">{{ $resgate->codigo_resgate }}</span>
                                    </div>

                                    <!-- Status -->
                                    <div
                                        class="flex items-center justify-between p-4 bg-gray-700/30 rounded-2xl border border-gray-600/30">
                                        <div class="flex items-center">
                                            <div
                                                class="p-2 bg-{{ $resgate->status === 'pendente' && !$resgate->data_expiracao->isPast() ? 'blue' : ($resgate->status === 'utilizado' ? 'green' : 'red') }}-500/10 rounded-lg mr-4">
                                                <i data-lucide="{{ $resgate->status === 'pendente' && !$resgate->data_expiracao->isPast() ? 'clock' : ($resgate->status === 'utilizado' ? 'check-circle' : 'x-circle') }}"
                                                    class="w-5 h-5 text-{{ $resgate->status === 'pendente' && !$resgate->data_expiracao->isPast() ? 'blue' : ($resgate->status === 'utilizado' ? 'green' : 'red') }}-400"></i>
                                            </div>
                                            <span class="text-gray-300 font-medium">Status</span>
                                        </div>
                                        <span
                                            class="text-{{ $resgate->status === 'pendente' && !$resgate->data_expiracao->isPast() ? 'blue' : ($resgate->status === 'utilizado' ? 'green' : 'red') }}-400 font-semibold">
                                            @if ($resgate->status == 'pendente' && $resgate->data_expiracao->isPast())
                                                Expirado
                                            @else
                                                {{ ucfirst($resgate->status) }}
                                            @endif
                                        </span>
                                    </div>

                                    <!-- Data de Expiração -->
                                    @if ($resgate->status === 'pendente' && !$resgate->data_expiracao->isPast() && $resgate->data_expiracao)
                                        @php
                                            $diasRestantes = $resgate->data_expiracao->diffInDays(now(), false);
                                            $corTexto = $diasRestantes <= 3 ? 'red' : 'orange';
                                        @endphp
                                        <div
                                            class="flex items-center justify-between p-4 bg-gray-700/30 rounded-2xl border border-gray-600/30">
                                            <div class="flex items-center">
                                                <div class="p-2 bg-{{ $corTexto }}-500/10 rounded-lg mr-4">
                                                    <i data-lucide="calendar"
                                                        class="w-5 h-5 text-{{ $corTexto }}-400"></i>
                                                </div>
                                                <span class="text-gray-300 font-medium">Expira em</span>
                                            </div>
                                            <div class="text-right">
                                                <span class="text-{{ $corTexto }}-400 font-semibold block">
                                                    {{ $resgate->data_expiracao->format('d/m/Y') }}
                                                </span>
                                                <span class="text-{{ $corTexto }}-400 text-xs">
                                                    ({{ abs($diasRestantes) }} dias restantes)
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Pontos Gastos -->
                                    <div
                                        class="flex items-center justify-between p-4 bg-gray-700/30 rounded-2xl border border-gray-600/30">
                                        <div class="flex items-center">
                                            <div class="p-2 bg-yellow-500/10 rounded-lg mr-4">
                                                <i data-lucide="coins" class="w-5 h-5 text-yellow-400"></i>
                                            </div>
                                            <span class="text-gray-300 font-medium">Pontos Gastos</span>
                                        </div>
                                        <span
                                            class="text-yellow-400 font-bold text-lg">{{ number_format($resgate->pontos_gastos, 0, ',', '.') }}
                                            pts</span>
                                    </div>

                                    <!-- Data do Resgate -->
                                    <div
                                        class="flex items-center justify-between p-4 bg-gray-700/30 rounded-2xl border border-gray-600/30">
                                        <div class="flex items-center">
                                            <div class="p-2 bg-blue-500/10 rounded-lg mr-4">
                                                <i data-lucide="calendar" class="w-5 h-5 text-blue-400"></i>
                                            </div>
                                            <span class="text-gray-300 font-medium">Resgatado em</span>
                                        </div>
                                        <span
                                            class="text-white font-semibold">{{ $resgate->created_at->format('d/m/Y H:i') }}</span>
                                    </div>

                                    <!-- ID -->
                                    <div
                                        class="flex items-center justify-between p-4 bg-gray-700/30 rounded-2xl border border-gray-600/30">
                                        <div class="flex items-center">
                                            <div class="p-2 bg-gray-500/10 rounded-lg mr-4">
                                                <i data-lucide="hash" class="w-5 h-5 text-gray-400"></i>
                                            </div>
                                            <span class="text-gray-300 font-medium">ID do Resgate</span>
                                        </div>
                                        <span
                                            class="font-mono text-gray-300 bg-black/20 px-3 py-1 rounded-lg">#{{ $resgate->id }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Recompensa Resgatada -->
                            <div>
                                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                                    <i data-lucide="award" class="w-6 h-6 text-purple-400 mr-3"></i>
                                    Recompensa Resgatada
                                </h3>

                                <div class="bg-gray-700/30 rounded-2xl p-6 border border-gray-600/30">
                                    @if ($resgate->reward->img_recompensa)
                                        <div class="w-full h-40 mb-4 bg-gray-600 rounded-xl overflow-hidden">
                                            <img class="w-full h-full object-cover"
                                                src="{{ asset('storage/' . $resgate->reward->img_recompensa) }}"
                                                alt="{{ $resgate->reward->titulo }}">
                                        </div>
                                    @else
                                        <div
                                            class="w-full h-40 mb-4 bg-gradient-to-br from-gray-600 to-gray-700 rounded-xl flex items-center justify-center">
                                            <i data-lucide="gift" class="w-12 h-12 text-gray-500"></i>
                                        </div>
                                    @endif

                                    <h4 class="text-xl font-bold text-white mb-3">{{ $resgate->reward->titulo }}</h4>

                                    @if ($resgate->reward->descricao)
                                        <p class="text-gray-300 mb-4 leading-relaxed">{{ $resgate->reward->descricao }}</p>
                                    @endif

                                    <div
                                        class="flex items-center p-3 bg-yellow-500/10 rounded-xl border border-yellow-500/20 mb-4">
                                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 mr-3"></i>
                                        <div>
                                            <span class="text-yellow-300 font-semibold block">Valor Original</span>
                                            <span
                                                class="text-yellow-400">{{ number_format($resgate->reward->pontos_necessarios, 0, ',', '.') }}
                                                pontos</span>
                                        </div>
                                    </div>

                                    <!-- Empresa -->
                                    <div
                                        class="flex items-center p-3 bg-blue-500/10 rounded-xl border border-blue-500/20 mb-4">
                                        <i data-lucide="building" class="w-5 h-5 text-blue-400 mr-3"></i>
                                        <div>
                                            <span class="text-blue-300 font-semibold block">Empresa</span>
                                            <span
                                                class="text-blue-400">{{ $resgate->reward->empresa->user->name ?? 'N/A' }}</span>
                                        </div>
                                    </div>

                                    <!-- Link para detalhes da recompensa -->
                                    <a href="{{ route('rewards.show', $resgate->reward->id) }}"
                                        class="inline-flex items-center text-sm font-medium text-lime-400 hover:text-lime-300 transition-colors group">
                                        Ver detalhes da recompensa
                                        <i data-lucide="arrow-right"
                                            class="w-4 h-4 ml-1 transition-transform duration-300 group-hover:translate-x-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Instruções de Uso -->
                        @if ($resgate->status === 'pendente' && !$resgate->data_expiracao->isPast())
                            @php
                                $diasRestantes = $resgate->data_expiracao->diffInDays(now(), false);
                            @endphp
                            <div
                                class="bg-gradient-to-r from-lime-500/10 to-emerald-500/10 rounded-2xl p-6 border border-lime-500/20 mb-6">
                                <div class="flex items-start">
                                    <div class="p-3 bg-lime-500/20 rounded-xl mr-4">
                                        <i data-lucide="info" class="w-6 h-6 text-lime-400"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-lime-300 mb-3">Como usar sua recompensa</h3>
                                        <p class="text-gray-300 leading-relaxed mb-4">
                                            Apresente o código <strong
                                                class="text-lime-300 text-xl font-mono">{{ $resgate->codigo_resgate }}</strong>
                                            no estabelecimento da empresa <strong
                                                class="text-white">{{ $resgate->reward->empresa->user->name ?? '' }}</strong>
                                            para utilizar sua recompensa.
                                        </p>
                                        <div class="bg-lime-500/5 border border-lime-500/20 rounded-xl p-4">
                                            <p class="text-lime-300 text-sm font-medium">
                                                <i data-lucide="alert-triangle" class="w-4 h-4 inline mr-2"></i>
                                                Este código expira em {{ $resgate->data_expiracao->format('d/m/Y') }}
                                                ({{ abs($diasRestantes) }} dias).
                                                Após esta data, os pontos serão reembolsados automaticamente.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Histórico de Utilização -->
                        @if ($resgate->status === 'utilizado' && $resgate->data_utilizacao)
                            <div
                                class="bg-gradient-to-r from-green-500/10 to-teal-500/10 rounded-2xl p-6 border border-green-500/20">
                                <div class="flex items-start">
                                    <div class="p-3 bg-green-500/20 rounded-xl mr-4">
                                        <i data-lucide="check-circle" class="w-6 h-6 text-green-400"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-green-300 mb-3">Recompensa Utilizada</h3>
                                        <p class="text-gray-300 leading-relaxed">
                                            Esta recompensa foi utilizada com sucesso em
                                            <strong
                                                class="text-green-300">{{ $resgate->data_utilizacao->format('d/m/Y \\à\\s H:i') }}</strong>.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Seção de Reembolso -->
                        @if ($resgate->status === 'pendente' && $resgate->data_expiracao && $resgate->data_expiracao->isFuture())
                            <div class="mt-8 pt-8 border-t border-gray-700/50">
                                <div
                                    class="bg-gradient-to-r from-orange-500/10 to-red-500/10 rounded-2xl p-6 border border-orange-500/20">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="p-3 bg-orange-500/20 rounded-xl mr-4">
                                                <i data-lucide="rotate-ccw" class="w-6 h-6 text-orange-400"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-orange-300 mb-1">Não vai usar a
                                                    recompensa?</h3>
                                                <p class="text-gray-400 text-sm">Solicite o reembolso e receba seus pontos
                                                    de volta</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('resgates.reembolsar.page', $resgate->id) }}"
                                            class="inline-flex items-center px-6 py-3 bg-orange-500 hover:bg-orange-400 text-slate-900 font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:shadow-orange-500/25">
                                            <i data-lucide="coins" class="w-5 h-5 mr-2"></i>
                                            Solicitar Reembolso
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
