@extends('layouts.guest')

@section('title', 'Criar Novo Anúncio')

@section('content')

    <div class="relative min-h-screen flex ">
        <a href="{{ route('home') }}" class="absolute top-5 left-7 z-50">
            <img src="{{ asset('img/logo_txt_perseph.png') }}" alt="Perseph" class="w-40" />
        </a>
        <div
            class="flex flex-col sm:flex-row items-center md:items-start sm:justify-center md:justify-start flex-auto min-w-0 bg-white">

            <div class="sm:w-1/2 xl:w-2/5 h-full hidden md:flex flex-auto items-center justify-start p-10 overflow-hidden text-white bg-no-repeat bg-cover relative"
                style="background-image: url('https://www.neoenergia.com/documents/d/guest/simbolo-da-reciclagem-jpg' );">
                <div class="absolute bg-gradient-to-b from-emerald-950 to-slate-900 opacity-75 inset-0 z-0"></div>
                <div class="absolute triangle max-h-screen right-0 w-16 bg-gradient-to-b from-emerald-700 to-slate-950">
                </div>
                <img src="{{ asset('img/reciclagem.png') }}" class="h-96 absolute right-1">
                <div class="w-full max-w-md z-10">
                    <div class="sm:text-4xl xl:text-5xl font-bold leading-tight mb-6">Divulgue suas novidades</div>
                    <div class="sm:text-sm xl:text-md text-gray-200 font-normal">Crie comunicados, anuncie parcerias ou
                        promova eventos. Seus anúncios serão vistos por toda a comunidade da plataforma.</div>
                </div>
                <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>

            <div
                class="md:flex md:items-center md:justify-center w-full sm:w-auto md:h-full w-2/5 xl:w-2/5 p-8 md:p-10 lg:p-14 sm:rounded-lg md:rounded-none bg-gradient-to-b from-emerald-700 to-slate-950">
                <div class="max-w-md w-full space-y-8">
                    <div class="text-center">
                        <h2 class="mt-6 text-3xl font-bold text-lime-400">Criar Anúncio</h2>
                        <p class="mt-2 text-sm text-slate-300">Preencha os campos para publicar.</p>
                    </div>

                    <form class="mt-8 space-y-6" method="POST" action="{{ route('advertisements.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Título -->
                        <div>
                            <label for="titulo" class="ml-3 text-sm font-bold text-green-400 tracking-wide">Título</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                        data-lucide="type" class="h-5 w-5 text-gray-400"></i></div>
                                <input id="titulo" name="titulo" type="text" required
                                    class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 @error('titulo') border-red-500 @else border-emerald-900 @enderror"
                                    placeholder="O título principal do seu anúncio" value="{{ old('titulo') }}">
                            </div>
                            @error('titulo')
                                <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Subtítulo -->
                        <div>
                            <label for="subtitulo" class="ml-3 text-sm font-bold text-green-400 tracking-wide">Subtítulo
                                (Opcional)</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                        data-lucide="text" class="h-5 w-5 text-gray-400"></i></div>
                                <input id="subtitulo" name="subtitulo" type="text"
                                    class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 @error('subtitulo') border-red-500 @else border-emerald-900 @enderror"
                                    placeholder="Uma frase curta de impacto" value="{{ old('subtitulo') }}">
                            </div>
                            @error('subtitulo')
                                <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tipo de Anúncio -->
                        <div class="relative">
                            <label for="tipo-dropdown" class="ml-3 text-sm font-bold text-green-400 tracking-wide">Tipo de
                                Anúncio</label>
                            <div id="tipo-dropdown" class="relative mt-1">
                                <button type="button"
                                    class="relative w-full cursor-pointer rounded-2xl bg-white py-2.5 pl-4 pr-10 text-left text-gray-900 border-b focus:outline-none focus:border-green-500 @error('tipo') border-red-500 @else border-emerald-900 @enderror"
                                    aria-haspopup="listbox" aria-expanded="false">
                                    <span class="block truncate" id="tipo-dropdown-label">Selecione uma categoria</span>
                                    <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10 3a.75.75 0 01.53.22l3.5 3.5a.75.75 0 01-1.06 1.06L10 4.81 6.53 8.28a.75.75 0 01-1.06-1.06l3.5-3.5A.75.75 0 0110 3zm-3.72 9.53a.75.75 0 011.06 0L10 15.19l2.47-2.47a.75.75 0 111.06 1.06l-3.5 3.5a.75.75 0 01-1.06 0l-3.5-3.5a.75.75 0 010-1.06z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </button>
                                <ul class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-slate-800 py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm 
                   opacity-0 scale-95 transform transition-all duration-200 ease-in-out pointer-events-none"
                                    tabindex="-1" role="listbox" id="tipo-dropdown-options">
                                    @php
                                        $tipos = ['Parceria', 'Evento', 'Comunicado', 'Promoção', 'Informativo'];
                                    @endphp
                                    @foreach ($tipos as $tipo)
                                        <li class="text-gray-300 relative cursor-pointer select-none py-2 pl-3 pr-9 hover:bg-emerald-700"
                                            role="option" data-value="{{ $tipo }}">
                                            <span class="font-normal block truncate">{{ $tipo }}</span>
                                            <span
                                                class="text-lime-400 absolute inset-y-0 right-0 flex items-center pr-4 hidden">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.052-.143z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                                <input type="hidden" name="tipo" id="tipo-hidden-input"
                                    value="{{ old('tipo', '') }}">
                            </div>

                            @error('tipo')
                                <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Conteúdo do Anúncio -->
                        <div class="relative">
                            <label class="ml-3 text-sm font-bold text-green-400 tracking-wide">Conteúdo do
                                Anúncio</label>
                            <textarea name="conteudo" rows="4" required
                                class="w-full text-base px-4 py-2 border border-emerald-900 rounded-2xl focus:outline-none focus:border-green-500"
                                placeholder="Escreva os detalhes do seu anúncio aqui...">{{ old('conteudo') }}</textarea>
                        </div>

                        <!-- Imagem do Anúncio -->
                        <div class="relative">
                            <label class="ml-3 text-sm font-bold text-green-400 tracking-wide">Imagem de Destaque
                                (Opcional)</label>
                            <input name="img_anuncio" type="file"
                                class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-800 hover:file:bg-green-200 cursor-pointer">
                        </div>

                        <div>
                            <button type="submit"
                                class="relative w-full flex justify-center p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer overflow-hidden bg-green-800 text-gray-100 z-10 group">
                                <span
                                    class="absolute inset-0 flex justify-center items-center text-white font-bold opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-hover:delay-200 z-20">
                                    Publicar!
                                </span>
                                <span class="z-20 transition-opacity duration-300 group-hover:opacity-0">
                                    Salvar e Publicar Anúncio
                                </span>
                                <span
                                    class="absolute w-full h-full bg-green-400 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                                <span
                                    class="absolute w-full h-full bg-green-400 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left"></span>
                                <span
                                    class="absolute w-full h-full bg-green-600 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></span>
                            </button>
                        </div>
                        <span class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-500">
                            <p>Quer ver os anúncios já publicados?</p>
                            <a href="{{ route('advertisements.my') }}"
                                class="btn group flex items-center bg-transparent p-2 px-6 text-md">
                                <span
                                    class="flex items-center relative pb-1 text-green-400 hover:text-green-500 after:transition-transform after:duration-500 after:ease-out after:absolute after:bottom-0 after:left-0 after:block after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-lime-400 after:content-[''] after:group-hover:origin-bottom-left after:group-hover:scale-x-100">
                                    Gerenciar Anúncios
                                    <svg class="pl-2 -translate-x-0 fill-slate-700 transition-all duration-300 ease-out group-hover:translate-x-1 group-hover:scale-x-105 group-hover:fill-green-100"
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z" />
                                    </svg>
                                </span>
                            </a>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
