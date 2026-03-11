@extends('layouts.main')

@section('title', 'O Que Reciclar - Guia Definitivo')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Hero Section -->
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6">
                    O Que Reciclar: Guia Definitivo e Impacto Ambiental
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Aprenda a identificar, separar e descartar corretamente cada material, entendendo o ciclo de vida e o
                    impacto positivo de suas ações.
                </p>
            </div>

            <!-- Seção 1: As Cores da Coleta Seletiva (Visual Aprimorado) -->
            <div class="max-w-7xl mx-auto mb-20">
                <h2 class="text-3xl font-bold text-lime-400 mb-10 text-center">
                    O Código de Cores da Reciclagem (CONAMA 275/2001)
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                    <!-- Papel - Azul -->
                    <div
                        class="text-center p-6 rounded-2xl border border-blue-700/50 bg-blue-900/20 shadow-lg shadow-blue-900/30 transform hover:scale-105 transition duration-300">
                        <div class="w-20 h-20 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="file-text" class="w-10 h-10 text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-blue-400">AZUL</h3>
                        <p class="text-gray-300">Papel e Papelão</p>
                    </div>

                    <!-- Plástico - Vermelho -->
                    <div
                        class="text-center p-6 rounded-2xl border border-red-700/50 bg-red-900/20 shadow-lg shadow-red-900/30 transform hover:scale-105 transition duration-300">
                        <div class="w-20 h-20 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="package" class="w-10 h-10 text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-red-400">VERMELHO</h3>
                        <p class="text-gray-300">Plástico</p>
                    </div>

                    <!-- Vidro - Verde -->
                    <div
                        class="text-center p-6 rounded-2xl border border-green-700/50 bg-green-900/20 shadow-lg shadow-green-900/30 transform hover:scale-105 transition duration-300">
                        <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="flask-conical" class="w-10 h-10 text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-green-400">VERDE</h3>
                        <p class="text-gray-300">Vidro</p>
                    </div>

                    <!-- Metal - Amarelo -->
                    <div
                        class="text-center p-6 rounded-2xl border border-yellow-700/50 bg-yellow-900/20 shadow-lg shadow-yellow-900/30 transform hover:scale-105 transition duration-300">
                        <div class="w-20 h-20 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="hard-hat" class="w-10 h-10 text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-yellow-400">AMARELO</h3>
                        <p class="text-gray-300">Metal</p>
                    </div>
                </div>
            </div>

            <!-- Seção 2: Detalhamento dos Materiais (Layout de Abas/Acordeão Simulado com Cards) -->
            <div class="max-w-6xl mx-auto mb-20">
                <h2 class="text-3xl font-bold text-white mb-8 text-center">
                    Detalhe por Material: Ciclo de Vida e Impacto
                </h2>

                <div class="space-y-6">

                    <!-- Plástico (Vermelho) -->
                    <div class="bg-gradient-to-br from-slate-800 to-red-900/10 rounded-2xl p-6 border border-red-700/30">
                        <h3 class="text-2xl font-bold text-red-400 mb-4 flex items-center">
                            <i data-lucide="package" class="w-6 h-6 mr-3"></i>
                            Plástico: O Desafio da Longevidade
                        </h3>
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div class="lg:col-span-2">
                                <p class="text-gray-300 mb-4">
                                    O plástico é um material versátil, mas sua durabilidade é o seu maior problema
                                    ambiental. Derivado do petróleo, ele pode levar centenas de anos para se decompor. A
                                    reciclagem do plástico é vital, pois reduz a necessidade de extração de matéria-prima
                                    virgem e diminui a quantidade de resíduos em aterros e oceanos.
                                </p>
                                <h4 class="text-xl font-semibold text-lime-300 mb-2">O que Reciclar:</h4>
                                <p class="text-gray-400 mb-4">Garrafas PET, embalagens de produtos de limpeza, potes de
                                    iogurte, sacolas e filmes plásticos (desde que limpos e secos).</p>
                                <h4 class="text-xl font-semibold text-gray-400 mb-2">O que Evitar:</h4>
                                <p class="text-gray-400">Embalagens metalizadas (salgadinhos), adesivos, esponjas de louça e
                                    plásticos contaminados com óleo ou produtos químicos.</p>
                            </div>
                            <div class="bg-slate-900/50 p-4 rounded-xl border border-slate-700">
                                <h4 class="text-lg font-bold text-emerald-300 mb-2">Impacto da Reciclagem:</h4>
                                <ul class="list-disc list-inside text-gray-400 space-y-1 ml-4">
                                    <li>Redução do consumo de petróleo.</li>
                                    <li>Economia de até 70% de energia no reprocessamento.</li>
                                    <li>Diminuição da poluição de solos e águas.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Papel (Azul) -->
                    <div class="bg-gradient-to-br from-slate-800 to-blue-900/10 rounded-2xl p-6 border border-blue-700/30">
                        <h3 class="text-2xl font-bold text-blue-400 mb-4 flex items-center">
                            <i data-lucide="file-text" class="w-6 h-6 mr-3"></i>
                            Papel: Preservando Nossas Florestas
                        </h3>
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div class="lg:col-span-2">
                                <p class="text-gray-300 mb-4">
                                    A reciclagem de papel é uma das mais eficientes, pois o material pode ser reprocessado
                                    várias vezes. O benefício mais direto é a preservação de árvores e a redução do consumo
                                    de água e energia. A produção de papel reciclado utiliza cerca de 50% menos água e 74%
                                    menos poluentes do ar do que a produção de papel virgem.
                                </p>
                                <h4 class="text-xl font-semibold text-lime-300 mb-2">O que Reciclar:</h4>
                                <p class="text-gray-400 mb-4">Jornais, revistas, caixas de papelão, papéis de escritório,
                                    embalagens longa vida (limpas e secas).</p>
                                <h4 class="text-xl font-semibold text-gray-400 mb-2">O que Evitar:</h4>
                                <p class="text-gray-400">Papéis sujos ou engordurados, papel higiênico, guardanapos usados,
                                    papel carbono, fotografias e adesivos.</p>
                            </div>
                            <div class="bg-slate-900/50 p-4 rounded-xl border border-slate-700">
                                <h4 class="text-lg font-bold text-emerald-300 mb-2">Impacto da Reciclagem:</h4>
                                <ul class="list-disc list-inside text-gray-400 space-y-1 ml-4">
                                    <li>Preservação de árvores e ecossistemas.</li>
                                    <li>Redução de 50% no consumo de água.</li>
                                    <li>Diminuição de 74% dos poluentes liberados no ar.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Metal (Amarelo) -->
                    <div
                        class="bg-gradient-to-br from-slate-800 to-yellow-900/10 rounded-2xl p-6 border border-yellow-700/30">
                        <h3 class="text-2xl font-bold text-yellow-400 mb-4 flex items-center">
                            <i data-lucide="hard-hat" class="w-6 h-6 mr-3"></i>
                            Metal: O Campeão da Economia de Energia
                        </h3>
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div class="lg:col-span-2">
                                <p class="text-gray-300 mb-4">
                                    O metal, especialmente o alumínio, é um dos materiais mais valiosos e eficientes para
                                    reciclar. A reciclagem de uma única lata de alumínio economiza energia suficiente para
                                    manter uma TV ligada por 3 horas. Além disso, o metal pode ser reciclado infinitas vezes
                                    sem perder suas propriedades, reduzindo drasticamente a necessidade de mineração.
                                </p>
                                <h4 class="text-xl font-semibold text-lime-300 mb-2">O que Reciclar:</h4>
                                <p class="text-gray-400 mb-4">Latas de alumínio, latas de aço (limpas), tampas de metal,
                                    arames, pregos e parafusos.</p>
                                <h4 class="text-xl font-semibold text-gray-400 mb-2">O que Evitar:</h4>
                                <p class="text-gray-400">Esponjas de aço (palha de aço), latas de tintas ou solventes,
                                    pilhas e baterias (descarte especial).</p>
                            </div>
                            <div class="bg-slate-900/50 p-4 rounded-xl border border-slate-700">
                                <h4 class="text-lg font-bold text-emerald-300 mb-2">Impacto da Reciclagem:</h4>
                                <ul class="list-disc list-inside text-gray-400 space-y-1 ml-4">
                                    <li>Economia de até 95% de energia (alumínio).</li>
                                    <li>Redução da necessidade de mineração.</li>
                                    <li>Pode ser reciclado infinitas vezes.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Vidro (Verde) -->
                    <div
                        class="bg-gradient-to-br from-slate-800 to-green-900/10 rounded-2xl p-6 border border-green-700/30">
                        <h3 class="text-2xl font-bold text-green-400 mb-4 flex items-center">
                            <i data-lucide="flask-conical" class="w-6 h-6 mr-3"></i>
                            Vidro: Reciclagem 100% e Eterna
                        </h3>
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div class="lg:col-span-2">
                                <p class="text-gray-300 mb-4">
                                    O vidro é um material 100% reciclável e pode ser reprocessado inúmeras vezes sem perda
                                    de qualidade. O uso de cacos de vidro (vidro reciclado) no processo de fabricação reduz
                                    a temperatura necessária no forno, economizando cerca de 30% de energia e diminuindo a
                                    emissão de CO2.
                                </p>
                                <h4 class="text-xl font-semibold text-lime-300 mb-2">O que Reciclar:</h4>
                                <p class="text-gray-400 mb-4">Garrafas, potes de alimentos, frascos de cosméticos e cacos de
                                    vidro (embalados com segurança).</p>
                                <h4 class="text-xl font-semibold text-gray-400 mb-2">O que Evitar:</h4>
                                <p class="text-gray-400">Espelhos, lâmpadas, louças, cerâmicas, porcelanas e vidros
                                    temperados (automóveis).</p>
                            </div>
                            <div class="bg-slate-900/50 p-4 rounded-xl border border-slate-700">
                                <h4 class="text-lg font-bold text-emerald-300 mb-2">Impacto da Reciclagem:</h4>
                                <ul class="list-disc list-inside text-gray-400 space-y-1 ml-4">
                                    <li>100% do material é reaproveitado.</li>
                                    <li>Economia de 30% de energia na produção.</li>
                                    <li>Redução do volume de lixo em aterros.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção 3: Vídeos Educativos (Mídia Integrada) -->
            <div class="max-w-6xl mx-auto mb-20">
                <div class="bg-gradient-to-br from-slate-800 to-gray-900 rounded-2xl p-8 border border-gray-700">
                    <h2 class="text-3xl font-bold text-white mb-8 flex items-center justify-center">
                        <i data-lucide="video" class="w-8 h-8 text-lime-400 mr-3"></i>
                        Aprenda na Prática: O Ciclo da Reciclagem
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                        <!-- Vídeo 1: Cores da Coleta Seletiva -->
                        <div>
                            <div class="aspect-w-16 aspect-h-9 bg-black rounded-xl overflow-hidden mb-4">
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/HhXdMGs52EM"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <h3 class="text-xl font-bold text-emerald-300 mb-2">Quais as Cores das Lixeiras?</h3>
                            <p class="text-gray-400 text-sm">Vídeo educativo que explica de forma simples o significado de
                                cada cor da coleta seletiva.</p>
                        </div>

                        <!-- Vídeo 2: O Que Não Pode Ser Reciclado -->
                        <div>
                            <div class="aspect-w-16 aspect-h-9 bg-black rounded-xl overflow-hidden mb-4">
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/G_qyLmNkTfI"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <h3 class="text-xl font-bold text-emerald-300 mb-2">Reciclagem Não Funciona?</h3>
                            <p class="text-gray-400 text-sm">Entenda por que alguns materiais não são aceitos e como evitar
                                a contaminação do lixo reciclável.</p>
                        </div>

                        <!-- Vídeo 3: O Ciclo do Plástico -->
                        <div>
                            <div class="aspect-w-16 aspect-h-9 bg-black rounded-xl overflow-hidden mb-4">
                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/lgk52ealccs"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <h3 class="text-xl font-bold text-emerald-300 mb-2">O Ciclo do Plástico</h3>
                            <p class="text-gray-400 text-sm">Um olhar detalhado sobre o processo de reciclagem de um dos
                                materiais mais importantes.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção 4: Dicas Finais -->
            <div class="max-w-4xl mx-auto mt-16">
                <div
                    class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 border border-emerald-700/30 rounded-2xl p-8">
                    <h2 class="text-3xl font-bold text-lime-400 text-center mb-6">
                        <i data-lucide="lightbulb" class="w-8 h-8 mr-2 inline-block"></i>
                        Dicas Essenciais para o Descarte
                    </h2>

                    <div class="grid md:grid-cols-2 gap-6">

                        <div class="flex items-start space-x-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0"></i>
                            <p class="text-gray-300">Sempre remova o excesso de resíduos (restos de comida, óleo) das
                                embalagens.</p>
                        </div>

                        <div class="flex items-start space-x-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0"></i>
                            <p class="text-gray-300">Amasse latas e garrafas PET para reduzir o volume e otimizar o
                                transporte.</p>
                        </div>

                        <div class="flex items-start space-x-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0"></i>
                            <p class="text-gray-300">Embale vidros quebrados em caixas ou jornais para garantir a segurança
                                dos coletores.</p>
                        </div>

                        <div class="flex items-start space-x-3">
                            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-400 mt-1 flex-shrink-0"></i>
                            <p class="text-gray-300">Mantenha o papel seco e evite misturá-lo com outros materiais úmidos.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
