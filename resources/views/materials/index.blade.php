@extends('layouts.main')

@section('title', 'Gerenciar Materiais')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho -->
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-extrabold text-white tracking-tight">Gerenciamento de Materiais</h1>
                <p class="mt-2 text-lg text-gray-400">Visualize, filtre e administre os materiais recicláveis da
                    plataforma.</p>
            </div>

            <!-- Barra de Ferramentas: Busca e Filtros -->
            <div class="mb-8 p-6 bg-gray-800/50 rounded-xl shadow-lg border border-gray-700">
                <form action="{{ route('materials.index') }}" method="GET" id="searchForm">
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
                                    placeholder="Pesquisar por categoria, descrição..." value="{{ request('search') }}">

                                <!-- Botão X SEMPRE visível, mas inativo quando não tem busca -->
                                <a href="{{ route('materials.index', ['fields' => request('fields')]) }}"
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
                            <div class="flex flex-wrap gap-4 pt-2">
                                <x-custom-checkbox id="field_categoria" name="fields[]" value="categoria" label="Categoria"
                                    :checked="in_array('categoria', request('fields', ['categoria']))" />
                                <x-custom-checkbox id="field_descricao" name="fields[]" value="descricao" label="Descrição"
                                    :checked="in_array('descricao', request('fields', []))" />
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

            <!-- Grade de Cards de Materiais -->
            @if ($materials->isEmpty())
                <div class="text-center py-16 px-4 bg-gray-800/50 rounded-lg shadow-md border border-gray-700">
                    <i data-lucide="search-x" class="w-16 h-16 text-gray-500 mx-auto mb-4"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-200">Nenhum material encontrado</h3>
                    <p class="mt-1 text-sm text-gray-400">Tente ajustar sua busca ou cadastre um novo material.</p>

                    <div class="mt-6">
                        <a href="{{ route('materials.create') }}"
                            class="inline-flex items-center justify-center gap-2 bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-6 rounded-lg border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 group">
                            <i data-lucide="plus"
                                class="w-5 h-5 text-lime-400 group-hover:scale-110 transition-transform"></i>
                            <span class="text-base font-medium">Cadastrar Novo Material</span>
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($materials as $material)
                        <div
                            class="bg-gradient-to-b from-gray-800 to-slate-900 rounded-2xl shadow-lg overflow-hidden border border-gray-700/50 flex flex-col hover:border-gray-600 transition-all duration-300">
                            <div class="p-6 flex-grow">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="h-14 w-14 rounded-full bg-green-800 flex items-center justify-center ring-2 ring-green-600">
                                            <i data-lucide="recycle" class="w-7 h-7 text-green-300"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-lg font-semibold text-white truncate">{{ $material->categoria }}</p>
                                        <div class="flex items-center mt-1 space-x-2">
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full {{ $material->ativo ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
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
                                            <dd class="text-sm text-gray-300 text-right max-w-[60%] truncate"
                                                title="{{ $material->descricao }}">
                                                {{ $material->descricao ?: 'Sem descrição' }}
                                            </dd>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <dt class="text-sm font-medium text-gray-500">Pontuação</dt>
                                            <dd class="text-sm text-lime-400 font-semibold">
                                                {{ number_format($material->ponto_kg, 0) }} pts/kg</dd>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                                            <dd
                                                class="text-sm {{ $material->ativo ? 'text-green-400' : 'text-red-400' }} font-medium">
                                                {{ $material->ativo ? 'Ativo' : 'Inativo' }}
                                            </dd>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <dt class="text-sm font-medium text-gray-500">Cadastrado em</dt>
                                            <dd class="text-sm text-gray-300">{{ $material->created_at->format('d/m/Y') }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>

                            <div class="bg-slate-900/50 px-6 py-4 flex items-center justify-end space-x-3">
                                <a href="{{ route('materials.show', $material->id) }}"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-sky-200 bg-sky-800/50 hover:bg-sky-700/50 transition-transform transform hover:-translate-y-0.5"
                                    title="Visualizar Material">
                                    <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                    Visualizar
                                </a>
                                <a href="{{ route('materials.edit', $material->id) }}"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-teal-200 bg-teal-800/50 hover:bg-teal-700/50 transition-transform transform hover:-translate-y-0.5">
                                    <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                    Editar
                                </a>
                                <button type="button"
                                    onclick="confirmarExclusaoMaterial('{{ $material->id }}', '{{ addslashes($material->categoria) }}', '{{ $material->ponto_kg }}')"
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
                {{ $materials->links() }}
            </div>
        </div>
    </div>

    <!-- Script SweetAlert para exclusão de materiais -->
    <script>
        // Função para confirmar exclusão de material
        function confirmarExclusaoMaterial(materialId, materialCategoria, materialPontos) {
            Swal.fire({
                html: `
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12 text-yellow-400 mx-auto mb-4">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                    <path d="M12 9v4"/>
                    <path d="M12 17h.01"/>
                </svg>
                <h3 class="text-xl mb-2 font-bold text-white mb-2">Excluir Material</h3>
                
                <div class="mb-4">
                    <h4 class="text-lg font-semibold text-white">${materialCategoria}</h4>
                    <p class="text-gray-400 text-sm">Pontos: ${materialPontos} pts/kg</p>
                </div>
                
                <p class="text-gray-300 mb-6 mt-6">Tem certeza que deseja excluir o material <strong class="text-white">"${materialCategoria}"</strong>?</p>
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
                    form.action = `/materials/delete/${materialId}`;

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
