@extends('layouts.main')

@section('title', 'Validar Código - Empresa')

@section('content')

    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-2xl mx-auto">

                <!-- Botão Voltar -->
                <div class="mb-8">
                    <a href="{{ route('empresas.resgates.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-lime-300 transition-colors group">
                        <i data-lucide="arrow-left"
                            class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:-translate-x-1"></i>
                        Voltar para Resgates
                    </a>
                </div>

                <!-- Card Principal -->
                <div
                    class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl shadow-2xl overflow-hidden border border-gray-700/30">

                    <!-- Header -->
                    <div class="bg-gradient-to-r from-lime-500/20 to-emerald-500/20 p-8 border-b border-gray-700/50">
                        <div class="text-center">
                            <div
                                class="inline-flex items-center px-4 py-2 bg-lime-500/10 rounded-2xl border border-lime-500/20 mb-4">
                                <i data-lucide="key" class="w-6 h-6 text-lime-400 mr-2"></i>
                                <span class="text-lime-300 font-semibold">Validar Código</span>
                            </div>
                            <h2 class="text-2xl font-bold text-white">Validar Código de Resgate</h2>
                            <p class="text-gray-400 mt-2">Digite o código informado pelo cliente para validar o resgate</p>
                        </div>
                    </div>

                    <div class="p-8">
                        <!-- Formulário de Validação -->
                        <form action="{{ route('empresas.resgates.validar') }}" method="POST">
                            @csrf

                            <div class="space-y-6">
                                <!-- Campo Código -->
                                <div>
                                    <label for="codigo_resgate" class="block text-sm font-medium text-gray-400 mb-3">
                                        Código do Resgate
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i data-lucide="key" class="w-5 h-5 text-gray-500"></i>
                                        </div>
                                        <input type="text" name="codigo_resgate" id="codigo_resgate" required
                                            maxlength="10"
                                            class="bg-gray-900 border border-gray-700 text-white text-lg font-mono tracking-wider focus:ring-lime-500 focus:border-lime-500 block w-full pl-10 pr-4 py-4 rounded-xl placeholder-gray-600"
                                            placeholder="EX: RECA1B2C3" value="{{ old('codigo_resgate') }}"
                                            autocomplete="off" autofocus>
                                    </div>
                                    @error('codigo_resgate')
                                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Instruções -->
                                <div class="bg-blue-500/10 border border-blue-500/20 rounded-2xl p-6">
                                    <div class="flex items-start">
                                        <div class="p-2 bg-blue-500/20 rounded-lg mr-4">
                                            <i data-lucide="info" class="w-5 h-5 text-blue-400"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-blue-300 mb-2">Como funciona</h3>
                                            <ul class="text-gray-300 space-y-2 text-sm">
                                                <li class="flex items-start">
                                                    <i data-lucide="check"
                                                        class="w-4 h-4 text-green-400 mr-2 mt-0.5 flex-shrink-0"></i>
                                                    <span>Peça ao cliente o código de resgate (ex: <code
                                                            class="bg-black/20 px-1 rounded">RECA1B2C3</code>)</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <i data-lucide="check"
                                                        class="w-4 h-4 text-green-400 mr-2 mt-0.5 flex-shrink-0"></i>
                                                    <span>Digite o código no campo acima e clique em "Validar Código"</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <i data-lucide="check"
                                                        class="w-4 h-4 text-green-400 mr-2 mt-0.5 flex-shrink-0"></i>
                                                    <span>O sistema verificará se o código é válido e pertence à sua
                                                        empresa</span>
                                                </li>
                                                <li class="flex items-start">
                                                    <i data-lucide="check"
                                                        class="w-4 h-4 text-green-400 mr-2 mt-0.5 flex-shrink-0"></i>
                                                    <span>Após validação, a recompensa será marcada como utilizada</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botão de Ação -->
                                <div class="pt-4">
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-8 py-4 bg-lime-500 hover:bg-lime-400 text-slate-900 font-bold text-lg rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-lime-500/30 group">
                                        <i data-lucide="check-circle"
                                            class="w-6 h-6 mr-3 transition-transform duration-300 group-hover:scale-110"></i>
                                        Validar Código
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Resgates Recentes -->
                        @if ($resgatesRecentes->count() > 0)
                            <div class="mt-12 pt-8 border-t border-gray-700/50">
                                <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                                    <i data-lucide="history" class="w-5 h-5 text-gray-400 mr-3"></i>
                                    Resgates Recentes
                                </h3>

                                <div class="space-y-3">
                                    @foreach ($resgatesRecentes as $resgate)
                                        <div
                                            class="bg-gray-700/30 rounded-xl p-4 border border-gray-600/30 hover:border-gray-500/50 transition-colors">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-4">
                                                    <div>
                                                        <div class="text-white font-medium">{{ $resgate->cadastrado->nome }}
                                                        </div>
                                                        <div class="text-gray-400 text-sm">{{ $resgate->reward->titulo }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    @if ($resgate->status == 'pendente' && $resgate->data_expiracao->isPast())
                                                        <span
                                                            class="text-red-400 bg-red-500/20 border border-red-500/30 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium">
                                                            Expirado
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                                {{ $resgate->status === 'pendente' ? 'bg-yellow-500/20 text-yellow-300 border border-yellow-500/30' : 'bg-green-500/20 text-green-300 border border-green-500/30' }}">
                                                            {{ ucfirst($resgate->status) }}
                                                    @endif
                                                    </span>
                                                    <div class="text-gray-400 text-xs mt-1">
                                                        {{ $resgate->created_at->format('d/m H:i') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

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

            // Focar no campo de código
            const codigoInput = document.getElementById('codigo_resgate');
            if (codigoInput) {
                codigoInput.focus();
            }

            // Converter para maiúsculas automaticamente
            codigoInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        });
    </script>

@endsection
