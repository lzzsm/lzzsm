@extends('layouts.main')

@section('title', 'Minhas Recompensas')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <div class="mb-8 text-center">
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-white">Minhas Recompensas</h1>
                <p class="mt-1 text-md text-gray-400">Gerencie aqui todas as recompensas que sua empresa publicou.</p>
            </div>

            <!-- Barra de Busca -->
            <div class="mb-8 p-6 bg-gray-800/50 rounded-xl shadow-lg border border-gray-700">
                <form action="{{ route('rewards.my') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-x-6 gap-y-4 items-end">

                        <!-- Campo de Busca -->
                        <div class="md:col-span-7">
                            <label for="search" class="block text-sm font-medium text-gray-400 mb-2">
                                <i data-lucide="search" class="w-4 h-4 inline mr-1"></i>
                                Buscar em minhas recompensas
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="search" class="h-5 w-5 text-gray-500"></i>
                                </div>
                                <input type="text" name="search" id="search"
                                    class="bg-gray-900 border border-gray-700 text-white focus:ring-lime-500 focus:border-lime-500 block w-full pl-10 pr-10 sm:text-sm rounded-md"
                                    placeholder="Pesquisar por título, descrição..." value="{{ request('search') }}">

                                <!-- Botão X SEMPRE visível, mas inativo quando não tem busca -->
                                <a href="{{ route('rewards.my', ['fields' => request('fields')]) }}"
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

            @if ($rewards->isEmpty())
                <div class="text-center py-16 px-4 bg-gray-800/50 rounded-lg shadow-md border border-gray-700">
                    <i data-lucide="search-x" class="w-16 h-16 text-gray-500 mx-auto mb-4"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-200">Nenhuma recompensa encontrada</h3>
                    <p class="mt-1 text-sm text-gray-400">Não encontramos recompensas suas que correspondam à busca.</p>
                    <div class="mt-6">
                        <a href="{{ route('rewards.create') }}"
                            class="inline-flex items-center justify-center gap-2 bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-6 rounded-lg border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 group">
                            <i data-lucide="plus"
                                class="w-5 h-5 text-lime-400 group-hover:scale-110 transition-transform"></i>
                            <span class="text-base font-medium">Criar Nova Recompensa</span>
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($rewards as $reward)
                        <div
                            class="bg-gradient-to-b from-gray-800 to-slate-900 rounded-2xl shadow-lg overflow-hidden border border-gray-700/50 flex flex-col">
                            <!-- Imagem da Recompensa -->
                            <div class="h-40 bg-gray-700 flex items-center justify-center">
                                @if ($reward->img_recompensa)
                                    <img src="{{ asset('storage/' . $reward->img_recompensa) }}"
                                        alt="Imagem de {{ $reward->titulo }}" class="w-full h-full object-cover">
                                @else
                                    <i data-lucide="gift" class="w-12 h-12 text-gray-500"></i>
                                @endif
                            </div>

                            <div class="p-6 flex-grow flex flex-col">
                                <div class="flex-grow">
                                    <!-- Pontos Necessários -->
                                    <div class="flex items-center mb-2">
                                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 mr-1"></i>
                                        <p class="text-sm font-semibold text-yellow-400">
                                            {{ $reward->pontos_necessarios }} pontos
                                        </p>
                                    </div>

                                    <h3 class="text-lg font-bold text-white truncate">{{ $reward->titulo }}</h3>
                                    <p class="mt-1 text-sm text-gray-400 h-10 overflow-hidden">
                                        {{ $reward->descricao }}
                                    </p>

                                    <!-- Quantidade Disponível -->
                                    <div class="mt-3 flex items-center text-xs text-gray-500">
                                        <i data-lucide="package" class="w-3 h-3 mr-1"></i>
                                        <span>{{ $reward->qtd_disponivel }} disponíveis</span>
                                    </div>
                                </div>

                                <div class="mt-4 border-t border-gray-700 pt-4 text-xs text-gray-500">
                                    Criada em {{ $reward->created_at->format('d/m/Y') }}
                                </div>
                            </div>

                            <div class="bg-slate-900/50 px-6 py-4 flex items-center justify-end space-x-3">
                                <a href="{{ route('rewards.show', $reward->id) }}"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-sky-200 bg-sky-800/50 hover:bg-sky-700/50 transition-transform transform hover:-translate-y-0.5"
                                    title="Visualizar Recompensa">
                                    Visualizar
                                </a>
                                <a href="{{ route('rewards.edit', $reward->id) }}"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-teal-200 bg-teal-800/50 hover:bg-teal-700/50 transition-transform transform hover:-translate-y-0.5">
                                    Editar
                                </a>
                                <button type="button"
                                    onclick="confirmarExclusaoMinhaRecompensa('{{ $reward->id }}', '{{ addslashes($reward->titulo) }}', '{{ $reward->pontos_necessarios }}', '{{ $reward->qtd_disponivel }}')"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-red-300 bg-red-800/50 hover:bg-red-700/50 transition-transform transform hover:-translate-y-0.5"
                                    title="Excluir">
                                    Excluir
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-10">
                {{ $rewards->links() }}
            </div>
        </div>
    </div>

    <!-- Script SweetAlert para exclusão de recompensas -->
    <script>
        // Função para confirmar exclusão de recompensa (minhas recompensas)
        function confirmarExclusaoMinhaRecompensa(rewardId, rewardTitulo, rewardPontos, rewardQuantidade) {
            Swal.fire({
                html: `
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12 text-yellow-400 mx-auto mb-4">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                    <path d="M12 9v4"/>
                    <path d="M12 17h.01"/>
                </svg>
                <h3 class="text-xl mb-2 font-bold text-white mb-2">Excluir Recompensa</h3>
                
                <div class="mb-4">
                    <h4 class="text-lg font-semibold text-white">${rewardTitulo}</h4>
                    <div class="flex items-center justify-center space-x-4 mt-2">
                        <div class="flex items-center text-sm text-yellow-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                            <span>${rewardPontos} pontos</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1">
                                <path d="m7.5 4.27 9 5.15"/>
                                <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                                <path d="m3.3 7 8.7 5 8.7-5"/>
                                <path d="M12 22V12"/>
                            </svg>
                            <span>${rewardQuantidade} disponíveis</span>
                        </div>
                    </div>
                </div>
                
                <p class="text-gray-300 mb-4 mt-6">Tem certeza que deseja excluir sua recompensa <strong class="text-white">"${rewardTitulo}"</strong>?</p>
                <p class="text-orange-400 text-xs mb-4">Usuários que já resgataram esta recompensa não serão afetados.</p>
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
                    form.action = `/rewards/delete/${rewardId}`;

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
