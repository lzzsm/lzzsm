@extends('layouts.guest')

@section('title', 'Quem Somos - Perseph')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho da Página -->
            <div class="relative text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight mb-4">
                    Perseph: Tecnologia e Sustentabilidade
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Conheça a história, a missão e a equipe por trás da plataforma que transforma o ato de reciclar em uma
                    jornada recompensadora.
                </p>

                <!-- Botão Voltar (Mantido e Estilizado) -->
                <div class="absolute top-0 left-0">
                    <button onclick="window.history.back()" title="Voltar"
                        class="group flex items-center justify-center w-12 h-12 bg-gradient-to-br from-slate-800/50 to-gray-900/50 border border-emerald-700/30 rounded-full hover:bg-emerald-800/50 hover:border-lime-400/30 transition-all duration-300">
                        <i data-lucide="arrow-left"
                            class="w-6 h-6 text-lime-400 group-hover:text-lime-300 transition-colors"></i>
                    </button>
                </div>
            </div>

            <!-- Seção 1: Missão, Visão e Valores (Cards de Destaque) -->
            <div class="max-w-6xl mx-auto mb-20">
                <h2 class="text-3xl font-bold text-white mb-10 text-center">
                    Nossos Pilares
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    <!-- Missão -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-8 rounded-2xl border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20">
                        <i data-lucide="target" class="w-8 h-8 text-lime-400 mb-3"></i>
                        <h3 class="text-2xl font-bold text-emerald-400 mb-3">Missão</h3>
                        <p class="text-gray-300">
                            Transformar o descarte de resíduos em uma experiência **gamificada e recompensadora**,
                            incentivando a participação ativa da comunidade na economia circular e na preservação ambiental.
                        </p>
                    </div>

                    <!-- Visão -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-8 rounded-2xl border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20">
                        <i data-lucide="eye" class="w-8 h-8 text-lime-400 mb-3"></i>
                        <h3 class="text-2xl font-bold text-emerald-400 mb-3">Visão</h3>
                        <p class="text-gray-300">
                            Ser a principal plataforma de incentivo à reciclagem no Brasil, reconhecida pela **inovação
                            tecnológica** e pelo **impacto social e ambiental** positivo gerado em larga escala.
                        </p>
                    </div>

                    <!-- Valores -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-8 rounded-2xl border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20">
                        <i data-lucide="heart-handshake" class="w-8 h-8 text-lime-400 mb-3"></i>
                        <h3 class="text-2xl font-bold text-emerald-400 mb-3">Valores</h3>
                        <p class="text-gray-300">
                            Sustentabilidade, Inovação, Transparência, Engajamento Comunitário e Reconhecimento do Esforço
                            Individual.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Seção 2: Nossa História (Conteúdo Expandido) -->
            <div class="max-w-4xl mx-auto mb-20">
                <div class="bg-gradient-to-br from-slate-800/50 to-gray-900/50 p-8 rounded-2xl border border-gray-700/50">
                    <h2 class="text-3xl font-bold text-white mb-6 text-center">
                        Nossa História: Da Academia ao Impacto
                    </h2>
                    <p class="text-lg text-gray-300 mb-4">
                        A Perseph nasceu como um projeto acadêmico no **IFSP – Campus Votuporanga**, impulsionada pela
                        paixão por tecnologia e pela urgência em encontrar soluções inovadoras para os desafios ambientais.
                        A ideia central era simples: se jogos conseguem engajar milhões de pessoas, por que não usar essa
                        mesma mecânica para incentivar a reciclagem?
                    </p>
                    <p class="text-lg text-gray-300 mb-4">
                        Desde o início, o foco foi criar uma plataforma que fosse mais do que um sistema de pontos.
                        Queríamos construir uma **comunidade** onde cada usuário pudesse ver o impacto real de suas ações,
                        transformando o descarte correto em um hábito divertido e recompensador. O nome "Perseph" (inspirado
                        em Perséfone, deusa grega da primavera e do renascimento) reflete nosso desejo de ver o renascimento
                        do nosso planeta através de práticas sustentáveis.
                    </p>
                    <p class="text-lg text-gray-300">
                        Hoje, a Perseph continua evoluindo, sempre buscando integrar as melhores práticas de gamificação e
                        as mais recentes tecnologias para maximizar a eficiência da coleta seletiva e a conscientização
                        ambiental.
                    </p>
                </div>
            </div>

            <!-- Seção 3: Equipe (Layout Visual) -->
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-white mb-10 text-center">
                    A Equipe Fundadora
                </h2>
                <div
                    class="text-center p-6 bg-slate-800/50 rounded-2xl border border-slate-700/50 hover:border-lime-400/30 transition duration-300">
                    <div class="w-24 h-24 bg-emerald-600/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="user" class="w-12 h-12 text-emerald-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white">Luiz Felipe Sanches Melozi</h3>
                    <p class="text-lime-300 font-semibold">Autor e Desenvolvedor</p>
                    <p class="text-gray-400 text-sm mt-2">Concepção, desenvolvimento e documentação completa do Perseph, realizado como trabalho de conclusão de curso.</p>
                </div>
                <div class="text-center mt-8">
                    <p class="text-lg font-semibold text-gray-300">Orientação:</p>
                    <p class="text-xl font-bold text-emerald-400">Prof.ª Mª. Juliana de Fátima Franciscani</p>
                </div>
            </div>
        </div>
    </div>
@endsection
