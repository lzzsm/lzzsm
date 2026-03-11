@extends('layouts.guest')

@section('title', 'Cadastrar Material')

@section('content')

    <div class="relative min-h-screen flex ">
        <a href="{{ route('home') }}" class="absolute top-5 left-7 z-50">
            <img src="{{ asset('img/logo_txt_perseph.png') }}" alt="Perseph" class="w-40" />
        </a>
        <div class="flex flex-col sm:flex-row items-center md:items-start sm:justify-center md:justify-start flex-auto min-w-0 bg-white">

            <div class="sm:w-1/2 xl:w-2/5 h-full hidden md:flex flex-auto items-center justify-start p-10 overflow-hidden text-white bg-no-repeat bg-cover relative"
                style="background-image: url('https://www.neoenergia.com/documents/d/guest/simbolo-da-reciclagem-jpg' );">
                <div class="absolute bg-gradient-to-b from-emerald-950 to-slate-900 opacity-75 inset-0 z-0"></div>
                <div class="absolute triangle max-h-screen right-0 w-16 bg-gradient-to-b from-emerald-700 to-slate-950">
                </div>
                <img src="{{ asset('img/reciclagem.png') }}" class="h-96 absolute right-1">
                <div class="w-full max-w-md z-10">
                    <div class="sm:text-4xl xl:text-5xl font-bold leading-tight mb-6">Cadastre novos materiais</div>
                    <div class="sm:text-sm xl:text-md text-gray-200 font-normal">Adicione materiais recicláveis para que os usuários possam visualizar pontos e categorias disponíveis para coleta.</div>
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

            <div class="md:flex md:items-center md:justify-center w-full sm:w-auto md:h-full w-2/5 xl:w-2/5 p-8 md:p-10 lg:p-14 sm:rounded-lg md:rounded-none bg-gradient-to-b from-emerald-700 to-slate-950">
                <div class="max-w-md w-full space-y-8">
                    <div class="text-center">
                        <h2 class="mt-6 text-3xl font-bold text-lime-400">Cadastrar Material</h2>
                        <p class="mt-2 text-sm text-slate-300">Preencha os dados do material reciclável.</p>
                    </div>

                    <form class="mt-8 space-y-6" method="POST" action="{{ route('materials.store') }}">
                        @csrf

                        <!-- Categoria -->
                        <div>
                            <label for="categoria" class="ml-3 text-sm font-bold text-green-400 tracking-wide">Categoria</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="tag" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input id="categoria" name="categoria" type="text" required
                                    class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 @error('categoria') border-red-500 @else border-emerald-900 @enderror"
                                    placeholder="Ex: Plástico PET, Alumínio, Papelão..." value="{{ old('categoria') }}">
                            </div>
                            @error('categoria')
                                <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Pontos por Kg - AJUSTADO PARA INTEIRO -->
                        <div>
                            <label for="ponto_kg" class="ml-3 text-sm font-bold text-green-400 tracking-wide">Pontos por Kg</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="star" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input id="ponto_kg" name="ponto_kg" type="number" min="0" required
                                    class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 @error('ponto_kg') border-red-500 @else border-emerald-900 @enderror"
                                    placeholder="Ex: 10" value="{{ old('ponto_kg') }}">
                            </div>
                            @error('ponto_kg')
                                <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Descrição -->
                        <div class="relative">
                            <label class="ml-3 text-sm font-bold text-green-400 tracking-wide">Descrição</label>
                            <textarea name="descricao" rows="4"
                                class="w-full text-base px-4 py-2 border border-emerald-900 rounded-2xl focus:outline-none focus:border-green-500 @error('descricao') border-red-500 @enderror"
                                placeholder="Descreva as características do material, formas de coleta, etc...">{{ old('descricao') }}</textarea>
                            @error('descricao')
                                <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <button type="submit"
                                class="relative w-full flex justify-center p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer overflow-hidden bg-green-800 text-gray-100 z-10 group">
                                <span class="absolute inset-0 flex justify-center items-center text-white font-bold opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-hover:delay-200 z-20">
                                    Cadastrar!
                                </span>
                                <span class="z-20 transition-opacity duration-300 group-hover:opacity-0">
                                    Cadastrar Material
                                </span>
                                <span class="absolute w-full h-full bg-green-400 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                                <span class="absolute w-full h-full bg-green-400 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left"></span>
                                <span class="absolute w-full h-full bg-green-600 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></span>
                            </button>
                        </div>
                        
                        <span class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-500">
                            <p>Quer ver os materiais já cadastrados?</p>
                            <a href="{{ route('materials.index') }}"
                                class="btn group flex items-center bg-transparent p-2 px-6 text-md">
                                <span class="flex items-center relative pb-1 text-green-400 hover:text-green-500 after:transition-transform after:duration-500 after:ease-out after:absolute after:bottom-0 after:left-0 after:block after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-lime-400 after:content-[''] after:group-hover:origin-bottom-left after:group-hover:scale-x-100">
                                    Gerenciar Materiais
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
        </div>
    </div>
@endsection