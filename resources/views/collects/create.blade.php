@extends('layouts.main')

@section('title', 'Agendar Coleta')

@section('content')

<div class="bg-slate-900 text-gray-200 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto">

            <!-- Cabeçalho -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-white mb-3">Agendar Coleta</h1>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">Agende sua coleta de recicláveis e ganhe pontos</p>
            </div>

            <!-- Formulário -->
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl shadow-2xl overflow-hidden border border-gray-700/30">
                
                <div class="p-8">
                    <form action="{{ route('collects.store') }}" method="POST" id="collectForm">
                        @csrf

                        <!-- Ponto de Coleta -->
                        <div class="mb-8">
                            <label class="block text-lg font-semibold text-white mb-4 flex items-center">
                                <i data-lucide="map-pin" class="w-5 h-5 text-lime-400 mr-2"></i>
                                Escolha o Ponto de Coleta
                            </label>
                            <select name="collect_point_id" required
                                class="w-full bg-gray-700 border border-gray-600 rounded-2xl px-4 py-3 text-white focus:border-lime-500 focus:ring focus:ring-lime-500/20 transition-colors">
                                <option value="">Selecione um ponto de coleta</option>
                                @foreach($collectPoints as $point)
                                    <option value="{{ $point->id }}" {{ old('collect_point_id') == $point->id ? 'selected' : '' }}>
                                        {{ $point->nome }} - {{ $point->endereco_completo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('collect_point_id')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Data e Hora -->
                        <div class="mb-8">
                            <label class="block text-lg font-semibold text-white mb-4 flex items-center">
                                <i data-lucide="calendar" class="w-5 h-5 text-lime-400 mr-2"></i>
                                Data e Hora da Coleta
                            </label>
                            <input type="datetime-local" name="data" required 
                                min="{{ now()->format('Y-m-d\TH:i') }}"
                                value="{{ old('data') }}"
                                class="w-full bg-gray-700 border border-gray-600 rounded-2xl px-4 py-3 text-white focus:border-lime-500 focus:ring focus:ring-lime-500/20 transition-colors">
                            @error('data')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Materiais -->
                        <div class="mb-8">
                            <label class="block text-lg font-semibold text-white mb-4 flex items-center">
                                <i data-lucide="package" class="w-5 h-5 text-lime-400 mr-2"></i>
                                Materiais para Reciclar
                            </label>
                            
                            <div id="materiais-container" class="space-y-4">
                                <!-- Material 1 -->
                                <div class="material-item bg-gray-700/50 rounded-2xl p-4 border border-gray-600/30">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Material -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-300 mb-2">Material</label>
                                            <select name="materiais[0][material_id]" required
                                                class="material-select w-full bg-gray-600 border border-gray-500 rounded-xl px-3 py-2 text-white focus:border-lime-500 focus:ring focus:ring-lime-500/20">
                                                <option value="">Selecione o material</option>
                                                @foreach($materials as $material)
                                                    <option value="{{ $material->id }}" data-pontos="{{ $material->ponto_kg }}">
                                                        {{ $material->categoria }} ({{ $material->ponto_kg }} pts/kg)
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <!-- Peso -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-300 mb-2">Peso (kg)</label>
                                            <input type="number" name="materiais[0][peso]" required min="0.1" step="0.1"
                                                class="peso-input w-full bg-gray-600 border border-gray-500 rounded-xl px-3 py-2 text-white focus:border-lime-500 focus:ring focus:ring-lime-500/20"
                                                placeholder="0.0">
                                        </div>
                                    </div>
                                    
                                    <!-- Pontos Calculados -->
                                    <div class="mt-3 text-right">
                                        <span class="text-sm text-gray-400">Pontos estimados: </span>
                                        <span class="pontos-calculados text-lime-400 font-semibold">0</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Botão Adicionar Material -->
                            <button type="button" id="add-material" 
                                class="mt-4 inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-500 text-white rounded-xl transition-colors">
                                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                                Adicionar Material
                            </button>

                            <!-- Mensagem de erro para materiais duplicados -->
                            <div id="duplicate-error" class="hidden mt-3 p-3 bg-red-500/10 border border-red-500/20 rounded-xl">
                                <div class="flex items-center text-red-400 text-sm">
                                    <i data-lucide="alert-triangle" class="w-4 h-4 mr-2"></i>
                                    <span>Você já selecionou este material. Por favor, escolha um material diferente ou ajuste o peso do material existente.</span>
                                </div>
                            </div>
                        </div>

                        <!-- Observações -->
                        <div class="mb-8">
                            <label class="block text-lg font-semibold text-white mb-4 flex items-center">
                                <i data-lucide="file-text" class="w-5 h-5 text-lime-400 mr-2"></i>
                                Observações (Opcional)
                            </label>
                            <textarea name="observacoes" rows="3"
                                class="w-full bg-gray-700 border border-gray-600 rounded-2xl px-4 py-3 text-white focus:border-lime-500 focus:ring focus:ring-lime-500/20 transition-colors"
                                placeholder="Alguma observação sobre os materiais ou a coleta...">{{ old('observacoes') }}</textarea>
                        </div>

                        <!-- Resumo de Pontos -->
                        <div class="bg-lime-500/10 border border-lime-500/20 rounded-2xl p-6 mb-8">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-semibold text-lime-300">Total de Pontos Estimados</h3>
                                    <p class="text-gray-300 text-sm">Pontos serão creditados após validação da coleta</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-lime-400" id="total-pontos">0</div>
                                    <div class="text-lime-300 text-sm">pontos</div>
                                </div>
                            </div>
                        </div>

                        <!-- Botões -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6">
                            <!-- Cancelar -->
                            <a href="{{ route('collects.my-collects') }}"
                                class="flex-1 inline-flex items-center justify-center px-6 py-4 bg-gray-600 hover:bg-gray-500 text-white font-semibold rounded-2xl transition-all duration-300 transform hover:scale-105 text-center">
                                <i data-lucide="x" class="w-5 h-5 mr-2"></i>
                                Cancelar
                            </a>

                            <!-- Agendar -->
                            <button type="submit" id="submit-btn"
                                class="flex-1 inline-flex items-center justify-center px-6 py-4 bg-lime-500 hover:bg-lime-400 text-slate-900 font-bold rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-lime-500/25 group">
                                <i data-lucide="calendar-check" class="w-5 h-5 mr-2 transition-transform duration-300 group-hover:rotate-12"></i>
                                Agendar Coleta
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let materialCount = 1;
        const materiaisContainer = document.getElementById('materiais-container');
        const addMaterialBtn = document.getElementById('add-material');
        const totalPontosElement = document.getElementById('total-pontos');
        const duplicateError = document.getElementById('duplicate-error');
        const submitBtn = document.getElementById('submit-btn');

        // Array para controlar materiais selecionados
        let selectedMaterials = new Set();

        // Adicionar novo material
        addMaterialBtn.addEventListener('click', function() {
            const newMaterial = document.createElement('div');
            newMaterial.className = 'material-item bg-gray-700/50 rounded-2xl p-4 border border-gray-600/30';
            newMaterial.innerHTML = `
                <div class="flex justify-between items-start mb-3">
                    <span class="text-gray-300 font-medium">Material ${materialCount + 1}</span>
                    <button type="button" class="remove-material text-red-400 hover:text-red-300">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Material</label>
                        <select name="materiais[${materialCount}][material_id]" required
                            class="material-select w-full bg-gray-600 border border-gray-500 rounded-xl px-3 py-2 text-white focus:border-lime-500 focus:ring focus:ring-lime-500/20">
                            <option value="">Selecione o material</option>
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}" data-pontos="{{ $material->ponto_kg }}">
                                    {{ $material->categoria }} ({{ $material->ponto_kg }} pts/kg)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Peso (kg)</label>
                        <input type="number" name="materiais[${materialCount}][peso]" required min="0.1" step="0.1"
                            class="peso-input w-full bg-gray-600 border border-gray-500 rounded-xl px-3 py-2 text-white focus:border-lime-500 focus:ring focus:ring-lime-500/20"
                            placeholder="0.0">
                    </div>
                </div>
                <div class="mt-3 text-right">
                    <span class="text-sm text-gray-400">Pontos estimados: </span>
                    <span class="pontos-calculados text-lime-400 font-semibold">0</span>
                </div>
            `;

            materiaisContainer.appendChild(newMaterial);
            materialCount++;
            
            // Inicializar ícones e eventos
            lucide.createIcons();
            attachMaterialEvents(newMaterial);
            updateTotalPontos();
            checkForDuplicates();
        });

        // Calcular pontos para um material
        function calcularPontosMaterial(materialElement) {
            const select = materialElement.querySelector('.material-select');
            const pesoInput = materialElement.querySelector('.peso-input');
            const pontosElement = materialElement.querySelector('.pontos-calculados');

            if (select.value && pesoInput.value) {
                const pontosPorKg = parseFloat(select.selectedOptions[0].dataset.pontos);
                const peso = parseFloat(pesoInput.value);
                const pontos = Math.floor(pontosPorKg * peso);
                pontosElement.textContent = pontos;
            } else {
                pontosElement.textContent = '0';
            }
        }

        // Atualizar total de pontos
        function updateTotalPontos() {
            let total = 0;
            document.querySelectorAll('.material-item').forEach(item => {
                const pontosText = item.querySelector('.pontos-calculados').textContent;
                total += parseInt(pontosText) || 0;
            });
            totalPontosElement.textContent = total;
        }

        // Verificar materiais duplicados
        function checkForDuplicates() {
            const selectedValues = new Set();
            let hasDuplicates = false;
            
            document.querySelectorAll('.material-select').forEach(select => {
                const value = select.value;
                if (value) {
                    if (selectedValues.has(value)) {
                        hasDuplicates = true;
                        select.classList.add('border-red-500', 'bg-red-500/10');
                    } else {
                        selectedValues.add(value);
                        select.classList.remove('border-red-500', 'bg-red-500/10');
                    }
                }
            });

            // Mostrar/ocultar mensagem de erro
            if (hasDuplicates) {
                duplicateError.classList.remove('hidden');
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                duplicateError.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }

            return hasDuplicates;
        }

        // Anexar eventos a um material
        function attachMaterialEvents(materialElement) {
            const select = materialElement.querySelector('.material-select');
            const pesoInput = materialElement.querySelector('.peso-input');
            const removeBtn = materialElement.querySelector('.remove-material');

            select.addEventListener('change', function() {
                calcularPontosMaterial(materialElement);
                updateTotalPontos();
                checkForDuplicates();
            });

            pesoInput.addEventListener('input', function() {
                calcularPontosMaterial(materialElement);
                updateTotalPontos();
            });

            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    materialElement.remove();
                    updateTotalPontos();
                    checkForDuplicates();
                });
            }
        }

        // Inicializar eventos para o primeiro material
        attachMaterialEvents(document.querySelector('.material-item'));

        // Validação do formulário
        document.getElementById('collectForm').addEventListener('submit', function(e) {
            const materiais = document.querySelectorAll('.material-item');
            if (materiais.length === 0) {
                e.preventDefault();
                alert('Adicione pelo menos um material para a coleta.');
                return;
            }

            if (checkForDuplicates()) {
                e.preventDefault();
                alert('Corrija os materiais duplicados antes de agendar a coleta.');
                return;
            }
        });
    });
</script>

@endsection