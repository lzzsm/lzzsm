@extends('layouts.main')

@section('title', 'Materiais Recicláveis')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <!-- Cabeçalho da Página -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">Materiais Recicláveis</h1>
                <p class="text-lg text-gray-400 mt-3 max-w-3xl mx-auto">Descubra os materiais que aceitamos e quantos pontos você ganha por cada kg reciclado.</p>
            </div>

            <!-- Barra de Busca -->
            <div class="max-w-2xl mx-auto mb-12">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i data-lucide="search" class="h-5 w-5 text-gray-500"></i>
                    </div>
                    <input type="text" id="searchInput" placeholder="Pesquisar por categoria ou descrição..."
                        class="w-full pl-12 pr-4 py-3 bg-gray-800/50 border border-gray-700 rounded-full focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-all duration-300">
                </div>
            </div>

            <!-- Grade de Materiais -->
            <div id="materials-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($materials as $material)
                    <div class="material-card bg-gradient-to-b from-gray-800 to-slate-900 rounded-2xl shadow-lg overflow-hidden border border-gray-700/50 flex flex-col hover:border-lime-500/30 transition-all duration-300"
                        data-search-text="{{ strtolower($material->categoria . ' ' . $material->descricao) }}">

                        <div class="p-6 flex-grow">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="h-14 w-14 rounded-full bg-green-800 flex items-center justify-center ring-2 ring-green-600">
                                        <i data-lucide="recycle" class="w-7 h-7 text-green-300"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-lg font-semibold text-white truncate">{{ $material->categoria }}</p>
                                    <div class="flex items-center mt-1 space-x-2">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $material->ativo ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                            {{ $material->ativo ? 'Ativo' : 'Inativo' }}
                                        </span>
                                        <span class="text-sm text-lime-400 font-semibold">
                                            {{ number_format($material->ponto_kg, 0) }} pts/kg
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 border-t border-gray-700 pt-5">
                                <dl class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <dt class="text-sm font-medium text-gray-500">Descrição</dt>
                                        <dd class="text-sm text-gray-300 text-right max-w-[60%] truncate" title="{{ $material->descricao }}">
                                            {{ $material->descricao ?: 'Sem descrição' }}
                                        </dd>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <dt class="text-sm font-medium text-gray-500">Pontuação</dt>
                                        <dd class="text-sm text-lime-400 font-semibold">{{ number_format($material->ponto_kg, 0) }} pts/kg</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <div class="bg-slate-900/50 px-6 py-4 flex items-center justify-end">
                            <a href="{{ route('materials.show', $material->id) }}"
                                class="inline-flex items-center justify-center w-full text-center bg-emerald-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-emerald-700 transition-transform transform hover:scale-105">
                                Ver Detalhes
                            </a>
                        </div>
                    </div>
                @empty
                    <!-- Mensagem para quando NÃO HÁ MATERIAIS CADASTRADOS -->
                    <div class="col-span-full text-center py-16 px-4 bg-gray-800/50 rounded-lg shadow-md border border-gray-700">
                        <i data-lucide="package-x" class="w-16 h-16 text-gray-500 mx-auto mb-4"></i>
                        <h3 class="mt-2 text-sm font-medium text-gray-200">Nenhum material cadastrado ainda.</h3>
                        <p class="mt-1 text-sm text-gray-400">Volte em breve para novidades.</p>
                    </div>
                @endforelse
            </div>

            <!-- MENSAGEM DE "NENHUM RESULTADO" PARA A BUSCA -->
            <div id="no-search-results" class="hidden col-span-full text-center py-16 px-4 bg-gray-800/50 rounded-lg shadow-md border border-gray-700">
                <i data-lucide="search-x" class="w-16 h-16 text-gray-500 mx-auto mb-4"></i>
                <h3 class="mt-2 text-sm font-medium text-gray-200">Nenhum material encontrado</h3>
                <p class="mt-1 text-sm text-gray-400">Tente usar outros termos na sua busca.</p>
            </div>

            <!-- Seção Informativa -->
            <div class="max-w-4xl mx-auto mt-16 grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Como Funciona -->
                <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700/50">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                        <i data-lucide="info" class="w-5 h-5 text-lime-400 mr-2"></i>
                        Como Funciona
                    </h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-4 h-4 text-green-400 mr-2 mt-1 flex-shrink-0"></i>
                            <span>Separe os materiais por categoria</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-4 h-4 text-green-400 mr-2 mt-1 flex-shrink-0"></i>
                            <span>Limpe os materiais antes de descartar</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-4 h-4 text-green-400 mr-2 mt-1 flex-shrink-0"></i>
                            <span>Leve até um ponto de coleta autorizado</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="check" class="w-4 h-4 text-green-400 mr-2 mt-1 flex-shrink-0"></i>
                            <span>Acumule pontos e troque por recompensas</span>
                        </li>
                    </ul>
                </div>

                <!-- Benefícios -->
                <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700/50">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                        <i data-lucide="award" class="w-5 h-5 text-lime-400 mr-2"></i>
                        Vantagens
                    </h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <i data-lucide="leaf" class="w-4 h-4 text-green-400 mr-2 mt-1 flex-shrink-0"></i>
                            <span>Contribuição para o meio ambiente</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="coins" class="w-4 h-4 text-green-400 mr-2 mt-1 flex-shrink-0"></i>
                            <span>Economia de recursos naturais</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="sparkles" class="w-4 h-4 text-green-400 mr-2 mt-1 flex-shrink-0"></i>
                            <span>Redução da poluição</span>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="trending-up" class="w-4 h-4 text-green-400 mr-2 mt-1 flex-shrink-0"></i>
                            <span>Fomento à economia circular</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const materialCards = document.querySelectorAll('.material-card');
            const materialsGrid = document.getElementById('materials-grid');
            const noResultsMessage = document.getElementById('no-search-results');
            const emptyState = document.querySelector('[data-search-text]') ? null : materialsGrid.querySelector('.col-span-full');

            // Função para filtrar os materiais
            function filterMaterials() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                materialCards.forEach(card => {
                    const searchText = card.getAttribute('data-search-text');
                    
                    if (searchText.includes(searchTerm)) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Mostrar/ocultar mensagens
                if (searchTerm === '') {
                    // Sem busca - estado normal
                    if (emptyState) {
                        emptyState.style.display = 'block';
                    }
                    materialsGrid.style.display = 'grid';
                    noResultsMessage.classList.add('hidden');
                } else {
                    // Com busca ativa
                    if (emptyState) {
                        emptyState.style.display = 'none';
                    }
                    
                    if (visibleCount === 0) {
                        materialsGrid.style.display = 'none';
                        noResultsMessage.classList.remove('hidden');
                    } else {
                        materialsGrid.style.display = 'grid';
                        noResultsMessage.classList.add('hidden');
                    }
                }
            }

            // Event listener para input com debounce
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(filterMaterials, 300);
            });

            // Event listener para Enter (prevenir submit acidental)
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    filterMaterials();
                }
            });

            // Focar no input de busca quando a página carregar
            searchInput.focus();
        });

        // Inicializar ícones do Lucide quando disponíveis
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
@endsection