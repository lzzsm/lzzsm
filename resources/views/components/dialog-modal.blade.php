@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="bg-gradient-to-br from-slate-900/50 to-red-900/50 p-6 border border-red-700/30">
        <!-- Cabeçalho -->
        <div class="text-center mb-4">
            <div class="text-lg font-semibold text-red-200">
                {{ $title }}
            </div>
            <div class="w-16 h-1 bg-gradient-to-r from-red-400 to-red-600 mx-auto rounded-full mt-2"></div>
        </div>

        <!-- Conteúdo -->
        <div class="mt-4 text-sm text-gray-300">
            {{ $content }}
        </div>
    </div>

    <!-- Rodapé -->
    <div class="flex flex-row justify-end gap-3 px-6 py-4 bg-slate-800/50 border-t border-red-700/30">
        {{ $footer }}
    </div>
</x-modal>