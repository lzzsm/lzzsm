@extends('layouts.main')

@section('title', 'Gerenciar Usuários')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <div class="mb-8 text-center">
                <h1 class="text-4xl font-extrabold text-white tracking-tight">Gerenciamento de Usuários</h1>
                <p class="mt-2 text-lg text-gray-400">Visualize, filtre e administre os usuários cadastrados na plataforma.
                </p>
            </div>

            <!-- Barra de Ferramentas: Busca Precisa -->
            <div class="mb-8 p-6 bg-gray-800/50 rounded-xl shadow-lg border border-gray-700">
                <form action="{{ route('users.index') }}" method="GET">
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
                                    placeholder="Digite para pesquisar..." value="{{ request('search') }}">

                                <!-- Botão X SEMPRE visível, mas inativo quando não tem busca -->
                                <a href="{{ route('users.index', ['fields' => request('fields')]) }}"
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
                            <div class="flex items-center space-x-6 pt-2">
                                <x-custom-checkbox id="field_name" name="fields[]" value="name" label="Nome"
                                    :checked="in_array('name', request('fields', ['name']))" />
                                <x-custom-checkbox id="field_email" name="fields[]" value="email" label="Email"
                                    :checked="in_array('email', request('fields', []))" />
                                <x-custom-checkbox id="field_cpf" name="fields[]" value="cpf" label="CPF"
                                    :checked="in_array('cpf', request('fields', []))" />
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

            <!-- Grade de Cards de Usuário -->
            @if ($users->isEmpty())
                <div class="text-center py-16 px-4 bg-gray-800/50 rounded-lg shadow-md border border-gray-700">
                    <i data-lucide="search-x" class="w-16 h-16 text-gray-500 mx-auto mb-4"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-200">Nenhum usuário encontrado</h3>
                    <p class="mt-1 text-sm text-gray-400">Tente ajustar sua busca ou filtros.
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach ($users as $user)
                        <div
                            class="bg-gradient-to-b from-gray-800 to-slate-900 rounded-2xl shadow-lg overflow-hidden border border-gray-700/50 flex flex-col">
                            <div class="p-6 flex-grow">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        @if ($user->profile_photo_path)
                                            <img class="h-14 w-14 rounded-full object-cover ring-2 ring-emerald-500"
                                                src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                                alt="Foto de {{ $user->name }}">
                                        @else
                                            <div
                                                class="h-14 w-14 rounded-full bg-emerald-800 flex items-center justify-center ring-2 ring-emerald-600">
                                                <span
                                                    class="text-2xl font-bold text-lime-300">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-lg font-semibold text-white truncate">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-400 truncate">{{ $user->email }}</p>
                                    </div>
                                </div>

                                <div class="mt-5 border-t border-gray-700 pt-5">
                                    <dl class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <dt class="text-sm font-medium text-gray-500">CPF</dt>
                                            <dd class="text-sm text-gray-300 font-mono">
                                                {{ $user->cadastrado->cpf_formatado ?? 'N/A' }}</dd>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <dt class="text-sm font-medium text-gray-500">Membro desde</dt>
                                            <dd class="text-sm text-gray-300">{{ $user->created_at->format('d/m/Y') }}
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>

                            <div class="bg-slate-900/50 px-6 py-4 flex items-center justify-end space-x-3">
                                <a href="{{ route('users.show', $user->id) }}"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-sky-200 bg-sky-800/50 hover:bg-sky-700/50 transition-transform transform hover:-translate-y-0.5"
                                    title="Visualizar Usuário">
                                    <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                    Visualizar
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-teal-200 bg-teal-800/50 hover:bg-teal-700/50 transition-transform transform hover:-translate-y-0.5">
                                    <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                    Editar
                                </a>
                                <button type="button"
                                    onclick="confirmarExclusaoUsuario('{{ $user->id }}', '{{ addslashes($user->name) }}', '{{ $user->email }}')"
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
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Script SweetAlert para exclusão de usuários -->
    <script>
        // Função para confirmar exclusão de usuário
        function confirmarExclusaoUsuario(userId, userName, userEmail) {
            Swal.fire({
                html: `
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12 text-yellow-400 mx-auto mb-4">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                    <path d="M12 9v4"/>
                    <path d="M12 17h.01"/>
                </svg>
                <h3 class="text-xl mb-2 font-bold text-white mb-2">Excluir Usuário</h3>
                
                <p class="text-gray-300 mb-6 mt-6">Tem certeza que deseja excluir o usuário <strong class="text-white">"${userName}"</strong>?</p>
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
                    form.action = `/users/delete/${userId}`;

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
