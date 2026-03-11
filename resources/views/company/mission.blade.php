@extends('layouts.guest')

@section('title', 'Nossa Missão - Perseph')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho da Página -->
            <div class="relative text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight mb-4">
                    Nossa <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-emerald-400">Missão</span>
                    Transformadora
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Conheça o propósito que impulsiona cada linha de código e cada ação da Perseph na construção de um
                    futuro mais sustentável.
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

            <!-- Seção 1: Pilares da Nossa Missão -->
            <div class="max-w-6xl mx-auto mb-20">
                <h2 class="text-3xl font-bold text-white mb-12 text-center">
                    Os Quatro Pilares da Nossa Missão
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <!-- Consciência Ambiental -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="brain" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Consciência Ambiental</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Ampliar escolhas sustentáveis no cotidiano através de educação ambiental e dados transparentes
                            sobre impacto.
                        </p>
                    </div>

                    <!-- Engajamento Gamificado -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="gamepad-2" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Engajamento Gamificado</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Transformar a reciclagem em experiência divertida e recompensadora através de mecânicas de jogo.
                        </p>
                    </div>

                    <!-- Valorização Social -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="users" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Valorização Social</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Unir comunidades em torno de objetivos comuns, reconhecendo cada contribuição individual.
                        </p>
                    </div>

                    <!-- Inovação Tecnológica -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="cpu" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Inovação Tecnológica</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Utilizar tecnologia de ponta para resolver desafios urbanos na gestão de resíduos sólidos.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Seção 2: Conteúdo Expandido da Missão -->
            <div class="max-w-4xl mx-auto mb-20">
                <div class="bg-gradient-to-br from-slate-800/50 to-gray-900/50 p-8 rounded-2xl border border-gray-700/50">
                    <h2 class="text-3xl font-bold text-white mb-8 text-center flex items-center justify-center">
                        <i data-lucide="sparkles" class="w-8 h-8 text-lime-400 mr-3"></i>
                        Por Que Existimos?
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
                            A <strong>Perseph</strong> nasceu da necessidade urgente de transformar a forma como a sociedade
                            lida com os resíduos, indo além da simples coleta seletiva para criar um <strong>ecossistema
                                sustentável e engajador</strong>.
                        </p>

                        <h3>Nossa Proposta de Valor</h3>
                        <p>
                            Tornar a reciclagem <strong>acessível, recompensadora e socialmente valorizada</strong> para
                            todos.
                            Acreditamos que quando as pessoas veem o impacto direto de suas ações e são reconhecidas por
                            isso,
                            o comportamento sustentável se torna um hábito natural.
                        </p>

                        <h3>O Problema que Resolvemos</h3>
                        <p>
                            Diariamente, toneladas de materiais recicláveis são desperdiçados em aterros sanitários,
                            enquanto
                            comunidades carecem de incentivos concretos para participar ativamente da economia circular.
                            A Perseph conecta esses dois mundos através de:
                        </p>

                        <ul>
                            <li><strong>Gamificação inteligente</strong> que transforma tarefas em conquistas</li>
                            <li><strong>Transparência total</strong> no rastreamento do impacto ambiental</li>
                            <li><strong>Recompensas tangíveis</strong> por contribuições sustentáveis</li>
                            <li><strong>Comunidade engajada</strong> que compartilha conhecimento e motivação</li>
                        </ul>

                        <h3>Nossa Abordagem Única</h3>
                        <p>
                            Combinamos tecnologia moderna com princípios de psicologia comportamental para criar uma
                            plataforma que não apenas facilita a reciclagem, mas também inspira mudanças duradouras
                            nos hábitos das pessoas.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Seção 3: Metas e Objetivos -->
            <div class="max-w-4xl mx-auto">
                <div
                    class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 rounded-2xl p-8 border border-emerald-700/30">
                    <h2 class="text-3xl font-bold text-white mb-10 text-center">
                        Nossos Objetivos Estratégicos
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="text-center">
                            <i data-lucide="arrow-up-circle" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Expansão do Alcance</h3>
                            <p class="text-gray-300 text-sm">
                                Levar a plataforma Perseph para mais comunidades, aumentando o acesso à reciclagem
                                recompensadora em todo o país.
                            </p>
                        </div>
                        <div class="text-center">
                            <i data-lucide="bar-chart-3" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Mensuração de Impacto</h3>
                            <p class="text-gray-300 text-sm">
                                Desenvolver sistemas precisos para quantificar e comunicar o impacto ambiental gerado por
                                cada usuário.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
