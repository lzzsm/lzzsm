@extends('layouts.guest')

@section('title', 'Parcerias - Perseph')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho da Página -->
            <div class="relative text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight mb-4">
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-emerald-400">Parcerias</span>
                    que Transformam
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Conectando empresas comprometidas com uma comunidade engajada para construir um futuro sustentável
                    juntos
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

            <!-- Seção 1: Como Funcionam as Parcerias -->
            <div class="max-w-6xl mx-auto mb-20">
                <h2 class="text-3xl font-bold text-white mb-12 text-center">
                    Como Funcionam Nossas Parcerias
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Cadastro e Integração -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="user-plus" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Cadastro e Integração</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Empresas locais e regionais passam por um processo de cadastro e análise para integração na
                            plataforma
                        </p>
                    </div>

                    <!-- Recompensas e Benefícios -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="gift" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Recompensas e Benefícios</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Oferecem descontos, cupons, produtos e experiências exclusivas como recompensas para a
                            comunidade
                        </p>
                    </div>

                    <!-- Comunicação e Campanhas -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 rounded-2xl p-6 border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20 h-full">
                        <div class="flex justify-center mb-4">
                            <div class="bg-emerald-900/30 p-3 rounded-full">
                                <i data-lucide="megaphone" class="w-6 h-6 text-emerald-400"></i>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-emerald-400 mb-3 text-center">Comunicação e Campanhas</h3>
                        <p class="text-gray-300 text-sm text-center">
                            Divulgam anúncios e campanhas especiais alinhadas com os valores de sustentabilidade da
                            plataforma
                        </p>
                    </div>
                </div>
            </div>

            <!-- Seção 2: Conteúdo Expandido -->
            <div class="max-w-4xl mx-auto mb-20">
                <div class="bg-gradient-to-br from-slate-800/50 to-gray-900/50 p-8 rounded-2xl border border-gray-700/50">
                    <h2 class="text-3xl font-bold text-white mb-8 text-center flex items-center justify-center">
                        <i data-lucide="users" class="w-8 h-8 text-lime-400 mr-3"></i>
                        Benefícios para Todos os Lados
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
                            As parcerias no <strong>Perseph</strong> representam muito mais que simples transações
                            comerciais.
                            São relações estratégicas que criam valor compartilhado e impulsionam a transformação
                            sustentável.
                        </p>

                        <h3>Para as Empresas Parceiras</h3>
                        <p>
                            As empresas que se unem ao Perseph desfrutam de benefícios significativos que vão além
                            do marketing tradicional:
                        </p>

                        <ul>
                            <li><strong>Visibilidade Ampliada</strong> - Acesso a uma comunidade engajada e consciente</li>
                            <li><strong>Imagem Sustentável</strong> - Associação positiva com valores ambientais e sociais
                            </li>
                            <li><strong>Fidelização de Clientes</strong> - Conexão com consumidores que valorizam
                                sustentabilidade</li>
                            <li><strong>Impacto Mensurável</strong> - Dados concretos sobre sua contribuição ambiental</li>
                            <li><strong>Networking Estratégico</strong> - Conexões com outras empresas comprometidas</li>
                        </ul>

                        <h3>Para os Usuários da Plataforma</h3>
                        <p>
                            Nossa comunidade recebe benefícios tangíveis que reconhecem seu compromisso com o meio ambiente:
                        </p>

                        <ul>
                            <li><strong>Recompensas Reais</strong> - Descontos, produtos e experiências exclusivas</li>
                            <li><strong>Variedade de Opções</strong> - Diversas categorias de recompensas para diferentes
                                perfis</li>
                            <li><strong>Economia Circular</strong> - Participação ativa em um modelo econômico sustentável
                            </li>
                            <li><strong>Oportunidades Exclusivas</strong> - Acesso a produtos e serviços antes do lançamento
                            </li>
                            <li><strong>Reconhecimento Social</strong> - Valorização do esforço individual pela
                                sustentabilidade</li>
                        </ul>

                        <h3>Para a Comunidade e Meio Ambiente</h3>
                        <p>
                            O impacto coletivo dessas parcerias gera benefícios que transcendem os participantes diretos:
                        </p>

                        <ul>
                            <li><strong>Engajamento Ambiental</strong> - Mais pessoas participando ativamente da reciclagem
                            </li>
                            <li><strong>Fortalecimento Local</strong> - Economia circular beneficiando empresas da região
                            </li>
                            <li><strong>Educação Continuada</strong> - Disseminação de práticas sustentáveis na sociedade
                            </li>
                            <li><strong>Inovação Colaborativa</strong> - Desenvolvimento conjunto de soluções ambientais
                            </li>
                            <li><strong>Legado Sustentável</strong> - Construção de um futuro mais verde para as próximas
                                gerações</li>
                        </ul>

                        <h3>Processo de Seleção de Parceiros</h3>
                        <p>
                            Para garantir a qualidade e o alinhamento com nossos valores, todas as empresas parceiras
                            passam por um rigoroso processo de seleção que avalia:
                        </p>

                        <ul>
                            <li>Compromisso comprovado com práticas sustentáveis</li>
                            <li>Transparência nas operações e cadeia produtiva</li>
                            <li>Qualidade e relevância das recompensas oferecidas</li>
                            <li>Alinhamento com os valores da comunidade Perseph</li>
                            <li>Potencial de impacto positivo no meio ambiente</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Seção 3: Seja um Parceiro -->
            <div class="max-w-4xl mx-auto">
                <div
                    class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 rounded-2xl p-8 border border-emerald-700/30">
                    <h2 class="text-3xl font-bold text-white mb-10 text-center">
                        Pronto para se Tornar um Parceiro?
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="text-center">
                            <i data-lucide="rocket" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Para Empresas</h3>
                            <p class="text-gray-300 text-sm">
                                Junte-se ao ecossistema Perseph e transforme sua marca em uma referência em sustentabilidade
                            </p>
                        </div>
                        <div class="text-center">
                            <i data-lucide="heart" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-3">Para a Comunidade</h3>
                            <p class="text-gray-300 text-sm">
                                Aproveite benefícios exclusivos enquanto apoia empresas comprometidas com o meio ambiente
                            </p>
                        </div>
                    </div>
                    <div class="text-center mt-8">
                        <button
                            class="bg-gradient-to-r from-lime-400 to-emerald-400 text-slate-900 font-bold px-8 py-3 rounded-lg flex items-center mx-auto">
                            <i data-lucide="mail" class="w-5 h-5 mr-2"></i> <a
                                href="mailto:l.melozi@aluno.ifsp.edu.br">Quero ser um Parceiro</a>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
