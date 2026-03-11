@extends('layouts.guest')

@section('title', 'Recompensas - Perseph')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho da Página -->
            <div class="relative text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight mb-4">
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-emerald-400">Recompensas</span>
                    que Valem a Pena
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Transforme seu compromisso com a reciclagem em benefícios reais e exclusivos
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

            <!-- Seção 1: Como Funciona -->
            <div class="max-w-6xl mx-auto mb-20">
                <h2 class="text-3xl font-bold text-white mb-12 text-center">
                    Como Funciona o Sistema de Recompensas
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                    <!-- Acumular Pontos -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="plus-circle" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">1. Acumular</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Registre suas coletas de recicláveis e acumule pontos baseados no tipo e quantidade de materiais
                        </p>
                    </div>

                    <!-- Explorar Catálogo -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="search" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">2. Explorar</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Navegue pelo catálogo de recompensas e descubra todas as opções disponíveis com seus pontos
                        </p>
                    </div>

                    <!-- Verificar Pontos -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="calculator" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">3. Verificar</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Confirme a quantidade de pontos necessária para cada recompensa e seu saldo atual
                        </p>
                    </div>

                    <!-- Resgatar -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="shopping-cart" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">4. Resgatar</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Clique em "Resgatar" e receba seu código digital ou cupom para usar na empresa parceira
                        </p>
                    </div>
                </div>
            </div>

            <!-- Seção 2: Conteúdo Expandido -->
            <div class="max-w-4xl mx-auto mb-20">
                <div class="bg-gradient-to-br from-slate-800/50 to-gray-900/50 p-8 rounded-2xl border border-gray-700/50">
                    <h2 class="text-3xl font-bold text-white mb-8 text-center flex items-center justify-center">
                        <i data-lucide="award" class="w-8 h-8 text-lime-400 mr-3"></i>
                        Recompensas que Fazem a Diferença
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
                            No <strong>Perseph</strong>, as recompensas são muito mais que simples benefícios - são o
                            reconhecimento tangível do seu compromisso com um futuro mais sustentável.
                        </p>

                        <h3>O Que São Nossas Recompensas?</h3>
                        <p>
                            As recompensas são vantagens exclusivas oferecidas por nossas empresas parceiras,
                            cuidadosamente selecionadas para oferecer valor real à nossa comunidade. Elas representam
                            uma forma concreta de agradecer e incentivar a continuidade das práticas sustentáveis.
                        </p>

                        <h3>Tipos de Recompensas Disponíveis</h3>
                        <p>
                            Nosso catálogo é diversificado e constantemente atualizado para atender a diferentes
                            perfis e preferências:
                        </p>

                        <ul>
                            <li><strong>Descontos Exclusivos</strong> - Reduções percentuais em produtos e serviços</li>
                            <li><strong>Cupons de Benefício</strong> - Valores fixos para uso em estabelecimentos</li>
                            <li><strong>Produtos Sustentáveis</strong> - Itens ecologicamente corretos das marcas parceiras
                            </li>
                            <li><strong>Experiências Únicas</strong> - Acesso a eventos, workshops e atividades especiais
                            </li>
                            <li><strong>Assinaturas e Serviços</strong> - Períodos gratuitos em plataformas digitais</li>
                            <li><strong>Doações em Seu Nome</strong> - Contribuições para causas ambientais indicadas por
                                você</li>
                        </ul>

                        <h3>Processo de Resgate Detalhado</h3>
                        <p>
                            Todo o processo de resgate foi desenvolvido para ser simples, seguro e transparente:
                        </p>

                        <ul>
                            <li><strong>Acumulação de Pontos</strong> - Cada coleta registrada gera pontos baseados no tipo
                                e peso dos materiais</li>
                            <li><strong>Catálogo Dinâmico</strong> - Navegação intuitiva por categorias e filtros por pontos
                                disponíveis</li>
                            <li><strong>Verificação Instantânea</strong> - Sistema automático que confirma seu saldo e
                                elegibilidade</li>
                            <li><strong>Resgate Imediato</strong> - Processamento rápido com entrega digital do código ou
                                cupom</li>
                            <li><strong>Validação Segura</strong> - Códigos únicos e com prazo de validade para garantir a
                                segurança</li>
                            <li><strong>Histórico Completo</strong> - Acompanhamento de todos os resgates realizados</li>
                        </ul>

                        <h3>Vantagens do Nosso Sistema</h3>
                        <p>
                            Diferente de programas tradicionais de fidelidade, nosso sistema oferece benefícios
                            exclusivos:
                        </p>

                        <ul>
                            <li><strong>Atualização Constante</strong> - Novas recompensas são adicionadas regularmente</li>
                            <li><strong>Variedade Garantida</strong> - Opções para todos os gostos e necessidades</li>
                            <li><strong>Transparência Total</strong> - Sem custos ocultos ou condições surpresa</li>
                            <li><strong>Valor Real</strong> - Recompensas que realmente fazem diferença no seu dia a dia
                            </li>
                            <li><strong>Impacto Duplo</strong> - Você ganha benefícios enquanto ajuda o meio ambiente</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Seção 3: Comece Agora -->
            <div class="max-w-4xl mx-auto">
                <div
                    class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 rounded-2xl p-8 border border-emerald-700/30">
                    <h2 class="text-3xl font-bold text-white mb-10 text-center">
                        Pronto para Começar a Ganhar Recompensas?
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="text-center">
                            <i data-lucide="user-check" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Já é Usuário?</h3>
                            <p class="text-gray-300 text-sm">
                                Acesse seu catálogo de recompensas e descubra todas as opções disponíveis com seus pontos
                            </p>
                        </div>
                        <div class="text-center">
                            <i data-lucide="user-plus" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Novo por Aqui?</h3>
                            <p class="text-gray-300 text-sm">
                                Cadastre-se agora e comece a transformar sua reciclagem em benefícios exclusivos
                            </p>
                        </div>
                    </div>
                    <div class="text-center mt-8">
                        @auth
                            <button
                                class="bg-gradient-to-r from-lime-400 to-emerald-400 text-slate-900 font-bold px-8 py-3 rounded-lg flex items-center mx-auto hover:scale-105 transition-transform">
                                <i data-lucide="sparkles" class="w-5 h-5 mr-2"></i>
                                <a href="{{ route('rewards.dashboard') }}">Ver Catálogo de Recompensas</a>
                            </button>
                        @else
                            <button
                                class="bg-gradient-to-r from-lime-400 to-emerald-400 text-slate-900 font-bold px-8 py-3 rounded-lg flex items-center mx-auto hover:scale-105 transition-transform">
                                <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                                <a href="{{ route('register') }}">Cadastre-se para Ver Recompensas</a>
                            </button>
                            <p class="text-gray-400 text-sm mt-3">Já tem conta?
                                <a href="{{ route('login') }}" class="text-lime-400 hover:text-lime-300 transition-colors">Faça
                                    login</a>
                            </p>
                        @endauth
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
