@extends('layouts.main')

@section('title', 'Solicitar Reembolso')

@section('content')

    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-2xl mx-auto">

                <!-- Botão Voltar -->
                <div class="mb-8">
                    <a href="{{ route('resgates.show', $resgate->id) }}"
                        class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-lime-300 transition-colors group">
                        <i data-lucide="arrow-left"
                            class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:-translate-x-1"></i>
                        Voltar para Detalhes
                    </a>
                </div>

                <!-- Card de Confirmação -->
                <div
                    class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl shadow-2xl overflow-hidden border border-orange-500/30">

                    <!-- Header -->
                    <div class="bg-gradient-to-r from-orange-500/20 to-red-500/20 p-8 border-b border-gray-700/50">
                        <div class="text-center">
                            <div
                                class="inline-flex items-center px-4 py-2 bg-orange-500/10 rounded-2xl border border-orange-500/20 mb-4">
                                <i data-lucide="alert-triangle" class="w-6 h-6 text-orange-400 mr-2"></i>
                                <span class="text-orange-300 font-semibold">Solicitar Reembolso</span>
                            </div>
                            <h2 class="text-2xl font-bold text-white">Confirmar Reembolso</h2>
                            <p class="text-gray-400 mt-2">Você está prestes a solicitar o reembolso deste resgate</p>
                        </div>
                    </div>

                    <div class="p-8">
                        <!-- Informações do Resgate -->
                        <div class="bg-gray-700/30 rounded-2xl p-6 border border-gray-600/30 mb-6">
                            <div class="flex items-center space-x-4 mb-4">
                                @if ($resgate->reward->img_recompensa)
                                    <img class="w-16 h-16 object-cover rounded-xl"
                                        src="{{ asset('storage/' . $resgate->reward->img_recompensa) }}"
                                        alt="{{ $resgate->reward->titulo }}">
                                @else
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-gray-600 to-gray-700 rounded-xl flex items-center justify-center">
                                        <i data-lucide="gift" class="w-8 h-8 text-gray-500"></i>
                                    </div>
                                @endif
                                <div>
                                    <h3 class="text-xl font-bold text-white">{{ $resgate->reward->titulo }}</h3>
                                    <p class="text-gray-400">Código: <code
                                            class="bg-black/20 px-2 py-1 rounded text-lime-400">{{ $resgate->codigo_resgate }}</code>
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-400">Pontos gastos:</span>
                                    <div class="text-yellow-400 font-semibold">
                                        {{ number_format($resgate->pontos_gastos, 0, ',', '.') }} pts</div>
                                </div>
                                <div>
                                    <span class="text-gray-400">Expira em:</span>
                                    @php
                                        $diasRestantes = $resgate->data_expiracao->diffInDays(now(), false);
                                    @endphp
                                    <div class="text-orange-400">{{ $resgate->data_expiracao->format('d/m/Y') }}
                                        ({{ abs($diasRestantes) }} dias)</div>
                                </div>
                            </div>
                        </div>

                        <!-- Alertas Importantes -->
                        <div class="bg-orange-500/10 border border-orange-500/20 rounded-2xl p-6 mb-6">
                            <div class="flex items-start">
                                <div class="p-2 bg-orange-500/20 rounded-lg mr-4">
                                    <i data-lucide="alert-circle" class="w-5 h-5 text-orange-400"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-orange-300 mb-3">Atenção!</h3>
                                    <ul class="text-gray-300 space-y-2 text-sm">
                                        <li class="flex items-start">
                                            <i data-lucide="rotate-ccw"
                                                class="w-4 h-4 text-orange-400 mr-2 mt-0.5 flex-shrink-0"></i>
                                            <span>Seus <strong>{{ number_format($resgate->pontos_gastos, 0, ',', '.') }}
                                                    pontos</strong> serão devolvidos para sua conta</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="package"
                                                class="w-4 h-4 text-orange-400 mr-2 mt-0.5 flex-shrink-0"></i>
                                            <span>Esta recompensa voltará a ficar disponível para outros usuários</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="key"
                                                class="w-4 h-4 text-orange-400 mr-2 mt-0.5 flex-shrink-0"></i>
                                            <span>O código <strong>{{ $resgate->codigo_resgate }}</strong> será invalidado
                                                permanentemente</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="clock"
                                                class="w-4 h-4 text-orange-400 mr-2 mt-0.5 flex-shrink-0"></i>
                                            <span>Esta ação é <strong>irreversível</strong> - você não poderá resgatar esta
                                                recompensa novamente</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <!-- Botão Cancelar -->
                            <a href="{{ route('resgates.show', $resgate->id) }}"
                                class="flex-1 inline-flex items-center justify-center px-6 py-4 bg-gray-600 hover:bg-gray-500 text-white font-semibold rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg text-center">
                                <i data-lucide="x" class="w-5 h-5 mr-2"></i>
                                Manter Resgate
                            </a>

                            <!-- Botão Confirmar Reembolso -->
                            <form action="{{ route('resgates.reembolsar', $resgate->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center px-6 py-4 bg-orange-500 hover:bg-orange-400 text-slate-900 font-bold rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-orange-500/25 group">
                                    <i data-lucide="coins"
                                        class="w-5 h-5 mr-2 transition-transform duration-300 group-hover:rotate-12"></i>
                                    Confirmar Reembolso
                                </button>
                            </form>
                        </div>

                        <!-- Informação Adicional -->
                        <div class="mt-6 text-center">
                            <p class="text-gray-400 text-sm">
                                <i data-lucide="info" class="w-4 h-4 inline mr-1"></i>
                                Após o reembolso, os pontos estarão disponíveis imediatamente em sua conta.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide notifications
            const notification = document.getElementById('notification');
            const errorNotification = document.getElementById('notification-error');

            // Confirmação adicional no envio do formulário
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const confirmacao = confirm(
                        'Tem certeza que deseja solicitar o reembolso? Esta ação não pode ser desfeita.'
                        );
                    if (!confirmacao) {
                        e.preventDefault();
                    }
                });
            }
        });
    </script>

@endsection
