@extends('layouts.guest')

@section('title', 'Perguntas Frequentes (FAQ) - Perseph')

@section('content')
    <div class="bg-slate-900 text-gray-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <!-- Cabeçalho da Página -->
            <div class="relative text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">Perguntas Frequentes</h1>
                <p class="mt-3 text-lg text-gray-400">Encontre respostas rápidas para as dúvidas mais comuns sobre
                    sustentabilidade e reciclagem.</p>

                <!-- Botão Voltar -->
                <div class="absolute top-0 left-0">
                    <button onclick="window.history.back()" title="Voltar"
                        class="group flex items-center justify-center w-12 h-12 bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-full hover:bg-emerald-800/50 hover:border-lime-400/30 transition-all duration-300">
                        <i data-lucide="arrow-left"
                            class="w-6 h-6 text-lime-400 group-hover:text-lime-300 transition-colors"></i>
                    </button>
                </div>
            </div>

            <!-- Barra de Busca -->
            <div class="max-w-2xl mx-auto mb-12">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i data-lucide="search" class="h-5 w-5 text-lime-400"></i>
                    </div>
                    <input type="text" id="searchInput"
                        class="w-full bg-gradient-to-br from-slate-800 to-emerald-900 border border-emerald-700/30 text-white placeholder-gray-400 focus:ring-2 focus:ring-lime-500 focus:border-lime-500 block pl-12 pr-4 py-3 sm:text-sm rounded-full transition-all duration-300"
                        placeholder="Pesquisar por uma dúvida...">
                </div>
            </div>

            <!-- Container do FAQ -->
            <div class="max-w-4xl mx-auto space-y-4" id="faqContainer">

                <!-- Item 1 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="perseph plataforma reciclagem gamificação pontos sustentabilidade educação ambiental">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="help-circle" class="w-5 h-5 text-lime-400 mr-3"></i>
                            O que é o Perseph?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">O Perseph é uma plataforma inovadora que combina <strong
                                    class="text-lime-300">educação ambiental</strong> com <strong
                                    class="text-lime-300">gamificação</strong> para promover a reciclagem. Através de um
                                sistema de recompensas, incentivamos usuários a adotarem hábitos sustentáveis enquanto
                                aprendem sobre preservação ambiental e contribuem para um planeta mais verde.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="dados coleta usuários questionários entrevistas voluntária privacidade segurança">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="shield" class="w-5 h-5 text-lime-400 mr-3"></i>
                            Como os dados dos usuários são coletados?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">Os dados são coletados de forma <strong
                                    class="text-lime-300">voluntária e transparente</strong>, através de questionários e
                                entrevistas presenciais com moradores de Votuporanga e região. Nenhuma informação pessoal
                                sensível é registrada sem consentimento explícito, conforme nossa <a href="#"
                                    class="text-emerald-400 hover:text-lime-300 transition-colors">Política de
                                    Privacidade</a>.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="desenvolvimento tecnologias html css javascript php mysql laravel tailwind código">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="code" class="w-5 h-5 text-lime-400 mr-3"></i>
                            Como a plataforma é desenvolvida?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">O Perseph utiliza <strong class="text-lime-300">tecnologias
                                    modernas</strong> como Laravel, Tailwind CSS, MySQL e Livewire, seguindo metodologias
                                ágeis para garantir uma experiência rápida, segura e responsiva para todos os usuários.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="descontos brindes benefícios recompensas ganhar prêmios parceiros">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="gift" class="w-5 h-5 text-lime-400 mr-3"></i>
                            Que tipo de recompensas posso ganhar?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">Oferecemos diversas recompensas incluindo <strong
                                    class="text-lime-300">descontos exclusivos</strong>, <strong
                                    class="text-lime-300">brindes sustentáveis</strong> e <strong
                                    class="text-lime-300">benefícios especiais</strong> oferecidos por empresas parceiras
                                comprometidas com a causa ambiental.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="descartar lixo reciclável descartes pontos coleta mapa agendamento">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="map-pin" class="w-5 h-5 text-lime-400 mr-3"></i>
                            Como posso saber onde descartar meu lixo reciclável?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">Utilize nosso <strong class="text-lime-300">mapa interativo</strong>
                                que mostra todos os pontos de coleta parceiros. Você pode visualizar locais próximos,
                                horários de funcionamento e até <strong class="text-lime-300">agendar descartes</strong> de
                                forma prática e organizada.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 6 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="participação anônima informação identificável privacidade anonimato">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="user-x" class="w-5 h-5 text-lime-400 mr-3"></i>
                            A participação é anônima?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">Sim. Garantimos o <strong class="text-lime-300">anonimato
                                    completo</strong> dos participantes. Nenhuma informação pessoal identificável é coletada
                                ou utilizada sem sua autorização explícita.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 7 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="melhorias suporte entrevistas sugestões sugerir testes feedback">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="message-square" class="w-5 h-5 text-lime-400 mr-3"></i>
                            Como posso sugerir melhorias?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">Durante a fase de testes, sugestões podem ser feitas nas entrevistas
                                presenciais. Futuramente, teremos uma <strong class="text-lime-300">área de suporte
                                    dedicada</strong> para receber feedback e implementar melhorias contínuas na plataforma.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Item 8 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="brasil disponível implementado região votuporanga expansão">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="globe" class="w-5 h-5 text-lime-400 mr-3"></i>
                            O Perseph estará disponível para todo o Brasil?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">Inicialmente, o projeto será implementado em <strong
                                    class="text-lime-300">Votuporanga e região</strong>. Com o sucesso da iniciativa,
                                planejamos expandir para outras cidades e estados, sempre focando no impacto positivo para o
                                meio ambiente.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 9 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="material descartado pontos quantidade pontuação acumula descarte sistema">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="star" class="w-5 h-5 text-lime-400 mr-3"></i>
                            Como funciona o sistema de pontos?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">Ao registrar o descarte em um ponto de coleta parceiro, você acumula
                                pontos. A pontuação varia de acordo com o <strong class="text-lime-300">tipo e quantidade
                                    de material</strong> entregue. Materiais como alumínio e plástico PET geram mais pontos
                                devido ao seu maior impacto positivo quando reciclados.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 10 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="gratuito pagar plataforma custo valor free">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="dollar-sign" class="w-5 h-5 text-lime-400 mr-3"></i>
                            Preciso pagar para usar a plataforma?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">Não. O uso do Perseph é <strong class="text-lime-300">totalmente
                                    gratuito</strong> para todos os usuários. Acreditamos que a sustentabilidade deve ser
                                acessível a todos.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 11 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="acumulados pontos trocar recompensa descontos brindes serviços resgatar">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="award" class="w-5 h-5 text-lime-400 mr-3"></i>
                            O que posso fazer com os pontos acumulados?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">Os pontos podem ser trocados por <strong
                                    class="text-lime-300">recompensas exclusivas</strong> como descontos em
                                estabelecimentos, brindes ecológicos e serviços oferecidos por empresas parceiras
                                comprometidas com a sustentabilidade.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 12 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="reciclam ranking rankings semana mes semanal mensal competição">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="trophy" class="w-5 h-5 text-lime-400 mr-3"></i>
                            Como funcionam os rankings?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">O Perseph mantém rankings <strong class="text-lime-300">semanais e
                                    mensais</strong> destacando os usuários que mais reciclam. Essa competição saudável
                                incentiva a participação contínua e reconhece o esforço de cada pessoa na preservação
                                ambiental.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 13 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="cadastro perfil registro conta usuário">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="user-plus" class="w-5 h-5 text-lime-400 mr-3"></i>
                            Preciso me cadastrar para usar?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">Sim, é necessário criar um <strong class="text-lime-300">perfil
                                    simples</strong> para registrar sua pontuação, acompanhar seu progresso e acessar todas
                                as funcionalidades da plataforma.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 14 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="segurança privacidade anonimato informações pessoais dados proteção">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="lock" class="w-5 h-5 text-lime-400 mr-3"></i>
                            A plataforma é segura?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">Sim. A Perseph adota <strong class="text-lime-300">medidas rigorosas
                                    de segurança</strong> para proteger suas informações, incluindo criptografia de dados e
                                anonimização, garantindo sua privacidade em todas as interações.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 15 -->
                <div class="faq-item bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-xl overflow-hidden transition-all duration-300 hover:border-lime-400/30"
                    data-keywords="empresas parceiras comércio estabelecimentos parceria">
                    <button
                        class="faq-toggle w-full px-6 py-4 text-left text-lg font-semibold text-white flex justify-between items-center hover:bg-slate-700/30 transition-colors">
                        <span class="flex items-center">
                            <i data-lucide="handshake" class="w-5 h-5 text-lime-400 mr-3"></i>
                            Empresas podem participar como parceiras?
                        </span>
                        <i data-lucide="chevron-down"
                            class="faq-icon w-5 h-5 text-lime-400 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                        <div class="p-6 pt-0">
                            <p class="text-gray-300">Sim! Empresas interessadas em apoiar a causa ambiental podem se tornar
                                parceiras para oferecer recompensas, ter mais visibilidade e contribuir ativamente para a
                                construção de um futuro mais sustentável.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mensagem de "Nenhum Resultado" -->
            <div id="noResults" class="hidden text-center py-16">
                <div
                    class="bg-gradient-to-br from-slate-800/50 to-emerald-900/50 rounded-2xl p-8 border border-emerald-700/30">
                    <i data-lucide="search-x" class="mx-auto h-12 w-12 text-lime-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-white mb-2">Nenhuma pergunta encontrada</h3>
                    <p class="text-gray-400 mb-4">Tente usar palavras-chave diferentes na sua busca.</p>
                    <button onclick="clearSearch()"
                        class="bg-gradient-to-r from-lime-400 to-emerald-400 text-slate-900 font-bold py-2 px-6 rounded-full hover:opacity-90 transition-opacity">
                        Limpar Busca
                    </button>
                </div>
            </div>

            <!-- Seção de Contato -->
            <div class="mt-16 text-center">
                <div
                    class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 rounded-2xl p-8 border border-emerald-700/30">
                    <h3 class="text-xl font-semibold text-white">Ainda com dúvidas?</h3>
                    <p class="mt-2 text-gray-400">Nossa equipe está pronta para ajudar você a entender melhor sobre
                        sustentabilidade e reciclagem.</p>
                    <div class="mt-6">
                        <a href="mailto:l.melozi@aluno.ifsp.edu.br"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-slate-900 bg-gradient-to-r from-lime-400 to-emerald-400 hover:opacity-90 transition-opacity">
                            <i data-lucide="mail" class="mr-2 h-5 w-5"></i>
                            Fale Conosco
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const faqContainer = document.getElementById('faqContainer');
            const searchInput = document.getElementById('searchInput');
            const noResults = document.getElementById('noResults');

            // Lógica para o Accordion (abrir/fechar)
            faqContainer.addEventListener('click', function(event) {
                const toggleButton = event.target.closest('.faq-toggle');
                if (!toggleButton) return;

                const content = toggleButton.nextElementSibling;
                const icon = toggleButton.querySelector('.faq-icon');

                // Fecha todos os outros itens abertos
                document.querySelectorAll('.faq-content').forEach(item => {
                    if (item !== content && item.style.maxHeight !== '0px') {
                        item.style.maxHeight = '0px';
                        item.previousElementSibling.querySelector('.faq-icon').classList.remove(
                            'rotate-180');
                    }
                });

                // Abre ou fecha o item clicado
                if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                    content.style.maxHeight = '0px';
                    icon.classList.remove('rotate-180');
                } else {
                    content.style.maxHeight = content.scrollHeight + 'px';
                    icon.classList.add('rotate-180');
                }
            });

            // Lógica para a Barra de Busca
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const faqItems = faqContainer.querySelectorAll('.faq-item');
                let resultsFound = false;

                faqItems.forEach(item => {
                    const keywords = (item.getAttribute('data-keywords') || '').toLowerCase();
                    const question = item.querySelector('span').textContent.toLowerCase();

                    if (keywords.includes(searchTerm) || question.includes(searchTerm)) {
                        item.style.display = 'block';
                        resultsFound = true;
                    } else {
                        item.style.display = 'none';
                    }
                });

                noResults.style.display = resultsFound ? 'none' : 'block';
            });
        });

        function clearSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('searchInput').focus();
            document.querySelectorAll('.faq-item').forEach(item => {
                item.style.display = 'block';
            });
            document.getElementById('noResults').style.display = 'none';
        }
    </script>

@endsection
