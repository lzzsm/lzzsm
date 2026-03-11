@extends('layouts.guest')

@section('title', 'Editar Ponto de Coleta')

@section('content')
    <div class="relative min-h-screen flex items-center justify-center bg-no-repeat bg-cover bg-center text-gray-200 py-12"
        style="background-image: url({{ asset('img/hero_background.jpg') }});">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/90 to-slate-950/90 z-0"></div>

        <!-- Logo -->
        <a href="{{ route('home') }}" class="absolute top-5 left-7 z-20">
            <img src="{{ asset('img/logo_txt_perseph.png') }}" alt="Perseph" class="w-40" />
        </a>

        <!-- Form Card -->
        <div
            class="relative z-10 max-w-4xl w-full bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-emerald-900">
            <h2 class="text-2xl font-bold text-lime-400 mb-6 flex items-center">
                <i data-lucide="map-pin" class="w-6 h-6 mr-2 text-lime-400"></i>
                Editar Ponto de Coleta
            </h2>

            <p class="text-gray-400 mb-8">Ajuste as informações necessárias e salve para manter os dados do ponto de coleta
                sempre atualizados.</p>

            <form action="{{ route('collect-points.update', $collectPoint->id) }}" method="POST" class="space-y-6"
                id="collectPointForm">
                @csrf
                @method('PUT')

                <!-- Linha 1: Nome do Ponto e CEP -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nome do Ponto -->
                    <div>
                        <label for="nome" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Nome do
                            Ponto</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="tag" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="nome" name="nome" type="text"
                                value="{{ old('nome', $collectPoint->nome) }}" required
                                class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('nome') border-red-500 @enderror">
                        </div>
                        @error('nome')
                            <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- CEP com validação -->
                    <div>
                        <label for="cep" class="ml-1 text-sm font-bold text-green-400 tracking-wide">CEP</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="map-pinned" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="cep" name="cep" type="text"
                                value="{{ old('cep', $collectPoint->cep_formatado) }}"
                                oninput="mascaraCEP(this); agendarValidacao()" required
                                class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('cep') border-red-500 @enderror">
                            <div id="cep-loading" class="hidden absolute right-3 top-3">
                                <i data-lucide="loader-2" class="w-5 h-5 text-lime-500 animate-spin"></i>
                            </div>
                        </div>
                        @error('cep')
                            <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Linha 2: Rua e Número -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Rua -->
                    <div>
                        <label for="rua" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Rua</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="navigation" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="rua" name="rua" type="text" value="{{ old('rua', $collectPoint->rua) }}"
                                oninput="agendarValidacao()" required
                                class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('rua') border-red-500 @enderror">
                        </div>
                        @error('rua')
                            <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Número -->
                    <div>
                        <label for="numero" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Número</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="hash" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="numero" name="numero" type="text"
                                value="{{ old('numero', $collectPoint->numero) }}" oninput="agendarValidacao()"
                                class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('numero') border-red-500 @enderror">
                        </div>
                        @error('numero')
                            <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Cidade e Estado -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Cidade -->
                    <div>
                        <label for="cidade" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Cidade</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="building" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="cidade" name="cidade" type="text"
                                value="{{ old('cidade', $collectPoint->cidade) }}" oninput="agendarValidacao()" required
                                class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('cidade') border-red-500 @enderror">
                        </div>
                        @error('cidade')
                            <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div>
                        <label for="estado" class="ml-1 text-sm font-bold text-green-400 tracking-wide">Estado</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="map" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <select id="estado" name="estado" required onchange="agendarValidacao()"
                                class="w-full text-base pl-10 pr-4 py-2 border-b rounded-2xl bg-gray-900 border-emerald-900 focus:outline-none focus:border-green-500 @error('estado') border-red-500 @enderror">
                                <option value="">Selecione o estado</option>
                                <option value="AC"
                                    {{ old('estado', $collectPoint->estado) == 'AC' ? 'selected' : '' }}>Acre</option>
                                <option value="AL"
                                    {{ old('estado', $collectPoint->estado) == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                <option value="AP"
                                    {{ old('estado', $collectPoint->estado) == 'AP' ? 'selected' : '' }}>Amapá</option>
                                <option value="AM"
                                    {{ old('estado', $collectPoint->estado) == 'AM' ? 'selected' : '' }}>Amazonas</option>
                                <option value="BA"
                                    {{ old('estado', $collectPoint->estado) == 'BA' ? 'selected' : '' }}>Bahia</option>
                                <option value="CE"
                                    {{ old('estado', $collectPoint->estado) == 'CE' ? 'selected' : '' }}>Ceará</option>
                                <option value="DF"
                                    {{ old('estado', $collectPoint->estado) == 'DF' ? 'selected' : '' }}>Distrito Federal
                                </option>
                                <option value="ES"
                                    {{ old('estado', $collectPoint->estado) == 'ES' ? 'selected' : '' }}>Espírito Santo
                                </option>
                                <option value="GO"
                                    {{ old('estado', $collectPoint->estado) == 'GO' ? 'selected' : '' }}>Goiás</option>
                                <option value="MA"
                                    {{ old('estado', $collectPoint->estado) == 'MA' ? 'selected' : '' }}>Maranhão</option>
                                <option value="MT"
                                    {{ old('estado', $collectPoint->estado) == 'MT' ? 'selected' : '' }}>Mato Grosso
                                </option>
                                <option value="MS"
                                    {{ old('estado', $collectPoint->estado) == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul
                                </option>
                                <option value="MG"
                                    {{ old('estado', $collectPoint->estado) == 'MG' ? 'selected' : '' }}>Minas Gerais
                                </option>
                                <option value="PA"
                                    {{ old('estado', $collectPoint->estado) == 'PA' ? 'selected' : '' }}>Pará</option>
                                <option value="PB"
                                    {{ old('estado', $collectPoint->estado) == 'PB' ? 'selected' : '' }}>Paraíba</option>
                                <option value="PR"
                                    {{ old('estado', $collectPoint->estado) == 'PR' ? 'selected' : '' }}>Paraná</option>
                                <option value="PE"
                                    {{ old('estado', $collectPoint->estado) == 'PE' ? 'selected' : '' }}>Pernambuco
                                </option>
                                <option value="PI"
                                    {{ old('estado', $collectPoint->estado) == 'PI' ? 'selected' : '' }}>Piauí</option>
                                <option value="RJ"
                                    {{ old('estado', $collectPoint->estado) == 'RJ' ? 'selected' : '' }}>Rio de Janeiro
                                </option>
                                <option value="RN"
                                    {{ old('estado', $collectPoint->estado) == 'RN' ? 'selected' : '' }}>Rio Grande do
                                    Norte</option>
                                <option value="RS"
                                    {{ old('estado', $collectPoint->estado) == 'RS' ? 'selected' : '' }}>Rio Grande do Sul
                                </option>
                                <option value="RO"
                                    {{ old('estado', $collectPoint->estado) == 'RO' ? 'selected' : '' }}>Rondônia</option>
                                <option value="RR"
                                    {{ old('estado', $collectPoint->estado) == 'RR' ? 'selected' : '' }}>Roraima</option>
                                <option value="SC"
                                    {{ old('estado', $collectPoint->estado) == 'SC' ? 'selected' : '' }}>Santa Catarina
                                </option>
                                <option value="SP"
                                    {{ old('estado', $collectPoint->estado) == 'SP' ? 'selected' : '' }}>São Paulo</option>
                                <option value="SE"
                                    {{ old('estado', $collectPoint->estado) == 'SE' ? 'selected' : '' }}>Sergipe</option>
                                <option value="TO"
                                    {{ old('estado', $collectPoint->estado) == 'TO' ? 'selected' : '' }}>Tocantins</option>
                            </select>
                        </div>
                        @error('estado')
                            <span class="ml-2 text-xs text-red-400">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Validação em Tempo Real -->
                <div id="endereco-validation" class="hidden p-4 bg-gray-800/50 border border-gray-700 rounded-lg">
                    <div class="flex items-start space-x-3">
                        <i data-lucide="map-pin" class="w-5 h-5 text-lime-400 mt-0.5"></i>
                        <div class="flex-1">
                            <h4 class="font-semibold text-lime-300 mb-2">Validação de Endereço</h4>
                            <div id="validation-results" class="space-y-2 text-sm"></div>
                        </div>
                    </div>
                </div>

                <!-- Botão (inicialmente desabilitado até validação) -->
                <div>
                    <button type="submit" id="submit-btn" disabled
                        class="relative w-full flex justify-center p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-not-allowed overflow-hidden bg-gray-600 text-gray-400 z-10 group">
                        <span class="z-20">
                            Aguardando validação do endereço...
                        </span>
                    </button>

                    <button type="submit" id="submit-btn-success"
                        class="hidden relative w-full flex justify-center p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer overflow-hidden bg-green-800 text-gray-100 z-10 group">
                        <span
                            class="absolute inset-0 flex justify-center items-center text-white font-bold opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-hover:delay-200 z-20">
                            Salvar Alterações!
                        </span>
                        <span class="z-20 transition-opacity duration-300 group-hover:opacity-0">
                            Atualizar Ponto de Coleta
                        </span>
                        <span
                            class="absolute w-full h-full bg-green-400 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        <span
                            class="absolute w-full h-full bg-green-600 -z-10 top-0 left-0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></span>
                    </button>
                </div>

                <!-- Link útil -->
                <span class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-400">
                    <p>Quer voltar para o gerenciamento de pontos de coleta?</p>

                    <a href="{{ route('collect-points.index') }}"
                        class="btn group flex items-center bg-transparent p-2 px-6 text-md">
                        <span
                            class="flex items-center relative pb-1 text-green-400 hover:text-green-500 after:transition-transform after:duration-500 after:ease-out after:absolute after:bottom-0 after:left-0 after:block after:h-[2px] after:w-full after:origin-bottom-right after:scale-x-0 after:bg-lime-400 after:content-[''] after:group-hover:origin-bottom-left after:group-hover:scale-x-100">
                            Gerenciar Pontos de Coleta

                            <svg class="pl-2 -translate-x-0 fill-slate-700 transition-all duration-300 ease-out group-hover:translate-x-1 group-hover:scale-x-105 group-hover:fill-green-100"
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z" />
                            </svg>
                        </span>
                    </a>
                </span>
            </form>
        </div>
    </div>

    <!-- Scripts das máscaras e validação em tempo real -->
    <script>
        let validacaoTimeout;
        let enderecoValido = false;

        function mascaraCEP(campo) {
            let cep = campo.value.replace(/\D/g, ''); // Remove tudo que não é número

            if (cep.length > 8) cep = cep.slice(0, 8); // limita a 8 números

            cep = cep.replace(/(\d{5})(\d)/, '$1-$2'); // coloca o traço depois do 5º dígito

            campo.value = cep;
        }

        function agendarValidacao() {
            clearTimeout(validacaoTimeout);
            validacaoTimeout = setTimeout(validarEnderecoCompleto, 800); // Debounce de 800ms
        }

        function atualizarBotaoSubmit(valido) {
            const btnDisabled = document.getElementById('submit-btn');
            const btnSuccess = document.getElementById('submit-btn-success');

            if (valido) {
                btnDisabled.classList.add('hidden');
                btnSuccess.classList.remove('hidden');
                enderecoValido = true;
            } else {
                btnDisabled.classList.remove('hidden');
                btnSuccess.classList.add('hidden');
                enderecoValido = false;
            }
        }

        async function validarEnderecoCompleto() {
            const cep = document.getElementById('cep').value.replace(/\D/g, '');
            const ruaInput = document.getElementById('rua');
            const cidadeInput = document.getElementById('cidade');
            const estadoInput = document.getElementById('estado');
            const loading = document.getElementById('cep-loading');
            const validationElement = document.getElementById('endereco-validation');
            const resultsElement = document.getElementById('validation-results');

            // Resetar estado
            validationElement.classList.add('hidden');
            resultsElement.innerHTML = '';
            atualizarBotaoSubmit(false);

            // Verificar se campos obrigatórios estão preenchidos
            if (!cep || cep.length !== 8 || !ruaInput.value || !cidadeInput.value || !estadoInput.value) {
                resultsElement.innerHTML = `
                    <div class="flex items-center text-amber-400">
                        <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i>
                        <span>Preencha todos os campos para validar o endereço</span>
                    </div>
                `;
                validationElement.classList.remove('hidden');
                return;
            }

            loading.classList.remove('hidden');

            try {
                // Buscar informações do CEP
                const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);

                if (!response.ok) throw new Error('Erro na requisição');

                const data = await response.json();

                if (!data.erro) {
                    const resultados = [];
                    let todasValidacoesPassaram = true;

                    // 1. Validar CEP → Cidade
                    const cidadeViaCEP = data.localidade.toLowerCase();
                    const cidadeInformada = cidadeInput.value.toLowerCase();

                    if (cidadeViaCEP === cidadeInformada) {
                        resultados.push(`
                            <div class="flex items-center text-green-400">
                                <i data-lucide="check-circle" class="w-4 h-4 mr-2"></i>
                                <span>CEP pertence à cidade informada</span>
                            </div>
                        `);
                    } else {
                        resultados.push(`
                            <div class="flex items-center text-red-400">
                                <i data-lucide="x-circle" class="w-4 h-4 mr-2"></i>
                                <span>CEP pertence a <strong>${data.localidade}</strong>, não a <strong>${cidadeInput.value}</strong></span>
                            </div>
                        `);
                        todasValidacoesPassaram = false;
                    }

                    // 2. Validar CEP → Estado
                    const estadoViaCEP = data.uf.toUpperCase();
                    const estadoInformado = estadoInput.value;

                    if (estadoViaCEP === estadoInformado) {
                        resultados.push(`
                            <div class="flex items-center text-green-400">
                                <i data-lucide="check-circle" class="w-4 h-4 mr-2"></i>
                                <span>CEP pertence ao estado informado</span>
                            </div>
                        `);
                    } else {
                        resultados.push(`
                            <div class="flex items-center text-red-400">
                                <i data-lucide="x-circle" class="w-4 h-4 mr-2"></i>
                                <span>CEP pertence a <strong>${data.uf}</strong>, não a <strong>${estadoInformado}</strong></span>
                            </div>
                        `);
                        todasValidacoesPassaram = false;
                    }

                    // 3. Validar Rua → Cidade (buscar CEP pela rua e cidade)
                    if (ruaInput.value && cidadeInput.value && estadoInput.value) {
                        try {
                            const ruaBusca = ruaInput.value.replace(/\s+/g, '+');
                            const ruaResponse = await fetch(
                                `https://viacep.com.br/ws/${estadoInput.value}/${cidadeInput.value}/${ruaBusca}/json/`
                                );
                            const ruas = await ruaResponse.json();

                            if (ruas.length > 0) {
                                resultados.push(`
                                    <div class="flex items-center text-green-400">
                                        <i data-lucide="check-circle" class="w-4 h-4 mr-2"></i>
                                        <span>Rua encontrada na cidade informada</span>
                                    </div>
                                `);
                            } else {
                                resultados.push(`
                                    <div class="flex items-center text-amber-400">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i>
                                        <span>Rua não encontrada em ${cidadeInput.value}/${estadoInput.value}</span>
                                    </div>
                                `);
                                todasValidacoesPassaram = false;
                            }
                        } catch (ruaError) {
                            resultados.push(`
                                <div class="flex items-center text-amber-400">
                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i>
                                    <span>Não foi possível validar a rua</span>
                                </div>
                            `);
                        }
                    }

                    // Mostrar resultados
                    if (resultados.length > 0) {
                        resultsElement.innerHTML = resultados.join('');
                        validationElement.classList.remove('hidden');

                        // Atualizar botão baseado na validação
                        if (todasValidacoesPassaram) {
                            atualizarBotaoSubmit(true);
                        }
                    }

                } else {
                    resultsElement.innerHTML = `
                        <div class="flex items-center text-red-400">
                            <i data-lucide="x-circle" class="w-4 h-4 mr-2"></i>
                            <span>CEP não encontrado na base de dados</span>
                        </div>
                    `;
                    validationElement.classList.remove('hidden');
                }

            } catch (error) {
                console.error('Erro na validação:', error);
                resultsElement.innerHTML = `
                    <div class="flex items-center text-red-400">
                        <i data-lucide="wifi-off" class="w-4 h-4 mr-2"></i>
                        <span>Erro ao validar endereço. Tente novamente.</span>
                    </div>
                `;
                validationElement.classList.remove('hidden');
            } finally {
                loading.classList.add('hidden');

                // Atualizar ícones do Lucide
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }
        }

        // Bloquear envio do formulário se endereço não for válido
        document.getElementById('collectPointForm').addEventListener('submit', function(e) {
            if (!enderecoValido) {
                e.preventDefault();
                // Scroll para a validação
                document.getElementById('endereco-validation').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                // Adicionar animação de shake para chamar atenção
                const validationElement = document.getElementById('endereco-validation');
                validationElement.classList.add('animate-pulse', 'border-red-500');
                setTimeout(() => {
                    validationElement.classList.remove('animate-pulse', 'border-red-500');
                }, 2000);
            }
        });

        // Validar ao carregar a página se campos estiverem preenchidos
        document.addEventListener('DOMContentLoaded', function() {
            const cep = document.getElementById('cep').value.replace(/\D/g, '');
            if (cep.length === 8) {
                setTimeout(() => validarEnderecoCompleto(), 1000);
            }
        });
    </script>
@endsection
