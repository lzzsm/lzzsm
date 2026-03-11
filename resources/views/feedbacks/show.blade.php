@extends('layouts.main')

@section('title', 'Detalhes da Avaliação')

@section('content')
<div class="bg-slate-900 text-gray-200 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto">

            <!-- Botão Voltar e Data -->
            <div class="flex justify-between items-center mb-8">
                <button onclick="window.history.back()"
                    class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-lime-300 transition-colors group">
                    <i data-lucide="arrow-left"
                        class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:-translate-x-1"></i>
                    Voltar
                </button>

                <p class="text-sm text-gray-400">
                    Avaliado em {{ $feedback->created_at->format('d/m/Y H:i') }}
                </p>
            </div>

            <!-- Card Principal -->
            <div class="bg-gradient-to-b from-gray-800 to-slate-900 rounded-2xl shadow-xl border border-gray-700/50 p-8 mb-8">
                <!-- Informações do Usuário -->
                <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-gray-700">
                    <!-- Avatar com Foto ou Inicial -->
                    @if($feedback->cadastrado->user->profile_photo_path)
                        <img src="{{ asset('storage/' . $feedback->cadastrado->user->profile_photo_path) }}" 
                             alt="Foto de {{ $feedback->cadastrado->nome }}"
                             class="w-16 h-16 rounded-full object-cover ring-2 ring-green-500">
                    @else
                        <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center ring-2 ring-green-500">
                            <span class="text-white font-semibold text-xl">
                                {{ strtoupper(substr($feedback->cadastrado->nome, 0, 1)) }}
                            </span>
                        </div>
                    @endif
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-white">{{ $feedback->cadastrado->nome }}</h2>
                        <p class="text-gray-400">{{ $feedback->cadastrado->user->email }}</p>
                        <p class="text-sm text-gray-500">ID do Usuário: {{ $feedback->cadastrado_id }}</p>
                    </div>
                </div>

                <!-- Avaliação -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-white mb-3">Avaliação</h3>
                    <div class="flex items-center space-x-2 mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <i data-lucide="star" 
                               class="w-8 h-8 {{ $i <= $feedback->avaliacao ? 'text-yellow-400 fill-yellow-400' : 'text-gray-600' }}"></i>
                        @endfor
                        <span class="text-xl font-bold text-white ml-2">{{ $feedback->avaliacao }}/5</span>
                    </div>
                </div>

                <!-- Comentário -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-white mb-3">Comentário</h3>
                    @if($feedback->conteudo)
                        <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
                            <p class="text-gray-300 leading-relaxed text-lg">{{ $feedback->conteudo }}</p>
                        </div>
                    @else
                        <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700 text-center">
                            <p class="text-gray-500 italic text-lg">Sem comentário adicional</p>
                        </div>
                    @endif
                </div>

                <!-- Metadados -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-gray-700">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-400 mb-2">Informações Técnicas</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">ID da Avaliação:</span>
                                <span class="text-white font-mono">{{ $feedback->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Criado em:</span>
                                <span class="text-white">{{ $feedback->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Atualizado em:</span>
                                <span class="text-white">{{ $feedback->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-sm font-semibold text-gray-400 mb-2">Ações</h4>
                        <div class="space-y-2">
                            <button onclick="window.print()" 
                                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm rounded-lg transition-colors">
                                <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                                Imprimir
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection