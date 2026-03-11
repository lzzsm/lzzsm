
        <section class="mb-20" id="feedbacks">
            <div class="max-w-4xl mx-auto">
                
                @php
                    $meuFeedback = Auth::user()->feedback;
                @endphp
                
                @if (!$meuFeedback)
                    <!-- Formulário de Avaliação -->
                    <div class="bg-gradient-to-b from-gray-800 to-slate-900 rounded-2xl shadow-xl border border-gray-700/50 p-8 mb-8">
                        <div class="text-center mb-6">
                            <h3 class="text-2xl font-bold text-white mb-2">Avalie nossa plataforma</h3>
                            <p class="text-gray-400">Sua opinião é muito importante para melhorarmos!</p>
                        </div>

                        <form action="{{ route('feedbacks.store') }}" method="POST" id="feedback-form">
                            @csrf
                            
                            <!-- Sistema de Estrelas -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-300 mb-4 text-center">
                                    Como você avalia nossa plataforma?
                                </label>
                                <div class="flex justify-center space-x-2 mb-2" id="star-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button type="button" class="star-btn" data-rating="{{ $i }}">
                                            <svg class="w-10 h-10 text-gray-600 hover:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                            </svg>
                                        </button>
                                    @endfor
                                </div>
                                <input type="hidden" name="avaliacao" id="avaliacao" value="0">
                                <div class="text-center">
                                    <span id="rating-text" class="text-sm text-gray-400">Selecione uma avaliação</span>
                                </div>
                            </div>

                            <!-- Comentário -->
                            <div class="mb-6">
                                <label for="conteudo" class="block text-sm font-medium text-gray-300 mb-2">
                                    Seu comentário (opcional)
                                </label>
                                <textarea name="conteudo" id="conteudo" rows="3" class="w-full px-3 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none" placeholder="Compartilhe sua experiência...">{{ old('conteudo') }}</textarea>
                                <div class="mt-1 text-sm text-gray-400 text-right">
                                    <span id="char-count">0</span>/500 caracteres
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" id="submit-btn" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 disabled:opacity-50">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Enviar Avaliação
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- Card de Avaliação Existente -->
                    <div class="bg-gradient-to-b from-gray-800 to-slate-900 rounded-2xl shadow-xl border border-gray-700/50 p-8 mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-2xl font-bold text-white">Sua Avaliação</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-400">Você já avaliou nossa plataforma</span>
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="flex items-center space-x-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-6 h-6 {{ $i <= $meuFeedback->avaliacao ? 'text-yellow-400 fill-yellow-400' : 'text-gray-600' }}" fill="{{ $i <= $meuFeedback->avaliacao ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-sm text-gray-400">{{ $meuFeedback->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button onclick="openEditModal()" class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Editar
                                    </button>
                                    <button onclick="confirmDelete()" class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Excluir
                                    </button>
                                </div>
                            </div>
                            
                            @if($meuFeedback->conteudo)
                                <p class="text-gray-300 leading-relaxed">{{ $meuFeedback->conteudo }}</p>
                            @else
                                <p class="text-gray-500 italic">Sem comentário adicional</p>
                            @endif
                        </div>
                    </div>

                    <!-- Modal de Edição -->
                    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
                        <div class="bg-slate-800 rounded-2xl p-6 w-full max-w-md">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-bold text-white">Editar Avaliação</h3>
                                <button onclick="closeEditModal()" class="text-gray-400 hover:text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            
                            <form action="{{ route('feedbacks.update', $meuFeedback) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-300 mb-2">Sua avaliação:</label>
                                    <div class="flex justify-center space-x-1" id="edit-star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" class="edit-star-btn" data-rating="{{ $i }}">
                                                <svg class="w-8 h-8 {{ $i <= $meuFeedback->avaliacao ? 'text-yellow-400 fill-yellow-400' : 'text-gray-600' }}" fill="{{ $i <= $meuFeedback->avaliacao ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="avaliacao" id="edit-avaliacao" value="{{ $meuFeedback->avaliacao }}">
                                </div>
                                
                                <div class="mb-4">
                                    <label for="edit-conteudo" class="block text-sm font-medium text-gray-300 mb-2">Comentário:</label>
                                    <textarea name="conteudo" id="edit-conteudo" rows="3" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-green-500">{{ $meuFeedback->conteudo }}</textarea>
                                </div>
                                
                                <div class="flex justify-end space-x-3">
                                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-sm text-gray-300 hover:text-white">Cancelar</button>
                                    <button type="submit" class="px-4 py-2 text-sm bg-green-600 hover:bg-green-700 text-white rounded-lg">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal de Confirmação de Exclusão -->
                    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
                        <div class="bg-slate-800 rounded-2xl p-6 w-full max-w-md">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-yellow-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                <h3 class="text-xl font-bold text-white mb-2">Excluir Avaliação</h3>
                                <p class="text-gray-300 mb-6">Tem certeza que deseja excluir sua avaliação?</p>
                                
                                <div class="flex justify-center space-x-3">
                                    <button onclick="closeDeleteModal()" class="px-6 py-2 text-sm text-gray-300 hover:text-white">Cancelar</button>
                                    <form action="{{ route('feedbacks.destroy', $meuFeedback) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-6 py-2 text-sm bg-red-600 hover:bg-red-700 text-white rounded-lg">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <script>
            // Sistema de Estrelas
            document.addEventListener('DOMContentLoaded', function() {
                // Formulário principal
                const starButtons = document.querySelectorAll('.star-btn');
                const ratingInput = document.getElementById('avaliacao');
                const ratingText = document.getElementById('rating-text');
                const textarea = document.getElementById('conteudo');
                const charCount = document.getElementById('char-count');
                const submitBtn = document.getElementById('submit-btn');
                
                starButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const rating = parseInt(this.getAttribute('data-rating'));
                        ratingInput.value = rating;
                        updateStars(rating);
                        updateRatingText(rating);
                        updateSubmitButton();
                    });
                });

                function updateStars(rating) {
                    starButtons.forEach((button, index) => {
                        const star = button.querySelector('svg');
                        const starRating = index + 1;
                        
                        if (starRating <= rating) {
                            star.classList.remove('text-gray-600');
                            star.classList.add('text-yellow-400', 'fill-yellow-400');
                        } else {
                            star.classList.remove('text-yellow-400', 'fill-yellow-400');
                            star.classList.add('text-gray-600');
                        }
                    });
                }

                function updateRatingText(rating) {
                    const texts = {
                        1: 'Péssimo', 2: 'Ruim', 3: 'Regular', 4: 'Bom', 5: 'Excelente'
                    };
                    ratingText.textContent = texts[rating] || 'Selecione uma avaliação';
                }

                function updateSubmitButton() {
                    submitBtn.disabled = ratingInput.value === '0';
                }

                // Contador de caracteres
                textarea.addEventListener('input', function() {
                    charCount.textContent = this.value.length;
                });

                // Sistema de Estrelas do Modal de Edição
                const editStarButtons = document.querySelectorAll('.edit-star-btn');
                const editRatingInput = document.getElementById('edit-avaliacao');

                editStarButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const rating = parseInt(this.getAttribute('data-rating'));
                        editRatingInput.value = rating;
                        updateEditStars(rating);
                    });
                });

                function updateEditStars(rating) {
                    editStarButtons.forEach((button, index) => {
                        const star = button.querySelector('svg');
                        const starRating = index + 1;
                        
                        if (starRating <= rating) {
                            star.classList.remove('text-gray-600');
                            star.classList.add('text-yellow-400', 'fill-yellow-400');
                        } else {
                            star.classList.remove('text-yellow-400', 'fill-yellow-400');
                            star.classList.add('text-gray-600');
                        }
                    });
                }

                updateSubmitButton();
                charCount.textContent = textarea.value.length;
            });

            // Funções dos Modais
            function openEditModal() {
                document.getElementById('editModal').classList.remove('hidden');
            }

            function closeEditModal() {
                document.getElementById('editModal').classList.add('hidden');
            }

            function confirmDelete() {
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
            }

            // Fechar modais clicando fora
            document.addEventListener('click', function(event) {
                if (event.target.id === 'editModal') closeEditModal();
                if (event.target.id === 'deleteModal') closeDeleteModal();
            });
        </script>
