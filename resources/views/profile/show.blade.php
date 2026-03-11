@extends('layouts.main')

@section('title', 'Configurações')

@section('content')
    <div class="bg-slate-900 text-gray-300 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <!-- Cabeçalho da Página -->
            <div class="relative text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">Configurações da Conta</h1>
                <p class="mt-3 text-lg text-gray-400">Gerencie suas informações pessoais e preferências.</p>

                <!-- Voltar à Dashboard -->
                <div class="absolute top-0 left-0">
                    <a href="{{ route('dashboard') }}">
                        <button type="button"
                            class="group flex items-center gap-2 px-4 py-2 bg-slate-800/50 border border-emerald-700/30 rounded-full hover:bg-emerald-800/50 hover:border-lime-400/50 transition-all duration-300 transform hover:-translate-y-1"
                            title="Voltar à Dashboard">
                            <i data-lucide="arrow-left"
                                class="w-5 h-5 text-lime-400 group-hover:scale-110 transition-transform"></i>
                            <span class="text-gray-300 font-medium group-hover:text-lime-300 transition-colors">
                                Dashboard
                            </span>
                        </button>
                    </a>
                </div>
            </div>

            <!-- Conteúdo Principal: Seções de Configuração -->
            <div class="max-w-4xl mx-auto space-y-8">

                <!-- Seção: Perfil -->
                <section
                    class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-xl p-6 sm:p-8 border border-emerald-700/30 hover:border-lime-500/50 transition-all duration-300">
                    <!-- Cabeçalho -->
                    <div class="text-center mb-6">
                        <h2 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                            <i data-lucide="user-cog" class="w-5 h-5 mr-2 text-lime-400"></i>
                            Informações do Perfil
                        </h2>
                        <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full"></div>
                        <p class="text-gray-400 text-sm mt-2">Atualize o nome, e-mail e foto do seu perfil.</p>
                    </div>
                    @livewire('profile.update-profile-information-form')
                </section>

                <!-- Seção: Excluir Conta -->
                <section
                    class="bg-gradient-to-br from-slate-900/50 to-red-900/50 rounded-xl p-6 sm:p-8 border border-red-700/30 hover:border-red-500/50 transition-all duration-300">
                    <!-- Cabeçalho -->
                    <div class="text-center mb-6">
                        <h2 class="font-semibold text-red-400 mb-2 flex items-center justify-center">
                            <i data-lucide="trash-2" class="w-5 h-5 mr-2 text-red-400"></i>
                            Excluir Conta
                        </h2>
                        <div class="w-16 h-1 bg-gradient-to-r from-red-400 to-red-600 mx-auto rounded-full"></div>
                        <p class="text-gray-300 text-sm mt-2">Exclua permanentemente sua conta e todos os seus dados.</p>
                    </div>
                    @livewire('profile.delete-user-form')
                </section>
            </div>
        </div>
    </div>
@endsection
