@extends('layouts.main')

@section('title', 'Gerenciar Anúncios')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <div class="mb-8 text-center">
                <h1 class="text-4xl font-extrabold text-white tracking-tight">Gerenciamento de Anúncios</h1>
                <p class="mt-2 text-lg text-gray-400">Modere, filtre e administre as publicações da plataforma.</p>
            </div>

            <!-- Barra de Ferramentas: Busca e Filtros -->
            <div class="mb-8 p-6 bg-gray-800/50 rounded-xl shadow-lg border border-gray-700">
                <form action="{{ route('advertisements.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-x-6 gap-y-4 items-end">

                        <!-- Campo de Busca -->
                        <div class="md:col-span-7">
                            <label for="search" class="block text-sm font-medium text-gray-400 mb-2">
                                <i data-lucide="search" class="w-4 h-4 inline mr-1"></i>
                                Termo de Pesquisa
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="search" class="h-5 w-5 text-gray-500"></i>
                                </div>
                                <input type="text" name="search" id="search"
                                    class="bg-gray-900 border border-gray-700 text-white focus:ring-lime-500 focus:border-lime-500 block w-full pl-10 pr-10 sm:text-sm rounded-md"
                                    placeholder="Pesquisar por título, subtítulo..." value="{{ request('search') }}">

                                <!-- Botão X SEMPRE visível, mas inativo quando não tem busca -->
                                <a href="{{ route('advertisements.index', ['fields' => request('fields')]) }}"
                                    class="absolute inset-y-0 right-0 flex items-center px-3 rounded-r-md transition-colors {{ request('search') ? 'bg-gray-700 text-gray-400 hover:bg-gray-600 hover:text-gray-300 cursor-pointer' : 'bg-gray-800 text-gray-600 cursor-not-allowed' }}"
                                    title="{{ request('search') ? 'Limpar Pesquisa' : 'Nada para limpar' }}"
                                    {{ !request('search') ? 'onclick="return false;"' : '' }}>
                                    <i data-lucide="x" class="h-5 w-5"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Checkboxes de Filtro -->
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-400 mb-2">
                                <i data-lucide="filter" class="w-4 h-4 inline mr-1"></i>
                                Pesquisar em:
                            </label>
                            <div class="flex items-center space-x-4 pt-2">
                                <x-custom-checkbox id="field_titulo" name="fields[]" value="titulo" label="Título"
                                    :checked="in_array('titulo', request('fields', ['titulo']))" />
                                <x-custom-checkbox id="field_subtitulo" name="fields[]" value="subtitulo" label="Subtítulo"
                                    :checked="in_array('subtitulo', request('fields', []))" />
                                <x-custom-checkbox id="field_tipo" name="fields[]" value="tipo" label="Tipo"
                                    :checked="in_array('tipo', request('fields', []))" />
                            </div>
                        </div>

                        <!-- Botão de Pesquisar - ESTILO PADRONIZADO -->
                        <div class="md:col-span-2">
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-4 py-2 w-full text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                                <i data-lucide="search" class="h-5 w-5 text-lime-300"></i>
                                <span>Pesquisar</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Grade de Cards de Anúncios -->
            @if ($advertisements->isEmpty())
                <div class="text-center py-16 px-4 bg-gray-800/50 rounded-lg shadow-md border border-gray-700">
                    <i data-lucide="search-x" class="w-16 h-16 text-gray-500 mx-auto mb-4"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-200">Nenhum anúncio encontrado</h3>
                    <p class="mt-1 text-sm text-gray-400">Tente ajustar sua busca ou filtros para encontrar o que procura.
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($advertisements as $advertisement)
                        <div
                            class="bg-gradient-to-b from-gray-800 to-slate-900 rounded-2xl shadow-lg overflow-hidden border border-gray-700/50 flex flex-col">
                            <!-- Imagem de Destaque -->
                            <div class="h-40 bg-gray-700 flex items-center justify-center">
                                @if ($advertisement->img_anuncio)
                                    <img src="{{ asset('storage/' . $advertisement->img_anuncio) }}"
                                        alt="Imagem de {{ $advertisement->titulo }}" class="w-full h-full object-cover">
                                @else
                                    <i data-lucide="image-off" class="w-12 h-12 text-gray-500"></i>
                                @endif
                            </div>

                            <div class="p-6 flex-grow flex flex-col">
                                <div class="flex-grow">
                                    <p class="text-sm font-semibold text-lime-400 uppercase tracking-wider">
                                        {{ $advertisement->tipo ?? 'Geral' }}</p>
                                    <h3 class="mt-1 text-lg font-bold text-white truncate">{{ $advertisement->titulo }}</h3>
                                    <p class="mt-1 text-sm text-gray-400 h-10 overflow-hidden">
                                        {{ $advertisement->subtitulo }}</p>
                                </div>

                                <div class="mt-4 border-t border-gray-700 pt-4 text-xs text-gray-500">
                                    Publicado por
                                    @if ($advertisement->empresa && $advertisement->empresa->user)
                                        <a href="{{ route('empresas.show', $advertisement->empresa->id) }}"
                                            class="font-medium text-lime-500 hover:text-lime-400">
                                            {{ $advertisement->empresa->user->name }}
                                        </a>
                                    @else
                                        <span class="font-medium text-gray-400">Empresa não encontrada</span>
                                    @endif
                                    em {{ $advertisement->created_at->format('d/m/Y') }}
                                </div>
                            </div>

                            <div class="bg-slate-900/50 px-6 py-4 flex items-center justify-end space-x-3">
                                <a href="{{ route('advertisements.show', $advertisement->id) }}"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-sky-200 bg-sky-800/50 hover:bg-sky-700/50 transition-transform transform hover:-translate-y-0.5"
                                    title="Visualizar Anúncio">
                                    <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                    Visualizar
                                </a>
                                <a href="{{ route('advertisements.edit', $advertisement->id) }}"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-teal-200 bg-teal-800/50 hover:bg-teal-700/50 transition-transform transform hover:-translate-y-0.5">
                                    <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                    Editar
                                </a>
                                <button type="button"
                                    onclick="confirmarExclusaoAnuncio('{{ $advertisement->id }}', '{{ addslashes($advertisement->titulo) }}', '{{ $advertisement->tipo ?? 'Geral' }}', '{{ $advertisement->empresa && $advertisement->empresa->user ? addslashes($advertisement->empresa->user->name) : 'Empresa não encontrada' }}')"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-red-300 bg-red-800/50 hover:bg-red-700/50 transition-transform transform hover:-translate-y-0.5"
                                    title="Excluir">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                    Excluir
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-10">
                {{ $advertisements->links() }}
            </div>
        </div>
    </div>

    <!-- Script SweetAlert para exclusão de anúncios -->
    <script>
        // Função para confirmar exclusão de anúncio
        function confirmarExclusaoAnuncio(anuncioId, anuncioTitulo, anuncioTipo, empresaNome) {
    Swal.fire({
        html: `
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12 text-yellow-400 mx-auto mb-4">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                    <path d="M12 9v4"/>
                    <path d="M12 17h.01"/>
                </svg>
                <h3 class="text-xl mb-2 font-bold text-white mb-2">Excluir Anúncio</h3>
                
                <div class="mb-4">
                    <h4 class="text-lg font-semibold text-white">${anuncioTitulo}</h4>
                    <div class="flex items-center justify-center space-x-4 mt-2">
                        <div class="flex items-center text-sm text-lime-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1">
                                <path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/>
                                <path d="M7 7h.01"/>
                            </svg>
                            <span>${anuncioTipo}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <span>${empresaNome}</span>
                        </div>
                    </div>
                </div>
                
                <p class="text-gray-300 mb-6 mt-6">Tem certeza que deseja excluir o anúncio <strong class="text-white">"${anuncioTitulo}"</strong>?</p>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Excluir',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        customClass: {
            popup: 'bg-slate-800 rounded-2xl border border-gray-700',
            title: 'hidden',
            htmlContainer: '!text-left',
            confirmButton: 'px-6 py-2 mr-2 text-sm bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors',
            cancelButton: 'px-6 py-2 ml-2 text-sm text-gray-300 bg-gray-600 hover:bg-gray-700 hover:text-white transition-colors rounded-lg'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/advertisements/${anuncioId}`;

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';

            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
    </script>
@endsection
