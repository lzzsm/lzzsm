@extends('layouts.guest')

@section('title', 'Anúncios - Perseph')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho da Página -->
            <div class="relative text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight mb-4">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-emerald-400">Anúncios</span>
                    & Parcerias
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Conectando empresas sustentáveis com nossa comunidade através de comunicação relevante e valor
                    compartilhado
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

            <!-- Seção 1: Tipos de Anúncios -->
            <div class="max-w-6xl mx-auto mb-20">
                <h2 class="text-3xl font-bold text-white mb-12 text-center">
                    Tipos de Anúncios na Plataforma
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- Parceria -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="handshake" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Parcerias</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Divulgação de marcas e benefícios exclusivos de empresas comprometidas com a sustentabilidade
                        </p>
                    </div>

                    <!-- Eventos -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="calendar" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Eventos</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Feiras, palestras, oficinas e atividades educativas ligadas ao meio ambiente e sustentabilidade
                        </p>
                    </div>

                    <!-- Comunicados -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="bell" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Comunicados</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Avisos importantes e atualizações relevantes para todos os usuários da plataforma
                        </p>
                    </div>

                    <!-- Promoções -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="tag" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Promoções</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Ofertas especiais e descontos exclusivos para usuários cadastrados na plataforma
                        </p>
                    </div>

                    <!-- Informativos -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="book-open" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Informativos</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Conteúdos educativos, dicas práticas e informações sobre sustentabilidade
                        </p>
                    </div>

                    <!-- Campanhas -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="target" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Campanhas</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Iniciativas especiais com objetivos ambientais específicos e impacto mensurável
                        </p>
                    </div>
                </div>
            </div>

            <!-- Seção 2: Conteúdo Expandido -->
            <div class="max-w-4xl mx-auto mb-20">
                <div class="bg-gradient-to-br from-slate-800/50 to-gray-900/50 p-8 rounded-2xl border border-gray-700/50">
                    <h2 class="text-3xl font-bold text-white mb-8 text-center flex items-center justify-center">
                        <i data-lucide="message-circle" class="w-8 h-8 text-lime-400 mr-3"></i>
                        Comunicação com Propósito
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
                            No <strong>Perseph</strong>, os anúncios representam muito mais que simples propaganda.
                            São uma ponte entre empresas comprometidas com a sustentabilidade e uma comunidade engajada
                            em fazer a diferença.
                        </p>

                        <h3>Nossa Abordagem de Comunicação</h3>
                        <p>
                            Desenvolvemos um modelo de anúncios que prioriza a <strong>relevância e o valor
                                compartilhado</strong>.
                            Cada comunicação na plataforma é cuidadosamente selecionada para garantir que traga benefícios
                            reais para nossa comunidade e esteja alinhada com nossos valores de sustentabilidade.
                        </p>

                        <h3>Onde Nossos Anúncios Aparecem</h3>
                        <p>
                            Para garantir uma experiência equilibrada e não intrusiva, os anúncios são distribuídos
                            estrategicamente em locais específicos da plataforma:
                        </p>

                        <ul>
                            <li><strong>Página Inicial</strong> - Destaques relevantes e campanhas em andamento</li>
                            <li><strong>Catálogo de Recompensas</strong> - Ofertas especiais de parceiros</li>
                            <li><strong>Painel do Usuário</strong> - Comunicados personalizados e avisos importantes</li>
                            <li><strong>Seção de Notícias</strong> - Conteúdos educativos e informativos</li>
                            <li><strong>App Mobile</strong> - Notificações push para alertas urgentes</li>
                        </ul>

                        <h3>Critérios para Parcerias</h3>
                        <p>
                            Todas as empresas parceiras passam por uma análise criteriosa para garantir que compartilham
                            nosso compromisso com a sustentabilidade. Avaliamos:
                        </p>

                        <ul>
                            <li>Práticas ambientais da empresa</li>
                            <li>Transparência nas operações</li>
                            <li>Compromisso com a economia circular</li>
                            <li>Valor oferecido à comunidade Perseph</li>
                            <li>Alinhamento com nossos valores fundamentais</li>
                        </ul>

                        <h3>Benefícios para a Comunidade</h3>
                        <p>
                            Através desse modelo, criamos um ecossistema onde todos ganham: as empresas alcançam um
                            público engajado, os usuários recebem benefícios exclusivos, e juntos fortalecemos a
                            economia circular e as práticas sustentáveis.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Seção 3: Seja um Parceiro -->
            <div class="max-w-4xl mx-auto">
                <div
                    class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 rounded-2xl p-8 border border-emerald-700/30">
                    <h2 class="text-3xl font-bold text-white mb-10 text-center">
                        Interessado em Ser Nosso Parceiro?
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="text-center">
                            <i data-lucide="building" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Para Empresas</h3>
                            <p class="text-gray-300 text-sm">
                                Conecte sua marca com uma comunidade engajada em sustentabilidade e amplie seu impacto
                                positivo
                            </p>
                        </div>
                        <div class="text-center">
                            <i data-lucide="users" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Para a Comunidade</h3>
                            <p class="text-gray-300 text-sm">
                                Aproveite benefícios exclusivos e participe de campanhas especiais com nossas empresas
                                parceiras
                            </p>
                        </div>
                    </div>
                    <div class="text-center mt-8">
                        <button
                            class="bg-gradient-to-r from-lime-400 to-emerald-400 text-slate-900 font-bold px-8 py-3 rounded-lg flex items-center mx-auto">
                            <i data-lucide="mail" class="w-5 h-5 mr-2"></i> <a
                                href="mailto:l.melozi@aluno.ifsp.edu.br">Entrar em Contato</a>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
