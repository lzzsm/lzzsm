@extends('layouts.guest')

@section('title', 'Termos de Uso - Perseph')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho da Página -->
            <div class="relative text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight mb-4">
                    Termos de <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-emerald-400">Uso</span>
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Última atualização: {{ date('d/m/Y') }}
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

            <!-- Conteúdo dos Termos -->
            <div
                class="max-w-4xl mx-auto bg-gradient-to-br from-slate-800/50 to-gray-900/50 p-8 rounded-2xl border border-gray-700/50">

                <div
                    class="prose prose-invert prose-lg max-w-none 
                        text-gray-300 
                        prose-headings:text-white prose-headings:font-bold
                        prose-h2:text-2xl prose-h2:border-b prose-h2:border-gray-700 prose-h2:pb-3 prose-h2:mb-6
                        prose-h3:text-xl prose-h3:text-lime-300 prose-h3:font-semibold prose-h3:mt-8
                        prose-strong:text-gray-100
                        prose-a:text-emerald-400 prose-a:no-underline hover:prose-a:underline
                        prose-ul:list-disc prose-ul:pl-6
                        prose-li:marker:text-emerald-500">

                    <p class="text-lg text-gray-200 border-l-4 border-emerald-500 pl-4 mb-8">
                        Bem-vindo à <strong>Perseph</strong>. Ao utilizar nossa plataforma, você concorda em cumprir e estar
                        vinculado aos seguintes termos e condições de uso. Por favor, leia-os atentamente.
                    </p>

                    <!-- 1. Aceitação dos Termos -->
                    <div class="mb-12">
                        <h2>1. Aceitação dos Termos</h2>
                        <div class="bg-slate-800/30 rounded-xl p-6 mt-4">
                            <div class="flex items-start">
                                <i data-lucide="check-circle" class="w-6 h-6 text-emerald-400 mr-3 mt-1"></i>
                                <p>
                                    Ao se cadastrar e utilizar os serviços oferecidos pela Perseph ("Plataforma"), você,
                                    doravante
                                    denominado "Usuário", declara ter lido, entendido e concordado com todas as disposições
                                    estabelecidas nestes Termos de Uso e em nossa <a
                                        href="{{ route('legal.privacy-policy') }}">Política
                                        de Privacidade</a>. Caso não concorde com qualquer um dos termos, você não deverá
                                    utilizar a
                                    Plataforma.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Objeto da Plataforma -->
                    <div class="mb-12">
                        <h2>2. Objeto da Plataforma</h2>
                        <div class="bg-slate-800/30 rounded-xl p-6 mt-4">
                            <div class="flex items-start">
                                <i data-lucide="target" class="w-6 h-6 text-emerald-400 mr-3 mt-1"></i>
                                <p>
                                    A Perseph é uma aplicação web que visa incentivar a prática da reciclagem e promover a
                                    educação
                                    ambiental através de um sistema de gamificação. A Plataforma permite que Usuários
                                    acumulem pontos ao
                                    realizar o descarte de resíduos recicláveis em pontos de coleta parceiros e,
                                    posteriormente, troquem
                                    esses pontos por recompensas oferecidas por Empresas Parceiras.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Cadastro e Conta do Usuário -->
                    <div class="mb-12">
                        <h2>3. Cadastro e Conta do Usuário</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div class="bg-slate-800/30 rounded-xl p-6">
                                <i data-lucide="user-check" class="w-8 h-8 text-emerald-400 mb-3"></i>
                                <h3 class="text-lg font-semibold text-lime-300">3.1. Elegibilidade e Veracidade</h3>
                                <p class="text-gray-300 text-sm mt-2">
                                    Para utilizar plenamente os recursos da Plataforma, o Usuário deverá realizar um
                                    cadastro,
                                    fornecendo informações precisas, completas e atualizadas. A criação de contas com
                                    informações falsas
                                    ou em nome de terceiros sem autorização constitui uma violação destes termos.
                                </p>
                            </div>
                            <div class="bg-slate-800/30 rounded-xl p-6">
                                <i data-lucide="shield" class="w-8 h-8 text-emerald-400 mb-3"></i>
                                <h3 class="text-lg font-semibold text-lime-300">3.2. Segurança da Conta</h3>
                                <p class="text-gray-300 text-sm mt-2">
                                    O Usuário é o único responsável pela segurança de sua senha e por todas as atividades
                                    que ocorrerem
                                    em sua conta. A Perseph não se responsabiliza por perdas ou danos decorrentes do acesso
                                    não
                                    autorizado à conta do Usuário.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Sistema de Pontuação e Recompensas -->
                    <div class="mb-12">
                        <h2>4. Sistema de Pontuação e Recompensas</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div class="bg-slate-800/30 rounded-xl p-6">
                                <i data-lucide="star" class="w-8 h-8 text-emerald-400 mb-3"></i>
                                <h3 class="text-lg font-semibold text-lime-300">4.1. Acúmulo de Pontos</h3>
                                <p class="text-gray-300 text-sm mt-2">
                                    Os pontos são um benefício concedido aos Usuários e sua forma de acúmulo, incluindo os
                                    valores por
                                    tipo de material e os métodos de validação, pode ser alterada a qualquer momento.
                                    Tentativas de fraude
                                    resultarão no cancelamento dos pontos e possível exclusão da conta.
                                </p>
                            </div>
                            <div class="bg-slate-800/30 rounded-xl p-6">
                                <i data-lucide="gift" class="w-8 h-8 text-emerald-400 mb-3"></i>
                                <h3 class="text-lg font-semibold text-lime-300">4.2. Resgate de Recompensas</h3>
                                <p class="text-gray-300 text-sm mt-2">
                                    As recompensas disponíveis na Plataforma são oferecidas e de responsabilidade exclusiva
                                    das Empresas
                                    Parceiras. A Perseph atua apenas como intermediária na divulgação dessas ofertas.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Propriedade Intelectual -->
                    <div class="mb-12">
                        <h2>5. Propriedade Intelectual</h2>
                        <div class="bg-slate-800/30 rounded-xl p-6 mt-4">
                            <div class="flex items-start">
                                <i data-lucide="copyright" class="w-6 h-6 text-emerald-400 mr-3 mt-1"></i>
                                <p>
                                    Todo o conteúdo presente na Plataforma, incluindo, mas não se limitando a, textos,
                                    gráficos, logos,
                                    ícones, imagens, e software, é propriedade exclusiva da Perseph ou de seus licenciadores
                                    e é
                                    protegido pelas leis de direitos autorais e propriedade intelectual.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Limitação de Responsabilidade -->
                    <div class="mb-12">
                        <h2>6. Limitação de Responsabilidade</h2>
                        <div class="bg-slate-800/30 rounded-xl p-6 mt-4">
                            <div class="flex items-start">
                                <i data-lucide="alert-triangle" class="w-6 h-6 text-emerald-400 mr-3 mt-1"></i>
                                <p>
                                    A Perseph não garante que a Plataforma estará livre de erros ou interrupções. O uso do
                                    serviço é por
                                    conta e risco do Usuário. Em nenhuma circunstância a Perseph, seus diretores ou
                                    colaboradores serão
                                    responsáveis por quaisquer danos diretos ou indiretos decorrentes do uso ou da
                                    incapacidade de usar
                                    a Plataforma.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Modificações nos Termos -->
                    <div class="mb-12">
                        <h2>7. Modificações nos Termos</h2>
                        <div class="bg-slate-800/30 rounded-xl p-6 mt-4">
                            <div class="flex items-start">
                                <i data-lucide="refresh-cw" class="w-6 h-6 text-emerald-400 mr-3 mt-1"></i>
                                <p>
                                    Reservamo-nos o direito de modificar estes Termos de Uso a qualquer momento. A versão
                                    mais
                                    atualizada estará sempre disponível em nossa Plataforma. A continuidade do uso dos
                                    serviços após a
                                    publicação de alterações constituirá sua aceitação dos novos termos.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 8. Lei Aplicável e Foro -->
                    <div class="mb-12">
                        <h2>8. Lei Aplicável e Foro</h2>
                        <div class="bg-slate-800/30 rounded-xl p-6 mt-4">
                            <div class="flex items-start">
                                <i data-lucide="scale" class="w-6 h-6 text-emerald-400 mr-3 mt-1"></i>
                                <p>
                                    Estes Termos de Uso serão regidos e interpretados de acordo com as leis da República
                                    Federativa do
                                    Brasil. Fica eleito o foro da Comarca de Votuporanga, São Paulo, Brasil, para dirimir
                                    quaisquer
                                    questões oriundas destes Termos.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 9. Contato -->
                    <div class="mb-12">
                        <h2>9. Contato</h2>
                        <div class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 rounded-xl p-6 mt-4">
                            <div class="flex items-start">
                                <i data-lucide="mail" class="w-6 h-6 text-emerald-400 mr-3 mt-1"></i>
                                <div>
                                    <p class="text-gray-200 mb-4">
                                        Para quaisquer dúvidas ou esclarecimentos sobre estes Termos, entre em contato
                                        conosco através do e-mail:
                                    </p>
                                    <a href="mailto:l.melozi@aluno.ifsp.edu.br"
                                        class="text-lime-400 font-semibold text-lg hover:text-lime-300 transition-colors">
                                        l.melozi@aluno.ifsp.edu.br
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Aceitação dos Termos -->
                    <div
                        class="bg-gradient-to-r from-emerald-900/30 to-lime-900/30 rounded-xl p-6 mt-8 border border-emerald-700/30">
                        <div class="text-center">
                            <i data-lucide="file-check" class="w-12 h-12 text-lime-400 mx-auto mb-4"></i>
                            <h3 class="text-xl font-bold text-white mb-2">Ao utilizar nossa plataforma, você concorda com
                                estes Termos</h3>
                            <p class="text-gray-300">
                                Sua continuidade no uso dos serviços da Perseph representa sua aceitação integral destes
                                Termos de Uso.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
