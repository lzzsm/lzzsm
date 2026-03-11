@extends('layouts.main')

@section('title', $advertisement->titulo)

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="max-w-4xl mx-auto">

                <!-- Botão Voltar e Data de Publicação -->
                <div class="flex justify-between items-center mb-8">
                    <button onclick="window.history.back()"
                        class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-lime-300 transition-colors group">
                        <i data-lucide="arrow-left"
                            class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:-translate-x-1"></i>
                        Voltar
                    </button>

                    <p class="text-sm text-gray-400">
                        Publicado por
                        <a href="{{ route('empresas.show', $advertisement->empresa->id) }}"
                            class="font-medium text-lime-500 hover:text-lime-400">
                            {{ $advertisement->empresa->user->name ?? 'Empresa desconhecida' }}
                        </a>
                        em {{ $advertisement->created_at->format('d/m/Y') }}
                    </p>
                </div>

                <!-- Conteúdo do Anúncio -->
                <div class="bg-gray-800/50 rounded-2xl shadow-lg overflow-hidden border border-gray-700/50">
                    @if ($advertisement->img_anuncio)
                        <div class="w-full h-64 sm:h-80 md:h-96 bg-gray-700">
                            <img class="w-full h-full object-cover"
                                src="{{ asset('storage/' . $advertisement->img_anuncio) }}"
                                alt="Imagem de destaque para {{ $advertisement->titulo }}">
                        </div>
                    @endif

                    <div class="p-6 sm:p-8 md:p-10">
                        @if ($advertisement->tipo)
                            <span
                                class="inline-block bg-lime-400/10 text-lime-300 text-xs font-semibold mb-3 px-3 py-1 rounded-full uppercase tracking-wider">{{ $advertisement->tipo }}</span>
                        @endif

                        <h1 class="text-3xl md:text-4xl font-bold text-white leading-tight">{{ $advertisement->titulo }}
                        </h1>

                        @if ($advertisement->subtitulo)
                            <p class="text-lg md:text-xl text-gray-400 mt-2">{{ $advertisement->subtitulo }}</p>
                        @endif

                        <div class="mt-8 border-t border-gray-700 pt-8">
                            <div
                                class="prose prose-invert prose-lg max-w-none text-gray-300 prose-p:leading-relaxed prose-a:text-emerald-400 hover:prose-a:text-emerald-300">
                                {!! nl2br(e($advertisement->conteudo)) !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
