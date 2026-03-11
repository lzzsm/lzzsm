@extends('layouts.main')

@section('title', 'Mural de Anúncios')

@section('content')
    <div class="bg-slate-900 text-gray-200">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <!-- Cabeçalho da Página -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">Nosso Mural de Anúncios</h1>
                <p class="text-lg text-gray-400 mt-3 max-w-3xl mx-auto">Fique por dentro das últimas novidades, parcerias e
                    comunicados importantes da nossa comunidade.</p>
            </div>

            @if ($advertisements->isEmpty())
                <div class="text-center py-16 px-4 bg-gray-800/50 rounded-lg shadow-md border border-gray-700">
                    <i data-lucide="megaphone-off" class="mx-auto h-12 w-12 text-gray-500"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-200">Nenhum anúncio no momento</h3>
                    <p class="mt-1 text-sm text-gray-400">Ainda não há anúncios publicados. Volte em breve para novidades!
                    </p>
                </div>
            @else
                @php
                    $featured = $advertisements->first();
                    $others = $advertisements->skip(1);
                @endphp

                <!-- Anúncio em Destaque -->
                <div class="mb-16">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                        <a href="{{ route('advertisements.show', $featured->id) }}"
                            class="block rounded-2xl overflow-hidden shadow-2xl">
                            @if ($featured->img_anuncio)
                                <img src="{{ asset('storage/' . $featured->img_anuncio) }}"
                                    alt="Imagem de {{ $featured->titulo }}"
                                    class="w-full h-full object-cover transition-transform duration-500 ease-in-out hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gray-800 flex items-center justify-center aspect-video"><i
                                        data-lucide="image-off" class="w-16 h-16 text-gray-600"></i></div>
                            @endif
                        </a>
                        <div class="text-center lg:text-left">
                            <p class="text-sm font-semibold text-lime-400 uppercase tracking-wider">
                                {{ $featured->tipo ?? 'Geral' }}</p>
                            <p class="mt-2 text-sm text-gray-500 mb-6">
                                Publicado por
                                <a href="{{ route('empresas.show', $featured->empresa->id) }}"
                                    class="font-medium text-lime-500 hover:text-lime-400">
                                    {{ $featured->empresa->user->name }}
                                </a>
                                em {{ $featured->created_at->format('d/m/Y') }}
                            </p>
                            <h2 class="mt-2 text-3xl md:text-4xl font-bold text-white leading-tight">{{ $featured->titulo }}
                            </h2>

                            @if ($featured->subtitulo)
                                <p class="mt-4 text-lg text-gray-400">{{ $featured->subtitulo }}</p>
                            @endif

                            <div class="mt-8">
                                <a href="{{ route('advertisements.show', $featured->id) }}"
                                    class="group relative inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-slate-900 bg-lime-400 hover:bg-lime-300 transition-all duration-300 transform hover:scale-105">
                                    Ler mais
                                    <i data-lucide="arrow-right"
                                        class="ml-2 h-5 w-5 transition-transform group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divisor Visível -->
                @if ($others->isNotEmpty())
                    <div class="relative text-center my-16">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-700"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-slate-900 px-4 text-sm font-medium text-gray-400">Mais Anúncios</span>
                        </div>
                    </div>
                @endif

                <!-- Grade com outros anúncios -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($others as $advertisement)
                        <a href="{{ route('advertisements.show', $advertisement->id) }}"
                            class="group block bg-gray-800/50 rounded-2xl shadow-lg overflow-hidden hover:shadow-lime-500/10 border border-gray-700/50 hover:border-lime-500/30 transition-all duration-300 transform hover:-translate-y-1">
                            <div class="h-48 bg-gray-700 overflow-hidden">
                                @if ($advertisement->img_anuncio)
                                    <img src="{{ asset('storage/' . $advertisement->img_anuncio) }}"
                                        alt="Imagem de {{ $advertisement->titulo }}"
                                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center"><i data-lucide="image-off"
                                            class="w-12 h-12 text-gray-600"></i></div>
                                @endif
                            </div>
                            <div class="p-6">
                                <p class="text-xs font-semibold text-lime-400 uppercase tracking-wider">
                                    {{ $advertisement->tipo ?? 'Geral' }}</p>
                                <h3 class="mt-2 font-bold text-xl text-white group-hover:text-lime-300 transition-colors">
                                    {{ $advertisement->titulo }}</h3>
                                @if ($advertisement->subtitulo)
                                    <p class="mt-1 text-sm text-gray-400">{{ $advertisement->subtitulo }}</p>
                                @endif

                                <div class="mt-4 border-t border-gray-700 pt-4 text-xs text-gray-500">
                                    <p class="text-sm text-gray-500">
                                        Publicado por
                                        <span class="font-medium text-lime-500">
                                            {{ $featured->empresa->user->name }}
                                        </span>
                                        em {{ $featured->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Paginação -->
                <div class="mt-16">
                    {{ $advertisements->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection
