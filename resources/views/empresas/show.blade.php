@extends('layouts.main')

@section('title', $empresa->user->name)

@section('content')
    <div class="bg-slate-900 min-h-screen py-12 sm:py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <div class="relative max-w-4xl mx-auto">

                <!-- Botão Voltar -->
                <div class="flex justify-between items-center mb-8">
                    <button onclick="window.history.back()"
                        class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-lime-300 transition-colors group">
                        <i data-lucide="arrow-left"
                            class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:-translate-x-1"></i>
                        Voltar
                    </button>
                </div>

                <!-- Banner da Empresa -->
                <div class="h-48 sm:h-64 rounded-t-2xl bg-gradient-to-tr from-emerald-800 via-teal-800 to-green-800">
                    @if ($empresa->imagem_capa)
                        <img src="{{ asset('storage/' . $empresa->imagem_capa) }}" alt="Banner de {{ $empresa->user->name }}"
                            class="w-full h-full object-cover rounded-t-2xl">
                    @endif
                </div>

                <!-- Card de Conteúdo -->
                <div class="relative bg-gray-800/80 backdrop-blur-sm border border-gray-700/50 rounded-b-2xl shadow-2xl">

                    <!-- Logo e Nome -->
                    <div
                        class="px-6 md:px-8 -mt-16 sm:-mt-20 flex flex-col sm:flex-row items-center sm:items-end space-y-4 sm:space-y-0 sm:space-x-5">
                        <div class="flex-shrink-0">
                            @if ($empresa->user->profile_photo_path)
                                <img class="h-24 w-24 sm:h-32 sm:w-32 rounded-full object-cover ring-4 ring-slate-800"
                                    src="{{ asset('storage/' . $empresa->user->profile_photo_path) }}"
                                    alt="Logo de {{ $empresa->user->name }}">
                            @else
                                <div
                                    class="h-24 w-24 sm:h-32 sm:w-32 rounded-full bg-emerald-700 flex items-center justify-center ring-4 ring-slate-800">
                                    <span
                                        class="text-5xl font-bold text-white">{{ strtoupper(substr($empresa->user->name, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 text-center sm:text-left pb-2">
                            <h1 class="text-2xl sm:text-3xl font-bold text-white">{{ $empresa->user->name }}</h1>
                            <p class="text-sm text-gray-400">Parceiro Oficial desde
                                {{ $empresa->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>

                    <!-- Conteúdo Principal -->
                    <div class="p-6 md:p-8 border-t border-gray-700/50 mt-6">

                        <!-- Sobre -->
                        <div class="mb-10">
                            <h2 class="text-xl font-semibold text-lime-300 mb-3">Sobre a Empresa</h2>
                            <div class="prose prose-invert max-w-none text-gray-300">
                                <p>{{ $empresa->descricao ?? 'Nenhuma descrição fornecida.' }}</p>
                            </div>
                        </div>

                        <!-- Contato -->
                        <div>
                            <h2 class="text-xl font-semibold text-lime-300 mb-4">Informações de Contato</h2>
                            <div class="space-y-4">

                                {{-- Email --}}
                                <div class="flex items-center text-gray-300">
                                    <i data-lucide="mail" class="h-5 w-5 mr-3 text-gray-500"></i>
                                    <a href="mailto:{{ $empresa->user->email }}"
                                        class="hover:text-lime-300 transition-colors">{{ $empresa->user->email }}</a>
                                </div>

                                {{-- Telefone --}}
                                @if ($empresa->telefone_comercial)
                                    <div class="flex items-center text-gray-300">
                                        <i data-lucide="phone" class="h-5 w-5 mr-3 text-gray-500"></i>
                                        <span class="font-mono">{{ $empresa->telefone_comercial_formatado }}</span>
                                    </div>
                                @endif

                                {{-- Website --}}
                                @if ($empresa->site)
                                    <div class="flex items-center text-gray-300">
                                        <i data-lucide="globe" class="h-5 w-5 mr-3 text-gray-500"></i>
                                        <a href="{{ $empresa->site }}" target="_blank" rel="noopener noreferrer"
                                            class="text-lime-400 hover:text-lime-300 transition-colors">{{ $empresa->site }}</a>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
