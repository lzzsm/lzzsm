@extends('layouts.main')

@section('title', 'Gerenciar Coletas - Admin')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho -->
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-extrabold text-white tracking-tight">Gerenciamento de Coletas</h1>
                <p class="mt-2 text-lg text-gray-400">Visualize e acompanhe todas as coletas agendadas na plataforma.</p>
            </div>

            <!-- Barra de Ferramentas: Busca e Filtros -->
            <div class="mb-8 p-6 bg-gray-800/50 rounded-xl shadow-lg border border-gray-700">
                <form action="{{ route('collects.index') }}" method="GET" id="searchForm">
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
                                    placeholder="Pesquisar por usuário, ponto de coleta..." value="{{ request('search') }}">

                                <!-- Botão X para limpar -->
                                <a href="{{ route('collects.index', ['fields' => request('fields'), 'status' => request('status')]) }}"
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
                                <x-custom-checkbox id="field_usuario" name="fields[]" value="usuario" label="Usuário"
                                    :checked="in_array('usuario', request('fields', ['usuario']))" />
                                <x-custom-checkbox id="field_ponto" name="fields[]" value="ponto" label="Ponto de Coleta"
                                    :checked="in_array('ponto', request('fields', []))" />
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
                            <option value="agendada" {{ request('status') == 'agendada' ? 'selected' : '' }}>Agendada
                            </option>
                            <option value="expirada" {{ request('status') == 'expirada' ? 'selected' : '' }}>Expirada
                            </option>
                            <option value="realizada" {{ request('status') == 'realizada' ? 'selected' : '' }}>Realizada
                            </option>
                            <option value="cancelada" {{ request('status') == 'cancelada' ? 'selected' : '' }}>Cancelada
                            </option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Cards de Estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-6 gap-6 mb-8">
                <!-- Total de Coletas -->
                <div
                    class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-700/50 shadow-lg text-center">
                    <div class="text-3xl font-bold text-blue-400 mb-2">{{ $collects->total() }}</div>
                    <div class="text-gray-400 text-sm">Total de Coletas</div>
                </div>

                <!-- Agendadas -->
                <div
                    class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-700/50 shadow-lg text-center">
                    <div class="text-3xl font-bold text-yellow-400 mb-2">
                        {{ $collects->where('status', 'agendada')->where('data', '>', now())->count() }}
                    </div>
                    <div class="text-gray-400 text-sm">Agendadas</div>
                </div>

                <!-- Expiradas -->
                <div
                    class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-700/50 shadow-lg text-center">
                    <div class="text-3xl font-bold text-orange-400 mb-2">
                        {{ $collects->where('status', 'agendada')->where('data', '<=', now())->count() }}
                    </div>
                    <div class="text-gray-400 text-sm">Expiradas</div>
                </div>

                <!-- Realizadas -->
                <div
                    class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-700/50 shadow-lg text-center">
                    <div class="text-3xl font-bold text-green-400 mb-2">
                        {{ $collects->where('status', 'realizada')->count() }}
                    </div>
                    <div class="text-gray-400 text-sm">Realizadas</div>
                </div>

                <!-- Canceladas -->
                <div
                    class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-700/50 shadow-lg text-center">
                    <div class="text-3xl font-bold text-red-400 mb-2">
                        {{ $collects->where('status', 'cancelada')->count() }}
                    </div>
                    <div class="text-gray-400 text-sm">Canceladas</div>
                </div>

                <!-- Pontos Distribuídos -->
                <div
                    class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-700/50 shadow-lg text-center">
                    <div class="text-3xl font-bold text-lime-400 mb-2">
                        {{ number_format($collects->where('status', 'realizada')->sum('pontos_gerados'), 0, ',', '.') }}
                    </div>
                    <div class="text-gray-400 text-sm">Pontos Distribuídos</div>
                </div>
            </div>

            <!-- Lista de Coletas -->
            @if ($collects->isEmpty())
                <div class="text-center py-16 px-4 bg-gray-800/50 rounded-lg shadow-md border border-gray-700">
                    <i data-lucide="calendar-x" class="w-16 h-16 text-gray-500 mx-auto mb-4"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-200">Nenhuma coleta encontrada</h3>
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
                                        ID
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Usuário
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Ponto de Coleta
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Materiais
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Data
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                        Status
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
                                @foreach ($collects as $collect)
                                    @php
                                        $pontoExcluido = $collect->collectPoint && $collect->collectPoint->trashed();
                                        $usuarioExcluido = $collect->cadastrado->user->trashed();
                                        $temMateriaisExcluidos = $collect->materials->contains(
                                            fn($material) => $material->trashed(),
                                        );

                                        // Lógica para determinar o status visual
                                        $statusVisual = $collect->status;
                                        $statusCor = 'gray';
                                        $statusIcon = 'help-circle';

                                        if ($collect->status === 'agendada') {
                                            if ($collect->data > now()) {
                                                // Agendada e data futura
                                                $statusVisual = 'agendada';
                                                $statusCor = 'yellow';
                                                $statusIcon = 'clock';
                                            } else {
                                                // Agendada mas data passada - Expirada
                                                $statusVisual = 'expirada';
                                                $statusCor = 'orange';
                                                $statusIcon = 'clock-alert';
                                            }
                                        } elseif ($collect->status === 'realizada') {
                                            $statusCor = 'green';
                                            $statusIcon = 'check-circle';
                                        } elseif ($collect->status === 'cancelada') {
                                            $statusCor = 'red';
                                            $statusIcon = 'x-circle';
                                        }
                                    @endphp
                                    <tr
                                        class="hover:bg-gray-700/50 transition-colors {{ $pontoExcluido || $usuarioExcluido || $temMateriaisExcluidos ? 'bg-red-900/10 border-l-4 border-l-red-500' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <div class="text-sm font-mono text-lime-400">#{{ $collect->id }}</div>
                                                @if ($pontoExcluido || $usuarioExcluido || $temMateriaisExcluidos)
                                                    <div class="flex gap-1">
                                                        @if ($pontoExcluido)
                                                            <span
                                                                class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30"
                                                                title="Ponto de coleta excluído">
                                                                <i data-lucide="map-pin" class="w-3 h-3 mr-0.5"></i>
                                                            </span>
                                                        @endif
                                                        @if ($usuarioExcluido)
                                                            <span
                                                                class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30"
                                                                title="Usuário excluído">
                                                                <i data-lucide="user-x" class="w-3 h-3 mr-0.5"></i>
                                                            </span>
                                                        @endif
                                                        @if ($temMateriaisExcluidos)
                                                            <span
                                                                class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-orange-500/20 text-orange-400 border border-orange-500/30"
                                                                title="Contém materiais excluídos">
                                                                <i data-lucide="package" class="w-3 h-3 mr-0.5"></i>
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                @if ($usuarioExcluido)
                                                    <i data-lucide="user-x" class="w-4 h-4 text-red-400"></i>
                                                @endif
                                                <div>
                                                    <div
                                                        class="text-sm font-medium {{ $usuarioExcluido ? 'text-red-300' : 'text-white' }}">
                                                        {{ $collect->cadastrado->user->name }}
                                                    </div>
                                                    <div
                                                        class="text-sm {{ $usuarioExcluido ? 'text-red-300/80' : 'text-gray-400' }}">
                                                        {{ $collect->cadastrado->user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                @if ($pontoExcluido)
                                                    <i data-lucide="ban" class="w-4 h-4 text-red-400"></i>
                                                @endif
                                                <div>
                                                    <div
                                                        class="text-sm font-medium {{ $pontoExcluido ? 'text-red-300' : 'text-white' }}">
                                                        {{ $collect->collectPoint->nome ?? 'Ponto de Coleta Removido' }}
                                                    </div>
                                                    <div
                                                        class="text-sm {{ $pontoExcluido ? 'text-red-300/80' : 'text-gray-400' }} truncate max-w-xs">
                                                        {{ $collect->collectPoint->cidade ?? 'N/A' }}/{{ $collect->collectPoint->estado ?? 'N/A' }}
                                                        @if ($pontoExcluido)
                                                            <span class="text-red-400 text-xs ml-1">(Excluído)</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="space-y-1 max-w-xs">
                                                @foreach ($collect->materials->take(2) as $material)
                                                    @php
                                                        $materialExcluido = $material->trashed();
                                                    @endphp
                                                    <div class="flex items-center justify-between text-sm">
                                                        <div class="flex items-center gap-1">
                                                            @if ($materialExcluido)
                                                                <i data-lucide="ban" class="w-3 h-3 text-red-400"></i>
                                                            @endif
                                                            <span
                                                                class="{{ $materialExcluido ? 'text-red-300 line-through' : 'text-gray-200' }} truncate">
                                                                {{ $material->categoria }}
                                                            </span>
                                                        </div>
                                                        <span
                                                            class="{{ $materialExcluido ? 'text-red-300' : 'text-lime-400' }} font-semibold text-xs">
                                                            {{ number_format($material->pivot->peso, 1, ',', '.') }}kg
                                                        </span>
                                                    </div>
                                                @endforeach
                                                @if ($collect->materials->count() > 2)
                                                    <div class="text-xs text-gray-500">
                                                        +{{ $collect->materials->count() - 2 }} mais
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                            {{ $collect->data->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full 
                                                {{ $statusVisual == 'agendada' ? 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30' : '' }}
                                                {{ $statusVisual == 'expirada' ? 'bg-orange-500/20 text-orange-400 border border-orange-500/30' : '' }}
                                                {{ $statusVisual == 'realizada' ? 'bg-green-500/20 text-green-400 border border-green-500/30' : '' }}
                                                {{ $statusVisual == 'cancelada' ? 'bg-red-500/20 text-red-400 border border-red-500/30' : '' }}">
                                                <i data-lucide="{{ $statusIcon }}" class="w-3 h-3 inline mr-1"></i>
                                                {{ ucfirst($statusVisual) }}
                                            </span>
                                            @if ($collect->status == 'realizada' && $collect->data_validacao)
                                                <div class="text-xs text-gray-400 mt-1">
                                                    Validada: {{ $collect->data_validacao->format('d/m/Y') }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-lime-400 font-semibold">
                                            {{ number_format($collect->pontos_gerados, 0, ',', '.') }} pts
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                            <div class="flex space-x-2">
                                                <!-- Ver Detalhes -->
                                                <a href="{{ route('collects.show', $collect->id) }}"
                                                    class="inline-flex items-center px-3 py-1 bg-blue-600/20 text-blue-400 hover:bg-blue-600/30 border border-blue-500/30 rounded-md transition-colors hover:text-blue-300"
                                                    title="Ver detalhes da coleta">
                                                    <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                                    Detalhes
                                                </a>

                                                @if ($collect->status === 'agendada' && $collect->data > now())
                                                    <!-- Validar Coleta - Só aparece se ainda não expirou -->
                                                    <form action="{{ route('collects.validate', $collect->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-1 bg-green-600/20 text-green-400 hover:bg-green-600/30 border border-green-500/30 rounded-md transition-colors hover:text-green-300"
                                                            title="Validar coleta realizada">
                                                            <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i>
                                                            Validar
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Paginação -->
                <div class="mt-6">
                    {{ $collects->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
