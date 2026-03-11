@extends('layouts.main')

@section('title', $user->name . ' - Detalhes do Usuário')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <!-- Botão de Voltar -->
            <div class="max-w-6xl mx-auto mb-8">
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-lime-300 transition-colors group">
                    <i data-lucide="arrow-left"
                        class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:-translate-x-1"></i>
                    Voltar para Usuários
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
                                <div class="flex items-center space-x-6">
                                    <!-- Avatar -->
                                    <div class="flex-shrink-0">
                                        @if ($user->profile_photo_path)
                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                                alt="Foto de {{ $user->name }}"
                                                class="w-24 h-24 rounded-full object-cover border-4 border-lime-500/50">
                                        @else
                                            <div
                                                class="w-24 h-24 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center border-4 border-lime-500/50">
                                                <i data-lucide="user" class="w-12 h-12 text-white"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Informações Básicas -->
                                    <div>
                                        <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2">{{ $user->name }}
                                        </h1>
                                        <div class="flex items-center space-x-4 mb-4">
                                            <span
                                                class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-500/20 text-blue-400 border border-blue-500/30">
                                                {{ $user->tipo_usuario }}
                                            </span>
                                            <div class="flex items-center text-gray-400">
                                                <i data-lucide="mail" class="w-4 h-4 mr-1"></i>
                                                <span>{{ $user->email }}</span>
                                            </div>
                                        </div>
                                        <div class="text-sm text-gray-400">
                                            Cadastrado em {{ $user->created_at->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="text-right">
                                    <div class="text-sm text-gray-400 mb-2">Status</div>
                                    <span
                                        class="px-3 py-1 text-sm font-semibold rounded-full bg-green-500/20 text-green-400 border border-green-500/30">
                                        Ativo
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Informações do Cadastrado -->
                        @if ($user->cadastrado)
                            <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-8 mb-8">
                                <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                                    <i data-lucide="user-check" class="w-6 h-6 text-lime-400 mr-2"></i>
                                    Informações do Cadastrado
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-gray-900/50 rounded-lg p-6 border border-gray-700">
                                        <div class="space-y-4">
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-400">CPF:</span>
                                                <span
                                                    class="text-white font-mono">{{ $user->cadastrado->cpf_formatado }}</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-400">Coletas Realizadas:</span>
                                                <span
                                                    class="text-lime-400 font-bold">{{ $user->cadastrado->coletas_realizadas }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gray-900/50 rounded-lg p-6 border border-gray-700">
                                        <div class="space-y-4">
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-400">Pontuação Total:</span>
                                                <span
                                                    class="text-lime-400 font-bold text-xl">{{ number_format($user->cadastrado->pontuacao_total) }}
                                                    pts</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-400">Pontos Gastos:</span>
                                                <span
                                                    class="text-amber-400 font-bold">{{ number_format($user->cadastrado->pontuacao_gasta) }}
                                                    pts</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-400">Pontos Disponíveis:</span>
                                                <span
                                                    class="text-green-400 font-bold">{{ number_format($user->cadastrado->pontos_disponiveis) }}
                                                    pts</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Histórico de Resgates -->
                        @if ($user->cadastrado && $user->cadastrado->resgates->count() > 0)
                            <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-8">
                                <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                                    <i data-lucide="history" class="w-6 h-6 text-purple-400 mr-2"></i>
                                    Histórico de Resgates
                                </h2>

                                <div class="space-y-4">
                                    @foreach ($user->cadastrado->resgates->take(5) as $resgate)
                                        <div
                                            class="flex items-center justify-between p-4 bg-gray-900/50 rounded-lg border border-gray-700 hover:bg-gray-800/50 transition-colors">
                                            <div class="flex items-center space-x-4">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-purple-500/20 flex items-center justify-center">
                                                    <i data-lucide="gift" class="w-5 h-5 text-purple-400"></i>
                                                </div>
                                                <div>
                                                    <div class="text-white font-medium">{{ $resgate->reward->titulo }}
                                                    </div>
                                                    <div class="text-sm text-gray-400">
                                                        {{ $resgate->reward->empresa->user->name }} •
                                                        {{ $resgate->created_at->format('d/m/Y H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-lime-400 font-bold">
                                                    {{ number_format($resgate->pontos_gastos) }} pts</div>
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full 
                                        {{ $resgate->status == 'pendente' ? 'bg-yellow-500/20 text-yellow-400' : '' }}
                                        {{ $resgate->status == 'utilizado' ? 'bg-green-500/20 text-green-400' : '' }}
                                        {{ $resgate->status == 'pendente' && $resgate->data_expiracao->isPast() ? 'bg-red-500/20 text-red-400' : '' }}
                                        {{ $resgate->status == 'reembolsado' ? 'bg-blue-500/20 text-blue-400' : '' }}">
                                                    {{ ucfirst($resgate->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if ($user->cadastrado->resgates->count() > 5)
                                        <div class="text-center pt-4">
                                            <a href="{{ route('admin.resgates.index') }}?search={{ $user->email }}&fields[]=usuario"
                                                class="inline-flex items-center text-sm text-lime-400 hover:text-lime-300 transition-colors">
                                                <span>Ver todos os {{ $user->cadastrado->resgates->count() }}
                                                    resgates</span>
                                                <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @elseif($user->cadastrado)
                            <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-8 text-center">
                                <i data-lucide="shopping-cart" class="w-16 h-16 text-gray-500 mx-auto mb-4"></i>
                                <h3 class="text-lg font-medium text-white mb-2">Nenhum resgate realizado</h3>
                                <p class="text-gray-400">Este usuário ainda não resgatou nenhuma recompensa.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Coluna da Direita: Informações Adicionais -->
                    <div class="space-y-8">
                        <!-- Estatísticas Rápidas -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-6">
                            <h3 class="text-xl font-bold text-white mb-4">Estatísticas</h3>
                            <dl class="space-y-4">
                                @if ($user->cadastrado)
                                    <div class="flex justify-between items-center">
                                        <dt class="text-gray-400">Total de Resgates</dt>
                                        <dd class="text-white font-bold">{{ $user->cadastrado->total_resgates }}</dd>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <dt class="text-gray-400">Resgates Pendentes</dt>
                                        <dd class="text-yellow-400 font-bold">
                                            {{ $user->cadastrado->resgates_pendentes_count }}</dd>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <dt class="text-gray-400">Resgates Utilizados</dt>
                                        <dd class="text-green-400 font-bold">
                                            {{ $user->cadastrado->resgates_utilizados_count }}</dd>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <dt class="text-gray-400">Resgates Expirados</dt>
                                        <dd class="text-red-400 font-bold">
                                            {{ $user->cadastrado->resgates_expirados_count }}</dd>
                                    </div>
                                @endif
                                <div class="flex justify-between items-center">
                                    <dt class="text-gray-400">Membro desde</dt>
                                    <dd class="text-white">{{ $user->created_at->format('d/m/Y') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Ações Rápidas -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-6">
                            <h3 class="text-xl font-bold text-white mb-4">Ações</h3>
                            <div class="space-y-3">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="w-full inline-flex items-center justify-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                                    <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                                    Editar Usuário
                                </a>
                                <a href="{{ route('users.index') }}"
                                    class="w-full inline-flex items-center justify-center bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-600 transition">
                                    <i data-lucide="list" class="w-4 h-4 mr-2"></i>
                                    Ver Todos Usuários
                                </a>
                                @if ($user->cadastrado)
                                    <a href="{{ route('admin.resgates.index') }}?search={{ $user->email }}&fields[]=usuario"
                                        class="w-full inline-flex items-center justify-center bg-purple-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-purple-700 transition">
                                        <i data-lucide="shopping-cart" class="w-4 h-4 mr-2"></i>
                                        Ver Resgates
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Informações de Contato -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-6">
                            <h3 class="text-xl font-bold text-white mb-4">Contato</h3>
                            <div class="space-y-3">
                                <div class="flex items-center text-gray-300">
                                    <i data-lucide="mail" class="w-4 h-4 mr-3 text-lime-400"></i>
                                    <span>{{ $user->email }}</span>
                                </div>
                                <div class="flex items-center text-gray-300">
                                    <i data-lucide="calendar" class="w-4 h-4 mr-3 text-lime-400"></i>
                                    <span>Cadastrado há {{ $user->created_at->diffForHumans() }}</span>
                                </div>
                                @if ($user->email_verified_at)
                                    <div class="flex items-center text-green-400">
                                        <i data-lucide="check-circle" class="w-4 h-4 mr-3"></i>
                                        <span>Email verificado</span>
                                    </div>
                                @else
                                    <div class="flex items-center text-yellow-400">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-3"></i>
                                        <span>Email não verificado</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Feedback do Usuário -->
                        @if ($user->cadastrado && $user->cadastrado->feedback)
                            <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-6">
                                <h3 class="text-xl font-bold text-white mb-4">Feedback</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center text-yellow-400">
                                        <span class="text-lg">{{ $user->cadastrado->feedback->avaliacao_estrelas }}</span>
                                    </div>
                                    <p class="text-gray-300 text-sm italic">
                                        "{{ $user->cadastrado->feedback->conteudo }}"
                                    </p>
                                    <div class="text-xs text-gray-400">
                                        Enviado em {{ $user->cadastrado->feedback->created_at->format('d/m/Y') }}
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
