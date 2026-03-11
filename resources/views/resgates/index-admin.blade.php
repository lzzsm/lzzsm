@extends('layouts.main')

@section('title', 'Gerenciar Resgates - Admin')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho -->
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-extrabold text-white tracking-tight">Gerenciamento de Resgates</h1>
                <p class="mt-2 text-lg text-gray-400">Visualize e acompanhe todos os resgates realizados na plataforma.</p>
            </div>

            @php
                // Contar resgates expirados para mostrar o alerta
                $resgatesExpiradosCount = App\Models\CadastradoReward::where('status', 'pendente')
                    ->where('data_expiracao', '<=', now())
                    ->count();
            @endphp

            <!-- Alert para Resgates Expirados -->
            @if ($resgatesExpiradosCount > 0)
                <div class="mb-6 p-4 bg-orange-500/10 border border-orange-500/30 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-start gap-3">
                            <i data-lucide="alert-triangle" class="w-5 h-5 text-orange-400 mt-0.5 flex-shrink-0"></i>
                            <div>
                                <h3 class="text-orange-300 font-semibold">
                                    {{ $resgatesExpiradosCount }} resgate(s) expirado(s) pendente(s)
                                </h3>
                                <p class="text-orange-200 text-sm mt-1">
                                    Estes resgates passaram da data de expiração e precisam ser reembolsados.
                                </p>
                            </div>
                        </div>
                        <button type="button" onclick="confirmarReembolsoExpirados({{ $resgatesExpiradosCount }})"
                            class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-500 text-white rounded-lg transition-colors group">
                            <i data-lucide="refresh-ccw"
                                class="w-4 h-4 mr-2 group-hover:rotate-180 transition-transform"></i>
                            Reembolsar Todos
                        </button>
                    </div>
                </div>
            @endif

            <!-- Mensagem de Sucesso -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-lg flex items-center gap-3">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-400 flex-shrink-0"></i>
                    <div>
                        <h3 class="text-green-300 font-semibold">{{ session('success') }}</h3>
                        @if (session('reembolsos') && count(session('reembolsos')) > 0)
                            <div class="mt-2 text-green-200 text-sm">
                                <p class="font-medium">Resgates reembolsados:</p>
                                <ul class="mt-1 space-y-1 max-h-32 overflow-y-auto">
                                    @foreach (session('reembolsos') as $reembolso)
                                        <li class="flex justify-between">
                                            <span>{{ $reembolso['usuario'] }} - {{ $reembolso['recompensa'] }}</span>
                                            <span class="text-green-300 font-mono">{{ $reembolso['pontos'] }} pts</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Barra de Ferramentas: Busca e Filtros -->
            <div class="mb-8 p-6 bg-gray-800/50 rounded-xl shadow-lg border border-gray-700">
                <form action="{{ route('admin.resgates.index') }}" method="GET" id="searchForm">
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
                                    placeholder="Pesquisar por código, usuário, empresa..." value="{{ request('search') }}">

                                <!-- Botão X para limpar -->
                                <a href="{{ route('admin.resgates.index', ['fields' => request('fields'), 'status' => request('status')]) }}"
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
                                <x-custom-checkbox id="field_codigo" name="fields[]" value="codigo" label="Código"
                                    :checked="in_array('codigo', request('fields', ['codigo']))" />
                                <x-custom-checkbox id="field_usuario" name="fields[]" value="usuario" label="Usuário"
                                    :checked="in_array('usuario', request('fields', []))" />
                                <x-custom-checkbox id="field_empresa" name="fields[]" value="empresa" label="Empresa"
                                    :checked="in_array('empresa', request('fields', []))" />
                                <x-custom-checkbox id="field_recompensa" name="fields[]" value="recompensa"
                                    label="Recompensa" :checked="in_array('recompensa', request('fields', []))" />
                            </div>
                        </div>

                        <!-- Botão de Pesquisar -->
                        <div class="md:col-span-2">
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-4 py-2 w-full text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                                <i data-lucide="search" class="h-5 w-5 text-lime-300"></i>
                                <span>Pesquisar</span>
                            </button>
                        </div>
                    </div>

                    <!-- Filtro de Status -->
                    <div class="mt-4 flex items-center gap-4">
                        <label class="text-sm font-medium text-gray-400">Status:</label>
                        <select name="status"
                            class="bg-gray-900 border border-gray-700 text-white text-sm rounded-md px-3 py-2 focus:ring-lime-500 focus:border-lime-500">
                            <option value="">Todos os status</option>
                            <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendente
                            </option>
                            <option value="utilizado" {{ request('status') == 'utilizado' ? 'selected' : '' }}>Utilizado
                            </option>
                            <option value="expirado" {{ request('status') == 'expirado' ? 'selected' : '' }}>Expirado
                            </option>
                            <option value="reembolsado" {{ request('status') == 'reembolsado' ? 'selected' : '' }}>
                                Reembolsado</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Lista de Resgates -->
            @if ($resgates->isEmpty())
                <div class="text-center py-16 px-4 bg-gray-800/50 rounded-lg shadow-md border border-gray-700">
                    <i data-lucide="search-x" class="w-16 h-16 text-gray-500 mx-auto mb-4"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-200">Nenhum resgate encontrado</h3>
                    <p class="mt-1 text-sm text-gray-400">Tente ajustar sua busca ou filtros.</p>
                </div>
            @else
                <div class="bg-gray-800/50 rounded-xl shadow-lg border border-gray-700 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-900">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Código
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Usuário
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Recompensa
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Empresa
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Data Resgate
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Pontos
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800/50 divide-y divide-gray-700">
                                @foreach ($resgates as $resgate)
                                    <tr class="hover:bg-gray-700/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-mono text-lime-400">{{ $resgate->codigo_resgate }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-white">
                                                {{ $resgate->cadastrado->user->name }}
                                            </div>
                                            <div class="text-sm text-gray-400">
                                                {{ $resgate->cadastrado->user->email }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-white">
                                                {{ $resgate->reward->titulo }}
                                            </div>
                                            <div class="text-sm text-gray-400 truncate max-w-xs">
                                                {{ $resgate->reward->descricao }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-300">
                                                {{ $resgate->reward->empresa->user->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $resgate->status == 'pendente' && $resgate->data_expiracao->isPast() ? 'bg-red-500/20 text-red-400 border border-red-500/30' : '' }}
                                                {{ $resgate->status == 'pendente' && !$resgate->data_expiracao->isPast() ? 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30' : '' }}
                                                {{ $resgate->status == 'utilizado' ? 'bg-green-500/20 text-green-400 border border-green-500/30' : '' }}
                                                {{ $resgate->status == 'reembolsado' ? 'bg-blue-500/20 text-blue-400 border border-blue-500/30' : '' }}">

                                                @if ($resgate->status == 'pendente' && $resgate->data_expiracao->isPast())
                                                    Expirado
                                                @else
                                                    {{ ucfirst($resgate->status) }}
                                                @endif

                                            </span>
                                            @if ($resgate->status == 'pendente' && $resgate->data_expiracao)
                                                <div class="text-xs text-gray-400 mt-1">
                                                    @if ($resgate->data_expiracao->isPast())
                                                        Expirou em: {{ $resgate->data_expiracao->format('d/m/Y') }}
                                                    @else
                                                        Expira: {{ $resgate->data_expiracao->format('d/m/Y') }}
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                            {{ $resgate->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-lime-400 font-semibold">
                                            {{ number_format($resgate->pontos_gastos, 0) }} pts
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                            <a href="{{ route('admin.resgates.show', $resgate->id) }}"
                                                class="inline-flex items-center px-3 py-1 bg-blue-600/20 text-blue-400 hover:bg-blue-600/30 border border-blue-500/30 rounded-md transition-colors hover:text-blue-300"
                                                title="Ver detalhes do resgate">
                                                <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                                Detalhes
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Paginação -->
                <div class="mt-6">
                    {{ $resgates->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Formulário oculto para reembolso -->
    <form id="reembolsoForm" action="{{ route('admin.resgates.reembolsar-expirados') }}" method="POST" class="hidden">
        @csrf
    </form>

    <script>
        function confirmarReembolsoExpirados(quantidade) {
            Swal.fire({
                html: `
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12 text-orange-400 mx-auto mb-4">
                            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                            <path d="M12 9v4"/>
                            <path d="M12 17h.01"/>
                        </svg>
                        <h3 class="text-xl mb-2 font-bold text-white mb-2">Reembolsar Resgates Expirados</h3>
                        
                        <div class="mb-4">
                            <div class="bg-orange-500/10 border border-orange-500/30 rounded-xl p-4 mb-3">
                                <div class="flex items-center justify-center text-lg text-orange-300 font-semibold">
                                    <i data-lucide="alert-triangle" class="w-5 h-5 mr-2"></i>
                                    ${quantidade} resgate(s) expirado(s)
                                </div>
                            </div>
                        </div>
                        
                        <p class="text-gray-300 mb-6 mt-6">Tem certeza que deseja reembolsar todos os <strong class="text-white">${quantidade} resgates expirados</strong>?</p>
                        <p class="text-orange-400 text-sm mb-4">Os pontos serão devolvidos aos usuários automaticamente.</p>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Reembolsar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#f59e0b',
                cancelButtonColor: '#6b7280',
                customClass: {
                    popup: 'bg-slate-800 rounded-2xl border border-gray-700',
                    title: 'hidden',
                    htmlContainer: '!text-left',
                    confirmButton: 'px-6 py-2 mr-2 text-sm bg-orange-600 hover:bg-orange-500 text-white rounded-lg transition-colors',
                    cancelButton: 'px-6 py-2 ml-2 text-sm text-gray-300 bg-gray-600 hover:bg-gray-700 hover:text-white transition-colors rounded-lg'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reembolsoForm').submit();
                }
            });
        }
    </script>
@endsection
