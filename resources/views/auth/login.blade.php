@extends('layouts.guest')

@section('title', 'Login')

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
                    <div class="sm:text-4xl xl:text-5xl font-bold leading-tight mb-6">Bem-vindo de volta!</div>
                    <div class="sm:text-sm xl:text-md text-gray-200 font-normal">Acesse sua conta e continue sua jornada
                        sustentável. Transforme resíduos em recompensas e faça parte da revolução verde!</div>
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
                            Bem-vindo de volta!
                        </h2>
                        <p class="mt-2 text-sm text-slate-300">Faça login na sua conta</p>
                    </div>
                    <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Campo Email -->
                        <div>
                            <label for="email" class="ml-3 text-sm font-bold text-green-400 tracking-wide">Email</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="mail" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input id="email" name="email" type="email" required autofocus autocomplete="email"
                                    class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 @error('email') border-red-500 @else border-emerald-900 @enderror"
                                    placeholder="mail@gmail.com" value="{{ old('email') }}">
                            </div>
                        </div>

                        <!-- Campo Senha -->
                        <div>
                            <label for="password" class="ml-3 text-sm font-bold text-green-400 tracking-wide">Senha</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="lock" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input id="password" name="password" type="password" required
                                    autocomplete="current-password"
                                    class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 @error('password') border-red-500 @else border-emerald-900 @enderror"
                                    placeholder="Digite sua senha">
                            </div>
                        </div>

                        <!-- Botão de Login -->
                        <div>
                            <button type="submit"
                                class="relative w-full flex justify-center p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer overflow-hidden bg-green-800 text-gray-100 z-10 group">
                                <span class="z-20">Entrar</span>
                                <span
                                    class="absolute w-full h-full bg-green-400 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                                <span
                                    class="absolute w-full h-full bg-green-500 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left"></span>
                                <span
                                    class="absolute w-full h-full bg-green-600 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></span>
                            </button>
                        </div>

                        <!-- Link para Criar Conta -->
                        <span class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-500">
                            <p>Não tem uma conta?</p>
                            <a href="{{ route('register') }}"
                                class="btn group flex items-center bg-transparent p-2 px-6 text-md">
                                <span
                                    class="flex items-center relative pb-1 text-green-400 hover:text-green-500 after:transition-transform after:duration-500 after:ease-out after:absolute after:bottom-0 after:left-0 after:block after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-lime-400 after:content-[''] after:group-hover:origin-bottom-left after:group-hover:scale-x-100">Criar
                                    Conta
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
