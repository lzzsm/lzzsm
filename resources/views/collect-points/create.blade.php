@extends('layouts.guest')

@section('title', 'Cadastrar Ponto de Coleta')

@section('content')

    <div class="relative min-h-screen flex">
        <a href="{{ route('home') }}" class="absolute top-5 left-7 z-50">
            <img src="{{ asset('img/logo_txt_perseph.png') }}" alt="Perseph" class="w-40" />
        </a>

        <div
            class="flex flex-col sm:flex-row items-center md:items-start sm:justify-center md:justify-start flex-auto min-w-0 bg-white">
            <div class="sm:w-1/2 xl:w-2/5 h-full hidden md:flex flex-auto items-center justify-start p-10 overflow-hidden text-white bg-no-repeat bg-cover relative"
                style="background-image: url('https://www.neoenergia.com/documents/d/guest/simbolo-da-reciclagem-jpg' );">
                <div class="absolute bg-gradient-to-b from-emerald-950 to-slate-900 opacity-75 inset-0 z-0"></div>
                <div class="absolute triangle max-h-screen right-0 w-16 bg-gradient-to-b from-emerald-700 to-slate-950">
                </div>
                <img src="{{ asset('img/reciclagem.png') }}" class="h-96 absolute right-1">
                <div class="w-full max-w-md z-10">
                    <div class="sm:text-4xl xl:text-5xl font-bold leading-tight mb-6">Cadastre um Ponto de Coleta</div>
                    <div class="sm:text-sm xl:text-md text-gray-200 font-normal">Sua contribuição é fundamental para o
                        sucesso da reciclagem. Informe os dados do novo ponto e ajude a construir um futuro mais verde.
                    </div>
                </div>
                <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>

            <div
                class="md:flex md:items-center md:justify-center w-full sm:w-auto md:h-full w-2/5 xl:w-2/5 p-8 md:p-10 lg:p-14 sm:rounded-lg md:rounded-none bg-gradient-to-b from-emerald-700 to-slate-950">
                <div class="max-w-md w-full space-y-8">
                    <div class="text-center">
                        <h2 class="mt-6 text-3xl font-bold text-lime-400">Novo Ponto de Coleta</h2>
                        <p class="mt-2 text-sm text-slate-300">Preencha os dados do local</p>
                    </div>

                    <form class="mt-8 space-y-6" method="POST" action="{{ route('collect-points.store') }}">
                        @csrf

                        <!-- BUSCA AUTOMÁTICA POR ENDEREÇO -->
                        <div class="bg-emerald-900/50 p-4 rounded-lg border border-emerald-700">
                            <h3 class="text-lg font-semibold text-lime-300 mb-3 flex items-center">
                                <i data-lucide="search" class="w-5 h-5 mr-2"></i>
                                Busca Automática de Endereço
                            </h3>

                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-green-300 mb-1">
                                        Digite o endereço completo:
                                    </label>
                                    <div class="flex gap-2">
                                        <input type="text" id="enderecoBusca"
                                            placeholder="Ex: Avenida Paulista 1000, São Paulo, SP"
                                            class="flex-1 bg-emerald-800 border border-emerald-600 text-white rounded-lg px-3 py-2 text-sm placeholder-emerald-400">
                                        <button type="button" onclick="buscarEndereco()"
                                            class="bg-lime-500 hover:bg-lime-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center">
                                            <i data-lucide="search" class="w-4 h-4 mr-1"></i>
                                            Buscar
                                        </button>
                                    </div>
                                    <p class="text-xs text-emerald-300 mt-1">
                                        💡 <strong>Dica:</strong> Inclua o número! Ex: "Avenida Paulista
                                        <strong>1000</strong>"
                                    </p>
                                </div>

                                <!-- Loading e Resultados -->
                                <div id="loading" class="hidden text-center py-2">
                                    <div class="flex items-center justify-center text-lime-400">
                                        <i data-lucide="loader-2" class="w-4 h-4 mr-2 animate-spin"></i>
                                        Buscando endereço...
                                    </div>
                                </div>

                                <div id="resultado" class="hidden text-sm p-3 rounded border">
                                    <!-- Resultado aparecerá aqui -->
                                </div>
                            </div>
                        </div>

                        <!-- Linha 1: Nome do Ponto e CEP -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nome" class="ml-3 text-sm font-bold text-green-400 tracking-wide">Nome do
                                    Ponto</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                            data-lucide="map-pin" class="h-5 w-5 text-gray-400"></i></div>
                                    <input id="nome" name="nome" type="text" required
                                        class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 @error('nome') border-red-500 @else border-emerald-900 @enderror"
                                        placeholder="Ex: Ponto Central" value="{{ old('nome') }}">
                                </div>
                                @error('nome')
                                    <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="cep"
                                    class="ml-3 text-sm font-bold text-green-400 tracking-wide">CEP</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                            data-lucide="mailbox" class="h-5 w-5 text-gray-400"></i></div>
                                    <input id="cep" name="cep" type="text" required
                                        class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 bg-emerald-800 @error('cep') border-red-500 @else border-emerald-900 @enderror"
                                        placeholder="00000-000" value="{{ old('cep') }}" readonly>
                                </div>
                                @error('cep')
                                    <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Linha 2: Rua e Número -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="rua"
                                    class="ml-3 text-sm font-bold text-green-400 tracking-wide">Rua</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                            data-lucide="navigation" class="h-5 w-5 text-gray-400"></i></div>
                                    <input maxlength="18" id="rua" name="rua" type="text" required
                                        class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 bg-emerald-800 @error('rua') border-red-500 @else border-emerald-900 @enderror"
                                        placeholder="Rua Exemplo" value="{{ old('rua') }}" readonly>
                                </div>
                                @error('rua')
                                    <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="numero"
                                    class="ml-3 text-sm font-bold text-green-400 tracking-wide">Número</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                            data-lucide="house" class="h-5 w-5 text-gray-400"></i></div>
                                    <input id="numero" name="numero" type="text"
                                        class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 bg-emerald-800 @error('numero') border-red-500 @else border-emerald-900 @enderror"
                                        placeholder="123" value="{{ old('numero') }}" readonly>
                                </div>
                                @error('numero')
                                    <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Cidade e Estado -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="cidade"
                                    class="ml-3 text-sm font-bold text-green-400 tracking-wide">Cidade</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                            data-lucide="building-2" class="h-5 w-5 text-gray-400"></i></div>
                                    <input id="cidade" name="cidade" type="text" required
                                        class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 bg-emerald-800 @error('cidade') border-red-500 @else border-emerald-900 @enderror"
                                        placeholder="São Paulo" value="{{ old('cidade') }}" readonly>
                                </div>
                                @error('cidade')
                                    <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="estado"
                                    class="ml-3 text-sm font-bold text-green-400 tracking-wide">Estado</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i
                                            data-lucide="map" class="h-5 w-5 text-gray-400"></i></div>
                                    <input id="estado" name="estado" type="text" required
                                        class="w-full text-base pl-10 pr-4 py-2 border-b focus:outline-none rounded-2xl focus:border-green-500 bg-emerald-800 @error('estado') border-red-500 @else border-emerald-900 @enderror"
                                        placeholder="SP" value="{{ old('estado') }}" readonly>
                                </div>
                                @error('estado')
                                    <span class="ml-3 text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="relative w-full flex justify-center p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer overflow-hidden bg-green-800 text-gray-100 z-10 group">
                                <span
                                    class="absolute inset-0 flex justify-center items-center text-white font-bold opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-hover:delay-200 z-20">
                                    Salvar!
                                </span>
                                <span class="z-20 transition-opacity duration-300 group-hover:opacity-0">
                                    Cadastrar Ponto
                                </span>
                                <span
                                    class="absolute w-full h-full bg-green-400 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                                <span
                                    class="absolute w-full h-full bg-green-400 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left"></span>
                                <span
                                    class="absolute w-full h-full bg-green-600 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></span>
                            </button>
                        </div>
                        <span class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-500">
                            <p>Quer ver os pontos já cadastrados?</p>
                            <a href="{{ route('collect-points.index') }}"
                                class="btn group flex items-center bg-transparent p-2 px-6 text-md">
                                <span
                                    class="flex items-center relative pb-1 text-green-400 hover:text-green-500 after:transition-transform after:duration-500 after:ease-out after:absolute after:bottom-0 after:left-0 after:block after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-lime-400 after:content-[''] after:group-hover:origin-bottom-left after:group-hover:scale-x-100">
                                    Gerenciar Pontos
                                    <svg class="pl-2 -translate-x-0 fill-slate-700 transition-all duration-300 ease-out group-hover:translate-x-1 group-hover:scale-x-105 group-hover:fill-green-100"
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z" />
                                    </svg>
                                </span>
                            </a>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    async function buscarEndereco() {
        const enderecoInput = document.getElementById('enderecoBusca');
        const endereco = enderecoInput.value.trim();

        if (!endereco) {
            mostrarResultado('❌ Por favor, digite um endereço para buscar.', 'error');
            return;
        }

        mostrarLoading();

        try {
            const buscaResponse = await fetch(
                `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(endereco + ', Brasil')}&limit=1&addressdetails=1`
            );

            const buscaData = await buscaResponse.json();

            if (buscaData && buscaData.length > 0) {
                const local = buscaData[0];

                const detalhesResponse = await fetch(
                    `https://nominatim.openstreetmap.org/reverse?format=json&lat=${local.lat}&lon=${local.lon}`
                );

                const detalhesData = await detalhesResponse.json();

                if (detalhesData.address) {
                    const addr = detalhesData.address;

                    const numeroExtraido = extrairNumeroDoEndereco(endereco);

                    document.getElementById('rua').value = addr.road || addr.pedestrian || addr.footway || '';
                    document.getElementById('numero').value = numeroExtraido || addr.house_number || '';
                    document.getElementById('cidade').value = addr.city || addr.town || addr.village || '';
                    document.getElementById('cep').value = addr.postcode || '';
                    
                    // CORREÇÃO: Converter nome do estado para sigla
                    document.getElementById('estado').value = converterEstadoParaSigla(addr.state || '');

                    esconderLoading();

                    if (numeroExtraido) {
                        mostrarResultado('✅ Endereço encontrado! Todos os campos preenchidos automaticamente.', 'success');
                    } else {
                        mostrarResultado('⚠️ Endereço encontrado, mas número não identificado. Verifique o campo número.', 'warning');
                    }
                } else {
                    esconderLoading();
                    mostrarResultado('❌ Não foi possível obter detalhes do endereço.', 'error');
                }

            } else {
                esconderLoading();
                mostrarResultado('❌ Endereço não encontrado. Tente incluir o número e ser mais específico.', 'error');
            }

        } catch (error) {
            esconderLoading();
            mostrarResultado('❌ Erro ao buscar endereço. Verifique sua conexão.', 'error');
            console.error('Erro:', error);
        }
    }

    // FUNÇÃO PARA CONVERTER NOME DO ESTADO PARA SIGLA
    function converterEstadoParaSigla(nomeEstado) {
        const estados = {
            'acre': 'AC',
            'alagoas': 'AL', 
            'amapá': 'AP',
            'amazonas': 'AM',
            'bahia': 'BA',
            'ceará': 'CE',
            'distrito federal': 'DF',
            'espírito santo': 'ES',
            'goiás': 'GO',
            'maranhão': 'MA',
            'mato grosso': 'MT',
            'mato grosso do sul': 'MS',
            'minas gerais': 'MG',
            'pará': 'PA',
            'paraíba': 'PB',
            'paraná': 'PR',
            'pernambuco': 'PE',
            'piauí': 'PI',
            'rio de janeiro': 'RJ',
            'rio grande do norte': 'RN',
            'rio grande do sul': 'RS',
            'rondônia': 'RO',
            'roraima': 'RR',
            'santa catarina': 'SC',
            'são paulo': 'SP',
            'sergipe': 'SE',
            'tocantins': 'TO'
        };

        const estadoLower = nomeEstado.toLowerCase().trim();
        return estados[estadoLower] || '';
    }

    function extrairNumeroDoEndereco(endereco) {
        const enderecoLimpo = endereco.replace(/,/g, ' ').replace(/\./g, ' ');

        const padroes = [
            /\b(\d{1,5}[A-Z]?)\b/,
            /n[º°]?\s*(\d+)/i,
            /numero\s*(\d+)/i,
            /,?\s*(\d{1,5})\s*,?/,
            /^.*?(\d{1,5}).*?$/
        ];

        for (let padrao of padroes) {
            const match = enderecoLimpo.match(padrao);
            if (match && match[1]) {
                return match[1];
            }
        }

        return '';
    }

    function mostrarLoading() {
        document.getElementById('loading').classList.remove('hidden');
        document.getElementById('resultado').classList.add('hidden');
    }

    function esconderLoading() {
        document.getElementById('loading').classList.add('hidden');
    }

    function mostrarResultado(mensagem, tipo) {
        const resultado = document.getElementById('resultado');
        resultado.innerHTML = mensagem;

        let classes = 'text-sm p-3 rounded border ';
        switch (tipo) {
            case 'success':
                classes += 'text-green-300 bg-green-800/50 border-green-600';
                break;
            case 'warning':
                classes += 'text-yellow-300 bg-yellow-800/50 border-yellow-600';
                break;
            case 'error':
                classes += 'text-red-300 bg-red-800/50 border-red-600';
                break;
            default:
                classes += 'text-emerald-300 bg-emerald-800/50 border-emerald-600';
        }

        resultado.className = classes;
        resultado.classList.remove('hidden');
    }

    document.getElementById('enderecoBusca').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            buscarEndereco();
        }
    });

    document.getElementById('enderecoBusca').addEventListener('input', function() {
        document.getElementById('rua').value = '';
        document.getElementById('numero').value = '';
        document.getElementById('cidade').value = '';
        document.getElementById('estado').value = '';
        document.getElementById('cep').value = '';
        document.getElementById('resultado').classList.add('hidden');
    });
</script>
@endsection