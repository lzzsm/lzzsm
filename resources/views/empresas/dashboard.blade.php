@extends('layouts.main')

@section('title', 'Nosso Ecossistema de Parceiros')

@section('content')
    <div class="bg-slate-900 text-gray-200 overflow-x-hidden">

        <!-- SEÇÃO 1: O MANIFESTO (Contêiner Padrão) -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-base font-semibold text-lime-400 tracking-wider uppercase">Nosso Ecossistema</h2>
                <p class="mt-2 text-4xl md:text-5xl font-extrabold text-white tracking-tight">
                    Juntos, Construímos o Futuro da Sustentabilidade.
                </p>
                <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-400 leading-8">
                    Nossos parceiros não são apenas clientes; são co-autores da nossa missão. Cada empresa em nosso
                    ecossistema é uma peça fundamental na engrenagem da inovação, investindo em tecnologia e processos que
                    transformam resíduos em recursos e consciência em ação.
                </p>
            </div>
        </div>

        <!-- SEÇÃO 2: A TECNOLOGIA COMPARTILHADA (Contêiner Largo) -->
        <div class="py-20 bg-black/20">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <i data-lucide="cpu" class="mx-auto h-12 w-12 text-emerald-400"></i>
                <h3 class="mt-4 text-3xl font-bold text-white">Tecnologia como Pilar da Transformação</h3>
                <p class="mt-4 text-lg text-gray-400 leading-8">
                    Acreditamos que a tecnologia é a maior aliada do meio ambiente. Por isso, oferecemos aos nossos
                    parceiros acesso a uma plataforma de dados robusta, que permite rastrear o ciclo de vida dos resíduos,
                    otimizar a logística de coleta e gerar relatórios de impacto precisos. Eles não apenas cumprem metas de
                    sustentabilidade; eles as definem, usando dados para tomar decisões mais inteligentes e eficientes.
                </p>
            </div>
        </div>

        <!-- SEÇÃO 3: O IMPACTO NA COMUNIDADE (Contêiner Padrão) -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="max-w-3xl mx-auto text-center">
                <i data-lucide="heart-handshake" class="mx-auto h-12 w-12 text-rose-400"></i>
                <h3 class="mt-4 text-3xl font-bold text-white">Mais que Reciclagem, um Movimento Social</h3>
                <p class="mt-4 text-lg text-gray-400 leading-8">
                    Cada anúncio, cada recompensa oferecida por nossos parceiros, reverbera pela nossa comunidade. Eles são
                    a ponte que conecta o descarte correto a benefícios reais, incentivando milhares de usuários a adotarem
                    hábitos mais conscientes. O engajamento gerado por eles transforma a reciclagem de uma obrigação em uma
                    cultura participativa e recompensadora.
                </p>
            </div>
        </div>

        <!-- SEÇÃO 4: A GALERIA DE PARCEIROS (Contêiner Full-Width) -->
        <div class="py-20 bg-black/20">
            <div class="text-center mb-16">
                <h3 class="text-3xl font-bold text-white">Conheça os Arquitetos da Mudança</h3>
                <p class="mt-2 text-lg text-gray-400">Empresas que lideram pelo exemplo.</p>
            </div>

            @if ($empresas->isEmpty())
                <div class="text-center py-16 px-4">
                    <i data-lucide="shield-off" class="mx-auto h-12 w-12 text-gray-500"></i>
                    <p class="mt-4 text-xl text-gray-500">Nosso ecossistema está em formação. Volte em breve!</p>
                </div>
            @else
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($empresas as $empresa)
                            <div
                                class="group relative rounded-2xl overflow-hidden border-2 border-gray-800 hover:border-lime-400/50 transition-all duration-300">
                                <a href="{{ route('empresas.show', $empresa->id) }}" class="block">
                                    <div class="h-80 w-full">
                                        @if ($empresa->user->profile_photo_path)
                                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 ease-out group-hover:scale-110"
                                                style="background-image: url('{{ asset('storage/' . $empresa->user->profile_photo_path) }}')">
                                            </div>
                                        @else
                                            <div class="absolute inset-0 bg-emerald-900"></div>
                                        @endif
                                    </div>
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/70 to-transparent">
                                    </div>
                                    <div class="absolute inset-0 p-6 flex flex-col justify-end">
                                        <h3 class="text-2xl font-bold text-white">{{ $empresa->user->name }}</h3>
                                        <p
                                            class="mt-2 text-gray-400 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            {{ Str::limit($empresa->descricao ?? 'Parceiro dedicado à sustentabilidade e inovação.', 80) }}
                                        </p>
                                        <div class="absolute top-4 right-4">
                                            <span
                                                class="flex items-center py-1 px-3 bg-slate-900/50 backdrop-blur-sm rounded-full text-xs text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <i data-lucide="arrow-up-right" class="w-4 h-4 mr-1"></i>
                                                Ver Perfil
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-16">
                        {{ $empresas->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
