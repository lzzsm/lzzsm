@extends('layouts.main')

@section('title', 'Como Pontuar - Perseph')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Hero Section -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6">
                    Sua Ação, Seu Ponto, Nosso Planeta
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Transforme suas ações sustentáveis em pontos e benefícios reais, contribuindo ativamente para a economia
                    circular.
                </p>
            </div>

            <!-- Seção 1: O Ciclo da Pontuação (Passo a Passo Refatorado) -->
            <div class="max-w-5xl mx-auto mb-20">
                <h2 class="text-3xl font-bold text-white mb-10 text-center">
                    Como Funciona a Pontuação
                </h2>

                <div class="grid md:grid-cols-2 gap-8">

                    <!-- Passo 1 -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-8 rounded-2xl border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20">
                        <h3 class="text-2xl font-bold text-lime-400 mb-3 flex items-center">
                            <i data-lucide="map-pin" class="w-6 h-6 mr-2"></i>
                            1. Entregando Materiais
                        </h3>
                        <p class="text-gray-300">Leve seus materiais recicláveis separados e limpos a um Ponto de Coleta
                            cadastrado. A qualidade do material é crucial para a pontuação!</p>
                    </div>

                    <!-- Passo 2 -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-8 rounded-2xl border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20">
                        <h3 class="text-2xl font-bold text-lime-400 mb-3 flex items-center">
                            <i data-lucide="scale" class="w-6 h-6 mr-2"></i>
                            2. Pontos por Material e Peso
                        </h3>
                        <p class="text-gray-300">Cada tipo de material (plástico, papel, metal, vidro) possui uma pontuação
                            específica por peso (kg). O sistema calcula automaticamente o valor da sua contribuição no
                            momento da validação.</p>
                    </div>

                    <!-- Passo 3 -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-8 rounded-2xl border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20">
                        <h3 class="text-2xl font-bold text-lime-400 mb-3 flex items-center">
                            <i data-lucide="trending-up" class="w-6 h-6 mr-2"></i>
                            3. Frequência e Bônus
                        </h3>
                        <p class="text-gray-300">Quanto mais vezes você reciclar, maior será sua pontuação acumulada. Fique
                            atento aos desafios e metas extras que garantem bônus de pontos, incentivando a constância.</p>
                    </div>

                    <!-- Passo 4 -->
                    <div
                        class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-8 rounded-2xl border border-emerald-700/30 transition hover:shadow-xl hover:shadow-emerald-900/20">
                        <h3 class="text-2xl font-bold text-lime-400 mb-3 flex items-center">
                            <i data-lucide="gift" class="w-6 h-6 mr-2"></i>
                            4. Troque e Celebre
                        </h3>
                        <p class="text-gray-300">Use seus pontos no <a href="{{ route('rewards.dashboard') }}"
                                class="text-emerald-400 hover:text-lime-300 font-semibold">Catálogo de Recompensas</a> e
                            ganhe benefícios. Acompanhe seu progresso no ranking e inspire outros a fazerem o mesmo!</p>
                    </div>
                </div>
            </div>

            <!-- Seção 2: A Chave para a Pontuação Máxima (Conteúdo Educativo) -->
            <div class="max-w-6xl mx-auto mb-20">
                <div class="bg-gradient-to-br from-slate-800 to-gray-900 rounded-2xl p-8 border border-emerald-700/30">
                    <h2 class="text-3xl font-bold text-emerald-400 mb-6 text-center">
                        Separação Correta: O Segredo da Reciclagem Eficaz
                    </h2>
                    <p class="text-lg text-gray-300 mb-8 text-center max-w-4xl mx-auto">
                        Para garantir que seus materiais sejam aceitos e você receba a pontuação máxima, a **separação e a
                        limpeza** são etapas fundamentais. Materiais contaminados podem inviabilizar todo um lote de
                        reciclagem.
                    </p>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                        <!-- Card 1: Separação -->
                        <div class="bg-slate-900/50 rounded-xl p-6 border border-slate-700">
                            <h3 class="text-xl font-bold text-lime-300 mb-3 flex items-center">
                                <i data-lucide="split" class="w-5 h-5 mr-2"></i>
                                Como Separar
                            </h3>
                            <ul class="list-disc list-inside text-gray-400 space-y-2 ml-4">
                                <li>**Orgânicos vs. Recicláveis:** Mantenha sempre o lixo orgânico (restos de comida,
                                    cascas) separado dos recicláveis (papel, plástico, metal, vidro).</li>
                                <li>**Papel:** Não amasse, dobre. Papéis sujos (guardanapos usados, papel higiênico) não são
                                    recicláveis.</li>
                                <li>**Vidro:** Retire tampas e rótulos. Se quebrado, embale em jornal ou caixa para
                                    segurança.</li>
                                <li>**Plástico e Metal:** Retire o máximo de resíduos possível.</li>
                            </ul>
                        </div>

                        <!-- Card 2: Limpeza -->
                        <div class="bg-slate-900/50 rounded-xl p-6 border border-slate-700">
                            <h3 class="text-xl font-bold text-lime-300 mb-3 flex items-center">
                                <i data-lucide="droplet" class="w-5 h-5 mr-2"></i>
                                A Importância da Limpeza
                            </h3>
                            <p class="text-gray-400">
                                Não é necessário lavar as embalagens com água potável, mas é essencial **remover o excesso
                                de resíduos** (restos de comida, óleo). Uma rápida limpeza (raspar, passar um papel usado)
                                evita odores, a proliferação de insetos e, principalmente, a contaminação de outros
                                materiais.
                            </p>
                            <p class="text-gray-400 mt-2">
                                **Lembre-se:** Material limpo é material que tem maior chance de ser reciclado e,
                                consequentemente, de gerar mais pontos para você.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção 3: Vídeos Educativos (Mídia Integrada) -->
            <div class="max-w-6xl mx-auto mb-20">
                <div class="bg-gradient-to-br from-slate-800 to-gray-900 rounded-2xl p-8 border border-gray-700">
                    <h2 class="text-3xl font-bold text-white mb-8 flex items-center justify-center">
                        <i data-lucide="video" class="w-8 h-8 text-lime-400 mr-3"></i>
                        Assista e Aprenda: Separação Sem Erros
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                        <!-- Vídeo 1: Como Separar o Lixo -->
                        <div>
                            <div class="aspect-w-16 aspect-h-9 bg-black rounded-xl overflow-hidden mb-4">
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/aWsog1A5dbY"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <h3 class="text-xl font-bold text-emerald-300 mb-2">Guia Prático de Separação</h3>
                            <p class="text-gray-400 text-sm">Um passo a passo visual de como organizar o lixo em sua casa
                                para a coleta seletiva.</p>
                        </div>

                        <!-- Vídeo 2: Como Separar o Lixo Reciclável -->
                        <div>
                            <div class="aspect-w-16 aspect-h-9 bg-black rounded-xl overflow-hidden mb-4">
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/KME93xzhWlE"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <h3 class="text-xl font-bold text-emerald-300 mb-2">O que Vai e o que Não Vai</h3>
                            <p class="text-gray-400 text-sm">Entenda as regras básicas e evite erros comuns que comprometem
                                a reciclagem.</p>
                        </div>

                        <!-- Vídeo 3: É Preciso Lavar? -->
                        <div>
                            <div class="aspect-w-16 aspect-h-9 bg-black rounded-xl overflow-hidden mb-4">
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/gwZ7e6yHlWQ"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <h3 class="text-xl font-bold text-emerald-300 mb-2">Dúvida Sem Lixo: Lavar Embalagens</h3>
                            <p class="text-gray-400 text-sm">Descubra a importância da higienização e como fazê-la de forma
                                eficiente e sustentável.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center mt-16">
                <a href="{{ route('collect-points.dashboard') }}"
                    class="inline-flex items-center px-10 py-4 bg-lime-500 hover:bg-lime-600 text-slate-900 font-black rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg shadow-lime-500/30">
                    <i data-lucide="map-pin" class="w-5 h-5 mr-2"></i>
                    ENCONTRE O PONTO DE COLETA MAIS PRÓXIMO
                </a>
                <p class="mt-4 text-gray-400 text-sm">Comece a pontuar agora e faça a diferença!</p>
            </div>
        </div>
    </div>
@endsection
