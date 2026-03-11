@extends('layouts.guest')

@section('title', 'Editar Empresa Parceira')

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
            class="relative z-10 max-w-4xl w-full bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-emerald-900">
            <h2 class="text-2xl font-bold text-lime-400 mb-6 flex items-center">
                <i data-lucide="building" class="w-6 h-6 mr-2 text-lime-400"></i>
                Editar Empresa Parceira
            </h2>

            <p class="text-gray-400 mb-8">Alterando dados de: <span class="text-lime-300">{{ $empresa->user->name }}</span></p>

            <form action="{{ route('admin.empresas.update', $empresa->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Linha 1: Nome da Empresa e Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nome da Empresa -->
                    <div>
                        <label for="name" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Nome da Empresa</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="building-2" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="name" name="name" type="text" value="{{ old('name', $empresa->user->name) }}"
                                required
                                class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('name') border-red-500 @enderror">
                        </div>
                        @error('name')
                            <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Email de Acesso</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="mail" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" value="{{ old('email', $empresa->user->email) }}"
                                required
                                class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('email') border-red-500 @enderror">
                        </div>
                        @error('email')
                            <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Linha 2: CNPJ e Telefone -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- CNPJ -->
                    <div>
                        <label for="cnpj" class="ml-1 text-sm font-bold text-green-400 tracking-wide">CNPJ</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="id-card" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="cnpj" name="cnpj" type="text" 
                                value="{{ old('cnpj', $empresa->cnpj_formatado) }}"
                                oninput="mascaraCNPJ(this)"
                                required
                                class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('cnpj') border-red-500 @enderror">
                        </div>
                        @error('cnpj')
                            <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Telefone Comercial -->
                    <div>
                        <label for="telefone_comercial" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Telefone Comercial</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="phone" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="telefone_comercial" name="telefone_comercial" type="tel"
                                value="{{ old('telefone_comercial', $empresa->telefone_comercial_formatado) }}"
                                oninput="mascaraTelefone(this)"
                                class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('telefone_comercial') border-red-500 @enderror">
                        </div>
                        @error('telefone_comercial')
                            <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Descrição -->
                <div>
                    <label for="descricao" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="3"
                        class="w-full text-base px-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('descricao') border-red-500 @enderror">{{ old('descricao', $empresa->descricao) }}</textarea>
                    @error('descricao')
                        <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Website -->
                <div>
                    <label for="site" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Website (Opcional)</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="globe" class="h-5 w-5 text-gray-400"></i>
                        </div>
                        <input id="site" name="site" type="url" value="{{ old('site', $empresa->site) }}"
                            class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('site') border-red-500 @enderror">
                    </div>
                    @error('site')
                        <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                    @enderror
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
                            Atualizar Empresa
                        </span>
                        <span
                            class="absolute w-full h-full bg-green-400 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        <span
                            class="absolute w-full h-full bg-green-600 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></span>
                    </button>
                </div>

                <!-- Link útil -->
                <span class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-400">
                    <p>Quer voltar para o gerenciamento de empresas?</p>

                    <a href="{{ route('empresas.index') }}"
                        class="btn group flex items-center bg-transparent p-2 px-6 text-md">
                        <span
                            class="flex items-center relative pb-1 text-green-400 hover:text-green-500 after:transition-transform after:duration-500 after:ease-out after:absolute after:bottom-0 after:left-0 after:block after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-lime-400 after:content-[''] after:group-hover:origin-bottom-left after:group-hover:scale-x-100">
                            Gerenciar Empresas

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

    <!-- Scripts das máscaras -->
    <script>
        function mascaraTelefone(campo) {
            let tel = campo.value.replace(/\D/g, '');

            // Limita a 11 dígitos
            if (tel.length > 11) tel = tel.slice(0, 11);

            // Remove a máscara toda antes de aplicar de novo
            let formatado = '';

            if (tel.length <= 10) {
                // (99) 12345678
                formatado = tel.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2$3');
            } else {
                // (99) 912345678
                formatado = tel.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2$3');
            }

            campo.value = formatado;
        }

        function mascaraCNPJ(campo) {
            let cnpj = campo.value.replace(/\D/g, '');

            if (cnpj.length > 14) cnpj = cnpj.slice(0, 14);

            cnpj = cnpj.replace(/^(\d{2})(\d)/, '$1.$2');
            cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
            cnpj = cnpj.replace(/\.(\d{3})(\d)/, '.$1/$2');
            cnpj = cnpj.replace(/(\d{4})(\d)/, '$1-$2');

            campo.value = cnpj;
        }
    </script>
@endsection