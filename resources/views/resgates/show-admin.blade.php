@extends('layouts.main')

@section('title', 'Detalhes do Resgate - ' . $resgate->codigo_resgate)

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <!-- Botão de Voltar -->
            <div class="max-w-6xl mx-auto mb-8">
                <a href="{{ route('admin.resgates.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-lime-300 transition-colors group">
                    <i data-lucide="arrow-left"
                        class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:-translate-x-1"></i>
                    Voltar para Resgates
                </a>
            </div>

            <!-- Conteúdo Principal -->
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <!-- Coluna da Esquerda: Informações Principais -->
                    <div class="lg:col-span-2">
                        <!-- Cabeçalho -->
                        <div
                            class="bg-gradient-to-b from-gray-800 to-slate-900 rounded-2xl shadow-xl border border-gray-700/50 p-8 mb-8">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2">Resgate
                                        #{{ $resgate->codigo_resgate }}</h1>
                                    <div class="flex items-center space-x-4 mb-4">
                                        <span
                                            class="px-3 py-1 text-sm font-semibold rounded-full 
                                        {{ $resgate->status == 'pendente' && !$resgate->data_expiracao->isPast() ? 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30' : '' }}
                                        {{ $resgate->status == 'utilizado' ? 'bg-green-500/20 text-green-400 border border-green-500/30' : '' }}
                                        {{ $resgate->status == 'pendente' && $resgate->data_expiracao->isPast() ? 'bg-red-500/20 text-red-400 border border-red-500/30' : '' }}
                                        {{ $resgate->status == 'reembolsado' ? 'bg-blue-500/20 text-blue-400 border border-blue-500/30' : '' }}">
                                            @if ($resgate->status == 'pendente' && $resgate->data_expiracao->isPast())
                                                Expirado
                                            @else
                                                {{ ucfirst($resgate->status) }}
                                            @endif
                                        </span>
                                        <div class="flex items-center text-lime-400">
                                            <i data-lucide="star" class="w-5 h-5 mr-1"></i>
                                            <span
                                                class="text-xl font-bold">{{ number_format($resgate->pontos_gastos) }}</span>
                                            <span class="text-sm ml-1">pontos</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-16 h-16 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center shadow-lg">
                                        <i data-lucide="key" class="w-8 h-8 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informações do Usuário -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-8 mb-8">
                            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                                <i data-lucide="user" class="w-6 h-6 text-blue-400 mr-2"></i>
                                Informações do Usuário
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gray-900/50 rounded-lg p-6 border border-gray-700">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center">
                                                <i data-lucide="user" class="w-6 h-6 text-blue-400"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-lg font-semibold text-white">
                                                {{ $resgate->cadastrado->user->name }}</div>
                                            <div class="text-sm text-gray-400">{{ $resgate->cadastrado->user->email }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-900/50 rounded-lg p-6 border border-gray-700">
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">CPF:</span>
                                            <span
                                                class="text-white font-mono">{{ $resgate->cadastrado->cpf_formatado }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Total de Pontos:</span>
                                            <span
                                                class="text-lime-400 font-semibold">{{ number_format($resgate->cadastrado->pontuacao_total) }}
                                                pts</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Pontos Gastos:</span>
                                            <span
                                                class="text-amber-400 font-semibold">{{ number_format($resgate->cadastrado->pontuacao_gasta) }}
                                                pts</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informações da Recompensa -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-8 mb-8">
                            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                                <i data-lucide="gift" class="w-6 h-6 text-purple-400 mr-2"></i>
                                Informações da Recompensa
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gray-900/50 rounded-lg p-6 border border-gray-700">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-purple-400 mb-2">{{ $resgate->reward->titulo }}
                                        </div>
                                        <div class="text-sm text-gray-400">{{ $resgate->reward->descricao }}</div>
                                    </div>
                                </div>

                                <div class="bg-gray-900/50 rounded-lg p-6 border border-gray-700">
                                    <div class="space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Pontos Necessários:</span>
                                            <span
                                                class="text-lime-400 font-semibold">{{ number_format($resgate->reward->pontos_necessarios) }}
                                                pts</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-400">Estoque:</span>
                                            <span
                                                class="text-amber-400 font-semibold">{{ number_format($resgate->reward->qtd_disponivel) }}
                                                unidades</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Histórico do Resgate -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-8">
                            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                                <i data-lucide="history" class="w-6 h-6 text-green-400 mr-2"></i>
                                Histórico do Resgate
                            </h2>

                            <div class="space-y-4">
                                <div
                                    class="flex items-center justify-between p-4 bg-gray-900/50 rounded-lg border border-gray-700">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-500/20 flex items-center justify-center">
                                            <i data-lucide="shopping-cart" class="w-4 h-4 text-blue-400"></i>
                                        </div>
                                        <div>
                                            <div class="text-white font-medium">Resgate Realizado</div>
                                            <div class="text-sm text-gray-400">Solicitação do resgate</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-white">{{ $resgate->created_at->format('d/m/Y H:i') }}</div>
                                        <div class="text-sm text-gray-400">{{ $resgate->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>

                                @if ($resgate->data_expiracao->isFuture())
                                    <div
                                        class="flex items-center justify-between p-4 bg-gray-900/50 rounded-lg border border-gray-700">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-8 h-8 rounded-full {{ $resgate->data_expiracao->isPast() ? 'bg-red-500/20' : 'bg-yellow-500/20' }} flex items-center justify-center">
                                                <i data-lucide="clock"
                                                    class="w-4 h-4 {{ $resgate->data_expiracao->isPast() ? 'text-red-400' : 'text-yellow-400' }}"></i>
                                            </div>
                                            <div>
                                                <div class="text-white font-medium">Expiração</div>
                                                <div class="text-sm text-gray-400">Data de expiração do código</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-white">{{ $resgate->data_expiracao->format('d/m/Y H:i') }}
                                            </div>
                                            <div
                                                class="text-sm {{ $resgate->data_expiracao->isPast() ? 'text-red-400' : 'text-yellow-400' }}">
                                                {{ $resgate->data_expiracao->isPast() ? 'Expirado' : $resgate->tempo_restante }}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($resgate->data_utilizacao)
                                    <div
                                        class="flex items-center justify-between p-4 bg-gray-900/50 rounded-lg border border-gray-700">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center">
                                                <i data-lucide="check-circle" class="w-4 h-4 text-green-400"></i>
                                            </div>
                                            <div>
                                                <div class="text-white font-medium">Utilização</div>
                                                <div class="text-sm text-gray-400">Código utilizado</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-white">{{ $resgate->data_utilizacao->format('d/m/Y H:i') }}
                                            </div>
                                            <div class="text-sm text-gray-400">
                                                {{ $resgate->data_utilizacao->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if ($resgate->data_reembolso)
                                    <div
                                        class="flex items-center justify-between p-4 bg-gray-900/50 rounded-lg border border-gray-700">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-blue-500/20 flex items-center justify-center">
                                                <i data-lucide="refresh-ccw" class="w-4 h-4 text-blue-400"></i>
                                            </div>
                                            <div>
                                                <div class="text-white font-medium">Reembolso</div>
                                                <div class="text-sm text-gray-400">Pontos devolvidos</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-white">{{ $resgate->data_reembolso->format('d/m/Y H:i') }}
                                            </div>
                                            <div class="text-sm text-gray-400">
                                                {{ $resgate->data_reembolso->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Coluna da Direita: Informações Adicionais -->
                    <div class="space-y-8">
                        <!-- Código de Resgate -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-6">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                                <i data-lucide="key" class="w-5 h-5 text-amber-400 mr-2"></i>
                                Código de Resgate
                            </h3>
                            <div class="bg-gray-900/80 rounded-lg p-4 border-2 border-amber-500/30">
                                <div class="text-center">
                                    <div class="text-2xl font-mono font-bold text-amber-400 tracking-wider">
                                        {{ $resgate->codigo_resgate }}
                                    </div>
                                    <div class="text-sm text-gray-400 mt-2">Código único para validação</div>
                                </div>
                            </div>
                        </div>

                        <!-- Empresa Parceira -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-6">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                                <i data-lucide="building" class="w-5 h-5 text-emerald-400 mr-2"></i>
                                Empresa Parceira
                            </h3>
                            <div class="bg-gray-900/50 rounded-lg p-4 border border-gray-700">
                                <div class="text-center">
                                    <div class="text-lg font-semibold text-white mb-1">
                                        {{ $resgate->reward->empresa->user->name }}</div>
                                    <div class="text-sm text-gray-400">{{ $resgate->reward->empresa->cnpj_formatado }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Detalhado -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-6">
                            <h3 class="text-xl font-bold text-white mb-4">Status do Resgate</h3>
                            <dl class="space-y-3">
                                <div class="flex justify-between">
                                    <dt class="text-gray-400">Status Atual</dt>
                                    <dd
                                        class="font-medium 
                                    {{ $resgate->status == 'pendente' && !$resgate->data_expiracao->isPast() ? 'text-yellow-400' : '' }}
                                    {{ $resgate->status == 'utilizado' ? 'text-green-400' : '' }}
                                    {{ $resgate->status == 'pendente' && $resgate->data_expiracao->isPast() ? 'text-red-400' : '' }}
                                    {{ $resgate->status == 'reembolsado' ? 'text-blue-400' : '' }}">
                                        @if ($resgate->status == 'pendente' && $resgate->data_expiracao->isPast())
                                            <span class="text-red-400 font-semibold block">
                                                Expirado
                                            </span>
                                        @else
                                            <span class="font-semibold block">
                                                {{ ucfirst($resgate->status) }}
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-gray-400">Pontos Gastos</dt>
                                    <dd class="text-lime-400 font-bold">{{ number_format($resgate->pontos_gastos) }} pts
                                    </dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-gray-400">Data do Resgate</dt>
                                    <dd class="text-gray-300">{{ $resgate->created_at->format('d/m/Y H:i') }}</dd>
                                </div>
                                @if ($resgate->data_expiracao)
                                    <div class="flex justify-between">
                                        <dt class="text-gray-400">
                                            @if ($resgate->status == 'pendente' && $resgate->data_expiracao->isPast())
                                                Expirou em
                                            @else
                                                Expira em
                                            @endif
                                        </dt>
                                        <dd class="text-gray-300">{{ $resgate->data_expiracao->format('d/m/Y H:i') }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        <!-- Ações Administrativas -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-6">
                            <h3 class="text-xl font-bold text-white mb-4">Ações</h3>
                            <div class="space-y-3">
                                <a href="{{ route('admin.resgates.index') }}"
                                    class="w-full inline-flex items-center justify-center bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-600 transition">
                                    <i data-lucide="list" class="w-4 h-4 mr-2"></i>
                                    Ver Todos Resgates
                                </a>
                                <button onclick="window.history.back()"
                                    class="w-full inline-flex items-center justify-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                                    Voltar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
