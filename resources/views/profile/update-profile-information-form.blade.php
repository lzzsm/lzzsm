<div class="bg-gradient-to-br from-slate-900/50 to-emerald-900/50 p-6 rounded-xl border border-emerald-700/30">
    <!-- Cabeçalho -->
    <div class="text-center mb-6">
        <h2 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
            <i data-lucide="user-cog" class="w-5 h-5 mr-2 text-lime-400"></i>
            Atualizar Perfil
        </h2>
        <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full"></div>
        <p class="text-gray-400 text-sm mt-2">Altere seu nome, email e foto de perfil.</p>
    </div>

    <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data"
        class="grid gap-6 sm:grid-cols-2">
        @csrf
        @method('PUT')

        <!-- Foto de Perfil -->
        <div class="sm:col-span-2 flex justify-center">
            <div class="space-y-4 flex flex-col items-center">
                <label for="photo" class="block text-sm font-medium text-gray-200">Foto de Perfil</label>

                <!-- Imagem atual -->
                <div class="mt-2">
                    @if (auth()->user()->profile_photo_path)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Foto de Perfil"
                            class="rounded-full w-20 h-20 object-cover border-2 border-lime-400/50">
                    @else
                        <img src="{{ asset('img/guest_profile_photo.webp') }}" alt="Foto padrão"
                            class="rounded-full w-20 h-20 object-cover border-2 border-lime-400/50">
                    @endif
                </div>

                <!-- Selecionar nova foto -->
                <div class="mt-2">
                    <input type="file" name="photo" accept="image/*"
                        class="block w-full text-sm text-gray-300 bg-slate-800/50 border border-emerald-600/30 rounded-lg px-3 py-2 file:bg-emerald-600/80 file:text-white file:rounded-md file:px-4 file:py-2 hover:file:bg-emerald-700 transition-colors">
                    @error('photo')
                        <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Nome -->
        <div class="sm:col-span-2">
            <label for="name" class="block text-sm font-medium text-gray-200">Nome</label>
            <input type="text" id="name" name="name" required autocomplete="name"
                value="{{ old('name', auth()->user()->name) }}"
                class="mt-1 text-gray-100 bg-slate-800/50 border border-emerald-600/30 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-colors">
            @error('name')
                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="sm:col-span-2">
            <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
            <input type="email" id="email" name="email" required autocomplete="email"
                value="{{ old('email', auth()->user()->email) }}"
                class="mt-1 text-gray-100 bg-slate-800/50 border border-emerald-600/30 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-colors">
            @error('email')
                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botões -->
        <div class="sm:col-span-2 flex justify-start gap-4">
            <button type="submit" 
                class="inline-flex items-center justify-center gap-2 bg-emerald-900/80 hover:bg-emerald-800 text-lime-100 py-3 px-6 rounded-lg border border-emerald-700/50 hover:border-lime-400/50 transition-all duration-300 hover:-translate-y-1 group">
                <i data-lucide="save" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                <span class="text-base font-medium">Salvar alterações</span>
            </button>

            @if (auth()->user()->profile_photo_path)
                <button type="submit" form="delete-photo-form"
                    class="inline-flex items-center justify-center gap-2 bg-red-600/80 hover:bg-red-700 text-white py-3 px-6 rounded-lg border border-red-700/50 hover:border-red-500 transition-all duration-300 hover:-translate-y-1 group">
                    <i data-lucide="trash-2" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    <span class="text-base font-medium">Remover foto</span>
                </button>
            @endif
        </div>
    </form>

    @if (auth()->user()->profile_photo_path)
        <form method="POST" action="{{ route('user.photo.delete') }}" id="delete-photo-form" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endif

    @if (auth()->user()->nivel_permissao === 'empresa')
        <div class="mt-8 pt-8 border-t border-emerald-700/30">
            <!-- Cabeçalho Empresa -->
            <div class="text-center mb-6">
                <h2 class="font-semibold text-gray-400 mb-2 flex items-center justify-center">
                    <i data-lucide="building" class="w-5 h-5 mr-2 text-lime-400"></i>
                    Dados Empresariais
                </h2>
                <div class="w-16 h-1 bg-gradient-to-r from-lime-400 to-emerald-400 mx-auto rounded-full"></div>
                <p class="text-gray-400 text-sm mt-2">Altere as informações públicas da sua empresa.</p>
            </div>

            <form method="POST" action="{{ route('empresas.update', auth()->user()->empresa->id) }}"
                class="grid gap-6 sm:grid-cols-2">
                @csrf
                @method('PUT')

                <!-- Site -->
                <div class="sm:col-span-2">
                    <label for="site" class="block text-sm font-medium text-gray-200">Site da Empresa</label>
                    <input type="text" id="site" name="site" autocomplete="url"
                        value="{{ old('site', auth()->user()->empresa->site ?? '') }}"
                        class="mt-1 text-gray-100 bg-slate-800/50 border border-emerald-600/30 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-colors">
                    @error('site')
                        <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Telefone Comercial -->
                <div class="sm:col-span-2">
                    <label for="telefone_comercial" class="block text-sm font-medium text-gray-200">Telefone Comercial</label>
                    <input type="text" id="telefone_comercial" name="telefone_comercial" autocomplete="tel"
                        value="{{ old('telefone_comercial', auth()->user()->empresa->telefone_comercial ?? '') }}"
                        class="mt-1 text-gray-100 bg-slate-800/50 border border-emerald-600/30 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-colors">
                    @error('telefone_comercial')
                        <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descrição -->
                <div class="sm:col-span-2">
                    <label for="descricao" class="block text-sm font-medium text-gray-200">Descrição da Empresa</label>
                    <textarea id="descricao" name="descricao" rows="4"
                        class="mt-1 text-gray-100 bg-slate-800/50 border border-emerald-600/30 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-colors">{{ old('descricao', auth()->user()->empresa->descricao ?? '') }}</textarea>
                    @error('descricao')
                        <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botão -->
                <div class="sm:col-span-2 flex justify-start">
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 bg-emerald-900/80 hover:bg-emerald-800 text-lime-100 py-3 px-6 rounded-lg border border-emerald-700/50 hover:border-lime-400/50 transition-all duration-300 hover:-translate-y-1 group">
                        <i data-lucide="save" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-base font-medium">Salvar Dados da Empresa</span>
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>