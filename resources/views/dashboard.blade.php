@extends('layouts.main')

@section('title', 'Meu Dashboard')

@section('content')

    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho de Boas-Vindas (Comum a todos) -->
            <div class="flex flex-col sm:flex-row items-center justify-between mb-12">
                <div class="flex items-center space-x-4">
                    @if (Auth::user()->profile_photo_path)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Foto de perfil"
                            class="w-16 h-16 rounded-full object-cover ring-2 ring-emerald-500">
                    @else
                        <div
                            class="w-16 h-16 rounded-full bg-emerald-800 flex items-center justify-center ring-2 ring-emerald-600">
                            <span
                                class="text-2xl font-bold text-lime-300">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                    @endif
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-white">Olá, {{ strtok(Auth::user()->name, ' ') }}!
                        </h1>
                        <p class="text-md text-gray-400">Bem-vindo(a) de volta ao <span
                                class="font-semibold text-lime-300">Perseph</span>.</p>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0">
                    <div class="flex items-center space-x-2 text-sm text-gray-400">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>{{ now()->format('d/m/Y - H:i') }}</span>
                    </div>
                </div>
            </div>

            {{-- ====================================================================== --}}
            {{-- 1. DASHBOARD PARA USUÁRIO CADASTRADO                                   --}}
            {{-- ====================================================================== --}}
            @if (Auth::user()->nivel_permissao == 'cadastrado')
                @php
                    // LÓGICA ALTERNATIVA: Query direta no banco
                    $meuFeedback = \App\Models\Feedback::where('cadastrado_id', Auth::user()->id)->first();
                    $jaAvaliou = $meuFeedback !== null;
                @endphp

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Coluna Esquerda: Métricas e Informações -->
                    <div class="lg:col-span-1 space-y-8">
                        <!-- Card Unificado de Métricas -->
                        <div
                            class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                            <!-- Cabeçalho -->
                            <div class="text-center mb-6">
                                <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                    <i data-lucide="trending-up" class="w-5 h-5 mr-2 text-lime-400"></i>
                                    Minhas Estatísticas
                                </h3>
                                <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                </div>
                            </div>

                            <!-- Seção Principal: Pontuação Total -->
                            <div class="bg-slate-800/50 rounded-lg p-4 mb-6 border border-emerald-600/30">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-400 font-medium">Pontuação Total</p>
                                        <p class="text-3xl font-bold text-lime-300 mt-1">
                                            {{ Auth::user()->cadastrado->pontuacao_total }}</p>
                                    </div>
                                    <div class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center">
                                        <i data-lucide="award" class="w-6 h-6 text-lime-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Grid de Métricas Detalhadas -->
                            <div class="space-y-4">
                                <!-- Linha 1: Pontos -->
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Pontos Disponíveis -->
                                    <div class="bg-slate-800/30 rounded-lg p-3 border border-emerald-500/20">
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="w-8 h-8 bg-emerald-500/20 rounded-full flex items-center justify-center">
                                                <i data-lucide="circle-check" class="w-4 h-4 text-emerald-400"></i>
                                            </div>
                                            <div>
                                                <p class="text-lg font-bold text-emerald-300">
                                                    {{ Auth::user()->cadastrado->pontos_disponiveis }}</p>
                                                <p class="text-xs text-gray-500">Disponíveis</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pontos Gastos -->
                                    <div class="bg-slate-800/30 rounded-lg p-3 border border-amber-500/20">
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="w-8 h-8 bg-amber-500/20 rounded-full flex items-center justify-center">
                                                <i data-lucide="shopping-bag" class="w-4 h-4 text-amber-400"></i>
                                            </div>
                                            <div>
                                                <p class="text-lg font-bold text-amber-300">
                                                    {{ Auth::user()->cadastrado->pontuacao_gasta }}</p>
                                                <p class="text-xs text-gray-500">Gastos</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Linha 2: Coletas -->
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Coletas Realizadas -->
                                    <div class="bg-slate-800/30 rounded-lg p-3 border border-cyan-500/20">
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="w-8 h-8 bg-cyan-500/20 rounded-full flex items-center justify-center">
                                                <i data-lucide="recycle" class="w-4 h-4 text-cyan-400"></i>
                                            </div>
                                            <div>
                                                <p class="text-lg font-bold text-cyan-300">
                                                    {{ Auth::user()->cadastrado->coletas_realizadas }}</p>
                                                <p class="text-xs text-gray-500">Coletas</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Média por Coleta -->
                                    <div class="bg-slate-800/30 rounded-lg p-3 border border-purple-500/20">
                                        <div class="flex items-center space-x-2">
                                            <div
                                                class="w-8 h-8 bg-purple-500/20 rounded-full flex items-center justify-center">
                                                <i data-lucide="bar-chart-3" class="w-4 h-4 text-purple-400"></i>
                                            </div>
                                            <div>
                                                <p class="text-lg font-bold text-purple-300">
                                                    {{ Auth::user()->cadastrado->coletas_realizadas > 0 ? round(Auth::user()->cadastrado->pontuacao_total / Auth::user()->cadastrado->coletas_realizadas, 1) : 0 }}
                                                </p>
                                                <p class="text-xs text-gray-500">Média/Coleta</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rodapé Informativo -->
                            <div class="mt-6 pt-4 border-t border-emerald-700/30">
                                <div class="flex items-center justify-center space-x-2 text-xs text-gray-500">
                                    <i data-lucide="info" class="w-3 h-3"></i>
                                    <span>Atualizado às {{ now()->format('H:i') }} do dia
                                        {{ now()->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card de Avaliação -->
                        <div
                            class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                            <h3 class="font-semibold text-white mb-4 text-lg flex items-center">
                                <i data-lucide="star" class="w-5 h-5 mr-2 text-yellow-400"></i>
                                Minha Avaliação
                            </h3>

                            @if (!$jaAvaliou)
                                <!-- Se não tiver avaliado -->
                                <div class="text-center py-4">
                                    <i data-lucide="star" class="w-12 h-12 text-gray-600 mx-auto mb-3"></i>
                                    <p class="text-gray-400 mb-4">Você ainda não avaliou nossa plataforma</p>
                                    <a href="{{ route('home') }}#feedbacks"
                                        class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                                        Fazer Avaliação
                                    </a>
                                </div>
                            @else
                                <!-- Se já tiver avaliado -->
                                <div class="space-y-4">
                                    <!-- Estrelas -->
                                    <div class="flex justify-center space-x-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i data-lucide="star"
                                                class="w-6 h-6 {{ $i <= $meuFeedback->avaliacao ? 'text-yellow-400 fill-yellow-400' : 'text-gray-600' }}"></i>
                                        @endfor
                                    </div>

                                    <!-- Comentário -->
                                    @if ($meuFeedback->conteudo)
                                        <div class="bg-gray-900/50 rounded-lg p-3">
                                            <p class="text-gray-300 text-sm leading-relaxed">{{ $meuFeedback->conteudo }}
                                            </p>
                                        </div>
                                    @else
                                        <p class="text-gray-500 text-sm italic text-center">Sem comentário adicional</p>
                                    @endif

                                    <!-- Data -->
                                    <p class="text-xs text-gray-500 text-center">
                                        Avaliado em {{ $meuFeedback->created_at->format('d/m/Y') }}
                                    </p>

                                    <!-- Ações -->
                                    <div class="flex space-x-2">
                                        <button onclick="openEditModal()"
                                            class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm rounded-lg transition-colors">
                                            <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                            Editar
                                        </button>
                                        <button onclick="confirmDelete()"
                                            class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition-colors">
                                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                            Excluir
                                        </button>
                                    </div>
                                </div>

                                <!-- Modal de Edição -->
                                <div id="editModal"
                                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
                                    <div class="bg-slate-800 rounded-2xl p-6 w-full max-w-md">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="text-xl font-bold text-white">Editar Avaliação</h3>
                                            <button onclick="closeEditModal()" class="text-gray-400 hover:text-white">
                                                <i data-lucide="x" class="w-6 h-6"></i>
                                            </button>
                                        </div>

                                        <form action="{{ route('feedbacks.update', $meuFeedback) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-300 mb-2">Sua
                                                    avaliação:</label>
                                                <div class="flex justify-center space-x-1" id="edit-star-rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <button type="button"
                                                            class="edit-star-btn transition-all duration-200 hover:scale-110"
                                                            data-rating="{{ $i }}">
                                                            <i data-lucide="star"
                                                                class="w-8 h-8 {{ $i <= $meuFeedback->avaliacao ? 'text-yellow-400 fill-yellow-400' : 'text-gray-600' }} star-icon"
                                                                data-rating="{{ $i }}"></i>
                                                        </button>
                                                    @endfor
                                                </div>
                                                <input type="hidden" name="avaliacao" id="edit-avaliacao"
                                                    value="{{ $meuFeedback->avaliacao }}">
                                            </div>

                                            <div class="mb-4">
                                                <label for="edit-conteudo"
                                                    class="block text-sm font-medium text-gray-300 mb-2">Comentário:</label>
                                                <textarea name="conteudo" id="edit-conteudo" rows="3"
                                                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-lime-500">{{ $meuFeedback->conteudo }}</textarea>
                                            </div>

                                            <div class="flex justify-end space-x-3">
                                                <button type="button" onclick="closeEditModal()"
                                                    class="px-4 py-2 text-sm text-gray-300 hover:text-white bg-gray-600 hover:bg-gray-700 rounded-lg transition-colors">Cancelar</button>
                                                <button type="submit"
                                                    class="px-4 py-2 text-sm bg-lime-600 hover:bg-lime-700 text-white rounded-lg transition-colors">Salvar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Modal de Confirmação de Exclusão -->
                                <div id="deleteModal"
                                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
                                    <div class="bg-slate-800 rounded-2xl p-6 w-full max-w-md">
                                        <div class="text-center">
                                            <i data-lucide="alert-triangle"
                                                class="w-12 h-12 text-yellow-400 mx-auto mb-4"></i>
                                            <h3 class="text-xl font-bold text-white mb-2">Excluir Avaliação</h3>
                                            <p class="text-gray-300 mb-6">Tem certeza que deseja excluir sua avaliação?</p>

                                            <div class="flex justify-center space-x-3">
                                                <form action="{{ route('feedbacks.destroy', $meuFeedback) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-6 py-2 text-sm bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">Excluir</button>
                                                </form>
                                                <button onclick="closeDeleteModal()"
                                                    class="px-6 py-2 text-sm text-gray-300 bg-gray-600 hover:bg-gray-700 hover:text-white transition-colors rounded-lg">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- JavaScript para as estrelas do modal -->
                                <script>
                                    function openEditModal() {
                                        document.getElementById('editModal').classList.remove('hidden');
                                    }

                                    function closeEditModal() {
                                        document.getElementById('editModal').classList.add('hidden');
                                    }

                                    function confirmDelete() {
                                        document.getElementById('deleteModal').classList.remove('hidden');
                                    }

                                    function closeDeleteModal() {
                                        document.getElementById('deleteModal').classList.add('hidden');
                                    }

                                    // Sistema de estrelas interativo
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const starButtons = document.querySelectorAll('.edit-star-btn');
                                        const starIcons = document.querySelectorAll('.star-icon');
                                        const avaliacaoInput = document.getElementById('edit-avaliacao');
                                        let currentRating = parseInt(avaliacaoInput.value);

                                        starButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const rating = parseInt(this.getAttribute('data-rating'));
                                                currentRating = rating;
                                                avaliacaoInput.value = rating;

                                                // Atualizar visual das estrelas
                                                starIcons.forEach(icon => {
                                                    const iconRating = parseInt(icon.getAttribute('data-rating'));
                                                    if (iconRating <= rating) {
                                                        icon.classList.remove('text-gray-600');
                                                        icon.classList.add('text-yellow-400', 'fill-yellow-400');
                                                    } else {
                                                        icon.classList.remove('text-yellow-400', 'fill-yellow-400');
                                                        icon.classList.add('text-gray-600');
                                                    }
                                                });
                                            });

                                            // Efeito hover
                                            button.addEventListener('mouseenter', function() {
                                                const rating = parseInt(this.getAttribute('data-rating'));
                                                starIcons.forEach(icon => {
                                                    const iconRating = parseInt(icon.getAttribute('data-rating'));
                                                    if (iconRating <= rating) {
                                                        icon.classList.add('text-yellow-300', 'fill-yellow-300');
                                                    }
                                                });
                                            });

                                            button.addEventListener('mouseleave', function() {
                                                starIcons.forEach(icon => {
                                                    const iconRating = parseInt(icon.getAttribute('data-rating'));
                                                    icon.classList.remove('text-yellow-300', 'fill-yellow-300');
                                                    if (iconRating <= currentRating) {
                                                        icon.classList.add('text-yellow-400', 'fill-yellow-400');
                                                    } else {
                                                        icon.classList.add('text-gray-600');
                                                    }
                                                });
                                            });
                                        });
                                    });
                                </script>
                            @endif
                        </div>
                    </div>

                    <!-- Coluna Direita: Ações e Perfil -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Ações Rápidas -->
                        <div
                            class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                            <!-- Cabeçalho -->
                            <div class="text-center mb-6">
                                <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                    <i data-lucide="zap" class="w-5 h-5 mr-2 text-lime-400"></i>
                                    Ações Rápidas
                                </h3>
                                <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                </div>
                            </div>

                            <!-- Grid de Ações -->
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                <!-- Agendar Coleta -->
                                <a href="{{ route('collects.create') }}"
                                    class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 hover:shadow-lg hover:shadow-lime-500/10">
                                    <div
                                        class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                        <i data-lucide="calendar-plus" class="w-6 h-6 text-lime-400"></i>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">Agendar
                                        Coleta</span>
                                </a>

                                <!-- Minhas Coletas -->
                                <a href="{{ route('collects.my-collects') }}"
                                    class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 hover:shadow-lg hover:shadow-lime-500/10">
                                    <div
                                        class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                        <i data-lucide="layout-list" class="w-6 h-6 text-lime-400"></i>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">Minhas
                                        Coletas</span>
                                </a>

                                <!-- Pontos de Coleta -->
                                <a href="{{ route('collect-points.dashboard') }}"
                                    class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 hover:shadow-lg hover:shadow-lime-500/10">
                                    <div
                                        class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                        <i data-lucide="map-pin" class="w-6 h-6 text-lime-400"></i>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">Pontos
                                        de Coleta</span>
                                </a>

                                <!-- Catálogo -->
                                <a href="{{ route('rewards.dashboard') }}"
                                    class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 hover:shadow-lg hover:shadow-lime-500/10">
                                    <div
                                        class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                        <i data-lucide="gift" class="w-6 h-6 text-lime-400"></i>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">Catálogo</span>
                                </a>

                                <!-- Meus Resgates -->
                                <a href="{{ route('resgates.index') }}"
                                    class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 hover:shadow-lg hover:shadow-lime-500/10">
                                    <div
                                        class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                        <i data-lucide="key" class="w-6 h-6 text-lime-400"></i>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">Meus
                                        Resgates</span>
                                </a>

                                <!-- Ranking -->
                                <a href="{{ route('ranking') }}"
                                    class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1 hover:shadow-lg hover:shadow-lime-500/10">
                                    <div
                                        class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                        <i data-lucide="trophy" class="w-6 h-6 text-lime-400"></i>
                                    </div>
                                    <span
                                        class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">Ranking</span>
                                </a>
                            </div>
                        </div>

                        <!-- Suas Informações -->
                        <div
                            class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                            <!-- Cabeçalho -->
                            <div class="text-center mb-6">
                                <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                    <i data-lucide="user" class="w-5 h-5 mr-2 text-lime-400"></i>
                                    Suas Informações
                                </h3>
                                <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                </div>
                            </div>

                            <!-- Informações do Usuário - Versão Compacta -->
                            <div class="space-y-3 mb-6">
                                <!-- Nome -->
                                <div
                                    class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                    <span class="text-gray-400 flex items-center text-sm">
                                        <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                                        Nome:
                                    </span>
                                    <span class="font-medium text-gray-200 text-sm">{{ Auth::user()->name }}</span>
                                </div>

                                <!-- Email -->
                                <div
                                    class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                    <span class="text-gray-400 flex items-center text-sm">
                                        <i data-lucide="mail" class="w-4 h-4 mr-2"></i>
                                        Email:
                                    </span>
                                    <span class="font-medium text-gray-200 text-sm">{{ Auth::user()->email }}</span>
                                </div>

                                <!-- CPF -->
                                <div
                                    class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                    <span class="text-gray-400 flex items-center text-sm">
                                        <i data-lucide="id-card" class="w-4 h-4 mr-2"></i>
                                        CPF:
                                    </span>
                                    <span
                                        class="font-medium text-gray-200 text-sm font-mono">{{ Auth::user()->cadastrado->cpf_formatado ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <!-- Botão Editar Perfil - Estilo Sólido Discreto -->
                            <a href="{{ route('profile.show') }}"
                                class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-900/80 px-4 py-3 text-sm font-medium text-lime-100 border border-emerald-700/50 transition-all duration-300 hover:bg-emerald-800 hover:border-emerald-600 hover:-translate-y-1 hover:shadow-lg active:translate-y-0 active:bg-emerald-900 group">
                                <i data-lucide="settings-2"
                                    class="h-5 w-5 text-lime-300 group-hover:scale-110 transition-all duration-300"></i>
                                <span class="group-hover:text-lime-50 transition-colors duration-300">Editar Perfil</span>
                            </a>
                        </div>

                        <script>
                            // Sistema de Estrelas do Modal de Edição
                            document.addEventListener('DOMContentLoaded', function() {
                                const editStarButtons = document.querySelectorAll('.edit-star-btn');
                                const editRatingInput = document.getElementById('edit-avaliacao');

                                editStarButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        const rating = parseInt(this.getAttribute('data-rating'));
                                        editRatingInput.value = rating;
                                        updateEditStars(rating);
                                    });
                                });

                                function updateEditStars(rating) {
                                    editStarButtons.forEach((button, index) => {
                                        const star = button.querySelector('i');
                                        const starRating = index + 1;

                                        if (starRating <= rating) {
                                            star.classList.remove('text-gray-600');
                                            star.classList.add('text-yellow-400', 'fill-yellow-400');
                                        } else {
                                            star.classList.remove('text-yellow-400', 'fill-yellow-400');
                                            star.classList.add('text-gray-600');
                                        }
                                    });
                                }
                            });

                            // Funções dos Modais
                            function openEditModal() {
                                document.getElementById('editModal').classList.remove('hidden');
                            }

                            function closeEditModal() {
                                document.getElementById('editModal').classList.add('hidden');
                            }

                            function confirmDelete() {
                                document.getElementById('deleteModal').classList.remove('hidden');
                            }

                            function closeDeleteModal() {
                                document.getElementById('deleteModal').classList.add('hidden');
                            }

                            // Fechar modais clicando fora
                            document.addEventListener('click', function(event) {
                                if (event.target.id === 'editModal') closeEditModal();
                                if (event.target.id === 'deleteModal') closeDeleteModal();
                            });
                        </script>
            @endif

            {{-- ====================================================================== --}}
            {{-- 2. DASHBOARD PARA EMPRESA --}}
            {{-- ====================================================================== --}}
            @if (Auth::user()->nivel_permissao == 'empresa')
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Coluna Esquerda: Ações de Conteúdo -->
                    <div class="lg:col-span-1 space-y-8">
                        <!-- Novo Anúncio -->
                        <a href="{{ route('advertisements.create') }}"
                            class="group block bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-bold text-lime-300">Novo Anúncio</h3>
                                <i data-lucide="radio"
                                    class="w-8 h-8 text-lime-400 group-hover:scale-110 transition-transform duration-300"></i>
                            </div>
                            <p class="text-sm text-gray-400">Divulgue novidades e promoções.</p>
                        </a>

                        <!-- Nova Recompensa -->
                        <a href="{{ route('rewards.create') }}"
                            class="group block bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-bold text-lime-300">Nova Recompensa</h3>
                                <i data-lucide="award"
                                    class="w-8 h-8 text-lime-400 group-hover:scale-110 transition-transform duration-300"></i>
                            </div>
                            <p class="text-sm text-gray-400">Ofereça um novo prêmio no catálogo.</p>
                        </a>

                        <!-- Card de Estatísticas da Empresa -->
                        <div
                            class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                            <!-- Cabeçalho -->
                            <div class="text-center mb-6">
                                <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                    <i data-lucide="bar-chart" class="w-5 h-5 mr-2 text-lime-400"></i>
                                    Estatísticas
                                </h3>
                                <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                </div>
                            </div>

                            <!-- Estatísticas -->
                            <div class="space-y-4">
                                <!-- Recompensas -->
                                <div
                                    class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                    <span class="text-gray-400 text-sm">Recompensas:</span>
                                    <span
                                        class="font-bold text-lime-400">{{ Auth::user()->empresa->rewards->count() }}</span>
                                </div>
                                <!-- Anúncios -->
                                <div
                                    class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                    <span class="text-gray-400 text-sm">Anúncios:</span>
                                    <span
                                        class="font-bold text-lime-400">{{ Auth::user()->empresa->advertisements->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coluna Direita: Gerenciamento e Perfil -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Gerenciamento -->
                        <div
                            class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                            <!-- Cabeçalho -->
                            <div class="text-center mb-6">
                                <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                    <i data-lucide="settings" class="w-5 h-5 mr-2 text-lime-400"></i>
                                    Gerenciamento
                                </h3>
                                <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                </div>
                            </div>

                            <!-- Grid de Ações -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Meus Anúncios -->
                                <a href="{{ route('advertisements.my') }}"
                                    class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                    <div
                                        class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                        <i data-lucide="archive" class="w-6 h-6 text-lime-400"></i>
                                    </div>
                                    <h4
                                        class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">
                                        Meus Anúncios</h4>
                                </a>

                                <!-- Minhas Recompensas -->
                                <a href="{{ route('rewards.my') }}"
                                    class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                    <div
                                        class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                        <i data-lucide="layout-list" class="w-6 h-6 text-lime-400"></i>
                                    </div>
                                    <h4
                                        class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">
                                        Minhas Recompensas</h4>
                                </a>

                                <!-- Validar Resgates -->
                                <a href="{{ route('empresas.resgates.index') }}"
                                    class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                    <div
                                        class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                        <i data-lucide="key" class="w-6 h-6 text-lime-400"></i>
                                    </div>
                                    <h4
                                        class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">
                                        Validar Resgates</h4>
                                </a>

                                <!-- Validar Código -->
                                <a href="{{ route('empresas.resgates.validar.page') }}"
                                    class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                    <div
                                        class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                        <i data-lucide="scan" class="w-6 h-6 text-lime-400"></i>
                                    </div>
                                    <h4
                                        class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">
                                        Validar Código</h4>
                                </a>
                            </div>
                        </div>

                        <!-- Informações da Empresa -->
                        <div
                            class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                            <!-- Cabeçalho -->
                            <div class="text-center mb-6">
                                <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                    <i data-lucide="building" class="w-5 h-5 mr-2 text-lime-400"></i>
                                    Informações da Empresa
                                </h3>
                                <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                </div>
                            </div>

                            <!-- Informações -->
                            <div class="space-y-3 mb-6">
                                <!-- Empresa -->
                                <div
                                    class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                    <span class="text-gray-400 flex items-center text-sm">
                                        <i data-lucide="building" class="w-4 h-4 mr-2"></i>
                                        Empresa:
                                    </span>
                                    <span class="font-medium text-gray-200 text-sm">{{ Auth::user()->name }}</span>
                                </div>

                                <!-- CNPJ -->
                                <div
                                    class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                    <span class="text-gray-400 flex items-center text-sm">
                                        <i data-lucide="id-card" class="w-4 h-4 mr-2"></i>
                                        CNPJ:
                                    </span>
                                    <span
                                        class="font-medium text-gray-200 text-sm font-mono">{{ Auth::user()->empresa->cnpj_formatado ?? 'N/A' }}</span>
                                </div>

                                <!-- Telefone -->
                                <div
                                    class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                    <span class="text-gray-400 flex items-center text-sm">
                                        <i data-lucide="phone" class="w-4 h-4 mr-2"></i>
                                        Telefone:
                                    </span>
                                    <span
                                        class="font-medium text-gray-200 text-sm font-mono">{{ Auth::user()->empresa->telefone_comercial_formatado ?? 'N/A' }}</span>
                                </div>

                                <!-- Site -->
                                <div
                                    class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                    <span class="text-gray-400 flex items-center text-sm">
                                        <i data-lucide="globe" class="w-4 h-4 mr-2"></i>
                                        Site:
                                    </span>
                                    <span class="text-lime-500 hover:text-lime-400 text-sm">
                                        <a href="{{ Auth::user()->empresa->site ?? '#' }}"
                                            target="_blank">{{ Auth::user()->empresa->site ?? 'N/A' }}</a>
                                    </span>
                                </div>
                            </div>

                            <!-- Botão Editar Perfil -->
                            <a href="{{ route('profile.show') }}"
                                class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-900/80 px-4 py-3 text-sm font-medium text-lime-100 border border-emerald-700/50 transition-all duration-300 hover:bg-emerald-800 hover:border-emerald-600 hover:-translate-y-1 hover:shadow-lg active:translate-y-0 active:bg-emerald-900 group">
                                <i data-lucide="settings-2"
                                    class="h-5 w-5 text-lime-300 group-hover:scale-110 transition-all duration-300"></i>
                                <span class="group-hover:text-lime-50 transition-colors duration-300">Editar Perfil e
                                    Dados</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- ====================================================================== --}}
            {{-- 3. DASHBOARD PARA ADMIN --}}
            {{-- ====================================================================== --}}
            @if (Auth::user()->nivel_permissao == 'admin')
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Coluna Esquerda: Gerenciamento Principal -->
                    <div
                        class="lg:col-span-2 bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                        <!-- Cabeçalho -->
                        <div class="text-center mb-6">
                            <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                <i data-lucide="settings" class="w-5 h-5 mr-2 text-lime-400"></i>
                                Gerenciamento da Plataforma
                            </h3>
                            <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full"></div>
                        </div>

                        <!-- Grid de Gerenciamento -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Gerenciar Usuários -->
                            <a href="{{ route('users.index') }}"
                                class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                <div
                                    class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                    <i data-lucide="users-round" class="w-6 h-6 text-lime-400"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">
                                    Gerenciar Usuários</h4>
                            </a>

                            <!-- Gerenciar Empresas -->
                            <a href="{{ route('empresas.index') }}"
                                class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                <div
                                    class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                    <i data-lucide="building-2" class="w-6 h-6 text-lime-400"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">
                                    Gerenciar Empresas</h4>
                            </a>

                            <!-- Gerenciar Pontos -->
                            <a href="{{ route('collect-points.index') }}"
                                class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                <div
                                    class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                    <i data-lucide="map" class="w-6 h-6 text-lime-400"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">
                                    Gerenciar Pontos</h4>
                            </a>

                            <!-- Gerenciar Anúncios -->
                            <a href="{{ route('advertisements.index') }}"
                                class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                <div
                                    class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                    <i data-lucide="chart-pie" class="w-6 h-6 text-lime-400"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">
                                    Gerenciar Anúncios</h4>
                            </a>

                            <!-- Gerenciar Materiais -->
                            <a href="{{ route('materials.index') }}"
                                class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                <div
                                    class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                    <i data-lucide="recycle" class="w-6 h-6 text-lime-400"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">
                                    Gerenciar Materiais</h4>
                            </a>

                            <!-- Gerenciar Coletas -->
                            <a href="{{ route('collects.index') }}"
                                class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                <div
                                    class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                    <i data-lucide="chart-line" class="w-6 h-6 text-lime-400"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">
                                    Gerenciar Coletas</h4>
                            </a>

                            <!-- Gerenciar Recompensas -->
                            <a href="{{ route('rewards.index') }}"
                                class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                <div
                                    class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                    <i data-lucide="award" class="w-6 h-6 text-lime-400"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">
                                    Gerenciar Recompensas</h4>
                            </a>

                            <!-- Gerenciar Feedbacks -->
                            <a href="{{ route('feedbacks.index') }}"
                                class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                <div
                                    class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                    <i data-lucide="star" class="w-6 h-6 text-lime-400"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">
                                    Gerenciar Feedbacks</h4>
                            </a>

                            <!-- Gerenciar Resgates -->
                            <a href="{{ route('admin.resgates.index') }}"
                                class="group bg-slate-800/50 rounded-lg p-4 text-center border border-emerald-600/30 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                <div
                                    class="w-12 h-12 bg-lime-500/20 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-lime-500/30 transition-colors">
                                    <i data-lucide="key" class="w-6 h-6 text-lime-400"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-200 group-hover:text-lime-300 transition-colors">
                                    Gerenciar Resgates</h4>
                            </a>
                        </div>
                    </div>

                    <!-- Coluna Direita: Ações de Criação e Perfil -->
                    <div class="lg:col-span-1 space-y-8">
                        <!-- Ações de Criação -->
                        <div
                            class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                            <!-- Cabeçalho -->
                            <div class="text-center mb-6">
                                <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                    <i data-lucide="plus" class="w-5 h-5 mr-2 text-lime-400"></i>
                                    Ações de Criação
                                </h3>
                                <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                </div>
                            </div>

                            <!-- Ações -->
                            <div class="space-y-3">
                                <!-- Nova Empresa -->
                                <a href="{{ route('empresas.create') }}"
                                    class="group flex items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                    <i data-lucide="building"
                                        class="w-5 h-5 mr-3 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                    <span
                                        class="font-medium text-gray-200 group-hover:text-lime-300 transition-colors">Nova
                                        Empresa</span>
                                </a>

                                <!-- Novo Ponto de Coleta -->
                                <a href="{{ route('collect-points.create') }}"
                                    class="group flex items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                    <i data-lucide="map-pin"
                                        class="w-5 h-5 mr-3 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                    <span
                                        class="font-medium text-gray-200 group-hover:text-lime-300 transition-colors">Novo
                                        Ponto de Coleta</span>
                                </a>

                                <!-- Novo Material -->
                                <a href="{{ route('materials.create') }}"
                                    class="group flex items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20 hover:border-lime-400/50 transition-all transform hover:-translate-y-1">
                                    <i data-lucide="package"
                                        class="w-5 h-5 mr-3 text-lime-400 group-hover:scale-110 transition-transform"></i>
                                    <span
                                        class="font-medium text-gray-200 group-hover:text-lime-300 transition-colors">Novo
                                        Material</span>
                                </a>
                            </div>
                        </div>

                        <!-- Meu Perfil -->
                        <div
                            class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30 hover:border-lime-500/50 transition-colors">
                            <!-- Cabeçalho -->
                            <div class="text-center mb-6">
                                <h3 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                                    <i data-lucide="user" class="w-5 h-5 mr-2 text-lime-400"></i>
                                    Meu Perfil
                                </h3>
                                <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full">
                                </div>
                            </div>

                            <!-- Informações -->
                            <div class="space-y-3 mb-6">
                                <!-- Nome -->
                                <div
                                    class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                    <span class="text-gray-400 text-sm">Nome:</span>
                                    <span class="font-medium text-gray-200 text-sm">{{ Auth::user()->name }}</span>
                                </div>

                                <!-- Email -->
                                <div
                                    class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                    <span class="text-gray-400 text-sm">Email:</span>
                                    <span class="font-medium text-gray-200 text-sm">{{ Auth::user()->email }}</span>
                                </div>

                                <!-- Função -->
                                <div
                                    class="flex justify-between items-center p-3 bg-slate-800/30 rounded-lg border border-emerald-600/20">
                                    <span class="text-gray-400 text-sm">Função:</span>
                                    <span class="font-medium text-lime-400 text-sm">Administrador</span>
                                </div>
                            </div>

                            <!-- Botão Editar Perfil -->
                            <a href="{{ route('profile.show') }}"
                                class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-900/80 px-4 py-3 text-sm font-medium text-lime-100 border border-emerald-700/50 transition-all duration-300 hover:bg-emerald-800 hover:border-emerald-600 hover:-translate-y-1 hover:shadow-lg active:translate-y-0 active:bg-emerald-900 group">
                                <i data-lucide="settings-2"
                                    class="h-5 w-5 text-lime-300 group-hover:scale-110 transition-all duration-300"></i>
                                <span class="group-hover:text-lime-50 transition-colors duration-300">Editar
                                    Informações</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
