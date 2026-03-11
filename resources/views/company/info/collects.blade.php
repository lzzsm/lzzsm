@extends('layouts.guest')

@section('title', 'Coletas - Perseph')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho da Página -->
            <div class="relative text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight mb-4">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-emerald-400">Coletas</span>
                    Inteligentes
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Transforme seus resíduos em pontos através de um processo simples, eficiente e recompensador
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

            <!-- Seção 1: Processo de Coleta -->
            <div class="max-w-6xl mx-auto mb-20">
                <h2 class="text-3xl font-bold text-white mb-12 text-center">
                    Processo de Coleta em 4 Passos
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                    <!-- Separação -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="package" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">1. Separar</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Separe os materiais recicláveis em casa ou no trabalho, garantindo que estejam limpos e secos
                        </p>
                    </div>

                    <!-- Localização -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="map" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">2. Localizar</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Use nosso mapa interativo para encontrar o ponto de coleta mais próximo da sua localização
                        </p>
                    </div>

                    <!-- Entrega -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="truck" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">3. Entregar</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Leve os materiais até o ponto de coleta e registre a entrega através do nosso sistema
                        </p>
                    </div>

                    <!-- Validação -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="shield-check" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">4. Validar</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Nossa equipe valida os materiais e o sistema gera automaticamente os pontos correspondentes
                        </p>
                    </div>
                </div>
            </div>

            <!-- Seção 2: Conteúdo Expandido -->
            <div class="max-w-4xl mx-auto mb-20">
                <div class="bg-gradient-to-br from-slate-800/50 to-gray-900/50 p-8 rounded-2xl border border-gray-700/50">
                    <h2 class="text-3xl font-bold text-white mb-8 text-center flex items-center justify-center">
                        <i data-lucide="bar-chart-3" class="w-8 h-8 text-lime-400 mr-3"></i>
                        Controle Total das Suas Coletas
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
                            As coletas são o <strong>coração do Perseph</strong> - é através delas que transformamos
                            resíduos em oportunidades e ações sustentáveis em recompensas tangíveis.
                        </p>

                        <h3>O Que Você Encontra na Página de Coletas</h3>
                        <p>
                            Nossa plataforma oferece um painel completo para gerenciar todas as suas entregas de
                            forma organizada e transparente:
                        </p>

                        <ul>
                            <li><strong>Histórico Completo de Entregas</strong> - Todas as suas coletas registradas ficam
                                armazenadas com data, horário e local</li>
                            <li><strong>Status de Validação em Tempo Real</strong> - Acompanhe cada coleta desde o registro
                                até a aprovação final</li>
                            <li><strong>Detalhes Detalhados dos Materiais</strong> - Peso exato, tipo específico e pontos
                                gerados por categoria</li>
                            <li><strong>Métricas de Impacto Ambiental</strong> - Veja quanto você contribuiu para reduzir a
                                pegada de carbono</li>
                            <li><strong>Relatórios Mensais</strong> - Análise do seu desempenho e comparação com meses
                                anteriores</li>
                            <li><strong>Pontuação Acumulada</strong> - Controle total dos pontos ganhos e disponíveis para
                                resgate</li>
                        </ul>

                        <h3>Tipos de Pontos de Coleta</h3>
                        <p>
                            Oferecemos diferentes opções para facilitar sua participação, independente da sua localização:
                        </p>

                        <ul>
                            <li><strong>Ecopontos Fixos</strong> - Locais permanentes com horários estendidos de
                                funcionamento</li>
                            <li><strong>Pontos Móveis</strong> - Coletas itinerantes em diferentes bairros e comunidades
                            </li>
                            <li><strong>Parcerias Comerciais</strong> - Estabelecimentos que aceitam materiais durante seu
                                horário comercial</li>
                            <li><strong>Eventos Especiais</strong> - Coletas durante feiras, festivais e atividades
                                comunitárias</li>
                        </ul>

                        <h3>Sistema de Validação e Pontuação</h3>
                        <p>
                            Garantimos transparência e justiça em todo o processo através de:
                        </p>

                        <ul>
                            <li><strong>Verificação por Especialistas</strong> - Nossa equipe qualificada analisa a
                                qualidade dos materiais</li>
                            <li><strong>Pesagem Digital</strong> - Sistemas precisos para cálculo exato dos pontos</li>
                            <li><strong>Classificação por Categoria</strong> - Diferentes materiais possuem valores
                                específicos baseados na complexidade de reciclagem</li>
                            <li><strong>Notificações em Tempo Real</strong> - Avisos instantâneos sobre a validação e
                                pontuação concedida</li>
                            <li><strong>Sistema de Recursos</strong> - Canal para esclarecer dúvidas sobre a pontuação
                                recebida</li>
                        </ul>

                        <h3>Dicas para Coletas Mais Eficientes</h3>
                        <p>
                            Maximize seus pontos e contribua ainda mais para o meio ambiente:
                        </p>

                        <ul>
                            <li>Materiais limpos e secos recebem validação mais rápida</li>
                            <li>Separe por categorias para facilitar o processamento</li>
                            <li>Verifique os horários de funcionamento dos pontos de coleta</li>
                            <li>Use embalagens reutilizáveis para transportar os materiais</li>
                            <li>Acompanhe as campanhas especiais para ganhar pontos extras</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Seção 3: Comece Agora -->
            <div class="max-w-4xl mx-auto">
                <div
                    class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 rounded-2xl p-8 border border-emerald-700/30">
                    <h2 class="text-3xl font-bold text-white mb-10 text-center">
                        Pronto para Começar a Coletar?
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="text-center">
                            <i data-lucide="map-pinned" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Encontre Pontos de Coleta</h3>
                            <p class="text-gray-300 text-sm">
                                Descubra os ecopontos mais próximos de você e comece a transformar resíduos em pontos
                            </p>
                        </div>
                        <div class="text-center">
                            <i data-lucide="calendar" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Agende Sua Primeira Coleta</h3>
                            <p class="text-gray-300 text-sm">
                                Planeje suas entregas e maximize seus pontos com nossa ferramenta de agendamento
                            </p>
                        </div>
                    </div>
                    <div class="text-center mt-8">
                        @auth
                            <button
                                class="bg-gradient-to-r from-lime-400 to-emerald-400 text-slate-900 font-bold px-8 py-3 rounded-lg flex items-center mx-auto hover:scale-105 transition-transform">
                                <i data-lucide="map" class="w-5 h-5 mr-2"></i>
                                <a href="{{ route('collect-points.dashboard') }}">Ver Pontos de Coleta</a>
                            </button>
                        @else
                            <button
                                class="bg-gradient-to-r from-lime-400 to-emerald-400 text-slate-900 font-bold px-8 py-3 rounded-lg flex items-center mx-auto hover:scale-105 transition-transform">
                                <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                                <a href="{{ route('register') }}">Cadastre-se para Coletar</a>
                            </button>
                            <p class="text-gray-400 text-sm mt-3">Já tem conta?
                                <a href="{{ route('login') }}"
                                    class="text-lime-400 hover:text-lime-300 transition-colors">Faça login</a>
                            </p>
                        @endauth
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
