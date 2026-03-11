@extends('layouts.main')

@section('title', 'Minhas Coletas')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho -->
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-extrabold text-white tracking-tight">Minhas Coletas</h1>
                <p class="mt-2 text-lg text-gray-400">Acompanhe todas as suas coletas agendadas e realizadas</p>
            </div>

            <!-- Barra de Ferramentas: Filtros -->
            <div class="mb-8 p-6 bg-gray-800/50 rounded-xl shadow-lg border border-gray-700">
                <form action="{{ route('collects.my-collects') }}" method="GET" id="filterForm">
                    <div class="flex flex-col sm:flex-row gap-4 items-end">
                        <!-- Filtro de Status -->
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-400 mb-2">
                                <i data-lucide="filter" class="w-4 h-4 inline mr-1"></i>
                                Filtrar por Status
                            </label>
                            <select name="status"
                                class="w-full bg-gray-900 border border-gray-700 text-white text-sm rounded-md px-3 py-2 focus:ring-lime-500 focus:border-lime-500">
                                <option value="">Todas as coletas</option>
                                <option value="agendada" {{ request('status') == 'agendada' ? 'selected' : '' }}>Agendadas
                                </option>
                                <option value="expirada" {{ request('status') == 'expirada' ? 'selected' : '' }}>
                                    Expiradas</option>
                                <option value="realizada" {{ request('status') == 'realizada' ? 'selected' : '' }}>
                                    Realizadas</option>
                                <option value="cancelada" {{ request('status') == 'cancelada' ? 'selected' : '' }}>
                                    Canceladas</option>
                            </select>
                        </div>

                        <!-- Botão de Filtrar -->
                        <div>
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-6 py-2 text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                                <i data-lucide="filter" class="h-5 w-5 text-lime-300"></i>
                                <span>Filtrar</span>
                            </button>
                        </div>

                        <!-- Botão Limpar Filtros -->
                        @if (request('status'))
                            <div>
                                <a href="{{ route('collects.my-collects') }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-gray-500/70 font-QuicksandMedium text-gray-300 bg-gray-700 px-6 py-2 text-sm font-semibold transition hover:bg-gray-600 hover:scale-[1.02] active:scale-95">
                                    <i data-lucide="x" class="h-5 w-5 text-gray-400"></i>
                                    <span>Limpar</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Cards de Estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
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

                <!-- Pontos Obtidos -->
                <div
                    class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-6 border border-gray-700/50 shadow-lg text-center">
                    <div class="text-3xl font-bold text-lime-400 mb-2">
                        {{ number_format($collects->where('status', 'realizada')->sum('pontos_gerados'), 0, ',', '.') }}
                    </div>
                    <div class="text-gray-400 text-sm">Pontos Obtidos</div>
                </div>
            </div>

            <!-- Lista de Coletas -->
            @if ($collects->isEmpty())
                <div class="text-center py-16 px-4 bg-gray-800/50 rounded-lg shadow-md border border-gray-700">
                    <i data-lucide="calendar-x" class="w-16 h-16 text-gray-500 mx-auto mb-4"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-200">Nenhuma coleta encontrada</h3>
                    <p class="mt-1 mb-6 text-sm text-gray-400">
                        @if (request('status'))
                            Não há coletas com o status selecionado.
                        @else
                            Você ainda não agendou nenhuma coleta.
                        @endif
                    </p>
                    <a href="{{ route('collects.create') }}"
                        class="inline-flex items-center justify-center gap-2 bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-6 rounded-lg border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 group">
                        <i data-lucide="calendar-plus"
                            class="w-5 h-5 text-lime-400 group-hover:scale-110 transition-transform"></i>
                        <span class="text-base font-medium">Agendar Coleta</span>
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach ($collects as $collect)
                        @php
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

                            $pontoExcluido = $collect->collectPoint && $collect->collectPoint->trashed();
                            $temMateriaisExcluidos = $collect->materials->contains(
                                fn($material) => $material->trashed(),
                            );
                        @endphp
                        <div
                            class="group bg-gradient-to-br from-gray-800/80 to-gray-900/80 rounded-2xl shadow-2xl overflow-hidden border {{ $pontoExcluido || $temMateriaisExcluidos ? 'border-red-500/50 bg-red-900/10' : 'border-gray-700/30' }} hover:border-lime-500/50 transition-all duration-500 hover:scale-[1.02] hover:shadow-lime-500/10">

                            <!-- Header -->
                            <div class="p-6 border-b border-gray-700/50">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex flex-wrap gap-2">
                                        <span
                                            class="bg-{{ $statusCor }}-500/20 text-{{ $statusCor }}-300 text-xs font-bold px-3 py-1 rounded-full border border-{{ $statusCor }}-500/30 flex items-center w-fit">
                                            <i data-lucide="{{ $statusIcon }}" class="w-3 h-3 mr-1"></i>
                                            {{ ucfirst($statusVisual) }}
                                        </span>

                                        @if ($pontoExcluido || $temMateriaisExcluidos)
                                            <div class="flex gap-1">
                                                @if ($pontoExcluido)
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-red-500/20 text-red-400 border border-red-500/30"
                                                        title="Ponto de coleta excluído">
                                                        <i data-lucide="map-pin" class="w-3 h-3 mr-1"></i>
                                                        Ponto
                                                    </span>
                                                @endif
                                                @if ($temMateriaisExcluidos)
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-orange-500/20 text-orange-400 border border-orange-500/30"
                                                        title="Contém materiais excluídos">
                                                        <i data-lucide="package" class="w-3 h-3 mr-1"></i>
                                                        Materiais
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lime-400 font-bold text-xl">
                                            {{ number_format($collect->pontos_gerados, 0, ',', '.') }} pts
                                        </div>
                                        <div class="text-gray-400 text-sm">Pontos</div>
                                    </div>
                                </div>

                                <h3
                                    class="text-xl font-bold text-white mb-2 line-clamp-2 group-hover:text-lime-300 transition-colors">
                                    Coleta #{{ $collect->id }}
                                </h3>
                                <div class="flex items-center gap-2">
                                    @if ($pontoExcluido)
                                        <i data-lucide="ban" class="w-4 h-4 text-red-400"></i>
                                    @else
                                        <i data-lucide="map-pin" class="w-4 h-4 text-gray-400"></i>
                                    @endif
                                    <p class="text-gray-400 text-sm {{ $pontoExcluido ? 'text-red-300' : '' }}">
                                        {{ $collect->collectPoint->nome ?? 'Ponto de Coleta Removido' }}
                                        @if ($pontoExcluido)
                                            <span class="text-red-400 text-xs ml-1">(Excluído)</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="p-6">
                                <!-- Informações -->
                                <div class="space-y-4 mb-6">
                                    <!-- Data -->
                                    <div
                                        class="flex items-center justify-between p-3 bg-gray-700/30 rounded-xl border border-gray-600/30">
                                        <div class="flex items-center">
                                            <i data-lucide="calendar" class="w-5 h-5 text-blue-400 mr-3"></i>
                                            <span class="text-gray-300 font-medium">Data</span>
                                        </div>
                                        <span class="text-gray-300 font-semibold">
                                            {{ $collect->data->format('d/m/Y H:i') }}
                                            @if ($statusVisual === 'expirada')
                                                <span class="text-orange-400 text-xs block">Data expirada</span>
                                            @endif
                                        </span>
                                    </div>

                                    <!-- Materiais -->
                                    <div class="p-3 bg-gray-700/30 rounded-xl border border-gray-600/30">
                                        <div class="flex items-center mb-2">
                                            <i data-lucide="package" class="w-5 h-5 text-purple-400 mr-3"></i>
                                            <span class="text-gray-300 font-medium">Materiais</span>
                                            @if ($temMateriaisExcluidos)
                                                <span
                                                    class="ml-2 px-2 py-1 text-xs bg-orange-500/20 text-orange-400 rounded-full border border-orange-500/30">
                                                    Com excluídos
                                                </span>
                                            @endif
                                        </div>
                                        <div class="space-y-2">
                                            @foreach ($collect->materials as $material)
                                                @php
                                                    $materialExcluido = $material->trashed();
                                                @endphp
                                                <div class="flex justify-between text-sm">
                                                    <div class="flex items-center gap-1">
                                                        @if ($materialExcluido)
                                                            <i data-lucide="ban" class="w-3 h-3 text-red-400"></i>
                                                        @endif
                                                        <span
                                                            class="{{ $materialExcluido ? 'text-red-300 line-through' : 'text-gray-400' }}">
                                                            {{ $material->categoria }}
                                                        </span>
                                                    </div>
                                                    <span
                                                        class="{{ $materialExcluido ? 'text-red-300' : 'text-lime-400' }} font-semibold">
                                                        {{ number_format($material->pivot->peso, 2, ',', '.') }} kg
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Validação -->
                                    @if ($collect->data_validacao)
                                        <div
                                            class="flex items-center justify-between p-3 bg-gray-700/30 rounded-xl border border-gray-600/30">
                                            <div class="flex items-center">
                                                <i data-lucide="check-circle" class="w-5 h-5 text-green-400 mr-3"></i>
                                                <span class="text-gray-300 font-medium">Validada em</span>
                                            </div>
                                            <span class="text-gray-300 text-sm">
                                                {{ $collect->data_validacao->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Botão de Detalhes -->
                                <div class="pt-4 border-t border-gray-700/50">
                                    <a href="{{ route('collects.show', $collect->id) }}"
                                        class="w-full inline-flex items-center justify-center px-6 py-3 bg-lime-500 hover:bg-lime-400 text-slate-900 font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg hover:shadow-lime-500/25 group/btn">
                                        <span>Ver Detalhes</span>
                                        <i data-lucide="arrow-right"
                                            class="w-4 h-4 ml-2 transition-transform duration-300 group-hover/btn:translate-x-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginação -->
                @if ($collects->hasPages())
                    <div class="mt-8 flex justify-center">
                        <div class="bg-gray-800/50 rounded-2xl p-4 border border-gray-700/30">
                            {{ $collects->links() }}
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
