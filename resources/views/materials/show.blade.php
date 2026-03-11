@extends('layouts.main')

@section('title', $material->categoria . ' - Materiais Recicláveis')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <!-- Botão de Voltar -->
            <div class="max-w-6xl mx-auto mb-8">
                <button onclick="window.history.back()"
                    class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-lime-300 transition-colors group">
                    <i data-lucide="arrow-left"
                        class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:-translate-x-1"></i>
                    Voltar para Materiais
                </button>
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
                                    <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2">
                                        {{ $material->categoria }}</h1>
                                    <div class="flex items-center space-x-4 mb-4">
                                        <span
                                            class="px-3 py-1 text-sm font-semibold rounded-full {{ $material->ativo ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-red-500/20 text-red-400 border border-red-500/30' }}">
                                            {{ $material->ativo ? '✅ Ativo para Coleta' : '❌ Indisponível' }}
                                        </span>
                                        <div class="flex items-center text-lime-400">
                                            <i data-lucide="star" class="w-5 h-5 mr-1"></i>
                                            <span class="text-xl font-bold">{{ number_format($material->ponto_kg) }}</span>
                                            <span class="text-sm ml-1">pts/kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-16 h-16 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center shadow-lg">
                                        <i data-lucide="recycle" class="w-8 h-8 text-white"></i>
                                    </div>
                                </div>
                            </div>

                            @if ($material->descricao)
                                <div class="mt-6 p-4 bg-gray-900/50 rounded-lg border border-gray-700">
                                    <p class="text-gray-300 leading-relaxed">{{ $material->descricao }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Sistema de Pontuação -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-8 mb-8">
                            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                                <i data-lucide="calculator" class="w-6 h-6 text-lime-400 mr-2"></i>
                                Como Calcular Seus Pontos
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gray-900/50 rounded-lg p-6 border border-gray-700">
                                    <div class="text-center">
                                        <div class="text-3xl font-bold text-lime-400 mb-2">
                                            {{ number_format($material->ponto_kg) }}</div>
                                        <div class="text-sm text-gray-400">pontos por kg</div>
                                    </div>
                                </div>

                                <div class="bg-gray-900/50 rounded-lg p-6 border border-gray-700">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-white mb-2">Fórmula</div>
                                        <div class="text-sm text-gray-300">
                                            Peso (kg) × {{ number_format($material->ponto_kg) }} = Pontos
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                                <div class="bg-gray-900/30 rounded-lg p-4">
                                    <div class="text-lime-400 font-bold">0.5 kg</div>
                                    <div class="text-sm text-gray-400">{{ number_format($material->ponto_kg * 0.5) }} pts
                                    </div>
                                </div>
                                <div class="bg-gray-900/30 rounded-lg p-4">
                                    <div class="text-lime-400 font-bold">1 kg</div>
                                    <div class="text-sm text-gray-400">{{ number_format($material->ponto_kg) }} pts</div>
                                </div>
                                <div class="bg-gray-900/30 rounded-lg p-4">
                                    <div class="text-lime-400 font-bold">2 kg</div>
                                    <div class="text-sm text-gray-400">{{ number_format($material->ponto_kg * 2) }} pts
                                    </div>
                                </div>
                                <div class="bg-gray-900/30 rounded-lg p-4">
                                    <div class="text-lime-400 font-bold">5 kg</div>
                                    <div class="text-sm text-gray-400">{{ number_format($material->ponto_kg * 5) }} pts
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Como Preparar o Material -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-8">
                            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                                <i data-lucide="clipboard-check" class="w-6 h-6 text-lime-400 mr-2"></i>
                                Como Preparar para a Coleta
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-lg font-semibold text-green-400 mb-3 flex items-center">
                                        <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                                        O Que Fazer
                                    </h3>
                                    <ul class="space-y-2 text-gray-300">
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-4 h-4 text-green-400 mr-2 mt-1 flex-shrink-0"></i>
                                            <span>Limpe e seque completamente</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-4 h-4 text-green-400 mr-2 mt-1 flex-shrink-0"></i>
                                            <span>Remova rótulos e tampas</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-4 h-4 text-green-400 mr-2 mt-1 flex-shrink-0"></i>
                                            <span>Compacte quando possível</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-4 h-4 text-green-400 mr-2 mt-1 flex-shrink-0"></i>
                                            <span>Separe por tipo de material</span>
                                        </li>
                                    </ul>
                                </div>

                                <div>
                                    <h3 class="text-lg font-semibold text-red-400 mb-3 flex items-center">
                                        <i data-lucide="x-circle" class="w-5 h-5 mr-2"></i>
                                        O Que Evitar
                                    </h3>
                                    <ul class="space-y-2 text-gray-300">
                                        <li class="flex items-start">
                                            <i data-lucide="x" class="w-4 h-4 text-red-400 mr-2 mt-1 flex-shrink-0"></i>
                                            <span>Materiais sujos ou úmidos</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="x" class="w-4 h-4 text-red-400 mr-2 mt-1 flex-shrink-0"></i>
                                            <span>Resíduos orgânicos</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="x" class="w-4 h-4 text-red-400 mr-2 mt-1 flex-shrink-0"></i>
                                            <span>Materiais contaminados</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="x" class="w-4 h-4 text-red-400 mr-2 mt-1 flex-shrink-0"></i>
                                            <span>Embalagens com restos</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coluna da Direita: Informações Adicionais -->
                    <div class="space-y-8">
                        @auth
                            <!-- Pontos de Coleta -->
                            <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-6">
                                <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                                    <i data-lucide="map-pin" class="w-5 h-5 text-lime-400 mr-2"></i>
                                    Onde Entregar
                                </h3>
                                <p class="text-gray-300 mb-4">Leve este material para um de nossos pontos de coleta autorizados.
                                </p>
                                <a href="{{ route('collect-points.dashboard') }}"
                                    class="w-full inline-flex items-center justify-center bg-emerald-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-emerald-700 transition-transform transform hover:scale-105">
                                    <i data-lucide="map" class="w-4 h-4 mr-2"></i>
                                    Ver Pontos de Coleta
                                </a>
                            </div>
                        @endauth

                        <!-- Benefícios Ambientais -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-6">
                            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                                <i data-lucide="leaf" class="w-5 h-5 text-lime-400 mr-2"></i>
                                Impacto Ambiental
                            </h3>
                            <ul class="space-y-3 text-gray-300">
                                <li class="flex items-start">
                                    <i data-lucide="heart" class="w-4 h-4 text-green-400 mr-2 mt-1"></i>
                                    <span>Reduz a poluição do solo e água</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="zap" class="w-4 h-4 text-green-400 mr-2 mt-1"></i>
                                    <span>Economiza energia na produção</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="tree-pine" class="w-4 h-4 text-green-400 mr-2 mt-1"></i>
                                    <span>Preserva recursos naturais</span>
                                </li>
                                <li class="flex items-start">
                                    <i data-lucide="smile" class="w-4 h-4 text-green-400 mr-2 mt-1"></i>
                                    <span>Contribui para economia circular</span>
                                </li>
                            </ul>
                        </div>

                        @auth
                            <!-- Recompensas -->
                            <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-6">
                                <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                                    <i data-lucide="award" class="w-5 h-5 text-lime-400 mr-2"></i>
                                    Suas Recompensas
                                </h3>
                                <p class="text-gray-300 mb-4">Troque seus pontos por recompensas exclusivas!</p>
                                <a href="{{ route('rewards.dashboard') }}"
                                    class="w-full inline-flex items-center justify-center bg-purple-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-purple-700 transition-transform transform hover:scale-105">
                                    <i data-lucide="gift" class="w-4 h-4 mr-2"></i>
                                    Ver Recompensas
                                </a>
                            </div>
                        @endauth

                        <!-- Status do Material -->
                        <div class="bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 p-6">
                            <h3 class="text-xl font-bold text-white mb-4">Informações</h3>
                            <dl class="space-y-3">
                                <div class="flex justify-between">
                                    <dt class="text-gray-400">Status</dt>
                                    <dd class="{{ $material->ativo ? 'text-green-400' : 'text-red-400' }} font-medium">
                                        {{ $material->ativo ? 'Disponível' : 'Indisponível' }}
                                    </dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-gray-400">Valor por kg</dt>
                                    <dd class="text-lime-400 font-bold">{{ number_format($material->ponto_kg) }} pts</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-gray-400">Categoria</dt>
                                    <dd class="text-gray-300">Material Reciclável</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inicializar ícones do Lucide
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
@endsection
