@extends('layouts.main')

@section('title', 'Detalhes da Coleta')

@section('content')

    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-4xl mx-auto">

                <!-- Botão Voltar -->
                <div class="mb-8">
                    <a href="{{ Auth::user()->nivel_permissao === 'admin' ? route('collects.index') : route('collects.my-collects') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-lime-300 transition-colors group">
                        <i data-lucide="arrow-left"
                            class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:-translate-x-1"></i>
                        Voltar para Lista
                    </a>
                </div>

                @php
                    $pontoExcluido = $collect->collectPoint && $collect->collectPoint->trashed();
                    $usuarioExcluido = $collect->cadastrado->user->trashed();
                    $materiaisExcluidos = $collect->materials->contains(fn($material) => $material->trashed());
                    $temMateriaisExcluidos = $collect->materials->contains(fn($material) => $material->trashed());

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

                <!-- Alert para itens excluídos -->
                @if ($pontoExcluido || $temMateriaisExcluidos || $usuarioExcluido)
                    <div class="mb-6 p-4 bg-red-900/30 border border-red-500/50 rounded-lg flex items-start gap-3">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-red-400 mt-0.5 flex-shrink-0"></i>
                        <div class="flex-1">
                            <h3 class="font-medium text-red-300 mb-1">Atenção: Itens excluídos</h3>
                            <p class="text-red-200 text-sm">
                                Esta coleta contém itens que foram excluídos do sistema.
                                As informações são mantidas para histórico.
                            </p>
                            <ul class="text-red-200 text-sm mt-2 space-y-1">
                                @if ($pontoExcluido)
                                    <li class="flex items-center gap-2">
                                        <i data-lucide="map-pin" class="w-3 h-3"></i>
                                        <span>Ponto de coleta foi excluído</span>
                                    </li>
                                @endif
                                @if ($temMateriaisExcluidos)
                                    <li class="flex items-center gap-2">
                                        <i data-lucide="package" class="w-3 h-3"></i>
                                        <span>Contém materiais excluídos</span>
                                    </li>
                                @endif
                                @if ($usuarioExcluido)
                                    <li class="flex items-center gap-2">
                                        <i data-lucide="user-x" class="w-3 h-3"></i>
                                        <span>Usuário foi excluído</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Card Principal -->
                <div
                    class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl shadow-2xl overflow-hidden border border-gray-700/30">

                    <!-- Header com Status -->
                    <div class="p-8 border-b border-gray-700/50">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                            <div>
                                <div class="flex flex-wrap items-center gap-2 mb-4">
                                    <span
                                        class="bg-{{ $statusCor }}-500/20 text-{{ $statusCor }}-300 text-sm font-bold px-4 py-2 rounded-full border border-{{ $statusCor }}-500/30 inline-flex items-center">
                                        <i data-lucide="{{ $statusIcon }}" class="w-4 h-4 mr-2"></i>
                                        {{ ucfirst($statusVisual) }}
                                    </span>

                                    @if ($pontoExcluido)
                                        <span
                                            class="bg-red-500/20 text-red-300 text-sm font-bold px-4 py-2 rounded-full border border-red-500/30 inline-flex items-center">
                                            <i data-lucide="ban" class="w-4 h-4 mr-2"></i>
                                            Ponto Excluído
                                        </span>
                                    @endif

                                    @if ($usuarioExcluido)
                                        <span
                                            class="bg-red-500/20 text-red-300 text-sm font-bold px-4 py-2 rounded-full border border-red-500/30 inline-flex items-center">
                                            <i data-lucide="user-x" class="w-4 h-4 mr-2"></i>
                                            Usuário Excluído
                                        </span>
                                    @endif
                                </div>
                                <h1 class="text-3xl font-bold text-white">Coleta #{{ $collect->id }}</h1>
                                <p class="text-gray-400 mt-2 flex items-center">
                                    <i data-lucide="map-pin" class="w-4 h-4 mr-1"></i>
                                    {{ $collect->collectPoint->nome ?? 'Ponto de Coleta Removido' }}
                                    @if ($pontoExcluido)
                                        <span class="ml-2 text-red-400 text-sm">(Excluído)</span>
                                    @endif
                                </p>
                            </div>
                            <div class="mt-4 lg:mt-0 text-center lg:text-right">
                                <div class="text-4xl font-bold text-lime-400">
                                    {{ number_format($collect->pontos_gerados, 0, ',', '.') }}
                                </div>
                                <div class="text-lime-300 text-sm">pontos gerados</div>
                            </div>
                        </div>
                    </div>

                    <div class="p-8">
                        <!-- Grid de Informações -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                            <!-- Informações da Coleta -->
                            <div class="space-y-6">
                                <h3 class="text-xl font-semibold text-white flex items-center">
                                    <i data-lucide="calendar" class="w-5 h-5 text-blue-400 mr-2"></i>
                                    Informações da Coleta
                                </h3>

                                <div class="space-y-4">
                                    <!-- Data Agendada -->
                                    <div
                                        class="flex justify-between items-center p-4 bg-gray-700/30 rounded-xl border border-gray-600/30">
                                        <div class="flex items-center">
                                            <i data-lucide="clock" class="w-5 h-5 text-blue-400 mr-3"></i>
                                            <span class="text-gray-300 font-medium">Data Agendada</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-white font-semibold">
                                                {{ $collect->data->format('d/m/Y H:i') }}
                                            </span>
                                            @if ($statusVisual === 'expirada')
                                                <div class="text-orange-400 text-xs mt-1">Data expirada</div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Ponto de Coleta -->
                                    <div
                                        class="p-4 bg-gray-700/30 rounded-xl border {{ $pontoExcluido ? 'border-red-500/30 bg-red-900/10' : 'border-gray-600/30' }}">
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="flex items-center">
                                                <i data-lucide="map-pin"
                                                    class="w-5 h-5 {{ $pontoExcluido ? 'text-red-400' : 'text-green-400' }} mr-3"></i>
                                                <span class="text-gray-300 font-medium">Ponto de Coleta</span>
                                            </div>
                                            @if ($pontoExcluido)
                                                <span
                                                    class="px-2 py-1 text-xs bg-red-500/20 text-red-400 rounded-full border border-red-500/30">
                                                    Excluído
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-white">
                                            <div class="font-semibold {{ $pontoExcluido ? 'text-red-300' : '' }}">
                                                {{ $collect->collectPoint->nome ?? 'Ponto de Coleta Removido' }}
                                            </div>
                                            @if ($collect->collectPoint)
                                                <div
                                                    class="text-sm {{ $pontoExcluido ? 'text-red-300/80' : 'text-gray-400' }} mt-1">
                                                    {{ $collect->collectPoint->endereco_completo ?? 'Endereço não disponível' }}
                                                </div>
                                            @else
                                                <div class="text-sm text-gray-400 mt-1">
                                                    Endereço não disponível
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Data de Validação -->
                                    @if ($collect->data_validacao)
                                        <div
                                            class="flex justify-between items-center p-4 bg-gray-700/30 rounded-xl border border-gray-600/30">
                                            <div class="flex items-center">
                                                <i data-lucide="check-circle" class="w-5 h-5 text-green-400 mr-3"></i>
                                                <span class="text-gray-300 font-medium">Validada em</span>
                                            </div>
                                            <span class="text-white font-semibold">
                                                {{ $collect->data_validacao->format('d/m/Y H:i') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Informações do Usuário -->
                            <div class="space-y-6">
                                <h3 class="text-xl font-semibold text-white flex items-center">
                                    <i data-lucide="user" class="w-5 h-5 text-purple-400 mr-2"></i>
                                    Informações do Usuário
                                </h3>

                                <div class="space-y-4">
                                    <!-- Nome -->
                                    <div
                                        class="p-4 bg-gray-700/30 rounded-xl border {{ $usuarioExcluido ? 'border-red-500/30 bg-red-900/10' : 'border-gray-600/30' }}">
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="flex items-center">
                                                <i data-lucide="user-round"
                                                    class="w-5 h-5 {{ $usuarioExcluido ? 'text-red-400' : 'text-purple-400' }} mr-3"></i>
                                                <span class="text-gray-300 font-medium">Usuário</span>
                                            </div>
                                            @if ($usuarioExcluido)
                                                <span
                                                    class="px-2 py-1 text-xs bg-red-500/20 text-red-400 rounded-full border border-red-500/30">
                                                    Excluído
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-white font-semibold {{ $usuarioExcluido ? 'text-red-300' : '' }}">
                                            {{ $collect->cadastrado->user->name }}
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div
                                        class="flex justify-between items-center p-4 bg-gray-700/30 rounded-xl border border-gray-600/30">
                                        <div class="flex items-center">
                                            <i data-lucide="mail" class="w-5 h-5 text-purple-400 mr-3"></i>
                                            <span class="text-gray-300 font-medium">Email</span>
                                        </div>
                                        <span class="text-white font-semibold text-sm">
                                            {{ $collect->cadastrado->user->email }}
                                        </span>
                                    </div>

                                    <!-- Coletas Realizadas -->
                                    <div
                                        class="flex justify-between items-center p-4 bg-gray-700/30 rounded-xl border border-gray-600/30">
                                        <div class="flex items-center">
                                            <i data-lucide="trending-up" class="w-5 h-5 text-purple-400 mr-3"></i>
                                            <span class="text-gray-300 font-medium">Total de Coletas</span>
                                        </div>
                                        <span class="text-white font-semibold">
                                            {{ $collect->cadastrado->coletas_realizadas }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Materiais -->
                        <div class="mb-8">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-semibold text-white flex items-center">
                                    <i data-lucide="package" class="w-5 h-5 text-orange-400 mr-2"></i>
                                    Materiais da Coleta
                                </h3>
                                @if ($temMateriaisExcluidos)
                                    <span
                                        class="px-3 py-1 text-sm bg-orange-500/20 text-orange-400 rounded-full border border-orange-500/30">
                                        Contém materiais excluídos
                                    </span>
                                @endif
                            </div>

                            @if ($collect->materials->count() > 0)
                                <div class="bg-gray-700/30 rounded-2xl border border-gray-600/30 overflow-hidden">
                                    <table class="w-full">
                                        <thead>
                                            <tr class="border-b border-gray-600/30">
                                                <th class="text-left py-4 px-6 text-gray-300 font-semibold">Material</th>
                                                <th class="text-right py-4 px-6 text-gray-300 font-semibold">Peso (kg)</th>
                                                <th class="text-right py-4 px-6 text-gray-300 font-semibold">Pontos por Kg
                                                </th>
                                                <th class="text-right py-4 px-6 text-gray-300 font-semibold">Pontos
                                                    Calculados
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($collect->materials as $material)
                                                @php
                                                    $materialExcluido = $material->trashed();
                                                @endphp
                                                <tr
                                                    class="border-b border-gray-600/20 last:border-0 {{ $materialExcluido ? 'bg-red-900/10' : '' }}">
                                                    <td class="py-4 px-6">
                                                        <div class="flex items-center gap-2">
                                                            @if ($materialExcluido)
                                                                <i data-lucide="ban" class="w-4 h-4 text-red-400"></i>
                                                            @else
                                                                <i data-lucide="package"
                                                                    class="w-4 h-4 text-lime-400"></i>
                                                            @endif
                                                            <span
                                                                class="{{ $materialExcluido ? 'text-red-300 line-through' : 'text-white' }}">
                                                                {{ $material->categoria }}
                                                            </span>
                                                            @if ($materialExcluido)
                                                                <span
                                                                    class="px-2 py-1 text-xs bg-red-500/20 text-red-400 rounded-full border border-red-500/30">
                                                                    Excluído
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="py-4 px-6 text-right font-semibold {{ $materialExcluido ? 'text-red-300' : 'text-lime-400' }}">
                                                        {{ number_format($material->pivot->peso, 2, ',', '.') }}
                                                    </td>
                                                    <td
                                                        class="py-4 px-6 text-right {{ $materialExcluido ? 'text-red-300' : 'text-gray-300' }}">
                                                        {{ $material->ponto_kg }} pts/kg
                                                    </td>
                                                    <td
                                                        class="py-4 px-6 text-right font-bold {{ $materialExcluido ? 'text-red-300' : 'text-lime-400' }}">
                                                        {{ number_format($material->pivot->pontos_calculados, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr class="bg-gray-600/20">
                                                <td class="py-4 px-6 text-white font-bold" colspan="3">Total</td>
                                                <td class="py-4 px-6 text-right text-lime-400 font-bold text-lg">
                                                    {{ number_format($collect->pontos_gerados, 0, ',', '.') }} pontos
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-8 px-4 bg-gray-700/30 rounded-2xl border border-gray-600/30">
                                    <i data-lucide="package-x" class="w-12 h-12 text-gray-500 mx-auto mb-3"></i>
                                    <p class="text-gray-400">Nenhum material encontrado para esta coleta</p>
                                </div>
                            @endif
                        </div>

                        <!-- Observações -->
                        @if ($collect->observacoes)
                            <div class="mb-8">
                                <h3 class="text-xl font-semibold text-white mb-4 flex items-center">
                                    <i data-lucide="file-text" class="w-5 h-5 text-blue-400 mr-2"></i>
                                    Observações
                                </h3>
                                <div class="bg-gray-700/30 rounded-2xl p-6 border border-gray-600/30">
                                    <p class="text-gray-300 leading-relaxed">{{ $collect->observacoes }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Ações -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-700/50">
                            @if (Auth::user()->nivel_permissao === 'admin')
                                @if ($collect->status === 'agendada' && $collect->data > now())
                                    <!-- Validar Coleta (Admin) - Só aparece se ainda não expirou -->
                                    <form action="{{ route('collects.validate', $collect->id) }}" method="POST"
                                        class="flex-1">
                                        @csrf
                                        <button type="submit"
                                            class="w-full inline-flex items-center justify-center px-6 py-4 bg-green-500 hover:bg-green-400 text-slate-900 font-bold rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-green-500/25 group">
                                            <i data-lucide="check-circle"
                                                class="w-5 h-5 mr-2 transition-transform duration-300 group-hover:scale-110"></i>
                                            Validar Coleta
                                        </button>
                                    </form>
                                @endif
                            @endif

                            @if ($collect->status === 'agendada' && $collect->data > now())
                                <!-- Cancelar Coleta - Só aparece se ainda não expirou -->
                                <form action="{{ route('collects.cancel', $collect->id) }}" method="POST"
                                    class="flex-1">
                                    @csrf
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-6 py-4 bg-orange-500 hover:bg-orange-400 text-slate-900 font-bold rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-orange-500/25 group">
                                        <i data-lucide="x-circle"
                                            class="w-5 h-5 mr-2 transition-transform duration-300 group-hover:scale-110"></i>
                                        Cancelar Coleta
                                    </button>
                                </form>
                            @endif

                            @if ($statusVisual === 'expirada')
                                <!-- Mensagem para coletas expiradas -->
                                <div class="flex-1 text-center">
                                    <div class="p-4 bg-orange-500/10 border border-orange-500/30 rounded-2xl">
                                        <i data-lucide="clock-alert" class="w-8 h-8 text-orange-400 mx-auto mb-2"></i>
                                        <p class="text-orange-300 text-sm">Esta coleta expirou e não pode mais ser
                                            cancelada ou validada.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
