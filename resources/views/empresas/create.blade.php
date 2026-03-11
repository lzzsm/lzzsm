@extends('layouts.guest')

@section('title', 'Cadastro de Empresa Parceira')

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
                    <div class="sm:text-4xl xl:text-5xl font-bold leading-tight mb-6">Amplie seu impacto sustentável</div>
                    <div class="sm:text-sm xl:text-md text-gray-200 font-normal">Faça parte da nossa rede de parceiros e
                        conecte sua empresa a um ecossistema de inovação e responsabilidade ambiental. Juntos, transformamos
                        o futuro.</div>
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
                        <h2 class="mt-6 text-3xl font-bold text-lime-400">
                            Cadastro de Parceiro
                        </h2>
                        <p class="mt-2 text-sm text-slate-300">Crie a conta de acesso da sua empresa.</p>
                    </div>
                    <form class="mt-8 space-y-6" method="POST" action="{{ route('empresas.store') }}">
                        @csrf

                        <!-- Linha 1: Nome da Empresa e Email -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="ml-3 text-sm font-bold text-green-400 tracking-wide">Nome da
                                    Empresa</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                            data-lucide="user" class="h-5 w-5 text-gray-400"></i></div>
                                    <input id="name" name="name" type="text" required
                                        class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 @error('name') border-red-500 @else border-emerald-900 @enderror"
                                        placeholder="Razão Social" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="ml-3 text-sm font-bold text-green-400 tracking-wide">Email de
                                    Acesso</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                            data-lucide="mail" class="h-5 w-5 text-gray-400"></i></div>
                                    <input id="email" name="email" type="email" required
                                        class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 @error('email') border-red-500 @else border-emerald-900 @enderror"
                                        placeholder="será seu login" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Linha 2: CNPJ e Telefone -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="cnpj"
                                    class="ml-3 text-sm font-bold text-green-400 tracking-wide">CNPJ</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                            data-lucide="id-card" class="h-5 w-5 text-gray-400"></i></div>
                                    <input maxlength="18" id="cnpj" name="cnpj" type="text" required
                                        oninput="mascaraCNPJ(this)"
                                        class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 @error('cnpj') border-red-500 @else border-emerald-900 @enderror"
                                        placeholder="00.000.000/0001-00" value="{{ old('cnpj') }}">
                                </div>
                                @error('cnpj')
                                    <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="telefone_comercial"
                                    class="ml-3 text-sm font-bold text-green-400 tracking-wide">Telefone Comercial</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                            data-lucide="phone" class="h-5 w-5 text-gray-400"></i></div>
                                    <input maxlength="15" id="telefone_comercial" name="telefone_comercial" type="tel"
                                        oninput="mascaraTelefone(this)"
                                        class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 @error('telefone_comercial') border-red-500 @else border-emerald-900 @enderror"
                                        placeholder="(11) 98765-4321" value="{{ old('telefone_comercial') }}">
                                </div>
                                @error('telefone_comercial')
                                    <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Descrição -->
                        <div>
                            <label for="descricao"
                                class="ml-3 text-sm font-bold text-green-400 tracking-wide">Descrição</label>
                            <div class="relative mt-1">
                                <textarea id="descricao" name="descricao" rows="3"
                                    class="w-full text-base px-4 py-2 border focus:outline-none rounded-2xl focus:border-green-500 @error('descricao') border-red-500 @else border-emerald-900 @enderror"
                                    placeholder="Conte-nos sobre a sua empresa e sua área de atuação.">{{ old('descricao') }}</textarea>
                            </div>
                            @error('descricao')
                                <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Website -->
                        <div>
                            <label for="site" class="ml-3 text-sm font-bold text-green-400 tracking-wide">Website
                                (Opcional)</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                        data-lucide="globe" class="h-5 w-5 text-gray-400"></i></div>
                                <input id="site" name="site" type="url"
                                    class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 @error('site') border-red-500 @else border-emerald-900 @enderror"
                                    placeholder="https://www.suaempresa.com.br" value="{{ old('site') }}">
                            </div>
                            @error('site')
                                <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Linha 3: Senha e Confirmação -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="ml-3 text-sm font-bold text-green-400 tracking-wide">Crie uma
                                    Senha</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                            data-lucide="lock" class="h-5 w-5 text-gray-400"></i></div>
                                    <input id="password" name="password" type="password" required
                                        class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 @error('password') border-red-500 @else border-emerald-900 @enderror"
                                        placeholder="Mínimo 8 caracteres">
                                </div>
                                @error('password')
                                    <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation"
                                    class="ml-3 text-sm font-bold text-green-400 tracking-wide">Confirme a Senha</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                            data-lucide="check-circle" class="h-5 w-5 text-gray-400"></i></div>
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        required
                                        class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 border-emerald-900"
                                        placeholder="Repita a senha">
                                </div>
                            </div>
                        </div>

                        <!-- Termos e condições -->
                        <div>
                            <div class="flex items-center justify-between mt-4">
                                <label for="terms" class="relative flex items-center cursor-pointer group">
                                    <input id="terms" name="terms" type="checkbox" required class="peer sr-only">
                                    <div
                                        class="w-5 h-5 rounded-md bg-emerald-800 border-2 transition-all duration-400 ease-in-out peer-checked:bg-gradient-to-br from-green-500 to-emerald-700 peer-checked:border-0 peer-checked:rotate-12 after:content-[''] after:absolute after:top-1/2 after:left-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:w-3 after:h-3 after:opacity-0 after:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMyIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cG9seWxpbmUgcG9pbnRzPSIyMCA2IDkgMTcgNCAxMiI+PC9wb2x5bGluZT48L3N2Zz4=')] after:bg-contain after:bg-no-repeat peer-checked:after:opacity-100 after:transition-opacity after:duration-300 hover:shadow-[0_0_15px_rgba(26,125,74,1)] @error('terms') border-red-500 @else border-green-600 @enderror">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-500">Concordo com os <a
                                            href="{{ route('legal.terms') }}"
                                            class="text-indigo-400 hover:text-blue-500">Termos de Uso</a> e <a
                                            href="{{ route('legal.privacy-policy') }}"
                                            class="text-indigo-400 hover:text-blue-500">Política de Privacidade</a></span>
                                </label>
                            </div>
                            @error('terms')
                                <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Botão e Link de Gerenciamento -->
                        <div>
                            <button type="submit"
                                class="relative w-full flex justify-center p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer overflow-hidden bg-green-800 text-gray-100 z-10 group">
                                <span
                                    class="absolute inset-0 flex justify-center items-center text-white font-bold opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-hover:delay-200 z-20">Cadastrar!</span>
                                <span class="z-20 transition-opacity duration-300 group-hover:opacity-0">Finalizar
                                    Cadastro</span>
                                <span
                                    class="absolute w-full h-full bg-green-400 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                                <span
                                    class="absolute w-full h-full bg-green-400 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left"></span>
                                <span
                                    class="absolute w-full h-full bg-green-600 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></span>
                            </button>
                        </div>
                        <span class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-500">
                            <p>Quer ver as empresas já cadastradas?</p>
                            <a href="{{ route('empresas.index') }}"
                                class="btn group flex items-center bg-transparent p-2 px-6 text-md">
                                <span
                                    class="flex items-center relative pb-1 text-green-400 hover:text-green-500 after:transition-transform after:duration-500 after:ease-out after:absolute after:bottom-0 after:left-0 after:block after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-lime-400 after:content-[''] after:group-hover:origin-bottom-left after:group-hover:scale-x-100">Gerenciar
                                    Parcerias
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
