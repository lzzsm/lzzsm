@extends('layouts.main')

@section('title', 'Catálogo de Recompensas')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <div class="mb-12 text-center">
                <h1 class="text-4xl font-extrabold text-white tracking-tight">Catálogo de Recompensas</h1>
                <p class="mt-3 text-lg text-gray-400 max-w-3xl mx-auto">
                    Troque seus pontos acumulados por recompensas exclusivas de nossos parceiros.
                </p>

                @auth
                    @if (Auth::user()->nivel_permissao === 'cadastrado')
                        <div
                            class="mt-4 inline-flex items-center px-4 py-2 bg-yellow-400/10 border border-yellow-400/20 rounded-full">
                            <i data-lucide="coins" class="w-4 h-4 text-yellow-400 mr-2"></i>
                            <span class="text-yellow-400 font-semibold">{{ Auth::user()->cadastrado->pontuacao_total ?? 0 }}
                                pontos disponíveis</span>
                        </div>
                    @endif
                @endauth
            </div>

            @if ($rewards->isEmpty())
                <div class="text-center py-16 px-4 bg-gray-800/50 rounded-lg shadow-md border border-gray-700">
                    <i data-lucide="gift" class="mx-auto h-12 w-12 text-gray-500"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-200">Nenhuma recompensa disponível</h3>
                    <p class="mt-1 text-sm text-gray-400">Volte em breve para novas recompensas!</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($rewards as $reward)
                        <div
                            class="bg-gradient-to-b from-gray-800 to-slate-900 rounded-2xl shadow-lg overflow-hidden border border-gray-700/50 flex flex-col transition-transform duration-300 hover:translate-y-1">
                            <!-- Imagem da Recompensa -->
                            <a href="{{ route('rewards.show', $reward->id) }}"
                                class="block h-40 bg-gray-700 flex items-center justify-center group">
                                @if ($reward->img_recompensa)
                                    <img src="{{ asset('storage/' . $reward->img_recompensa) }}" alt="{{ $reward->titulo }}"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                @else
                                    <i data-lucide="gift" class="w-12 h-12 text-gray-500"></i>
                                @endif
                            </a>

                            <div class="p-6 flex-grow flex flex-col">
                                <div class="flex-grow">
                                    <!-- Pontos Necessários -->
                                    <div class="flex items-center mb-2">
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 mr-1"></i>
                                        <span class="text-sm font-semibold text-yellow-400">
                                            {{ $reward->pontos_necessarios }} pontos
                                        </span>
                                    </div>

                                    <h3 class="text-lg font-bold text-white mb-2">{{ $reward->titulo }}</h3>
                                    <p class="text-sm text-gray-400 line-clamp-2">
                                        {{ $reward->descricao }}
                                    </p>

                                    <!-- Quantidade Disponível -->
                                    <div class="mt-3 flex items-center text-xs text-gray-500">
                                        <i data-lucide="package" class="w-3 h-3 mr-1"></i>
                                        <span>{{ $reward->qtd_disponivel }} disponíveis</span>
                                    </div>
                                </div>

                                <!-- Empresa Parceira -->
                                <div class="mt-4 pt-4 border-t border-gray-700">
                                    <p class="text-xs text-gray-500">
                                        Oferecido por
                                        <span class="font-medium text-lime-500">
                                            {{ $reward->empresa->user->name ?? 'Parceiro' }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <div class="bg-slate-900/50 px-6 py-4 flex justify-end">
                                <a href="{{ route('rewards.show', $reward->id) }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-slate-900 bg-lime-400 hover:bg-lime-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-500 transition-colors duration-200">
                                    <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                    Ver Detalhes
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginação -->
                <div class="mt-12">
                    {{ $rewards->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
