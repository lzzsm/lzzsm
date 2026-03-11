@extends('layouts.main')

@section('title', 'Gerenciar Resgates - Empresa')

@section('content')

    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-7xl mx-auto">

                <!-- Cabeçalho -->
                <div class="relative text-center mb-12">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">Gerenciar Resgates</h1>
                    <p class="mt-3 text-lg text-gray-400">Controle e valide os resgates das suas recompensas</p>

                    <!-- Voltar -->
                    <div class="absolute top-0 left-0">
                        <a href="{{ route('dashboard') }}">
                            <button type="button"
                                class="group flex items-center gap-2 px-4 py-2 bg-slate-800/50 border border-emerald-700/30 rounded-full hover:bg-emerald-800/50 hover:border-lime-400/50 transition-all duration-300 transform hover:-translate-y-1"
                                title="Voltar à Dashboard">
                                <i data-lucide="arrow-left"
                                    class="w-5 h-5 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                <span class="text-gray-300 font-medium group-hover:text-lime-300 transition-colors">
                                    Dashboard
                                </span>
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Cards de Estatísticas -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <!-- Total de Resgates -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-xl p-6 border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                        <div class="flex items-center">
                            <div class="p-3 bg-lime-500/20 rounded-xl mr-4">
                                <i data-lucide="gift" class="w-8 h-8 text-lime-400"></i>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Total Resgates</p>
                                <p class="text-3xl font-bold text-lime-400 mt-1">{{ $resgates->total() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pendentes -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-xl p-6 border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                        <div class="flex items-center">
                            <div class="p-3 bg-amber-500/20 rounded-xl mr-4">
                                <i data-lucide="clock" class="w-8 h-8 text-amber-400"></i>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Pendentes</p>
                                <p class="text-3xl font-bold text-amber-400 mt-1">
                                    {{ $resgates->where('status', 'pendente')->where('data_expiracao', '>', now())->count() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Utilizados -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-xl p-6 border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                        <div class="flex items-center">
                            <div class="p-3 bg-emerald-500/20 rounded-xl mr-4">
                                <i data-lucide="check-circle" class="w-8 h-8 text-emerald-400"></i>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Utilizados</p>
                                <p class="text-3xl font-bold text-emerald-400 mt-1">
                                    {{ $resgates->where('status', 'utilizado')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Expirados -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-xl p-6 border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                        <div class="flex items-center">
                            <div class="p-3 bg-red-500/20 rounded-xl mr-4">
                                <i data-lucide="x-circle" class="w-8 h-8 text-red-400"></i>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm font-medium">Expirados</p>
                                <p class="text-3xl font-bold text-red-400 mt-1">
                                    {{ $resgates->where('status', 'pendente')->where('data_expiracao', '<=', now())->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Validar Código -->
                <div
                    class="mb-8 bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-xl p-6 border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="p-3 bg-lime-500/20 rounded-xl mr-4">
                                <i data-lucide="key" class="w-8 h-8 text-lime-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-lime-300 mb-1">Validar Código</h3>
                                <p class="text-gray-400 text-sm">Valide um código de resgate informado pelo cliente</p>
                            </div>
                        </div>
                        <a href="{{ route('empresas.resgates.validar') }}"
                            class="inline-flex items-center justify-center gap-2 bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-6 rounded-lg border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 group">
                            <i data-lucide="check-circle"
                                class="w-5 h-5 text-lime-400 group-hover:scale-110 transition-transform"></i>
                            <span class="text-base font-medium">Validar</span>
                        </a>
                    </div>
                </div>

                <!-- Filtros -->
                {{--
                <div
                    class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-xl p-6 border border-emerald-700/30 hover:border-lime-500/50 transition-colors mb-8">
                    <div class="flex flex-wrap gap-4 items-center">
                        <span class="text-gray-400 font-medium">Filtrar por:</span>
                        <a href="{{ request()->fullUrlWithQuery(['status' => '']) }}"
                            class="px-4 py-2 rounded-lg border {{ !request('status') ? 'bg-lime-500/20 border-lime-500/50 text-lime-300' : 'bg-slate-800/50 border-emerald-600/30 text-gray-400 hover:bg-slate-700/60' }} transition-colors">
                            Todos
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'pendente'], ['data_expiracao' > now()]) }}"
                            class="px-4 py-2 rounded-lg border {{ request('status') === 'pendente' ? 'bg-amber-500/20 border-amber-500/50 text-amber-300' : 'bg-slate-800/50 border-emerald-600/30 text-gray-400 hover:bg-slate-700/60' }} transition-colors">
                            Pendentes
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'utilizado']) }}"
                            class="px-4 py-2 rounded-lg border {{ request('status') === 'utilizado' ? 'bg-emerald-500/20 border-emerald-500/50 text-emerald-300' : 'bg-slate-800/50 border-emerald-600/30 text-gray-400 hover:bg-slate-700/60' }} transition-colors">
                            Utilizados
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'expirado']) }}"
                            class="px-4 py-2 rounded-lg border {{ request('status') === 'expirado' ? 'bg-red-500/20 border-red-500/50 text-red-300' : 'bg-slate-800/50 border-emerald-600/30 text-gray-400 hover:bg-slate-700/60' }} transition-colors">
                            Expirados
                        </a>
                    </div>
                </div>
                --}}

                @if ($resgates->count() > 0)
                    <!-- Tabela de Resgates -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-xl border border-emerald-700/30 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-slate-800/50 border-b border-emerald-700/30">
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Cliente</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Recompensa</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Status</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Expiração</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Pontos</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-emerald-700/30">
                                    @foreach ($resgates as $resgate)
                                        @php
                                            $estaExpirado =
                                                $resgate->status === 'pendente' && $resgate->data_expiracao->isPast();
                                            $podeSerReembolsado = $resgate->status === 'pendente' && $estaExpirado;
                                            $diasRestantes = $resgate->data_expiracao
                                                ? $resgate->data_expiracao->diffInDays(now(), false) * -1
                                                : 0;
                                        @endphp
                                        <tr class="hover:bg-slate-800/30 transition-colors">
                                            <!-- Cliente -->
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    @if ($resgate->cadastrado->user->profile_photo_path)
                                                        <img src="{{ asset('storage/' . $resgate->cadastrado->user->profile_photo_path) }}"
                                                            alt="Foto"
                                                            class="w-8 h-8 rounded-full mr-3 border border-lime-400/50">
                                                    @else
                                                        <div
                                                            class="w-8 h-8 bg-lime-600 rounded-full flex items-center justify-center mr-3 border border-lime-400/50">
                                                            <span class="text-white text-xs font-bold">
                                                                {{ strtoupper(substr($resgate->cadastrado->nome, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="text-white font-medium">
                                                            {{ $resgate->cadastrado->nome }}</div>
                                                        <div class="text-gray-400 text-sm">
                                                            {{ $resgate->cadastrado->user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Recompensa -->
                                            <td class="px-6 py-4">
                                                <div class="text-white font-medium">{{ $resgate->reward->titulo }}</div>
                                                <div class="text-gray-400 text-sm">Valor:
                                                    {{ number_format($resgate->reward->pontos_necessarios, 0, ',', '.') }}
                                                    pts</div>
                                            </td>

                                            <!-- Status -->
                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                                    {{ $resgate->status == 'pendente' && !$resgate->data_expiracao->isPast() ? 'bg-amber-500/20 text-amber-300 border border-amber-500/30' : '' }}
                                                    {{ $resgate->status == 'utilizado' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : '' }}
                                                    {{ $resgate->status == 'pendente' && $resgate->data_expiracao->isPast() ? 'bg-red-500/20 text-red-300 border border-red-500/30' : '' }}
                                                    {{ $resgate->status == 'reembolsado' ? 'bg-gray-500/20 text-gray-300 border border-gray-500/30' : '' }}">
                                                    <i data-lucide="{{ $resgate->status === 'pendente' ? 'clock' : ($resgate->status === 'utilizado' ? 'check-circle' : 'x-circle') }}"
                                                        class="w-3 h-3 mr-1"></i>
                                                    @if ($resgate->status == 'pendente' && $resgate->data_expiracao->isPast())
                                                        Expirado
                                                    @else
                                                        {{ ucfirst($resgate->status) }}
                                                    @endif
                                                </span>
                                                @if ($resgate->status === 'pendente' && $diasRestantes <= 3 && $diasRestantes > 0)
                                                    <div class="text-red-400 text-xs mt-1">{{ $diasRestantes }} dias
                                                        restantes</div>
                                                @endif
                                            </td>

                                            <!-- Expiração -->
                                            <td class="px-6 py-4">
                                                @if ($resgate->status === 'pendente')
                                                    <div class="text-white">
                                                        {{ $resgate->data_expiracao->format('d/m/Y') }}</div>
                                                    @if ($resgate->status == 'pendente' && $resgate->data_expiracao->isPast())
                                                        <div class="text-red-400 text-sm">Expirado</div>
                                                    @else
                                                        <div class="text-yellow-600 text-sm">{{ $diasRestantes }} dias
                                                            restantes</div>
                                                    @endif
                                                @else
                                                    <div class="text-gray-500">-</div>
                                                @endif
                                            </td>

                                            <!-- Pontos -->
                                            <td class="px-6 py-4">
                                                <div class="text-amber-400 font-semibold">
                                                    {{ number_format($resgate->pontos_gastos, 0, ',', '.') }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Paginação -->
                    @if ($resgates->hasPages())
                        <div class="mt-6 flex justify-center">
                            <div
                                class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-xl p-4 border border-emerald-700/30">
                                {{ $resgates->links() }}
                            </div>
                        </div>
                    @endif
                @else
                    <!-- Estado Vazio -->
                    <div class="text-center py-16 px-4 bg-gray-800/50 rounded-lg shadow-md border border-gray-700">
                        <i data-lucide="search-x" class="w-16 h-16 text-gray-500 mx-auto mb-4"></i>
                        <h3 class="mt-2 text-sm font-medium text-gray-200">Nenhum resgate encontrado</h3>
                        <p class="mt-1 text-sm text-gray-400">
                            @if (request('status'))
                                Não há resgates com o status selecionado.
                            @else
                                Ainda não há resgates das suas recompensas.
                            @endif
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('rewards.my') }}"
                                class="inline-flex items-center justify-center gap-2 bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-6 rounded-lg border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 group">
                                <i data-lucide="package"
                                    class="w-5 h-5 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                <span class="text-base font-medium">Gerenciar Recompensas</span>
                            </a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script>
        // Auto-hide notifications
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('notification');
            const errorNotification = document.getElementById('notification-error');

            if (notification) {
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 5000);
            }

            if (errorNotification) {
                setTimeout(() => {
                    errorNotification.style.display = 'none';
                }, 5000);
            }
        });
    </script>

@endsection
