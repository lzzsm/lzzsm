@extends('layouts.guest')

@section('title', 'Editar Material')

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
                <i data-lucide="recycle" class="w-6 h-6 mr-2 text-lime-400"></i>
                Editar Material
            </h2>

            <form action="{{ route('materials.update', $material->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Categoria -->
                <div>
                    <label for="categoria" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Categoria</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="tag" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input id="categoria" name="categoria" type="text" value="{{ old('categoria', $material->categoria) }}"
                            required
                            class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('categoria') border-red-500 @enderror"
                            placeholder="Ex: Plástico PET, Alumínio, Papelão...">
                    </div>
                    @error('categoria')
                        <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Pontos por Kg - AJUSTADO PARA INTEIRO -->
                <div>
                    <label for="ponto_kg" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Pontos por Kg</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="star" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input id="ponto_kg" name="ponto_kg" type="number" min="0" 
                            value="{{ old('ponto_kg', $material->ponto_kg) }}" required
                            class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('ponto_kg') border-red-500 @enderror"
                            placeholder="Ex: 10">
                    </div>
                    @error('ponto_kg')
                        <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Descrição -->
                <div>
                    <label for="descricao" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="4"
                        class="w-full text-base px-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('descricao') border-red-500 @enderror"
                        placeholder="Descreva as características do material, formas de coleta, etc...">{{ old('descricao', $material->descricao) }}</textarea>
                    @error('descricao')
                        <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Status Ativo - MESMO ESTILO DA INDEX -->
                <div class="flex items-center pt-2">
                    <input type="hidden" name="ativo" value="0">
                    <x-custom-checkbox 
                        id="ativo" 
                        name="ativo" 
                        value="1" 
                        label="Material ativo para coleta"
                        :checked="old('ativo', $material->ativo)" 
                    />
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
                            Atualizar Material
                        </span>
                        <span
                            class="absolute w-full h-full bg-green-400 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        <span
                            class="absolute w-full h-full bg-green-600 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></span>
                    </button>
                </div>

                <!-- Link útil -->
                <span class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-400">
                    <p>Quer voltar para o gerenciamento?</p>
                    <a href="{{ route('materials.index') }}"
                        class="btn group flex items-center bg-transparent p-2 px-6 text-md">
                        <span
                            class="flex items-center relative pb-1 text-green-400 hover:text-green-500 after:transition-transform after:duration-500 after:ease-out after:absolute after:bottom-0 after:left-0 after:block after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-lime-400 after:content-[''] after:group-hover:origin-bottom-left after:group-hover:scale-x-100">
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
@endsection