@extends('layouts.main')

@section('title', 'Avaliações de Usuários')

@section('content')

    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Cabeçalho -->
            <div class="mb-8 flex justify-between items-center">
                <div class="text-center md:text-left">
                    <h1 class="text-4xl font-extrabold text-white tracking-tight">Gerenciar Avaliações</h1>
                    <p class="mt-2 text-lg text-gray-400">Visualize e administre todas as avaliações dos usuários</p>
                </div>
            </div>

            <!-- Estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gradient-to-b from-gray-800 to-slate-900 rounded-xl border border-gray-700/50 p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-yellow-500/10 rounded-lg">
                            <i data-lucide="star" class="w-6 h-6 text-yellow-400"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-400">Média de Avaliações</p>
                            <p class="text-2xl font-bold text-white">{{ number_format($mediaAvaliacoes, 1) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-b from-gray-800 to-slate-900 rounded-xl border border-gray-700/50 p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-500/10 rounded-lg">
                            <i data-lucide="message-square" class="w-6 h-6 text-green-400"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-400">Total de Avaliações</p>
                            <p class="text-2xl font-bold text-white">{{ $totalAvaliacoes }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barra de Ferramentas: Busca e Filtros -->
            <div class="mb-8 p-6 bg-gray-800/50 rounded-xl shadow-lg border border-gray-700">
                <form action="{{ route('feedbacks.index') }}" method="GET" id="searchForm">
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
                                    placeholder="Pesquisar por nome, email, conteúdo..." value="{{ request('search') }}">

                                <!-- Botão X SEMPRE visível, mas inativo quando não tem busca -->
                                <a href="{{ route('feedbacks.index', ['avaliacao' => request('avaliacao')]) }}"
                                    class="absolute inset-y-0 right-0 flex items-center px-3 rounded-r-md transition-colors {{ request('search') ? 'bg-gray-700 text-gray-400 hover:bg-gray-600 hover:text-gray-300 cursor-pointer' : 'bg-gray-800 text-gray-600 cursor-not-allowed' }}"
                                    title="{{ request('search') ? 'Limpar Pesquisa' : 'Nada para limpar' }}"
                                    {{ !request('search') ? 'onclick="return false;"' : '' }}>
                                    <i data-lucide="x" class="h-5 w-5"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Filtro por Avaliação -->
                        <div class="md:col-span-3">
                            <label for="avaliacao" class="block text-sm font-medium text-gray-400 mb-2">
                                <i data-lucide="star" class="w-4 h-4 inline mr-1"></i>
                                Filtrar por Avaliação
                            </label>
                            <select name="avaliacao" id="avaliacao"
                                class="bg-gray-900 border border-gray-700 text-white focus:ring-lime-500 focus:border-lime-500 block w-full sm:text-sm rounded-md">
                                <option value="">Todas as avaliações</option>
                                <option value="5" {{ request('avaliacao') == '5' ? 'selected' : '' }}>⭐ 5 Estrelas
                                </option>
                                <option value="4" {{ request('avaliacao') == '4' ? 'selected' : '' }}>⭐ 4 Estrelas
                                </option>
                                <option value="3" {{ request('avaliacao') == '3' ? 'selected' : '' }}>⭐ 3 Estrelas
                                </option>
                                <option value="2" {{ request('avaliacao') == '2' ? 'selected' : '' }}>⭐ 2 Estrelas
                                </option>
                                <option value="1" {{ request('avaliacao') == '1' ? 'selected' : '' }}>⭐ 1 Estrela
                                </option>
                            </select>
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

            <!-- Lista de Avaliações -->
            <div
                class="bg-gradient-to-b from-gray-800 to-slate-900 rounded-2xl shadow-xl border border-gray-700/50 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-700 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-white">Todas as Avaliações</h2>
                    <span class="text-sm text-gray-400">
                        {{ $feedbacks->total() }} {{ $feedbacks->total() == 1 ? 'avaliação' : 'avaliações' }}
                        encontrada(s)
                    </span>
                </div>

                <div class="divide-y divide-gray-700">
                    @forelse($feedbacks as $feedback)
                        <div class="p-6 hover:bg-gray-800/50 transition-colors duration-200">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center space-x-3">
                                    <!-- Avatar com Foto ou Inicial -->
                                    @if ($feedback->cadastrado->user->profile_photo_path)
                                        <img src="{{ asset('storage/' . $feedback->cadastrado->user->profile_photo_path) }}"
                                            alt="Foto de {{ $feedback->cadastrado->nome }}"
                                            class="w-10 h-10 rounded-full object-cover ring-2 ring-green-500">
                                    @else
                                        <div
                                            class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center ring-2 ring-green-500">
                                            <span class="text-white font-semibold text-sm">
                                                {{ strtoupper(substr($feedback->cadastrado->nome, 0, 1)) }}
                                            </span>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="font-semibold text-white">{{ $feedback->cadastrado->nome }}</h3>
                                        <p class="text-sm text-gray-400">{{ $feedback->cadastrado->user->email }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="flex items-center space-x-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i data-lucide="star"
                                                class="w-4 h-4 {{ $i <= $feedback->avaliacao ? 'text-yellow-400 fill-yellow-400' : 'text-gray-600' }}"></i>
                                        @endfor
                                    </div>
                                    <span
                                        class="text-sm text-gray-400">{{ $feedback->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>

                            @if ($feedback->conteudo)
                                <p class="text-gray-300 leading-relaxed mb-3">{{ $feedback->conteudo }}</p>
                            @else
                                <p class="text-gray-500 italic mb-3">Sem comentário</p>
                            @endif

                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">
                                    ID: {{ $feedback->id }}
                                </span>
                                <a href="{{ route('feedbacks.show', $feedback) }}"
                                    class="inline-flex items-center px-3 py-1 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                                    <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                    Ver Detalhes
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16 px-4 bg-gray-800/50 rounded-lg shadow-md border border-gray-700">
                            <i data-lucide="search-x" class="w-16 h-16 text-gray-500 mx-auto mb-4"></i>
                            <h3 class="mt-2 text-sm font-medium text-gray-200">Nenhuma avaliação encontrada</h3>
                            <p class="mt-1 text-sm text-gray-400">
                                @if (request()->hasAny(['search', 'avaliacao']))
                                    Tente ajustar os filtros de pesquisa.
                                @else
                                    Os usuários ainda não enviaram avaliações.
                                @endif
                            </p>
                        </div>
                    @endforelse
                </div>

                <!-- Paginação -->
                @if ($feedbacks->hasPages())
                    <div class="px-6 py-4 border-t border-gray-700">
                        {{ $feedbacks->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Auto-hide notification after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('notification');
            if (notification) {
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 5000);
            }
        });
    </script>
@endsection
