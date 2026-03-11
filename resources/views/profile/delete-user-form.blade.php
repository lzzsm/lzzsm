<div class="space-y-6">
    <p class="text-gray-400 text-sm">
        Ao excluir sua conta, todos os dados serão permanentemente removidos. Faça backup de qualquer informação
        importante antes de continuar.
    </p>

    <button wire:click="confirmUserDeletion" wire:loading.attr="disabled"
        class="inline-flex items-center justify-center gap-2 bg-red-600/80 hover:bg-red-700 text-white py-3 px-6 rounded-lg border border-red-700/50 hover:border-red-500 transition-all duration-300 hover:-translate-y-1 group">
        <i data-lucide="trash-2" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
        <span class="text-base font-medium">Excluir Conta</span>
    </button>

    <x-dialog-modal wire:model.live="confirmingUserDeletion">
        <x-slot name="title">
            <div class="flex items-center justify-center gap-2 text-red-400">
                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Confirmação de Exclusão
            </div>
        </x-slot>

        <x-slot name="content">
            <p class="text-sm text-gray-400">
                Tem certeza que deseja excluir sua conta? Essa ação é irreversível. Digite sua senha para confirmar.
            </p>

            <div class="mt-4">
                <x-input type="password"
                    class="mt-1 block w-full rounded-lg bg-slate-800/50 border border-emerald-600/30 text-white focus:ring-red-500 focus:border-red-500"
                    placeholder="Senha" wire:model.defer="password" wire:keydown.enter="deleteUser" />
                <x-input-error for="password" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled"
                class="bg-slate-800/50 hover:bg-slate-700/60 border border-emerald-600/30 hover:border-lime-400/50">
                Cancelar
            </x-secondary-button>

            <x-danger-button wire:click="deleteUser" wire:loading.attr="disabled"
                class="ml-3 bg-red-600/80 hover:bg-red-700 border border-red-700/50 hover:border-red-500">
                Excluir Permanentemente
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
