@extends('layouts.main')

@section('title', 'Quiz - Perseph')

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-white tracking-tight">🧠 Quiz</h1>
                <p class="mt-3 text-lg text-gray-400">
                    Teste seus conhecimentos sobre sustentabilidade
                </p>
            </div>

            <!-- Card do Quiz -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-gradient-to-b from-gray-800 to-slate-900 rounded-2xl shadow-xl border border-gray-700/50 p-8">

                    <!-- Estado: Início -->
                    <div id="quiz-start" class="text-center">
                        <div class="w-20 h-20 mx-auto mb-6 bg-emerald-800 rounded-full flex items-center justify-center">
                            <i data-lucide="brain" class="w-10 h-10 text-lime-400"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Quiz de Sustentabilidade</h3>
                        <p class="text-gray-400 mb-6">
                            Responda 5 perguntas sobre meio ambiente e sustentabilidade.
                        </p>
                        <button onclick="iniciarQuiz()"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-lg transition-colors flex items-center mx-auto">
                            <i data-lucide="play" class="w-5 h-5 mr-2"></i>
                            Começar Quiz
                        </button>
                    </div>

                    <!-- Estado: Perguntas -->
                    <div id="quiz-questions" class="hidden">
                        <div class="mb-6">
                            <div class="flex justify-between text-sm text-gray-400 mb-2">
                                <span>Pergunta <span id="current-question">1</span> de 5</span>
                                <span id="quiz-score">0 pontos</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div id="progress-bar" class="bg-lime-400 h-2 rounded-full transition-all"
                                    style="width: 20%"></div>
                            </div>
                        </div>

                        <h3 id="question-text" class="text-xl font-bold text-white mb-6 text-center"></h3>

                        <div class="space-y-3 mb-6" id="answers-container">
                            <!-- Alternativas aparecem aqui -->
                        </div>

                        <button onclick="proximaPergunta()" id="next-btn"
                            class="w-full bg-gray-700 hover:bg-gray-600 text-white font-medium py-3 rounded-lg transition-colors hidden">
                            Próxima Pergunta
                        </button>
                    </div>

                    <!-- Estado: Resultado -->
                    <div id="quiz-result" class="hidden text-center">
                        <div class="text-6xl mb-4">🎉</div>
                        <h3 class="text-2xl font-bold text-white mb-2" id="result-title"></h3>
                        <p class="text-gray-400 mb-6" id="result-message"></p>

                        <div class="bg-gray-800 rounded-lg p-6 mb-6">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-2xl font-bold text-lime-400" id="final-score">0</div>
                                    <div class="text-sm text-gray-400">Pontuação</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-lime-400" id="correct-answers">0/5</div>
                                    <div class="text-sm text-gray-400">Acertos</div>
                                </div>
                            </div>
                        </div>

                        <button onclick="reiniciarQuiz()"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                            <i data-lucide="refresh-cw" class="w-4 h-4 inline mr-2"></i>
                            Fazer Quiz Novamente
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

<script>
    let quiz = {
        perguntas: [],
        perguntaAtual: 0,
        score: 0,
        acertos: 0
    };

    // Perguntas fixas sobre sustentabilidade
    const perguntasFixas = [{
            pergunta: "Qual material leva MAIS tempo para se decompor na natureza?",
            alternativas: ["Papel", "Plástico", "Vidro", "Orgânico"],
            correta: 2
        },
        {
            pergunta: "Qual destes NÃO é um tipo de energia renovável?",
            alternativas: ["Solar", "Eólica", "Nuclear", "Hidrelétrica"],
            correta: 2
        },
        {
            pergunta: "O que significa a sigla 'ODS'?",
            alternativas: [
                "Organização para Desenvolvimento Social",
                "Objetivos de Desenvolvimento Sustentável",
                "Ordem de Sustentabilidade",
                "Ocupação de Direitos Sociais"
            ],
            correta: 1
        },
        {
            pergunta: "Qual destes é um exemplo de prática sustentável?",
            alternativas: [
                "Usar copos descartáveis todos os dias",
                "Separar o lixo para reciclagem",
                "Deixar as luzes acesas ao sair",
                "Comprar produtos com excesso de embalagem"
            ],
            correta: 1
        },
        {
            pergunta: "Qual o principal gás do efeito estufa?",
            alternativas: ["Oxigênio", "Nitrogênio", "Dióxido de Carbono", "Hélio"],
            correta: 2
        }
    ];

    function iniciarQuiz() {
        quiz = {
            perguntas: perguntasFixas,
            perguntaAtual: 0,
            score: 0,
            acertos: 0
        };

        document.getElementById('quiz-start').classList.add('hidden');
        document.getElementById('quiz-questions').classList.remove('hidden');

        mostrarPergunta(0);
    }

    function mostrarPergunta(index) {
        const pergunta = quiz.perguntas[index];

        // Atualizar progresso
        document.getElementById('current-question').textContent = index + 1;
        document.getElementById('progress-bar').style.width = `${((index + 1) / quiz.perguntas.length) * 100}%`;
        document.getElementById('quiz-score').textContent = `${quiz.score} pontos`;

        // Mostrar pergunta
        document.getElementById('question-text').textContent = pergunta.pergunta;

        // Mostrar alternativas
        const container = document.getElementById('answers-container');
        container.innerHTML = pergunta.alternativas.map((alt, i) => `
            <button onclick="selecionarResposta(${i}, ${pergunta.correta})"
                    class="w-full bg-gray-800 hover:bg-gray-700 border-2 border-gray-700 text-white text-left p-4 rounded-lg transition-colors text-lg">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-3">
                        <span class="font-medium">${String.fromCharCode(65 + i)}</span>
                    </div>
                    <span>${alt}</span>
                </div>
            </button>
        `).join('');

        // Esconder botão próximo
        document.getElementById('next-btn').classList.add('hidden');
    }

    function selecionarResposta(selecionada, correta) {
        const botoes = document.querySelectorAll('#answers-container button');

        botoes.forEach((botao, index) => {
            botao.disabled = true;

            if (index === correta) {
                botao.classList.add('border-green-500', 'bg-green-900/20');
            } else if (index === selecionada) {
                botao.classList.add('border-red-500', 'bg-red-900/20');
            }
        });

        // Atualizar pontuação
        if (selecionada === correta) {
            quiz.score += 100;
            quiz.acertos++;
        }

        document.getElementById('quiz-score').textContent = `${quiz.score} pontos`;
        document.getElementById('next-btn').classList.remove('hidden');
    }

    function proximaPergunta() {
        quiz.perguntaAtual++;

        if (quiz.perguntaAtual < quiz.perguntas.length) {
            mostrarPergunta(quiz.perguntaAtual);
        } else {
            mostrarResultado();
        }
    }

    function mostrarResultado() {
        document.getElementById('quiz-questions').classList.add('hidden');
        document.getElementById('quiz-result').classList.remove('hidden');

        document.getElementById('final-score').textContent = quiz.score;
        document.getElementById('correct-answers').textContent = `${quiz.acertos}/${quiz.perguntas.length}`;

        // Mensagem baseada no desempenho
        if (quiz.acertos >= 4) {
            document.getElementById('result-title').textContent = 'Excelente! 🎉';
            document.getElementById('result-message').textContent = 'Você sabe muito sobre sustentabilidade!';
        } else if (quiz.acertos >= 3) {
            document.getElementById('result-title').textContent = 'Muito bom! 👍';
            document.getElementById('result-message').textContent = 'Você tem bons conhecimentos!';
        } else {
            document.getElementById('result-title').textContent = 'Bom trabalho! 💪';
            document.getElementById('result-message').textContent = 'Continue aprendendo sobre sustentabilidade!';
        }
    }

    function reiniciarQuiz() {
        document.getElementById('quiz-result').classList.add('hidden');
        document.getElementById('quiz-start').classList.remove('hidden');
    }

    // Inicializar ícones
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
