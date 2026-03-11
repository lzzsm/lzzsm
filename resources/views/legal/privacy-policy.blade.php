@extends('layouts.guest')

@section('title', 'Política de Privacidade - Perseph')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho da Página -->
            <div class="relative text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight mb-4">
                    Política de <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 to-emerald-400">Privacidade</span>
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

            <!-- Conteúdo da Política -->
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
                        A sua privacidade é de extrema importância para a <strong>Perseph</strong>. Esta Política de
                        Privacidade descreve como coletamos, usamos, armazenamos e protegemos suas informações pessoais em
                        conformidade com a Lei Geral de Proteção de Dados (LGPD - Lei nº 13.709/2018).
                    </p>

                    <!-- 1. Informações que Coletamos -->
                    <div class="mb-12">
                        <h2>1. Informações que Coletamos</h2>

                        <div class="bg-slate-800/30 rounded-xl p-6 mt-4">
                            <h3>1.1. Dados Fornecidos pelo Usuário</h3>
                            <ul>
                                <li><strong>Para Usuários Cadastrados:</strong> Nome, e-mail e CPF.</li>
                                <li><strong>Para Empresas Parceiras:</strong> Nome da empresa, e-mail de contato, CNPJ,
                                    telefone e website.</li>
                            </ul>
                        </div>

                        <div class="bg-slate-800/30 rounded-xl p-6 mt-6">
                            <h3>1.2. Dados Coletados Automaticamente</h3>
                            <ul>
                                <li><strong>Dados de Uso:</strong> Informações sobre suas interações com a Plataforma, como
                                    coletas realizadas, pontuação, resgates de recompensas e anúncios criados.</li>
                                <li><strong>Dados Técnicos:</strong> Endereço IP, tipo de navegador, sistema operacional e
                                    informações do dispositivo, coletados para fins de segurança e análise.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- 2. Finalidade do Tratamento dos Dados -->
                    <div class="mb-12">
                        <h2>2. Finalidade do Tratamento dos Dados</h2>
                        <p class="mb-4">Utilizamos os dados coletados para as seguintes finalidades:</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <div class="bg-slate-800/30 rounded-xl p-4">
                                <i data-lucide="settings" class="w-6 h-6 text-emerald-400 mb-2"></i>
                                <strong>Operar a Plataforma</strong>
                                <p class="text-sm text-gray-400 mt-2">Gerenciar contas, processar pontos e viabilizar
                                    comunicação entre usuários e parceiros</p>
                            </div>
                            <div class="bg-slate-800/30 rounded-xl p-4">
                                <i data-lucide="user" class="w-6 h-6 text-emerald-400 mb-2"></i>
                                <strong>Personalizar a Experiência</strong>
                                <p class="text-sm text-gray-400 mt-2">Oferecer conteúdos e recompensas relevantes baseados
                                    no seu perfil</p>
                            </div>
                            <div class="bg-slate-800/30 rounded-xl p-4">
                                <i data-lucide="shield" class="w-6 h-6 text-emerald-400 mb-2"></i>
                                <strong>Segurança</strong>
                                <p class="text-sm text-gray-400 mt-2">Proteger a Plataforma contra fraudes e atividades não
                                    autorizadas</p>
                            </div>
                            <div class="bg-slate-800/30 rounded-xl p-4">
                                <i data-lucide="message-circle" class="w-6 h-6 text-emerald-400 mb-2"></i>
                                <strong>Comunicação</strong>
                                <p class="text-sm text-gray-400 mt-2">Enviar notificações importantes sobre sua conta e
                                    atualizações</p>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Compartilhamento de Informações -->
                    <div class="mb-12">
                        <h2>3. Compartilhamento de Informações</h2>
                        <p class="mb-4">A Perseph não vende, aluga ou comercializa suas informações pessoais. O
                            compartilhamento de dados ocorre apenas nas seguintes hipóteses:</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div class="bg-slate-800/30 rounded-xl p-6">
                                <i data-lucide="handshake" class="w-8 h-8 text-emerald-400 mb-3"></i>
                                <h3 class="text-lg font-semibold text-lime-300">Com Empresas Parceiras</h3>
                                <p class="text-gray-300">Ao resgatar uma recompensa, compartilhamos informações estritamente
                                    necessárias para que o parceiro possa validar e entregar o benefício</p>
                            </div>
                            <div class="bg-slate-800/30 rounded-xl p-6">
                                <i data-lucide="scale" class="w-8 h-8 text-emerald-400 mb-3"></i>
                                <h3 class="text-lg font-semibold text-lime-300">Por Obrigação Legal</h3>
                                <p class="text-gray-300">Em caso de requisição judicial ou ordem de autoridade competente,
                                    poderemos compartilhar dados conforme exigido por lei</p>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Armazenamento e Segurança dos Dados -->
                    <div class="mb-12">
                        <h2>4. Armazenamento e Segurança dos Dados</h2>
                        <div class="bg-slate-800/30 rounded-xl p-6 mt-4">
                            <div class="flex items-start">
                                <i data-lucide="lock" class="w-6 h-6 text-emerald-400 mr-3 mt-1"></i>
                                <p>
                                    Adotamos medidas técnicas e administrativas robustas para proteger seus dados contra
                                    acesso não autorizado, perda, alteração ou destruição. As informações são armazenadas em
                                    servidores seguros, e o acesso é restrito a colaboradores autorizados que necessitam da
                                    informação para desempenhar suas funções.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Seus Direitos como Titular dos Dados -->
                    <div class="mb-12">
                        <h2>5. Seus Direitos como Titular dos Dados</h2>
                        <p class="mb-4">De acordo com a LGPD, você tem o direito de:</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                            <div class="bg-slate-800/30 rounded-xl p-4 text-center">
                                <i data-lucide="check-circle" class="w-6 h-6 text-emerald-400 mx-auto mb-2"></i>
                                <p class="text-sm">Confirmar a existência de tratamento dos seus dados</p>
                            </div>
                            <div class="bg-slate-800/30 rounded-xl p-4 text-center">
                                <i data-lucide="eye" class="w-6 h-6 text-emerald-400 mx-auto mb-2"></i>
                                <p class="text-sm">Acessar seus dados a qualquer momento</p>
                            </div>
                            <div class="bg-slate-800/30 rounded-xl p-4 text-center">
                                <i data-lucide="edit" class="w-6 h-6 text-emerald-400 mx-auto mb-2"></i>
                                <p class="text-sm">Solicitar a correção de dados incompletos ou inexatos</p>
                            </div>
                            <div class="bg-slate-800/30 rounded-xl p-4 text-center">
                                <i data-lucide="trash-2" class="w-6 h-6 text-emerald-400 mx-auto mb-2"></i>
                                <p class="text-sm">Solicitar a eliminação de dados desnecessários</p>
                            </div>
                            <div class="bg-slate-800/30 rounded-xl p-4 text-center">
                                <i data-lucide="download" class="w-6 h-6 text-emerald-400 mx-auto mb-2"></i>
                                <p class="text-sm">Solicitar a portabilidade dos seus dados</p>
                            </div>
                            <div class="bg-slate-800/30 rounded-xl p-4 text-center">
                                <i data-lucide="x-circle" class="w-6 h-6 text-emerald-400 mx-auto mb-2"></i>
                                <p class="text-sm">Revogar o consentimento a qualquer momento</p>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 rounded-xl p-6 mt-6">
                            <p class="text-gray-200">
                                Para exercer seus direitos, entre em contato conosco através dos canais informados nesta
                                política.
                            </p>
                        </div>
                    </div>

                    <!-- 6. Retenção de Dados -->
                    <div class="mb-12">
                        <h2>6. Retenção de Dados</h2>
                        <div class="bg-slate-800/30 rounded-xl p-6 mt-4">
                            <div class="flex items-start">
                                <i data-lucide="clock" class="w-6 h-6 text-emerald-400 mr-3 mt-1"></i>
                                <p>
                                    Manteremos seus dados pessoais armazenados somente pelo tempo necessário para cumprir
                                    com as finalidades para as quais foram coletados, inclusive para fins de cumprimento de
                                    quaisquer obrigações legais, contratuais, ou requisição de autoridades competentes.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Alterações nesta Política -->
                    <div class="mb-12">
                        <h2>7. Alterações nesta Política</h2>
                        <div class="bg-slate-800/30 rounded-xl p-6 mt-4">
                            <div class="flex items-start">
                                <i data-lucide="refresh-cw" class="w-6 h-6 text-emerald-400 mr-3 mt-1"></i>
                                <p>
                                    Esta Política de Privacidade pode ser atualizada periodicamente. Notificaremos sobre
                                    quaisquer alterações significativas através da Plataforma ou por e-mail. Recomendamos a
                                    revisão regular desta página para se manter informado.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 8. Contato -->
                    <div class="mb-12">
                        <h2>8. Contato</h2>
                        <div class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 rounded-xl p-6 mt-4">
                            <div class="flex items-start">
                                <i data-lucide="mail" class="w-6 h-6 text-emerald-400 mr-3 mt-1"></i>
                                <div>
                                    <p class="text-gray-200 mb-4">
                                        Se você tiver dúvidas sobre esta Política de Privacidade ou sobre como tratamos seus
                                        dados, entre em contato com nosso Encarregado de Proteção de Dados (DPO) pelo
                                        e-mail:
                                    </p>
                                    <a href="mailto:l.melozi@aluno.ifsp.edu.br"
                                        class="text-lime-400 font-semibold text-lg hover:text-lime-300 transition-colors">
                                        l.melozi@aluno.ifsp.edu.br
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
