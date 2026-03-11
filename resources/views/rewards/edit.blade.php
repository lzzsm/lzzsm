@extends('layouts.guest')

@section('title', 'Editar Recompensa')

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
            class="relative z-10 max-w-lg w-full bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-emerald-900">
            <h2 class="text-2xl font-bold text-lime-400 mb-6 flex items-center">
                <i data-lucide="gift" class="w-6 h-6 mr-2 text-lime-400"></i>
                Editar Recompensa
            </h2>

            <form action="{{ route('rewards.update', $reward->id) }}" method="POST" enctype="multipart/form-data"
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
                        <input id="titulo" name="titulo" type="text" value="{{ old('titulo', $reward->titulo) }}"
                            required
                            class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('titulo') border-red-500 @enderror">
                    </div>
                    @error('titulo')
                        <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Descrição -->
                <div>
                    <label for="descricao" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="3"
                        class="w-full text-base px-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('descricao') border-red-500 @enderror">{{ old('descricao', $reward->descricao) }}</textarea>
                    @error('descricao')
                        <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Pontos Necessários -->
                <div>
                    <label for="pontos_necessarios" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Pontos
                        Necessários</label>
                    <input id="pontos_necessarios" name="pontos_necessarios" type="number"
                        value="{{ old('pontos_necessarios', $reward->pontos_necessarios) }}" required
                        class="w-full text-base px-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('pontos_necessarios') border-red-500 @enderror">
                    @error('pontos_necessarios')
                        <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Quantidade Disponível -->
                <div>
                    <label for="qtd_disponivel" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Quantidade
                        Disponível</label>
                    <input id="qtd_disponivel" name="qtd_disponivel" type="number"
                        value="{{ old('qtd_disponivel', $reward->qtd_disponivel) }}" required
                        class="w-full text-base px-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('qtd_disponivel') border-red-500 @enderror">
                    @error('qtd_disponivel')
                        <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Imagem -->
                <div>
                    <label for="img_recompensa" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Imagem</label>
                    @if ($reward->img_recompensa)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $reward->img_recompensa) }}" alt="Imagem atual"
                                class="h-28 rounded-lg shadow">
                            <p class="text-xs text-gray-400 mt-1">Imagem atual</p>
                        </div>
                    @endif
                    <input id="img_recompensa" name="img_recompensa" type="file"
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
                            Atualizar Recompensa
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
                            Quer voltar para suas recompensas?
                        @else
                            Quer voltar para o gerenciamento?
                        @endif
                    </p>

                    <a href="{{ Auth::user()->nivel_permissao === 'empresa' ? route('rewards.my') : route('rewards.index') }}"
                        class="btn group flex items-center bg-transparent p-2 px-6 text-md">
                        <span
                            class="flex items-center relative pb-1 text-green-400 hover:text-green-500 after:transition-transform after:duration-500 after:ease-out after:absolute after:bottom-0 after:left-0 after:block after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-lime-400 after:content-[''] after:group-hover:origin-bottom-left after:group-hover:scale-x-100">
                            @if (Auth::user()->nivel_permissao === 'empresa')
                                Minhas Recompensas
                            @else
                                Gerenciar Recompensas
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
