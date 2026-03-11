@extends('layouts.guest')

@section('title', 'Sistema de Pontuação - Perseph')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho da Página -->
            <div class="relative text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight mb-4">
                    Sistema de <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-emerald-400">Pontuação</span>
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Transforme seu esforço em benefícios reais enquanto contribui para um planeta mais sustentável
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

            <!-- Seção 1: Como Ganhar Pontos -->
            <div class="max-w-6xl mx-auto mb-20">
                <h2 class="text-3xl font-bold text-white mb-12 text-center">
                    Como Ganhar Pontos
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Materiais Recicláveis -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="recycle" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Materiais Recicláveis</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Cada tipo de material possui uma pontuação específica por quilo, baseada na complexidade de
                            reciclagem e valor ambiental
                        </p>
                    </div>

                    <!-- Validação e Qualidade -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="shield-check" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Validação e Qualidade</h3>
                        <p class="text-gray-300 text-sm text-center">
                            A pontuação é validada após cada coleta, garantindo a qualidade dos materiais e a precisão do
                            sistema
                        </p>
                    </div>

                    <!-- Bônus e Desafios -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="star" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Bônus e Desafios</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Participe de metas semanais e mensais para ganhar pontos extras e recompensas especiais
                        </p>
                    </div>
                </div>
            </div>

            <!-- Seção 2: Conteúdo Expandido -->
            <div class="max-w-4xl mx-auto mb-20">
                <div class="bg-gradient-to-br from-slate-800/50 to-gray-900/50 p-8 rounded-2xl border border-gray-700/50">
                    <h2 class="text-3xl font-bold text-white mb-8 text-center flex items-center justify-center">
                        <i data-lucide="calculator" class="w-8 h-8 text-lime-400 mr-3"></i>
                        Detalhes do Sistema de Pontuação
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
                            O sistema de pontuação do <strong>Perseph</strong> foi desenvolvido para reconhecer e
                            recompensar
                            cada contribuição ambiental, transformando ações sustentáveis em benefícios tangíveis.
                        </p>

                        <h3>Como a Pontuação é Calculada</h3>
                        <p>
                            Nossa metodologia considera diversos fatores para garantir que cada material receba a
                            pontuação adequada ao seu impacto ambiental e complexidade de reciclagem:
                        </p>

                        <ul>
                            <li><strong>Peso dos materiais</strong> - A quantidade em quilos determina a base da pontuação
                            </li>
                            <li><strong>Tipo de material</strong> - Diferentes materiais possuem valores distintos baseados
                                em critérios ambientais</li>
                            <li><strong>Qualidade da separação</strong> - Materiais bem separados e limpos recebem validação
                                mais rápida</li>
                            <li><strong>Frequência de participação</strong> - Usuários consistentes recebem reconhecimento
                                adicional</li>
                        </ul>

                        <h3>Sistema de Ranking Comunitário</h3>
                        <p>
                            Além da pontuação individual, o Perseph mantém um <strong>ranking geral</strong> que permite
                            comparar seu desempenho com outros membros da comunidade. Esta funcionalidade promove:
                        </p>

                        <ul>
                            <li><strong>Competitividade saudável</strong> - Incentiva a participação contínua</li>
                            <li><strong>Reconhecimento social</strong> - Destaque para os usuários mais engajados</li>
                            <li><strong>Troca de experiências</strong> - A comunidade aprende com as melhores práticas</li>
                            <li><strong>Meta coletiva</strong> - Todos contribuem para objetivos ambientais comuns</li>
                        </ul>

                        <h3>Validação e Transparência</h3>
                        <p>
                            Todo o processo de pontuação é transparente e auditável. Após cada entrega, os materiais
                            são pesados e classificados, com a pontuação sendo automaticamente somada ao perfil do usuário.
                            Qualquer questionamento pode ser resolvido através do nosso suporte.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Seção 3: Comece Agora -->
            <div class="max-w-4xl mx-auto">
                <div
                    class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 rounded-2xl p-8 border border-emerald-700/30">
                    <h2 class="text-3xl font-bold text-white mb-10 text-center">
                        Pronto para Começar?
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="text-center">
                            <i data-lucide="user-plus" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Cadastre-se</h3>
                            <p class="text-gray-300 text-sm">
                                Crie sua conta na plataforma e comece sua jornada sustentável com recompensas
                            </p>
                        </div>
                        <div class="text-center">
                            <i data-lucide="map-pinned" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Encontre Pontos de Coleta</h3>
                            <p class="text-gray-300 text-sm">
                                Localize os ecopontos mais próximos e comece a acumular pontos hoje mesmo
                            </p>
                        </div>
                    </div>
                    <div class="text-center mt-8">
                        <button
                            class="bg-gradient-to-r from-lime-400 to-emerald-400 text-slate-900 font-bold px-8 py-3 rounded-lg flex items-center mx-auto">
                            <i data-lucide="rocket" class="w-5 h-5 mr-2"></i> <a href="{{ route('register') }}">Começar
                                Agora</a>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
