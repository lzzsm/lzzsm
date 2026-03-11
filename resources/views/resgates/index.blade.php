@extends('layouts.main')

@section('title', 'Meus Resgates')

@section('content')

    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-7xl mx-auto">

                <!-- Cabeçalho -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-white mb-3">Meus Resgates</h1>
                    <p class="text-gray-400 text-lg max-w-2xl mx-auto">Acompanhe todas as recompensas que você resgatou com
                        seus pontos</p>
                </div>

                <!-- Cards de Estatísticas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <!-- Card Pontos Gastos -->
                    <div
                        class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-700/50 shadow-lg">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-500/10 rounded-xl mr-4">
                                <i data-lucide="coins" class="w-8 h-8 text-yellow-400"></i>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Total de Pontos Gastos</p>
                                <p class="text-3xl font-bold text-yellow-400 mt-1">
                                    {{ number_format(Auth::user()->cadastrado->pontuacao_gasta ?? 0, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Total Resgatado -->
                    <div
                        class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-700/50 shadow-lg">
                        <div class="flex items-center">
                            <div class="p-3 bg-lime-500/10 rounded-xl mr-4">
                                <i data-lucide="gift" class="w-8 h-8 text-lime-400"></i>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Recompensas Resgatadas</p>
                                <p class="text-3xl font-bold text-lime-400 mt-1">
                                    {{ $resgates->total() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Resgates Ativos -->
                    <div
                        class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-700/50 shadow-lg">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-500/10 rounded-xl mr-4">
                                <i data-lucide="clock" class="w-8 h-8 text-blue-400"></i>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Resgates Ativos</p>
                                <p class="text-3xl font-bold text-blue-400 mt-1">
                                    {{ $resgates->where('status', 'pendente')->where('data_expiracao', '>', now())->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($resgates->count() > 0)
                    <!-- Grid de Resgates -->
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                        @foreach ($resgates as $resgate)
                            @php
                                // Verificar se o resgate expirou e atualizar status se necessário
                                $estaExpirado = $resgate->status === 'pendente' && $resgate->data_expiracao->isPast();

                                // Agora usar o status atualizado
                                $diasRestantes = $resgate->data_expiracao
                                    ? $resgate->data_expiracao->diffInDays(now(), false) * -1
                                    : 0;
                                $statusCor = match ($resgate->status) {
                                    'pendente' => 'blue',
                                    'utilizado' => 'green',
                                    'expirado' => 'red',
                                    'reembolsado' => 'gray',
                                    default => 'gray',
                                };
                                $diasCor = $diasRestantes <= 3 ? 'red' : 'gray';
                            @endphp
                            <div
                                class="group bg-gradient-to-br from-gray-800/80 to-gray-900/80 rounded-2xl shadow-2xl overflow-hidden border border-gray-700/30 hover:border-lime-500/50 transition-all duration-500 hover:scale-[1.02] hover:shadow-lime-500/10">

                                <!-- Imagem -->
                                <div class="relative overflow-hidden">
                                    @if ($resgate->reward && $resgate->reward->img_recompensa)
                                        <img class="w-full h-52 object-cover transition-transform duration-700 group-hover:scale-110"
                                            src="{{ asset('storage/' . $resgate->reward->img_recompensa) }}"
                                            alt="{{ $resgate->reward->titulo ?? 'Recompensa' }}">
                                    @else
                                        <div
                                            class="w-full h-52 bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                                            <i data-lucide="gift"
                                                class="w-16 h-16 text-gray-500 group-hover:text-lime-400 transition-colors"></i>
                                        </div>
                                    @endif

                                    <!-- Overlay gradient -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent"></div>

                                    <!-- Status -->
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="bg-{{ $resgate->status === 'pendente' && $resgate->data_expiracao->isPast() ? 'red' : $statusCor }}-500/20 text-{{ $resgate->status === 'pendente' && $resgate->data_expiracao->isPast() ? 'red' : $statusCor }}-300 text-xs font-bold px-3 py-1 rounded-full border border-{{ $resgate->status === 'pendente' && $resgate->data_expiracao->isPast() ? 'red' : $statusCor }}-500/30">
                                            @if ($resgate->status == 'pendente' && $resgate->data_expiracao->isPast())
                                                Expirado
                                            @else
                                                {{ ucfirst($resgate->status) }}
                                            @endif
                                        </span>
                                    </div>

                                    <!-- Data Expiração -->
                                    <div class="absolute top-4 right-4">
                                        @if ($resgate->status === 'pendente' && !$resgate->data_expiracao->isPast())
                                            <span
                                                class="bg-black/40 text-{{ $diasCor }}-300 text-xs px-3 py-2 rounded-full border border-{{ $diasCor }}-600/50">
                                                {{ $diasRestantes }} dias
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="p-6">
                                    <!-- Título -->
                                    <h3
                                        class="text-xl font-bold text-white mb-3 line-clamp-2 group-hover:text-lime-300 transition-colors">
                                        {{ $resgate->reward->titulo ?? 'Recompensa Indisponível' }}
                                    </h3>

                                    <!-- Descrição -->
                                    @if ($resgate->reward && $resgate->reward->descricao)
                                        <p class="text-gray-400 text-sm mb-6 line-clamp-3 leading-relaxed">
                                            {{ $resgate->reward->descricao }}
                                        </p>
                                    @endif

                                    <!-- Informações -->
                                    <div class="space-y-4 mb-6">
                                        <!-- Pontos Gastos -->
                                        <div
                                            class="flex items-center justify-between p-3 bg-gray-700/30 rounded-xl border border-gray-600/30">
                                            <div class="flex items-center">
                                                <i data-lucide="coins" class="w-5 h-5 text-yellow-400 mr-3"></i>
                                                <span class="text-gray-300 font-medium">Pontos Gastos</span>
                                            </div>
                                            <span class="text-yellow-400 font-bold text-lg">
                                                {{ number_format($resgate->pontos_gastos, 0, ',', '.') }}
                                            </span>
                                        </div>

                                        <!-- Status e Expiração -->
                                        <div
                                            class="flex items-center justify-between p-3 bg-gray-700/30 rounded-xl border border-gray-600/30">
                                            <div class="flex items-center">
                                                <i data-lucide="clock" class="w-5 h-5 text-blue-400 mr-3"></i>
                                                <span class="text-gray-300 font-medium">Status</span>
                                            </div>
                                            <div class="text-right">

                                                @if ($resgate->status == 'pendente' && $resgate->data_expiracao->isPast())
                                                    <span class="text-red-400 font-semibold block">
                                                        Expirado
                                                    </span>
                                                @else
                                                    <span class="text-{{ $statusCor }}-400 font-semibold block">
                                                        {{ ucfirst($resgate->status) }}
                                                    </span>
                                                @endif

                                                @if ($resgate->status === 'pendente' && !$resgate->data_expiracao->isPast())
                                                    <span class="text-{{ $diasCor }}-400 text-xs">
                                                        Expira em {{ $diasRestantes }} dias
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Data de Expiração -->
                                        @if ($resgate->data_expiracao)
                                            <div
                                                class="flex items-center justify-between p-3 bg-gray-700/30 rounded-xl border border-gray-600/30">
                                                <div class="flex items-center">
                                                    <i data-lucide="calendar" class="w-5 h-5 text-purple-400 mr-3"></i>
                                                    <span class="text-gray-300 font-medium">
                                                        @if ($resgate->status === 'pendente' && $resgate->data_expiracao->isPast())
                                                            Expirou em
                                                        @else
                                                            Expira em
                                                        @endif
                                                    </span>
                                                </div>
                                                <span class="text-gray-300 font-semibold">
                                                    {{ $resgate->data_expiracao->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Botão de Detalhes -->
                                    <div class="pt-4 border-t border-gray-700/50">
                                        <a href="{{ route('resgates.show', $resgate->id) }}"
                                            class="w-full inline-flex items-center justify-center px-6 py-3 bg-lime-500 hover:bg-lime-400 text-slate-900 font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:shadow-lime-500/25 group/btn">
                                            <span>Ver Detalhes</span>
                                            <i data-lucide="arrow-right"
                                                class="w-4 h-4 ml-2 transition-transform duration-300 group-hover/btn:translate-x-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Paginação -->
                    @if ($resgates->hasPages())
                        <div class="mt-12 flex justify-center">
                            <div class="bg-gray-800/50 rounded-2xl p-4 border border-gray-700/30">
                                {{ $resgates->links() }}
                            </div>
                        </div>
                    @endif
                @else
                    <!-- Estado Vazio -->
                    <div class="text-center py-20">
                        <div class="max-w-md mx-auto">
                            <div
                                class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl p-12 border border-gray-700/50 shadow-2xl">
                                <div
                                    class="w-24 h-24 mx-auto mb-6 bg-lime-500/10 rounded-2xl flex items-center justify-center">
                                    <i data-lucide="gift" class="w-12 h-12 text-lime-400"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-white mb-3">Nenhum resgate encontrado</h3>
                                <p class="text-gray-400 text-lg mb-8 leading-relaxed">
                                    Você ainda não resgatou nenhuma recompensa. Explore nossas recompensas disponíveis e
                                    comece a usar seus pontos!
                                </p>
                                <a href="{{ route('rewards.dashboard') }}"
                                    class="inline-flex items-center px-8 py-4 bg-lime-500 hover:bg-lime-400 text-slate-900 font-bold text-lg rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-lime-500/30 group">
                                    <i data-lucide="sparkles"
                                        class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:rotate-12"></i>
                                    Explorar Recompensas
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    
@endsection
