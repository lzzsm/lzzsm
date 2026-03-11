<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/form.css', 'resources/js/form.js'])
    @livewireStyles

</head>

<body class="bg-gray-100">

    <!-- Topbar fixa -->
    <header
        class="shadow-[0_2px_4px_rgba(0,0,0,0.1)] fixed top-0 left-0 right-0 h-[65px] bg-gradient-to-r from-slate-900 via-emerald-900 to-slate-900 shadow flex items-center justify-between px-4 z-50 w-full h-14">

        <!-- Esquerda: Toggle + Título -->
        <div class="flex items-center gap-x-3">
            <!-- Botão Toggle funcional -->
            <button id="toggleSidebarBtn"
                class="relative toggle-btn w-[42px] h-[42px] active:translate-y-0.5 bg-gradient-to-r from-green-950 via-emerald-900 to-green-800 rounded-full flex items-center justify-center transition-all duration-200 ring-2 ring-teal-600 hover:ring-4 active:ring-1 ring-opacity-65">
                <div class="relative w-5 h-5">
                    <!-- Linhas do hamburguer -->
                    <span
                        class="line absolute top-0 left-0 w-full h-[2px] bg-white transition-all duration-300 origin-left"></span>
                    <span
                        class="line absolute top-1/2 left-0 w-full h-[2px] bg-white transition-all duration-300 origin-left -translate-y-1/2"></span>
                    <span
                        class="line absolute bottom-0 left-0 w-full h-[2px] bg-white transition-all duration-300 origin-left"></span>
                    <!-- Linhas do X -->
                    <span
                        class="x-line absolute top-1/2 left-0 w-full h-[2px] bg-white rotate-45 scale-0 transition-all duration-300 origin-center -translate-y-1/2"></span>
                    <span
                        class="x-line absolute top-1/2 left-0 w-full h-[2px] bg-white -rotate-45 scale-0 transition-all duration-300 origin-center -translate-y-1/2"></span>
                </div>
            </button>
            <a href="{{ route('home') }}"><img class="h-6 sm:h-10 w-auto mt-2 ml-2"
                    src="{{ asset('img/txt_perseph.png') }}" alt="Perseph"></a>
        </div>

        <!-- Espaço central -->
        <div class="flex-1"></div>

        <!-- Direita: Botões e Perfil -->
        <div class="flex items-center gap-x-3">
            @auth
                @if (Auth::user()->nivel_permissao == 'admin')
                    <!-- Cadastrar Empresa -->
                    <a href="{{ route('empresas.create') }}" class="hidden sm:inline-flex">
                        <button
                            class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-4 py-2 text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                            <i data-lucide="building-2" class="h-5 w-5 text-lime-300"></i>
                            <span>Cadastrar Empresa</span>
                        </button>
                    </a>
                    <!-- Cadastrar Ponto de Coleta -->
                    <a href="{{ route('collect-points.create') }}" class="hidden sm:inline-flex">
                        <button
                            class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-4 py-2 text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                            <i data-lucide="map-pin-plus" class="h-5 w-5 text-lime-300"></i>
                            <span>Cadastrar Ponto</span>
                        </button>
                    </a>
                    <!-- Cadastrar Material -->
                    <a href="{{ route('materials.create') }}" class="hidden sm:inline-flex">
                        <button
                            class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-4 py-2 text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                            <i data-lucide="recycle" class="h-5 w-5 text-lime-300"></i>
                            <span>Cadastrar Material</span>
                        </button>
                    </a>
                @elseif (Auth::user()->nivel_permissao == 'empresa')
                    <!-- Cadastrar Recompensa -->
                    <a href="{{ route('rewards.create') }}" class="hidden sm:inline-flex">
                        <button
                            class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-4 py-2 text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                            <i data-lucide="award" class="h-5 w-5 text-lime-300"></i>
                            <span>Cadastrar Recompensa</span>
                        </button>
                    </a>
                    <!-- Publicar Anúncio -->
                    <a href="{{ route('advertisements.create') }}" class="hidden sm:inline-flex">
                        <button
                            class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-4 py-2 text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                            <i data-lucide="radio" class="h-5 w-5 text-lime-300"></i>
                            <span>Publicar Anúncio</span>
                        </button>
                    </a>
                    <!-- Validar Resgates -->
                    <a href="{{ route('empresas.resgates.index') }}" class="hidden sm:inline-flex">
                        <button
                            class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-4 py-2 text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                            <i data-lucide="key" class="h-5 w-5 text-lime-300"></i>
                            <span>Validar Resgates</span>
                        </button>
                    </a>
                @else
                    <!-- Agendar Coleta -->
                    <a href="{{ route('collects.create') }}" class="hidden sm:inline-flex">
                        <button
                            class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-4 py-2 text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                            <i data-lucide="calendar-plus" class="h-5 w-5 text-lime-300"></i>
                            <span>Agendar Coleta</span>
                        </button>
                    </a>
                    <!-- Minhas Coletas -->
                    <a href="{{ route('collects.my-collects') }}" class="hidden sm:inline-flex">
                        <button
                            class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-4 py-2 text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                            <i data-lucide="layout-list" class="h-5 w-5 text-lime-300"></i>
                            <span>Minhas Coletas</span>
                        </button>
                    </a>
                    <!-- Catálogo de Recompensas -->
                    <a href="{{ route('rewards.dashboard') }}" class="hidden sm:inline-flex">
                        <button
                            class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-4 py-2 text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                            <i data-lucide="layout-dashboard" class="h-5 w-5 text-lime-300"></i>
                            <span>Catálogo de Recompensas</span>
                        </button>
                    </a>
                @endif

                <!-- Foto de perfil -->
                <div class="relative">
                    <button id="userDropdownToggle"
                        class="focus:outline-none active:translate-y-0.5 transition-transform duration-200 hover:scale-110">
                        <div class="relative">
                            <div
                                class="w-11 h-11 rounded-full p-px bg-transparent hover:bg-lime-400 active:bg-lime-600 transition-colors duration-300">
                                @if (auth()->user()->profile_photo_path)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}"
                                        alt="Foto de Perfil"
                                        class="w-full h-full rounded-full object-cover border-2 border-teal-600 hover:border-gray-700 transition-all duration-300">
                                @else
                                    <img src="{{ asset('img/guest_profile_photo.webp') }}" alt="Foto de Perfil"
                                        class="w-full h-full rounded-full object-cover border-2 border-teal-600 hover:border-gray-700 transition-all duration-300">
                                @endif
                            </div>
                        </div>
                    </button>

                    <!-- Dropdown menu do usuário -->
                    <div id="userDropdownMenu"
                        class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-xl py-1 z-50 border border-gray-700 opacity-0 pointer-events-none transition-all duration-200 transform -translate-y-2 origin-top-right overflow-hidden">
                        <a href="{{ route('dashboard') }}"
                            class="block px-3 py-2 text-gray-300 hover:bg-gray-700 hover:text-teal-400 transition-all duration-200 hover:-translate-x-1 group">
                            <div class="flex items-center space-x-2">
                                <div class="p-1 rounded-full bg-gray-700 group-hover:bg-teal-500/20 transition-colors">
                                    <i data-lucide="user-circle" class="w-4 h-4"></i>
                                </div>
                                <span class="text-sm">Dashboard</span>
                            </div>
                        </a>
                        <a href="{{ route('profile.show') }}"
                            class="block px-3 py-2 text-gray-300 hover:bg-gray-700 hover:text-teal-400 transition-all duration-200 hover:-translate-x-1 group">
                            <div class="flex items-center space-x-2">
                                <div class="p-1 rounded-full bg-gray-700 group-hover:bg-teal-500/20 transition-colors">
                                    <i data-lucide="settings" class="w-4 h-4"></i>
                                </div>
                                <span class="text-sm">Config</span>
                            </div>
                        </a>
                        <div class="border-t border-lime-400 mx-2 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full block px-3 py-2 text-gray-300 hover:bg-gray-700 hover:text-red-400 transition-all duration-200 hover:-translate-x-1 group">
                                <div class="flex items-center space-x-2">
                                    <div class="p-1 rounded-full bg-gray-700 group-hover:bg-red-500/20 transition-colors">
                                        <i data-lucide="log-out" class="w-4 h-4"></i>
                                    </div>
                                    <span class="text-sm">Sair</span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}">
                    <button
                        class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-4 py-2 text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                        <i data-lucide="log-in" class="h-5 w-5 text-lime-300"></i>
                        <span>Login</span>
                    </button>
                </a>
                <a href="{{ route('register') }}">
                    <button
                        class="inline-flex items-center justify-center gap-2 rounded-md border-b border-b-lime-500/70 font-QuicksandMedium text-lime-100 bg-emerald-900 px-4 py-2 text-sm font-semibold shadow-[0_1px_3px_#84cc16] transition hover:bg-emerald-800 hover:shadow-[0_0.7px_4px_#a3e635] hover:scale-[1.02] active:scale-95">
                        <i data-lucide="user-plus" class="h-5 w-5 text-lime-300"></i>
                        <span>Comece a Reciclar!</span>
                    </button>
                </a>
            @endguest
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="shadow-[6px_0_12px_rgba(0,0,0,0.4)] fixed top-14 left-0 h-[calc(100vh-56px)] bg-gradient-to-b from-slate-900 via-emerald-900 to-slate-900 text-white w-64 opacity-0 pointer-events-none overflow-y-auto scrollbar-none transform -translate-x-full transition-all duration-300 ease-in-out z-40">
        <nav class="flex flex-col justify-between h-full p-4">

            <!-- TOPO: Dropdown fixo + Home -->
            <div class="flex flex-col gap-y-2 items-stretch">

                <!-- Home -->
                <a href="{{ route('home') }}">
                    <div
                        class="w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300">
                        <div
                            class="w-1 rounded-xl h-10 bg-transparent transition-colors duration-200 relative overflow-hidden">
                            <div
                                class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-lime-400 transition-all duration-300">
                            </div>
                        </div>
                        <div
                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-200 sidebar-button cursor-pointer border border-transparent">
                            <i data-lucide="house" class="h-7 w-7 text-lime-400 transition-colors duration-200"></i>
                            <span class="font-QuicksandMedium">Home</span>
                        </div>
                    </div>
                </a>

                <!-- Conscientização -->
                <div class="flex flex-col">

                    <!-- Botão do dropdown -->
                    <div
                        class="dropdown-toggle w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300 cursor-pointer">
                        <div
                            class="w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300">
                            <div
                                class="w-1 rounded-xl h-10 bg-transparent transition-colors duration-200 relative overflow-hidden">
                                <div
                                    class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-lime-400 transition-all duration-300">
                                </div>
                            </div>
                            <div
                                class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-200 sidebar-button cursor-pointer border border-transparent">
                                <i data-lucide="brain"
                                    class="h-7 w-7 text-emerald-400 transition-colors duration-200"></i>
                                <span class="font-QuicksandMedium">Conscientização</span>
                                <svg class="h-4 w-4 dropdown-icon transform transition-transform duration-300 fill-gray-400 group-hover:fill-lime-400"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M9 6l6 6-6 6" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Itens do dropdown -->
                    <div
                        class="dropdown-content ml-6 space-y-2 max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out dropdown-transition">

                        <!-- Como Reciclar -->
                        <a href="{{ route('info-pages.how-to-recycle') }}">
                            <div
                                class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                <div
                                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                    <i data-lucide="recycle"
                                        class="h-6 w-6 text-emerald-400 group-hover:text-lime-400 transition-colors duration-200"></i>
                                    <span class="font-QuicksandMedium">Como Reciclar</span>
                                </div>
                            </div>
                        </a>

                        <!-- Tipos de Materiais -->
                        <a href="{{ route('materials.dashboard') }}">
                            <div
                                class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                <div
                                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                    <i data-lucide="package-open"
                                        class="h-6 w-6 text-yellow-400 group-hover:text-lime-400 transition-colors duration-200"></i>
                                    <span class="font-QuicksandMedium">Tipos de Materiais</span>
                                </div>
                            </div>
                        </a>

                        <!-- Jogos e Quizzes -->
                        <a href="{{ route('info-pages.games-and-quizzes') }}">
                            <div
                                class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                <div
                                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                    <i data-lucide="gamepad-2"
                                        class="h-6 w-6 text-pink-400 group-hover:text-rose-400 transition-colors duration-200"></i>
                                    <span class="font-QuicksandMedium">Jogos e Quizzes</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Parcerias -->
                <div class="flex flex-col">

                    <!-- Botão do dropdown -->
                    <div
                        class="dropdown-toggle w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300 cursor-pointer">
                        <div
                            class="w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300">
                            <div
                                class="w-1 rounded-xl h-10 bg-transparent transition-colors duration-200 relative overflow-hidden">
                                <div
                                    class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-lime-400 transition-all duration-300">
                                </div>
                            </div>
                            <div
                                class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-200 sidebar-button cursor-pointer border border-transparent">
                                <i data-lucide="heart-handshake"
                                    class="h-7 w-7 text-cyan-400 transition-colors duration-200"></i>
                                <span class="font-QuicksandMedium">Parcerias</span>
                                <svg class="h-4 w-4 dropdown-icon transform transition-transform duration-300 fill-gray-400 group-hover:fill-lime-400"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M9 6l6 6-6 6" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Itens do dropdown -->
                    <div
                        class="dropdown-content ml-6 space-y-2 max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out dropdown-transition">

                        <!-- Nossos Parceiros -->
                        <a href="{{ route('empresas.dashboard') }}">
                            <div
                                class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                <div
                                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                    <i data-lucide="hand-coins"
                                        class="h-6 w-6 text-cyan-400 group-hover:text-teal-400 transition-colors duration-200"></i>
                                    <span class="font-QuicksandMedium">Nossos Parceiros</span>
                                </div>
                            </div>
                        </a>

                        <!-- Anúncios -->
                        <a href="{{ route('advertisements.dashboard') }}">
                            <div
                                class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                <div
                                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                    <i data-lucide="megaphone"
                                        class="h-6 w-6 text-indigo-400 group-hover:text-violet-400 transition-colors duration-200"></i>
                                    <span class="font-QuicksandMedium">Anúncios</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            @auth
                <!-- Divider -->
                <div class="border-t border-lime-400 mx-2 mt-4 mb-4"></div>

                <!-- MEIO: Itens comuns centralizados -->
                <div class="flex flex-col items-stretch justify-center gap-y-3 flex-1">

                    <!-- Coletas -->
                    <div class="flex flex-col">

                        <!-- Botão do dropdown -->
                        <div
                            class="dropdown-toggle w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300 cursor-pointer">
                            <div
                                class="w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300">
                                <div
                                    class="w-1 rounded-xl h-10 bg-transparent transition-colors duration-200 relative overflow-hidden">
                                    <div
                                        class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-lime-400 transition-all duration-300">
                                    </div>
                                </div>
                                <div
                                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-200 sidebar-button cursor-pointer border border-transparent">
                                    <i data-lucide="leaf"
                                        class="h-7 w-7 text-green-400 transition-colors duration-200"></i>
                                    <span class="font-QuicksandMedium">Coletas</span>
                                    <svg class="h-4 w-4 dropdown-icon transform transition-transform duration-300 fill-gray-400 group-hover:fill-lime-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M9 6l6 6-6 6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Itens do dropdown -->
                        <div
                            class="dropdown-content ml-6 space-y-2 max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out dropdown-transition">

                            @if (Auth::user()->nivel_permissao == 'cadastrado')
                                <!-- Minhas Coletas -->
                                <a href="{{ route('collects.my-collects') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="layout-list"
                                                class="h-6 w-6 text-green-400 group-hover:text-lime-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Minhas Coletas</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- Agendar Coleta -->
                                <a href="{{ route('collects.create') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="calendar-plus"
                                                class="h-6 w-6 text-teal-400 group-hover:text-cyan-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Agendar Coleta</span>
                                        </div>
                                    </div>
                                </a>
                            @endif

                            <!-- Pontos de Coleta -->
                            <a href="{{ route('collect-points.dashboard') }}">
                                <div
                                    class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                    <div
                                        class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                        <i data-lucide="map-pin"
                                            class="h-6 w-6 text-lime-400 group-hover:text-green-300 transition-colors duration-200"></i>
                                        <span class="font-QuicksandMedium">Pontos de Coleta</span>
                                    </div>
                                </div>
                            </a>

                            @if (Auth::user()->nivel_permissao == 'admin')
                                <!-- Cadastrar Pontos de Coleta -->
                                <a href="{{ route('collect-points.create') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="map-pin-plus"
                                                class="h-6 w-6 text-sky-400 group-hover:text-cyan-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Cadastrar Pontos</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- Cadastrar Materiais -->
                                <a href="{{ route('materials.create') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="recycle"
                                                class="h-6 w-6 text-sky-400 group-hover:text-cyan-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Cadastrar Materiais</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- Gerenciar Coletas -->
                                <a href="{{ route('collects.index') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="chart-line"
                                                class="h-6 w-6 text-emerald-300 group-hover:text-lime-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Gerenciar Coletas</span>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Pontuação -->
                    <div class="flex flex-col">

                        <!-- Botão do dropdown -->
                        <div
                            class="dropdown-toggle w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300 cursor-pointer">
                            <div
                                class="w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300">
                                <div
                                    class="w-1 rounded-xl h-10 bg-transparent transition-colors duration-200 relative overflow-hidden">
                                    <div
                                        class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-lime-400 transition-all duration-300">
                                    </div>
                                </div>
                                <div
                                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-200 sidebar-button cursor-pointer border border-transparent">
                                    <i data-lucide="sparkle"
                                        class="h-7 w-7 text-yellow-400 transition-colors duration-200"></i>
                                    <span class="font-QuicksandMedium">Pontuação</span>
                                    <svg class="h-4 w-4 dropdown-icon transform transition-transform duration-300 fill-gray-400 group-hover:fill-lime-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M9 6l6 6-6 6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Itens do dropdown -->
                        <div
                            class="dropdown-content ml-6 space-y-2 max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out dropdown-transition">

                            @if (Auth::user()->nivel_permissao == 'cadastrado')
                                <!-- Meus Pontos -->
                                <a href="{{ route('my-points') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="sparkles"
                                                class="h-6 w-6 text-orange-400 group-hover:text-yellow-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Meus Pontos</span>
                                        </div>
                                    </div>
                                </a>
                            @endif
                            @if (Auth::user()->nivel_permissao != 'empresa')
                                <!-- Como Pontuar -->
                                <a href="{{ route('info-pages.how-to-score') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="info"
                                                class="h-6 w-6 text-amber-400 group-hover:text-lime-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Como Pontuar</span>
                                        </div>
                                    </div>
                                </a>
                            @endif

                            <!-- Ranking -->
                            <a href="{{ route('ranking') }}">
                                <div
                                    class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                    <div
                                        class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                        <i data-lucide="crown"
                                            class="h-6 w-6 text-yellow-300 group-hover:text-amber-400 transition-colors duration-200"></i>
                                        <span class="font-QuicksandMedium">Ranking</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    @if (Auth::user()->nivel_permissao == 'empresa')
                        <!-- Anúncios -->
                        <div class="flex flex-col">

                            <!-- Botão do dropdown -->
                            <div
                                class="dropdown-toggle w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300 cursor-pointer">
                                <div
                                    class="w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300">
                                    <div
                                        class="w-1 rounded-xl h-10 bg-transparent transition-colors duration-200 relative overflow-hidden">
                                        <div
                                            class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-lime-400 transition-all duration-300">
                                        </div>
                                    </div>
                                    <div
                                        class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-200 sidebar-button cursor-pointer border border-transparent">
                                        <i data-lucide="megaphone"
                                            class="h-7 w-7 text-indigo-400 transition-colors duration-200"></i>
                                        <span class="font-QuicksandMedium">Anúncios</span>
                                        <svg class="h-4 w-4 dropdown-icon transform transition-transform duration-300 fill-gray-400 group-hover:fill-lime-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M9 6l6 6-6 6" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Itens do dropdown -->
                            <div
                                class="dropdown-content ml-6 space-y-2 max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out dropdown-transition">

                                <!-- Anunciar -->
                                <a href="{{ route('advertisements.create') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="radio"
                                                class="h-6 w-6 text-rose-400 group-hover:text-pink-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Anunciar</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- Meus Anúncios -->
                                <a href="{{ route('advertisements.my') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="archive"
                                                class="h-6 w-6 text-yellow-400 group-hover:text-amber-300 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Meus Anúncios</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Recompensas -->
                    <div class="flex flex-col">

                        <!-- Botão do dropdown -->
                        <div
                            class="dropdown-toggle w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300 cursor-pointer">
                            <div
                                class="w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300">
                                <div
                                    class="w-1 rounded-xl h-10 bg-transparent transition-colors duration-200 relative overflow-hidden">
                                    <div
                                        class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-lime-400 transition-all duration-300">
                                    </div>
                                </div>
                                <div
                                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-200 sidebar-button cursor-pointer border border-transparent">
                                    <i data-lucide="gift"
                                        class="h-7 w-7 text-amber-400 transition-colors duration-200"></i>
                                    <span class="font-QuicksandMedium">Recompensas</span>
                                    <svg class="h-4 w-4 dropdown-icon transform transition-transform duration-300 fill-gray-400 group-hover:fill-lime-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M9 6l6 6-6 6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Itens do dropdown -->
                        <div
                            class="dropdown-content ml-6 space-y-2 max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out dropdown-transition">

                            <!-- Catálogo -->
                            <a href="{{ route('rewards.dashboard') }}">
                                <div
                                    class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                    <div
                                        class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                        <i data-lucide="layout-dashboard"
                                            class="h-6 w-6 text-amber-400 group-hover:text-yellow-400 transition-colors duration-200"></i>
                                        <span class="font-QuicksandMedium">Catálogo</span>
                                    </div>
                                </div>
                            </a>

                            @if (Auth::user()->nivel_permissao == 'empresa')
                                <!-- Cadastrar Recompensa -->
                                <a href="{{ route('rewards.create') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="award"
                                                class="h-6 w-6 text-sky-400 group-hover:text-cyan-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Cadastrar Recomp.</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- Minhas Recompensas -->
                                <a href="{{ route('rewards.my') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="layout-list"
                                                class="h-6 w-6 text-emerald-400 group-hover:text-lime-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Minhas Recomp.</span>
                                        </div>
                                    </div>
                                </a>
                            @elseif(Auth::user()->nivel_permissao == 'admin')
                                <!-- Gerenciar Recompensas -->
                                <a href="{{ route('rewards.index') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="chart-network"
                                                class="h-6 w-6 text-indigo-400 group-hover:text-violet-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Gerenciar Recomp.</span>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Resgates -->
                    <div class="flex flex-col">

                        <!-- Botão do dropdown -->
                        <div
                            class="dropdown-toggle w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300 cursor-pointer">
                            <div
                                class="w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300">
                                <div
                                    class="w-1 rounded-xl h-10 bg-transparent transition-colors duration-200 relative overflow-hidden">
                                    <div
                                        class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-lime-400 transition-all duration-300">
                                    </div>
                                </div>
                                <div
                                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-200 sidebar-button cursor-pointer border border-transparent">
                                    <i data-lucide="key"
                                        class="h-7 w-7 text-amber-400 transition-colors duration-200"></i>
                                    <span class="font-QuicksandMedium">Resgates</span>
                                    <svg class="h-4 w-4 dropdown-icon transform transition-transform duration-300 fill-gray-400 group-hover:fill-lime-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M9 6l6 6-6 6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Itens do dropdown -->
                        <div
                            class="dropdown-content ml-6 space-y-2 max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out dropdown-transition">

                            <!-- Como Resgatar -->
                                <a href="{{ route('info-pages.how-to-redeem') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="key"
                                                class="h-6 w-6 text-lime-400 group-hover:text-emerald-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Como Resgatar</span>
                                        </div>
                                    </div>
                                </a>

                            @if (Auth::user()->nivel_permissao == 'cadastrado')
                                <!-- Meus Resgates -->
                                <a href="{{ route('resgates.index') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="history"
                                                class="h-6 w-6 text-lime-400 group-hover:text-emerald-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Meus Resgates</span>
                                        </div>
                                    </div>
                                </a>
                            @elseif (Auth::user()->nivel_permissao == 'empresa')
                                <!-- Minhas Recompensas Resgatadas -->
                                <a href="{{ route('empresas.resgates.index') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="layout-list"
                                                class="h-6 w-6 text-emerald-400 group-hover:text-lime-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Recomp. Resgatadas</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- Validar Resgate -->
                                <a href="{{ route('empresas.resgates.validar') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="key"
                                                class="h-6 w-6 text-sky-400 group-hover:text-cyan-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Validar Resgate</span>
                                        </div>
                                    </div>
                                </a>
                            @elseif (Auth::user()->nivel_permissao == 'admin')
                                <!-- Gerenciar Resgates -->
                                <a href="{{ route('admin.resgates.index') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="key"
                                                class="h-6 w-6 text-sky-400 group-hover:text-cyan-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Gerenciar Resgates</span>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>

                    @if (Auth::user()->nivel_permissao == 'admin')
                        <!-- Plataforma -->
                        <div class="flex flex-col">

                            <!-- Botão do dropdown -->
                            <div
                                class="dropdown-toggle w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300 cursor-pointer">
                                <div
                                    class="w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300">
                                    <div
                                        class="w-1 rounded-xl h-10 bg-transparent transition-colors duration-200 relative overflow-hidden">
                                        <div
                                            class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-lime-400 transition-all duration-300">
                                        </div>
                                    </div>
                                    <div
                                        class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-200 sidebar-button cursor-pointer border border-transparent">
                                        <i data-lucide="cog"
                                            class="h-7 w-7 text-amber-400 transition-colors duration-200"></i>
                                        <span class="font-QuicksandMedium">Plataforma</span>
                                        <svg class="h-4 w-4 dropdown-icon transform transition-transform duration-300 fill-gray-400 group-hover:fill-lime-400"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M9 6l6 6-6 6" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Itens do dropdown -->
                            <div
                                class="dropdown-content ml-6 space-y-2 max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out dropdown-transition">
                                <!-- Gerenciar Usuários -->
                                <a href="{{ route('users.index') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="users-round"
                                                class="h-6 w-6 text-emerald-300 group-hover:text-lime-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Gerenciar Usuários</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- Gerenciar Empresas -->
                                <a href="{{ route('empresas.index') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="building-2"
                                                class="h-6 w-6 text-emerald-300 group-hover:text-lime-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Gerenciar Empresas</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- Gerenciar Feedbacks -->
                                <a href="{{ route('feedbacks.index') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="star"
                                                class="h-6 w-6 text-orange-400 group-hover:text-amber-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Gerenciar Feedbacks</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- Gerenciar Anúncios -->
                                <a href="{{ route('advertisements.index') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="chart-pie"
                                                class="h-6 w-6 text-purple-400 group-hover:text-indigo-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Gerenciar Anúncios</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- Gerenciar Materiais -->
                                <a href="{{ route('materials.index') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="recycle"
                                                class="h-6 w-6 text-blue-400 group-hover:text-cyan-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Gerenciar Materiais</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- Gerenciar Pontos de Coleta -->
                                <a href="{{ route('collect-points.index') }}">
                                    <div
                                        class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                        <div
                                            class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                            <i data-lucide="map"
                                                class="h-6 w-6 text-indigo-400 group-hover:text-violet-400 transition-colors duration-200"></i>
                                            <span class="font-QuicksandMedium">Gerenciar Pontos</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Divider -->
                <div class="border-t border-lime-400 mx-2 mt-4 mb-4"></div>
            @endauth


            <!-- BASE: Meu Perfil + Logout -->
            <div class="flex flex-col gap-y-2 items-stretch">

                @auth
                    <!-- Meu Perfil -->
                    <div class="flex flex-col">

                        <!-- Botão do dropdown -->
                        <div
                            class="dropdown-toggle w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300 cursor-pointer">
                            <div
                                class="w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300">
                                <div
                                    class="w-1 rounded-xl h-10 bg-transparent transition-colors duration-200 relative overflow-hidden">
                                    <div
                                        class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-lime-400 transition-all duration-300">
                                    </div>
                                </div>
                                <div
                                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-200 sidebar-button cursor-pointer border border-transparent">
                                    <i data-lucide="user-round"
                                        class="h-7 w-7 text-sky-400 transition-colors duration-200"></i>
                                    <span class="font-QuicksandMedium">Meu Perfil</span>
                                    <svg class="h-4 w-4 dropdown-icon transform transition-transform duration-300 fill-gray-400 group-hover:fill-lime-400"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M9 6l6 6-6 6" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Itens do dropdown -->
                        <div
                            class="dropdown-content ml-6 space-y-2 max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out dropdown-transition">

                            <!-- Dashboard -->
                            <a href="{{ route('dashboard') }}">
                                <div
                                    class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                    <div
                                        class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                        <i data-lucide="id-card"
                                            class="h-6 w-6 text-sky-300 group-hover:text-cyan-300 transition-colors duration-200"></i>
                                        <span class="font-QuicksandMedium">Dashboard</span>
                                    </div>
                                </div>
                            </a>

                            <!-- Configurações -->
                            <a href="{{ route('profile.show') }}">
                                <div
                                    class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                    <div
                                        class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                        <i data-lucide="settings"
                                            class="h-6 w-6 text-gray-400 group-hover:text-gray-300 transition-colors duration-200"></i>
                                        <span class="font-QuicksandMedium">Configurações</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endauth

                <!-- Suporte -->
                <div class="flex flex-col">

                    <!-- Botão do dropdown -->
                    <div
                        class="dropdown-toggle w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300 cursor-pointer">
                        <div
                            class="w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300">
                            <div
                                class="w-1 rounded-xl h-10 bg-transparent transition-colors duration-200 relative overflow-hidden">
                                <div
                                    class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-lime-400 transition-all duration-300">
                                </div>
                            </div>
                            <div
                                class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-200 sidebar-button cursor-pointer border border-transparent">
                                <i data-lucide="phone"
                                    class="h-7 w-7 text-rose-400 transition-colors duration-200"></i>
                                <span class="font-QuicksandMedium">Suporte</span>
                                <svg class="h-4 w-4 dropdown-icon transform transition-transform duration-300 fill-gray-400 group-hover:fill-lime-400"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M9 6l6 6-6 6" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Itens do dropdown -->
                    <div
                        class="dropdown-content ml-6 space-y-2 max-h-0 overflow-hidden transition-[max-height] duration-500 ease-in-out dropdown-transition">

                        <!-- Central de Ajuda -->
                        <a href="{{ route('support.help-center') }}">
                            <div
                                class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                <div
                                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                    <i data-lucide="mail"
                                        class="h-6 w-6 text-rose-300 group-hover:text-pink-400 transition-colors duration-200"></i>
                                    <span class="font-QuicksandMedium">Central de Ajuda</span>
                                </div>
                            </div>
                        </a>

                        <!-- FAQ -->
                        <a href="{{ route('support.faq') }}">
                            <div
                                class="w-full flex items-center gap-x-2 mt-1 mb-1 group select-none sidebar-item transition-all duration-300 rounded-xl h-10 bg-transparent relative overflow-hidden">
                                <div
                                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-300 sidebar-button cursor-pointer border border-transparent">
                                    <i data-lucide="circle-question-mark"
                                        class="h-6 w-6 text-purple-300 group-hover:text-violet-400 transition-colors duration-200"></i>
                                    <span class="font-QuicksandMedium">FAQ</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                @auth
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-x-2 group select-none sidebar-item transition-all duration-300 pb-4">
                            <div
                                class="w-1 rounded-xl h-10 bg-transparent transition-colors duration-200 relative overflow-hidden">
                                <div
                                    class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-red-500 transition-all duration-300">
                                </div>
                            </div>
                            <div
                                class="group-hover:bg-red-500/20 w-full group-active:scale-95 self-stretch pl-3 rounded-lg flex items-center space-x-3 transition-all duration-200 sidebar-button cursor-pointer border border-transparent">
                                <i data-lucide="log-out" class="h-7 w-7 text-red-400 transition-colors duration-200"></i>
                                <span class="font-QuicksandMedium">Logout</span>
                            </div>
                        </button>
                    </form>
                @endauth
            </div>
        </nav>
    </aside>

    <!-- Conteúdo principal -->
    <main id="mainContent" class="pt-[65px] transition-all duration-300 ease-in-out">
        <!-- Flash Notifications -->
        @include('components.flash-notification')
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="globalFooter"
        class="bg-gradient-to-r from-slate-900 via-emerald-900 to-slate-900 text-white py-12 transition-all duration-300 ease-in-out">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <div>
                    <img src="{{ asset('img/logo_txt_perseph.png') }}" class="h-12 sm:h-18 w-auto" alt="logo">
                    <p class="max-w-xs mt-4 text-sm text-gray-600">
                        Transformando a educação ambiental através da gamificação e incentivos sustentáveis.
                    </p>
                    <div class="flex mt-8 space-x-6 text-gray-600">
                        <a class="hover:opacity-75 hover:text-pink-600 transition-all duration-200"
                            href="https://www.instagram.com/luizmelozi" target="_blank" rel="noreferrer">
                            <span class="sr-only"> Instagram </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fillRule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clipRule="evenodd" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75 hover:text-lime-400 transition-all duration-200" href="https://wa.me/5517996165877"
                            target="_blank" rel="noreferrer">
                            <span class="sr-only"> Whatsapp </span>
                            <svg class="w-6 h-6" fill="currentColor" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75 hover:text-slate-950 transition-all duration-200"
                            href="https://github.com/lzzsm" target="_blank" rel="noreferrer">
                            <span class="sr-only"> GitHub </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fillRule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clipRule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-8 lg:col-span-2 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <p class="font-medium">
                            Sistemas
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-sm text-gray-500">
                            <a class="hover:opacity-75" href="{{ route('company.info.collects') }}"> Coletas </a>
                            <a class="hover:opacity-75" href="{{ route('company.info.scoring') }}"> Pontuação </a>
                            <a class="hover:opacity-75" href="{{ route('company.info.partnerships') }}"> Parcerias
                            </a>
                            <a class="hover:opacity-75" href="{{ route('company.info.rewards') }}"> Recompensas </a>
                            <a class="hover:opacity-75" href="{{ route('company.info.advertisements') }}"> Anúncios
                            </a>
                        </nav>
                    </div>
                    <div>
                        <p class="font-medium">
                            Institucional
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-sm text-gray-500">
                            <a class="hover:opacity-75" href="{{ route('company.about') }}"> Quem Somos </a>
                            <a class="hover:opacity-75" href="{{ route('company.mission') }}"> Nossa Missão </a>
                            <a class="hover:opacity-75" href="{{ route('company.impact') }}"> Impacto Ambiental </a>
                        </nav>
                    </div>
                    <div>
                        <p class="font-medium">
                            Suporte
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-sm text-gray-500">
                            <a class="hover:opacity-75" href="{{ route('support.help-center') }}"> Central de Ajuda
                            </a>
                            <a class="hover:opacity-75" href="{{ route('support.faq') }}"> FAQ </a>
                            <a class="hover:opacity-75" href="{{ route('legal.terms') }}"> Termos de Uso </a>
                            <a class="hover:opacity-75" href="{{ route('legal.privacy-policy') }}"> Política de
                                Privacidade </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="border-t border-teal-600 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; 2025 Perseph. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
</body>

</html>
