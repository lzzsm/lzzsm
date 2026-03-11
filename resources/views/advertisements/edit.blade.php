@extends('layouts.guest')

@section('title', 'Editar Anúncio')

@section('content')
    <div class="relative min-h-screen flex items-center justify-center bg-no-repeat bg-cover bg-center text-gray-200 py-12"
        style="background-image: url({{ asset('img/hero_background.jpg') }});">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/90 to-slate-950/90 z-0"></div>

        <!-- Logo -->
        <a href="{{ route('home') }}" class="absolute top-5 left-7 z-20">
            <img src="{{ asset('img/logo_txt_perseph.png') }}" alt="Perseph" class="w-40" />
        </a>

        <!-- Form Card -->
        <div
            class="relative z-10 max-w-2xl w-full bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-emerald-900">
            <h2 class="text-2xl font-bold text-lime-400 mb-6 flex items-center">
                <i data-lucide="megaphone" class="w-6 h-6 mr-2 text-lime-400"></i>
                Editar Anúncio
            </h2>

            <form action="{{ route('advertisements.update', $advertisement->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Título -->
                <div>
                    <label for="titulo" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Título</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="type" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input id="titulo" name="titulo" type="text" value="{{ old('titulo', $advertisement->titulo) }}"
                            required
                            class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('titulo') border-red-500 @enderror">
                    </div>
                    @error('titulo')
                        <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Subtítulo -->
                <div>
                    <label for="subtitulo" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Subtítulo (Opcional)</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="subtitles" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input id="subtitulo" name="subtitulo" type="text" value="{{ old('subtitulo', $advertisement->subtitulo) }}"
                            class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('subtitulo') border-red-500 @enderror">
                    </div>
                    @error('subtitulo')
                        <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tipo de Anúncio -->
                <div>
                    <label for="tipo" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Tipo de Anúncio</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="tag" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <select id="tipo" name="tipo" required
                            class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 appearance-none cursor-pointer @error('tipo') border-red-500 @enderror">
                            <option value="">Selecione uma categoria</option>
                            @php
                                $tipos = ['Parceria', 'Evento', 'Comunicado', 'Promoção', 'Informativo'];
                            @endphp
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo }}" {{ old('tipo', $advertisement->tipo) == $tipo ? 'selected' : '' }}>
                                    {{ $tipo }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i data-lucide="chevron-down" class="h-5 w-5 text-gray-400"></i>
                        </div>
                    </div>
                    @error('tipo')
                        <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Conteúdo -->
                <div>
                    <label for="conteudo" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Conteúdo do Anúncio</label>
                    <textarea id="conteudo" name="conteudo" rows="4" required
                        class="w-full text-base px-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('conteudo') border-red-500 @enderror">{{ old('conteudo', $advertisement->conteudo) }}</textarea>
                    @error('conteudo')
                        <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Imagem -->
                <div>
                    <label for="img_anuncio" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Imagem de Destaque</label>
                    @if ($advertisement->img_anuncio)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $advertisement->img_anuncio) }}" alt="Imagem atual"
                                class="h-28 rounded-lg shadow">
                            <p class="text-xs text-gray-400 mt-1">Imagem atual</p>
                        </div>
                    @endif
                    <input id="img_anuncio" name="img_anuncio" type="file"
                        class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:font-semibold file:bg-green-100 file:text-green-800 hover:file:bg-green-200 cursor-pointer">
                </div>

                <!-- Botão -->
                <div>
                    <button type="submit"
                        class="relative w-full flex justify-center p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer overflow-hidden bg-green-800 text-gray-100 z-10 group">
                        <span
                            class="absolute inset-0 flex justify-center items-center text-white font-bold opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-hover:delay-200 z-20">
                            Salvar Alterações!
                        </span>
                        <span class="z-20 transition-opacity duration-300 group-hover:opacity-0">
                            Atualizar Anúncio
                        </span>
                        <span
                            class="absolute w-full h-full bg-green-400 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        <span
                            class="absolute w-full h-full bg-green-600 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></span>
                    </button>
                </div>

                <!-- Link útil -->
                <span class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-400">
                    <p>
                        @if (Auth::user()->nivel_permissao === 'empresa')
                            Quer voltar para seus anúncios?
                        @else
                            Quer voltar para o gerenciamento?
                        @endif
                    </p>

                    <a href="{{ Auth::user()->nivel_permissao === 'empresa' ? route('advertisements.my') : route('advertisements.index') }}"
                        class="btn group flex items-center bg-transparent p-2 px-6 text-md">
                        <span
                            class="flex items-center relative pb-1 text-green-400 hover:text-green-500 after:transition-transform after:duration-500 after:ease-out after:absolute after:bottom-0 after:left-0 after:block after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-lime-400 after:content-[''] after:group-hover:origin-bottom-left after:group-hover:scale-x-100">
                            @if (Auth::user()->nivel_permissao === 'empresa')
                                Meus Anúncios
                            @else
                                Gerenciar Anúncios
                            @endif

                            <svg class="pl-2 -translate-x-0 fill-slate-700 transition-all duration-300 ease-out group-hover:translate-x-1 group-hover:scale-x-105 group-hover:fill-green-100"
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z" />
                            </svg>
                        </span>
                    </a>
                </span>
            </form>
        </div>
    </div>
@endsection