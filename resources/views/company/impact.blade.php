@extends('layouts.guest')

@section('title', 'Impacto Ambiental - Perseph')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho da Página -->
            <div class="relative text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight mb-4">
                    Impacto <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-emerald-400">Ambiental</span>
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Descubra como cada ação no Perseph contribui para um futuro mais sustentável e o impacto real que
                    estamos construindo juntos.
                </p>

                <!-- Botão Voltar -->
                <div class="absolute top-0 left-0">
                    <button onclick="window.history.back()" title="Voltar"
                        class="group flex items-center justify-center w-12 h-12 bg-gradient-to-br from-slate-800/50 to-gray-900/50 border border-emerald-700/30 rounded-full hover:bg-emerald-800/50 hover:border-lime-400/30 transition-all duration-300">
                        <i data-lucide="arrow-left"
                            class="w-6 h-6 text-lime-400 group-hover:text-lime-300 transition-colors"></i>
                    </button>
                </div>
            </div>

            <!-- Seção 1: Benefícios da Reciclagem -->
            <div class="max-w-6xl mx-auto mb-20">
                <h2 class="text-3xl font-bold text-white mb-12 text-center">
                    Benefícios Ambientais da Reciclagem
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <!-- Redução de Poluição -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="wind" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Redução da Poluição</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Evita a contaminação do solo, água e ar, reduzindo emissões de gases de efeito estufa e
                            substâncias tóxicas.
                        </p>
                    </div>

                    <!-- Preservação de Recursos -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="mountain" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Preservação de Recursos Naturais
                        </h3>
                        <p class="text-gray-300 text-sm text-center">
                            Diminui a extração de matérias-primas virgens, conservando florestas, minerais e recursos
                            hídricos.
                        </p>
                    </div>

                    <!-- Economia de Energia -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="zap" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Economia de Energia</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Processos de reciclagem consomem significativamente menos energia que a produção a partir de
                            matérias-primas virgens.
                        </p>
                    </div>

                    <!-- Cidades Sustentáveis -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="building" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Cidades Mais Sustentáveis</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Promove o desenvolvimento urbano sustentável e melhora a qualidade de vida nas comunidades.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Seção 2: Conteúdo Expandido -->
            <div class="max-w-4xl mx-auto mb-20">
                <div class="bg-gradient-to-br from-slate-800/50 to-gray-900/50 p-8 rounded-2xl border border-gray-700/50">
                    <h2 class="text-3xl font-bold text-white mb-8 text-center flex items-center justify-center">
                        <i data-lucide="globe" class="w-8 h-8 text-lime-400 mr-3"></i>
                        O Impacto Coletivo das Nossas Ações
                    </h2>

                    <div
                        class="prose prose-invert prose-lg max-w-none 
                        text-gray-300 
                        prose-headings:text-white prose-headings:font-bold
                        prose-h3:text-xl prose-h3:text-lime-300 prose-h3:font-semibold prose-h3:mt-8
                        prose-strong:text-gray-100
                        prose-a:text-emerald-400 prose-a:no-underline hover:prose-a:underline
                        prose-ul:list-disc prose-ul:pl-6
                        prose-li:marker:text-emerald-500">

                        <p class="text-lg text-gray-200 border-l-4 border-emerald-500 pl-4 mb-6">
                            Cada material reciclado corretamente através da plataforma <strong>Perseph</strong> representa
                            um passo concreto em direção a um <strong>futuro mais limpo e equilibrado</strong>.
                        </p>

                        <h3>Como Funciona o Impacto Ambiental</h3>
                        <p>
                            Quando você recicla através do Perseph, está contribuindo para uma cadeia de valor sustentável
                            que vai muito além do simples descarte adequado. Suas ações geram benefícios ambientais
                            mensuráveis e de longo prazo.
                        </p>

                        <h3>Benefícios Específicos da Reciclagem</h3>
                        <ul>
                            <li><strong>Redução de aterros sanitários</strong> - Diminui a necessidade de novos espaços para
                                descarte</li>
                            <li><strong>Preservação da biodiversidade</strong> - Menos extração significa menos impacto em
                                habitats naturais</li>
                            <li><strong>Economia circular</strong> - Materiais são reinseridos no ciclo produtivo</li>
                            <li><strong>Educação ambiental</strong> - Cada ação conscientiza e inspira outras pessoas</li>
                            <li><strong>Inovação tecnológica</strong> - Impulsiona o desenvolvimento de soluções
                                sustentáveis</li>
                        </ul>

                        <h3>O Papel do Perseph Nesta Transformação</h3>
                        <p>
                            A plataforma foi desenvolvida para tornar visível o impacto individual e coletivo. Através
                            de gamificação e recompensas, transformamos a reciclagem em uma experiência positiva que
                            incentiva a continuidade das práticas sustentáveis.
                        </p>

                        <p>
                            Com o Perseph, cada ação conta. Ao participar ativamente, você não apenas recebe recompensas
                            imediatas, mas também contribui para a construção de um <strong>legado ambiental
                                positivo</strong>
                            para as futuras gerações.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Seção 3: Compromisso com o Futuro -->
            <div class="max-w-4xl mx-auto">
                <div
                    class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 rounded-2xl p-8 border border-emerald-700/30">
                    <h2 class="text-3xl font-bold text-white mb-10 text-center">
                        Nosso Compromisso com o Futuro
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="text-center">
                            <i data-lucide="target" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Visão de Longo Prazo</h3>
                            <p class="text-gray-300 text-sm">
                                Desenvolver soluções escaláveis que possam ser implementadas em diversas comunidades,
                                ampliando o impacto positivo da reciclagem.
                            </p>
                        </div>
                        <div class="text-center">
                            <i data-lucide="heart" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Responsabilidade Ambiental</h3>
                            <p class="text-gray-300 text-sm">
                                Garantir que cada funcionalidade da plataforma contribua genuinamente para a preservação
                                ambiental e conscientização dos usuários.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
