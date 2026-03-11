@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-4 py-6 border-t border-gray-700">
        <!-- Informação de resultados -->
        <div class="text-sm text-gray-400">
            Página <span class="font-medium text-white">{{ $paginator->currentPage() }}</span> de <span
                class="font-medium text-white">{{ $paginator->lastPage() }}</span>
        </div>

        <!-- Navegação -->
        <div class="flex items-center space-x-3">
            <!-- Botão Anterior -->
            @if ($paginator->onFirstPage())
                <button disabled
                    class="p-2 text-gray-500 bg-gray-800 border border-gray-700 rounded-lg cursor-not-allowed">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="p-2 text-gray-300 bg-gray-800 border border-gray-700 rounded-lg hover:bg-gray-700 hover:text-white transition-colors"
                    title="Página anterior">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </a>
            @endif

            <!-- Números das páginas -->
            <div class="flex items-center space-x-2">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="px-3 py-1 text-sm text-gray-500">...</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span
                                    class="flex items-center justify-center w-8 h-8 text-sm font-medium text-white bg-lime-600 rounded-lg">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="flex items-center justify-center w-8 h-8 text-sm text-gray-300 bg-gray-800 rounded-lg hover:bg-gray-700 hover:text-white transition-colors">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            <!-- Botão Próxima -->
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="p-2 text-gray-300 bg-gray-800 border border-gray-700 rounded-lg hover:bg-gray-700 hover:text-white transition-colors"
                    title="Próxima página">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </a>
            @else
                <button disabled
                    class="p-2 text-gray-500 bg-gray-800 border border-gray-700 rounded-lg cursor-not-allowed">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </button>
            @endif
        </div>
    </div>
@endif
