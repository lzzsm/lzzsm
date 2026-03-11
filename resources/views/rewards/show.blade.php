@extends('layouts.main')

@section('title', $reward->titulo)

@section('content')

    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="max-w-4xl mx-auto">

                <!-- Botão Voltar e Data de Publicação -->
                <div class="flex justify-between items-center mb-8">
                    <button onclick="window.history.back()"
                        class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-lime-300 transition-colors group">
                        <i data-lucide="arrow-left"
                            class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:-translate-x-1"></i>
                        Voltar
                    </button>

                    <p class="text-sm text-gray-400">
                        Oferecida por
                        <a href="{{ route('empresas.show', $reward->empresa->id) }}"
                            class="font-medium text-lime-500 hover:text-lime-400">
                            {{ $reward->empresa->user->name ?? 'Empresa desconhecida' }}
                        </a>
                        em {{ $reward->created_at->format('d/m/Y') }}
                    </p>
                </div>

                <!-- Conteúdo da Recompensa -->
                <div class="bg-gray-800/50 rounded-2xl shadow-lg overflow-hidden border border-gray-700/50">
                    @if ($reward->img_recompensa)
                        <div class="w-full h-64 sm:h-80 md:h-96 bg-gray-700">
                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $reward->img_recompensa) }}"
                                alt="Imagem de destaque para {{ $reward->titulo }}">
                        </div>
                    @endif

                    <div class="p-6 sm:p-8 md:p-10">
                        <!-- Badge de Pontos -->
                        <div class="flex items-center mb-4">
                            <i data-lucide="star" class="w-5 h-5 text-yellow-400 mr-2"></i>
                            <span
                                class="bg-yellow-400/10 text-yellow-300 text-sm font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                                {{ $reward->pontos_necessarios }} pontos necessários
                            </span>
                        </div>

                        <h1 class="text-3xl md:text-4xl font-bold text-white leading-tight">{{ $reward->titulo }}</h1>

                        @if ($reward->descricao)
                            <p class="text-lg md:text-xl text-gray-400 mt-2">{{ $reward->descricao }}</p>
                        @endif

                        <div class="mt-8 border-t border-gray-700 pt-8">
                            <!-- Informações da Recompensa -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div class="flex items-center text-gray-300">
                                    <i data-lucide="package" class="w-5 h-5 text-lime-400 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-400">Quantidade disponível</p>
                                        <p class="text-lg font-semibold">{{ $reward->qtd_disponivel }} unidades</p>
                                    </div>
                                </div>
                                <div class="flex items-center text-gray-300">
                                    <i data-lucide="calendar" class="w-5 h-5 text-lime-400 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-400">Criada em</p>
                                        <p class="text-lg font-semibold">{{ $reward->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Status dos Pontos do Usuário (apenas para usuários cadastrados) -->
                            @auth
                                @if (Auth::user()->nivel_permissao === 'cadastrado')
                                    @php
                                        $cadastrado = Auth::user()->cadastrado;
                                        $pontosDisponiveis =
                                            $cadastrado->pontuacao_total - $cadastrado->pontuacao_gasta;
                                        $pontosNecessarios = $reward->pontos_necessarios;
                                        $pontosFaltantes = max(0, $pontosNecessarios - $pontosDisponiveis);
                                        $jaResgatou = $cadastrado
                                            ->resgates()
                                            ->where('reward_id', $reward->id)
                                            ->exists();
                                        $podeResgatar =
                                            $pontosDisponiveis >= $pontosNecessarios &&
                                            $reward->qtd_disponivel > 0 &&
                                            !$jaResgatou;
                                    @endphp

                                    <div class="mb-6 p-4 bg-gray-700/30 rounded-lg border border-gray-600">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <i data-lucide="coins" class="w-5 h-5 text-yellow-400 mr-2"></i>
                                                <span class="text-gray-300">Seus pontos disponíveis:</span>
                                            </div>
                                            <span class="text-lg font-bold text-yellow-400">
                                                {{ $pontosDisponiveis }} pontos
                                            </span>
                                        </div>

                                        @if ($jaResgatou)
                                            <div class="mt-2 flex items-center text-sm text-blue-400">
                                                <i data-lucide="badge-check" class="w-4 h-4 mr-1"></i>
                                                <span>Você já resgatou esta recompensa anteriormente</span>
                                            </div>
                                        @elseif ($podeResgatar)
                                            <div class="mt-2 flex items-center text-sm text-green-400">
                                                <i data-lucide="circle-check" class="w-4 h-4 mr-1"></i>
                                                <span>Você tem pontos suficientes para resgatar esta recompensa!</span>
                                            </div>
                                        @elseif($reward->qtd_disponivel > 0)
                                            <div class="mt-2 flex items-center text-sm text-orange-400">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                <span>Faltam <strong class="text-white">{{ $pontosFaltantes }} pontos</strong>
                                                    para resgatar esta recompensa</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Botão de Resgate (apenas para usuários cadastrados) -->
                                    @if ($reward->qtd_disponivel > 0)
                                        @if ($jaResgatou)
                                            <!-- Já resgatou -->
                                            <div class="text-center p-6 bg-blue-500/10 rounded-lg border border-blue-500/20">
                                                <i data-lucide="badge-check" class="w-12 h-12 text-blue-400 mx-auto mb-3"></i>
                                                <h3 class="text-lg font-semibold text-blue-300 mb-2">Recompensa Já Resgatada
                                                </h3>
                                                <p class="text-gray-300 text-sm mb-4">
                                                    Você já resgatou esta recompensa anteriormente.
                                                    Cada recompensa pode ser resgatada apenas uma vez por usuário.
                                                </p>
                                                <a href="{{ route('resgates.index') }}"
                                                    class="inline-flex items-center text-blue-400 hover:text-blue-300 font-medium">
                                                    <i data-lucide="list" class="w-4 h-4 mr-2"></i>
                                                    Ver meus resgates
                                                </a>
                                            </div>
                                        @elseif ($podeResgatar)
                                            <!-- Pode resgatar -->
                                            <form action="{{ route('rewards.redeem', $reward->id) }}" method="POST"
                                                class="mt-6" id="resgateForm">
                                                @csrf
                                                <button type="button" onclick="confirmarResgate()"
                                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-slate-900 bg-lime-400 hover:bg-lime-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-500 transition-transform transform hover:scale-105">
                                                    <i data-lucide="gift" class="w-5 h-5 mr-2"></i>
                                                    Resgatar Recompensa
                                                </button>
                                                <p class="mt-2 text-sm text-gray-400">
                                                    Esta ação custará <strong>{{ $reward->pontos_necessarios }} pontos</strong>
                                                    da sua conta. <span class="text-lime-400">✓ Única vez por usuário</span>
                                                </p>
                                            </form>
                                        @else
                                            <!-- Pontos insuficientes -->
                                            <div
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-400 bg-gray-700/50 cursor-not-allowed">
                                                <i data-lucide="lock" class="w-4 h-4 mr-2"></i>
                                                Pontos Insuficientes
                                            </div>
                                            <p class="mt-2 text-sm text-gray-400">
                                                Você precisa de mais <strong>{{ $pontosFaltantes }} pontos</strong> para
                                                resgatar esta recompensa.
                                            </p>
                                        @endif
                                    @else
                                        <!-- Esgotada -->
                                        <div
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-400 bg-gray-700/50 cursor-not-allowed">
                                            <i data-lucide="x-circle" class="w-4 h-4 mr-2"></i>
                                            Recompensa Esgotada
                                        </div>
                                        <p class="mt-2 text-sm text-gray-400">
                                            Esta recompensa não está mais disponível.
                                        </p>
                                    @endif
                                @else
                                    <!-- Mensagem para admin/empresa logados -->
                                    <div class="text-center p-4 bg-gray-700/30 rounded-lg border border-gray-600">
                                        <i data-lucide="shield" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
                                        <p class="text-gray-300">Esta área é exclusiva para usuários cadastrados</p>
                                        <p class="text-sm text-gray-400 mt-1">Como {{ Auth::user()->nivel_permissao }}, você
                                            pode gerenciar recompensas mas não resgatá-las.</p>
                                    </div>
                                @endif
                            @else
                                <!-- Mensagem para usuários não logados -->
                                <div class="text-center p-4 bg-gray-700/30 rounded-lg border border-gray-600">
                                    <i data-lucide="log-in" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
                                    <p class="text-gray-300">Faça login como usuário cadastrado para resgatar esta recompensa
                                    </p>
                                    <a href="{{ route('login') }}"
                                        class="inline-flex items-center mt-2 text-lime-400 hover:text-lime-300">
                                        Fazer login
                                        <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Script para confirmação de resgate -->
    <script>
        function confirmarResgate() {
            Swal.fire({
                html: `
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12 text-lime-400 mx-auto mb-4">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
                <h3 class="text-xl mb-2 font-bold text-white mb-2">Resgatar Recompensa</h3>
                
                <div class="mb-4">
                    <h4 class="text-lg font-semibold text-white">{{ $reward->titulo }}</h4>
                </div>
                
                <div class="bg-gray-700/30 rounded-xl p-4 mb-4 border border-gray-600/30">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-300">Custo:</span>
                        <span class="text-yellow-400 font-bold text-lg">{{ $reward->pontos_necessarios }} pontos</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-400">Seus pontos após o resgate:</span>
                        <span class="text-green-400 font-semibold">{{ (Auth::user()->cadastrado->pontuacao_total ?? 0) - (Auth::user()->cadastrado->pontuacao_gasta - $reward->pontos_necessarios ?? 0) }}</span>
                    </div>
                </div>

                <div class="bg-blue-500/10 border border-blue-500/30 rounded-xl p-3 mb-3">
                    <div class="flex items-center text-sm text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="16" x2="12" y2="12"/>
                            <line x1="12" y1="8" x2="12.01" y2="8"/>
                        </svg>
                        <span>Esta recompensa só pode ser resgatada uma vez</span>
                    </div>
                </div>
                
                <p class="text-gray-300 mb-6 mt-6">Tem certeza que deseja resgatar a recompensa <strong class="text-white">"{{ $reward->titulo }}"</strong>?</p>
            </div>
        `,
                showCancelButton: true,
                confirmButtonText: 'Resgatar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                customClass: {
                    popup: 'bg-slate-800 rounded-2xl border border-gray-700',
                    title: 'hidden',
                    htmlContainer: '!text-left',
                    confirmButton: 'px-6 py-2 mr-2 text-sm bg-lime-600 hover:bg-lime-500 text-white rounded-lg transition-colors',
                    cancelButton: 'px-6 py-2 ml-2 text-sm text-gray-300 bg-gray-600 hover:bg-gray-700 hover:text-white transition-colors rounded-lg'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('resgateForm').submit();
                }
            });
        }
    </script>
@endsection
