@extends('layouts.guest')

@section('title', 'Central de Ajuda - Perseph')

@section('content')
    <div class="bg-slate-900 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Cabeçalho -->
            <div class="relative text-center mb-16">
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6">
                    Central de <span
                        class="bg-gradient-to-r from-lime-400 to-emerald-400 bg-clip-text text-transparent">Ajuda</span>
                </h1>
                <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                    Encontre soluções rápidas e respostas para as dúvidas mais comuns sobre nossa plataforma de
                    sustentabilidade.
                </p>

                <!-- Botão Voltar -->
                <div class="absolute top-0 left-0">
                    <button onclick="window.history.back()" title="Voltar"
                        class="group flex items-center justify-center w-12 h-12 bg-gradient-to-br from-slate-800/50 to-emerald-900/50 border border-emerald-700/30 rounded-full hover:bg-emerald-800/50 hover:border-lime-400/30 transition-all duration-300">
                        <i data-lucide="arrow-left"
                            class="w-6 h-6 text-lime-400 group-hover:text-lime-300 transition-colors"></i>
                    </button>
                </div>
            </div>

            <!-- Grid de Categorias -->
            <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">

                <!-- Sistema de Pontos -->
                <div
                    class="bg-gradient-to-br from-slate-800/50 to-emerald-900/50 rounded-2xl p-8 border border-emerald-700/30">
                    <div class="text-center mb-6">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-lime-400 to-emerald-400 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="star" class="w-8 h-8 text-slate-900"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-2">Sistema de Pontos</h2>
                        <p class="text-gray-400">Aprenda a ganhar e usar seus pontos</p>
                    </div>

                    <div class="space-y-4">
                        <div class="faq-item">
                            <button
                                class="faq-toggle w-full text-left p-4 rounded-xl bg-slate-700/30 hover:bg-slate-600/30 transition-colors border border-transparent hover:border-lime-400/20">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-semibold text-white">Como ganho pontos?</h3>
                                    <i data-lucide="chevron-down"
                                        class="faq-icon w-5 h-5 text-lime-400 transition-transform"></i>
                                </div>
                            </button>
                            <div class="faq-content mt-3 hidden">
                                <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700">
                                    <p class="text-gray-300 mb-3">Você acumula pontos ao descartar materiais recicláveis nos
                                        pontos de coleta parceiros:</p>
                                    <ul class="text-gray-300 space-y-2 text-sm">
                                        <li class="flex items-center"><i data-lucide="check"
                                                class="w-4 h-4 text-lime-400 mr-2"></i> Plástico PET: 10 pontos/kg</li>
                                        <li class="flex items-center"><i data-lucide="check"
                                                class="w-4 h-4 text-lime-400 mr-2"></i> Alumínio: 15 pontos/kg</li>
                                        <li class="flex items-center"><i data-lucide="check"
                                                class="w-4 h-4 text-lime-400 mr-2"></i> Vidro: 8 pontos/kg</li>
                                        <li class="flex items-center"><i data-lucide="check"
                                                class="w-4 h-4 text-lime-400 mr-2"></i> Papelão: 12 pontos/kg</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button
                                class="faq-toggle w-full text-left p-4 rounded-xl bg-slate-700/30 hover:bg-slate-600/30 transition-colors border border-transparent hover:border-lime-400/20">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-semibold text-white">Meus pontos sumiram</h3>
                                    <i data-lucide="chevron-down"
                                        class="faq-icon w-5 h-5 text-lime-400 transition-transform"></i>
                                </div>
                            </button>
                            <div class="faq-content mt-3 hidden">
                                <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700">
                                    <p class="text-gray-300 mb-3">Se seus pontos não aparecem, verifique:</p>
                                    <ul class="text-gray-300 space-y-2 text-sm">
                                        <li class="flex items-center"><i data-lucide="clock"
                                                class="w-4 h-4 text-lime-400 mr-2"></i> Aguarde até 24h para processamento
                                        </li>
                                        <li class="flex items-center"><i data-lucide="map-pin"
                                                class="w-4 h-4 text-lime-400 mr-2"></i> Confirme se foi ponto parceiro</li>
                                        <li class="flex items-center"><i data-lucide="calendar"
                                                class="w-4 h-4 text-lime-400 mr-2"></i> Verifique validade (12 meses)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recompensas -->
                <div
                    class="bg-gradient-to-br from-slate-800/50 to-emerald-900/50 rounded-2xl p-8 border border-emerald-700/30">
                    <div class="text-center mb-6">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-lime-400 to-emerald-400 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="gift" class="w-8 h-8 text-slate-900"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-2">Recompensas</h2>
                        <p class="text-gray-400">Troque seus pontos por benefícios</p>
                    </div>

                    <div class="space-y-4">
                        <div class="faq-item">
                            <button
                                class="faq-toggle w-full text-left p-4 rounded-xl bg-slate-700/30 hover:bg-slate-600/30 transition-colors border border-transparent hover:border-lime-400/20">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-semibold text-white">Como trocar pontos?</h3>
                                    <i data-lucide="chevron-down"
                                        class="faq-icon w-5 h-5 text-lime-400 transition-transform"></i>
                                </div>
                            </button>
                            <div class="faq-content mt-3 hidden">
                                <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700">
                                    <p class="text-gray-300 mb-3">Para trocar seus pontos por recompensas:</p>
                                    <ol class="text-gray-300 space-y-2 text-sm">
                                        <li class="flex items-start"><span
                                                class="bg-lime-400 text-slate-900 rounded-full w-5 h-5 text-xs flex items-center justify-center mr-2 mt-0.5">1</span>
                                            Acesse a seção "Recompensas"</li>
                                        <li class="flex items-start"><span
                                                class="bg-lime-400 text-slate-900 rounded-full w-5 h-5 text-xs flex items-center justify-center mr-2 mt-0.5">2</span>
                                            Escolha a recompensa desejada</li>
                                        <li class="flex items-start"><span
                                                class="bg-lime-400 text-slate-900 rounded-full w-5 h-5 text-xs flex items-center justify-center mr-2 mt-0.5">3</span>
                                            Confirme a troca de pontos</li>
                                        <li class="flex items-start"><span
                                                class="bg-lime-400 text-slate-900 rounded-full w-5 h-5 text-xs flex items-center justify-center mr-2 mt-0.5">4</span>
                                            Siga as instruções de resgate</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button
                                class="faq-toggle w-full text-left p-4 rounded-xl bg-slate-700/30 hover:bg-slate-600/30 transition-colors border border-transparent hover:border-lime-400/20">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-semibold text-white">Prazo das recompensas</h3>
                                    <i data-lucide="chevron-down"
                                        class="faq-icon w-5 h-5 text-lime-400 transition-transform"></i>
                                </div>
                            </button>
                            <div class="faq-content mt-3 hidden">
                                <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700">
                                    <p class="text-gray-300">Cada empresa parceira define a validade de suas ofertas. Sempre
                                        verifique a data de expiração na descrição da recompensa antes de confirmar a troca.
                                    </p>
                                    <div class="mt-3 p-3 bg-amber-900/20 rounded-lg border border-amber-700/30">
                                        <p class="text-amber-300 text-sm flex items-center">
                                            <i data-lucide="alert-triangle" class="w-4 h-4 mr-2"></i>
                                            Recompensas expiradas não podem ser reembolsadas
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pontos de Coleta -->
                <div
                    class="bg-gradient-to-br from-slate-800/50 to-emerald-900/50 rounded-2xl p-8 border border-emerald-700/30">
                    <div class="text-center mb-6">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-lime-400 to-emerald-400 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="map-pin" class="w-8 h-8 text-slate-900"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-2">Pontos de Coleta</h2>
                        <p class="text-gray-400">Encontre onde descartar seus recicláveis</p>
                    </div>

                    <div class="space-y-4">
                        <div class="faq-item">
                            <button
                                class="faq-toggle w-full text-left p-4 rounded-xl bg-slate-700/30 hover:bg-slate-600/30 transition-colors border border-transparent hover:border-lime-400/20">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-semibold text-white">Encontrar pontos de coleta</h3>
                                    <i data-lucide="chevron-down"
                                        class="faq-icon w-5 h-5 text-lime-400 transition-transform"></i>
                                </div>
                            </button>
                            <div class="faq-content mt-3 hidden">
                                <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700">
                                    <p class="text-gray-300 mb-3">Para encontrar pontos de coleta próximos:</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                        <div class="text-center p-3 bg-emerald-900/20 rounded-lg">
                                            <i data-lucide="map" class="w-6 h-6 text-lime-400 mx-auto mb-2"></i>
                                            <p class="text-gray-300 text-sm">Mapa Interativo</p>
                                        </div>
                                        <div class="text-center p-3 bg-emerald-900/20 rounded-lg">
                                            <i data-lucide="list" class="w-6 h-6 text-lime-400 mx-auto mb-2"></i>
                                            <p class="text-gray-300 text-sm">Lista Completa</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-300 text-sm">Acesse a dashboard de "Pontos de Coleta" para
                                        visualizar todos os locais parceiros com endereços, horários e instruções.</p>
                                </div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button
                                class="faq-toggle w-full text-left p-4 rounded-xl bg-slate-700/30 hover:bg-slate-600/30 transition-colors border border-transparent hover:border-lime-400/20">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-semibold text-white">Agendar descartes</h3>
                                    <i data-lucide="chevron-down"
                                        class="faq-icon w-5 h-5 text-lime-400 transition-transform"></i>
                                </div>
                            </button>
                            <div class="faq-content mt-3 hidden">
                                <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700">
                                    <p class="text-gray-300">Alguns pontos de coleta permitem agendamento prévio. No mapa
                                        interativo, clique no ponto desejado e verifique se a opção "Agendar" está
                                        disponível.</p>
                                    <div class="mt-3 p-3 bg-emerald-900/20 rounded-lg border border-emerald-700/30">
                                        <p class="text-lime-300 text-sm flex items-center">
                                            <i data-lucide="info" class="w-4 h-4 mr-2"></i>
                                            Agendamento garante seu horário e evita filas
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Conta e Privacidade -->
                <div
                    class="bg-gradient-to-br from-slate-800/50 to-emerald-900/50 rounded-2xl p-8 border border-emerald-700/30">
                    <div class="text-center mb-6">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-lime-400 to-emerald-400 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="user" class="w-8 h-8 text-slate-900"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-2">Conta & Privacidade</h2>
                        <p class="text-gray-400">Gerencie seus dados e configurações</p>
                    </div>

                    <div class="space-y-4">
                        <div class="faq-item">
                            <button
                                class="faq-toggle w-full text-left p-4 rounded-xl bg-slate-700/30 hover:bg-slate-600/30 transition-colors border border-transparent hover:border-lime-400/20">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-semibold text-white">Alterar dados cadastrais</h3>
                                    <i data-lucide="chevron-down"
                                        class="faq-icon w-5 h-5 text-lime-400 transition-transform"></i>
                                </div>
                            </button>
                            <div class="faq-content mt-3 hidden">
                                <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700">
                                    <p class="text-gray-300 mb-3">Para atualizar suas informações:</p>
                                    <ol class="text-gray-300 space-y-2 text-sm">
                                        <li class="flex items-start"><span
                                                class="bg-lime-400 text-slate-900 rounded-full w-5 h-5 text-xs flex items-center justify-center mr-2 mt-0.5">1</span>
                                            Acesse seu perfil</li>
                                        <li class="flex items-start"><span
                                                class="bg-lime-400 text-slate-900 rounded-full w-5 h-5 text-xs flex items-center justify-center mr-2 mt-0.5">2</span>
                                            Clique em "Editar Perfil"</li>
                                        <li class="flex items-start"><span
                                                class="bg-lime-400 text-slate-900 rounded-full w-5 h-5 text-xs flex items-center justify-center mr-2 mt-0.5">3</span>
                                            Atualize nome e e-mail</li>
                                        <li class="flex items-start"><span
                                                class="bg-lime-400 text-slate-900 rounded-full w-5 h-5 text-xs flex items-center justify-center mr-2 mt-0.5">4</span>
                                            Salve as alterações</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <button
                                class="faq-toggle w-full text-left p-4 rounded-xl bg-slate-700/30 hover:bg-slate-600/30 transition-colors border border-transparent hover:border-lime-400/20">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-semibold text-white">Excluir minha conta</h3>
                                    <i data-lucide="chevron-down"
                                        class="faq-icon w-5 h-5 text-lime-400 transition-transform"></i>
                                </div>
                            </button>
                            <div class="faq-content mt-3 hidden">
                                <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700">
                                    <p class="text-gray-300 mb-3">Para solicitar a exclusão da sua conta:</p>
                                    <div class="p-3 bg-rose-900/20 rounded-lg border border-rose-700/30 mb-3">
                                        <p class="text-rose-300 text-sm flex items-center">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i>
                                            Esta ação é irreversível e excluirá todos os seus dados
                                        </p>
                                    </div>
                                    <p class="text-gray-300 text-sm">Entre em contato com nosso suporte através do e-mail:
                                    </p>
                                    <a href="mailto:l.melozi@aluno.ifsp.edu.br"
                                        class="text-lime-400 font-semibold text-lg hover:text-lime-300 transition-colors block mt-2">
                                        l.melozi@aluno.ifsp.edu.br
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção de Contato -->
            <div class="max-w-4xl mx-auto text-center">
                <div
                    class="bg-gradient-to-r from-emerald-900/20 to-lime-900/20 rounded-2xl p-12 border border-emerald-700/30">
                    <i data-lucide="life-buoy" class="mx-auto h-16 w-16 text-lime-400 mb-6"></i>
                    <h3 class="text-3xl font-bold text-white mb-4">Precisa de mais ajuda?</h3>
                    <p class="text-gray-400 text-lg mb-8 max-w-2xl mx-auto">
                        Nossa equipe de suporte está pronta para te ajudar com qualquer dúvida ou problema que você possa
                        ter.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="mailto:l.melozi@aluno.ifsp.edu.br"
                            class="bg-gradient-to-r from-lime-400 to-emerald-400 text-slate-900 font-bold py-4 px-8 rounded-full hover:opacity-90 transition-opacity flex items-center justify-center text-lg">
                            <i data-lucide="mail" class="mr-3 h-6 w-6"></i>
                            Enviar Email
                        </a>
                        <a href="{{ route('support.faq') }}"
                            class="bg-slate-800 text-white font-bold py-4 px-8 rounded-full border border-emerald-700/30 hover:bg-slate-700 transition-colors flex items-center justify-center text-lg">
                            <i data-lucide="help-circle" class="mr-3 h-6 w-6"></i>
                            Ver FAQ Completo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Accordion Functionality
            document.querySelectorAll('.faq-toggle').forEach(button => {
                button.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    const icon = this.querySelector('.faq-icon');

                    // Close all others in the same category
                    const category = this.closest('.bg-gradient-to-br');
                    category.querySelectorAll('.faq-content').forEach(item => {
                        if (item !== content && !item.classList.contains('hidden')) {
                            item.classList.add('hidden');
                            item.previousElementSibling.querySelector('.faq-icon').classList
                                .remove('rotate-180');
                        }
                    });

                    // Toggle current
                    content.classList.toggle('hidden');
                    icon.classList.toggle('rotate-180');
                });
            });
        });
    </script>

    <style>
        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
@endsection
