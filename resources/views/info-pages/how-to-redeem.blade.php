@extends('layouts.main')

@section('title', 'Como Resgatar - Perseph')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Hero Section -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6">
                    Seu Esforço, Sua Recompensa
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Aprenda como trocar seus pontos por recompensas incríveis e descubra o impacto positivo de cada resgate.
                </p>
            </div>

            <!-- Seção 1: O Impacto do Seu Resgate (Conteúdo Educativo Expandido) -->
            <div class="max-w-6xl mx-auto mb-20">
                <div class="bg-gradient-to-br from-slate-800 to-gray-900 rounded-2xl p-8 border border-emerald-700/30">
                    <h2 class="text-3xl font-bold text-emerald-400 mb-6 flex items-center justify-center">
                        <i data-lucide="leaf" class="w-8 h-8 text-lime-400 mr-3"></i>
                        O Poder da Sua Reciclagem
                    </h2>
                    <p class="text-lg text-gray-300 mb-6 text-center max-w-4xl mx-auto">
                        Cada ponto que você acumula não é apenas um número; é a representação de um ato concreto de
                        sustentabilidade. Ao resgatar suas recompensas, você fecha o ciclo da economia circular,
                        transformando resíduos em valor e incentivando a continuidade de um futuro mais verde.
                    </p>

                    <!-- Grid de Estatísticas Destacadas -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-8">
                        <div class="text-center bg-emerald-900/20 rounded-xl p-4 border border-emerald-700/30">
                            <div class="text-3xl font-bold text-lime-400 mb-1">~70%</div>
                            <div class="text-sm text-gray-400">Economia de Energia</div>
                        </div>
                        <div class="text-center bg-emerald-900/20 rounded-xl p-4 border border-emerald-700/30">
                            <div class="text-3xl font-bold text-lime-400 mb-1">1 Ton</div>
                            <div class="text-sm text-gray-400">Menos Resíduos em Aterros</div>
                        </div>
                        <div class="text-center bg-emerald-900/20 rounded-xl p-4 border border-emerald-700/30">
                            <div class="text-3xl font-bold text-lime-400 mb-1">1 Árvore</div>
                            <div class="text-sm text-gray-400">Preservada (por 50kg de papel)</div>
                        </div>
                        <div class="text-center bg-emerald-900/20 rounded-xl p-4 border border-emerald-700/30">
                            <div class="text-3xl font-bold text-lime-400 mb-1">100%</div>
                            <div class="text-sm text-gray-400">Material Reutilizado</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção 2: Como Resgatar (Passo a Passo Original Refatorado) -->
            <div class="max-w-5xl mx-auto mb-20">
                <h2 class="text-3xl font-bold text-white mb-10 text-center">
                    Seu Guia Rápido para o Resgate
                </h2>

                <div class="grid md:grid-cols-2 gap-8">

                    <!-- Passo 1 -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-8 rounded-2xl border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20">
                        <h3 class="text-2xl font-bold text-lime-400 mb-3 flex items-center">
                            <i data-lucide="gift" class="w-6 h-6 mr-2"></i>
                            1. Escolha sua Recompensa
                        </h3>
                        <p class="text-gray-300">Navegue pelo nosso <a href="{{ route('rewards.dashboard') }}"
                                class="text-emerald-400 hover:text-lime-300 font-semibold">Catálogo de Recompensas</a> e
                            selecione a que mais te agrada. Verifique os pontos necessários e a disponibilidade. Priorize as
                            opções de parceiros que compartilham nosso compromisso com a sustentabilidade.</p>
                    </div>

                    <!-- Passo 2 -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-8 rounded-2xl border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20">
                        <h3 class="text-2xl font-bold text-lime-400 mb-3 flex items-center">
                            <i data-lucide="check-circle" class="w-6 h-6 mr-2"></i>
                            2. Confirme o Resgate
                        </h3>
                        <p class="text-gray-300">Ao confirmar, seus pontos serão debitados automaticamente. Você receberá um
                            código único e intransferível, que será seu comprovante de resgate. Lembre-se: seus pontos são
                            valiosos, use-os com consciência!</p>
                    </div>

                    <!-- Passo 3 -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-8 rounded-2xl border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20">
                        <h3 class="text-2xl font-bold text-lime-400 mb-3 flex items-center">
                            <i data-lucide="ticket" class="w-6 h-6 mr-2"></i>
                            3. Use seu Código
                        </h3>
                        <p class="text-gray-300">Apresente o código na empresa parceira dentro do prazo de validade (30
                            dias). Este código é a chave para transformar seu esforço de reciclagem em um benefício real.
                            Verifique sempre as condições de uso do parceiro.</p>
                    </div>

                    <!-- Passo 4 -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-8 rounded-2xl border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20">
                        <h3 class="text-2xl font-bold text-lime-400 mb-3 flex items-center">
                            <i data-lucide="smile" class="w-6 h-6 mr-2"></i>
                            4. Aproveite o Benefício
                        </h3>
                        <p class="text-gray-300">A empresa valida seu código e você recebe sua recompensa! Seja um produto
                            sustentável, um desconto em serviços ecológicos ou uma experiência de bem-estar, aproveite o
                            fruto do seu compromisso com o planeta.</p>
                    </div>
                </div>
            </div>

            <!-- Seção 3: Vídeos Educativos (Mídia Integrada) -->
            <div class="max-w-6xl mx-auto mb-20">
                <div class="bg-gradient-to-br from-slate-800 to-gray-900 rounded-2xl p-8 border border-gray-700">
                    <h2 class="text-3xl font-bold text-white mb-8 flex items-center justify-center">
                        <i data-lucide="play-circle" class="w-8 h-8 text-lime-400 mr-3"></i>
                        Aprenda Mais: Reciclagem e Sustentabilidade
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                        <!-- Vídeo 1: Importância da Reciclagem -->
                        <div>
                            <div class="aspect-w-16 aspect-h-9 bg-black rounded-xl overflow-hidden mb-4">
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/ITur0JNJZos"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <h3 class="text-xl font-bold text-emerald-300 mb-2">Importância da Reciclagem</h3>
                            <p class="text-gray-400 text-sm">Entenda o papel fundamental da reciclagem na preservação dos
                                recursos naturais e na redução da poluição.</p>
                        </div>

                        <!-- Vídeo 2: Reciclagem, o motor da sustentabilidade -->
                        <div>
                            <div class="aspect-w-16 aspect-h-9 bg-black rounded-xl overflow-hidden mb-4">
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/vFdUvhtEj1A"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <h3 class="text-xl font-bold text-emerald-300 mb-2">Reciclagem, o Motor da Sustentabilidade</h3>
                            <p class="text-gray-400 text-sm">Veja como a reciclagem impulsiona a economia circular e
                                contribui para um futuro mais sustentável para todos.</p>
                        </div>

                        <!-- Vídeo 3: Como se recicla o plástico -->
                        <div>
                            <div class="aspect-w-16 aspect-h-9 bg-black rounded-xl overflow-hidden mb-4">
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/lgk52ealccs"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <h3 class="text-xl font-bold text-emerald-300 mb-2">Como se Recicla o Plástico?</h3>
                            <p class="text-gray-400 text-sm">Um olhar detalhado sobre o processo de reciclagem de um dos
                                materiais mais comuns e importantes para o meio ambiente.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção 4: Dicas Importantes (Refatorado) -->
            <div class="max-w-4xl mx-auto mt-16">
                <div
                    class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 border border-emerald-700/30 rounded-2xl p-8">
                    <h2 class="text-3xl font-bold text-lime-400 text-center mb-6">
                        <i data-lucide="lightbulb" class="w-8 h-8 mr-2 inline-block"></i>
                        Dicas e Conexão Sustentável
                    </h2>

                    <div class="grid md:grid-cols-2 gap-6">

                        <!-- Dica 1: Prazo de Validade -->
                        <div class="flex items-start space-x-3">
                            <div
                                class="w-6 h-6 rounded-full bg-lime-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="clock" class="w-4 h-4 text-slate-900"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-emerald-300">Prazo de Validade</h3>
                                <p class="text-sm text-gray-300">Códigos expiram em 30 dias. Planeje seu resgate para
                                    garantir que o benefício seja utilizado e seu esforço não seja em vão.</p>
                            </div>
                        </div>

                        <!-- Dica 2: Reembolso -->
                        <div class="flex items-start space-x-3">
                            <div
                                class="w-6 h-6 rounded-full bg-lime-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="refresh-cw" class="w-4 h-4 text-slate-900"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-emerald-300">Reembolso Consciente</h3>
                                <p class="text-sm text-gray-300">Códigos não utilizados podem ser reembolsados antes do
                                    vencimento. Isso garante que seus pontos voltem para você, prontos para um novo resgate
                                    sustentável.</p>
                            </div>
                        </div>

                        <!-- Dica 3: Estoque Limitado -->
                        <div class="flex items-start space-x-3">
                            <div
                                class="w-6 h-6 rounded-full bg-lime-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="package" class="w-4 h-4 text-slate-900"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-emerald-300">Recompensas Sustentáveis</h3>
                                <p class="text-sm text-gray-300">Recompensas têm quantidades limitadas. Priorize as que
                                    promovem produtos e serviços ecológicos, maximizando seu impacto positivo.</p>
                            </div>
                        </div>

                        <!-- Dica 4: Acompanhamento -->
                        <div class="flex items-start space-x-3">
                            <div
                                class="w-6 h-6 rounded-full bg-lime-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <i data-lucide="eye" class="w-4 h-4 text-slate-900"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-emerald-300">Acompanhamento</h3>
                                <p class="text-sm text-gray-300">Acompanhe seus resgates na seção "Meus Resgates" para ter
                                    controle total sobre seus benefícios e o impacto gerado.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action (Refatorado) -->
            <div class="text-center mt-16">
                <a href="{{ route('rewards.dashboard') }}"
                    class="inline-flex items-center px-10 py-4 bg-lime-500 hover:bg-lime-600 text-slate-900 font-black rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg shadow-lime-500/30">
                    <i data-lucide="shopping-bag" class="w-5 h-5 mr-2"></i>
                    IR PARA O CATÁLOGO DE RECOMPENSAS
                </a>
                <p class="mt-4 text-gray-400 text-sm">Transforme seus pontos em benefícios que fazem a diferença para você
                    e para o planeta.</p>
            </div>
        </div>
    </div>
@endsection
