@extends('layouts.main')

@section('title', 'Encontre um Ponto de Coleta')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <!-- Cabeçalho da Página -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">Encontre um Ponto de Coleta</h1>
                <p class="text-lg text-gray-400 mt-3 max-w-3xl mx-auto">Use a busca para encontrar o local mais próximo e
                    conveniente para você.</p>
            </div>

            <!-- Barra de Busca -->
            <div class="max-w-2xl mx-auto mb-12">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i data-lucide="search" class="h-5 w-5 text-gray-500"></i>
                    </div>
                    <input type="text" id="searchInput" placeholder="Pesquisar por nome, cidade ou rua..."
                        class="w-full pl-12 pr-4 py-3 bg-gray-800/50 border border-gray-700 rounded-full focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-all duration-300">
                </div>
            </div>

            <!-- Grade de Pontos de Coleta -->
            <div id="points-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($points as $point)
                    <div class="point-card bg-gray-800/50 rounded-2xl shadow-lg border border-gray-700/50 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lime-500/10 hover:border-lime-500/30"
                        data-search-text="{{ strtolower($point->nome . ' ' . $point->cidade . ' ' . $point->rua . ' ' . $point->estado . ' ' . $point->cep_formatado) }}">

                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="font-bold text-xl text-lime-300">{{ $point->nome }}</h3>
                                    <p class="text-sm text-gray-400 mt-1">{{ $point->cidade }}/{{ $point->estado }}</p>
                                </div>
                                <div class="flex-shrink-0 text-emerald-400">
                                    <i data-lucide="map-pin" class="w-7 h-7"></i>
                                </div>
                            </div>

                            <div class="mt-4 border-t border-gray-700 pt-4">
                                <p class="text-gray-300">{{ $point->rua }}, {{ $point->numero ?? 'S/N' }}</p>
                                <p class="text-gray-400 font-mono text-sm">{{ $point->cep_formatado }}</p>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('collect-points.show', $point->id) }}"
                                    class="inline-flex items-center justify-center w-full text-center bg-emerald-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-emerald-700 transition-transform transform hover:scale-105">
                                    Ver Detalhes e Mapa
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Mensagem para quando NÃO HÁ PONTOS CADASTRADOS no banco --}}
                    <div class="col-span-full text-center text-gray-500 py-16">
                        <i data-lucide="map-pin-off" class="mx-auto h-12 w-12 text-gray-500"></i>
                        <h3 class="mt-2 text-lg font-medium text-gray-200">Nenhum ponto de coleta cadastrado ainda.</h3>
                        <p class="mt-1 text-sm text-gray-400">Volte em breve para novidades.</p>
                    </div>
                @endforelse
            </div>

            <!-- MENSAGEM DE "NENHUM RESULTADO" PARA A BUSCA (inicialmente oculta) -->
            <div id="no-search-results" class="hidden col-span-full text-center text-gray-500 py-16">
                <i data-lucide="search-x" class="mx-auto h-12 w-12 text-gray-500"></i>
                <h3 class="mt-2 text-lg font-medium text-gray-200">Nenhum resultado encontrado</h3>
                <p class="mt-1 text-sm text-gray-400">Tente usar outros termos na sua busca.</p>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const pointCards = document.querySelectorAll('.point-card');
            const pointsGrid = document.getElementById('points-grid');
            const noResultsMessage = document.getElementById('no-search-results');
            const emptyState = document.querySelector('[data-search-text]') ? null : pointsGrid.querySelector('.col-span-full');

            // Função para filtrar os pontos
            function filterPoints() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                pointCards.forEach(card => {
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
                    pointsGrid.style.display = 'grid';
                    noResultsMessage.classList.add('hidden');
                } else {
                    // Com busca ativa
                    if (emptyState) {
                        emptyState.style.display = 'none';
                    }
                    
                    if (visibleCount === 0) {
                        pointsGrid.style.display = 'none';
                        noResultsMessage.classList.remove('hidden');
                    } else {
                        pointsGrid.style.display = 'grid';
                        noResultsMessage.classList.add('hidden');
                    }
                }
            }

            // Event listener para input com debounce
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(filterPoints, 300);
            });

            // Event listener para Enter (prevenir submit acidental)
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    filterPoints();
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