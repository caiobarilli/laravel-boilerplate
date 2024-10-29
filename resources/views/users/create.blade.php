<div>
    <x-mary-form wire:submit="onView">
        <x-mary-button label="NOVO" type="submit" icon="o-plus" spinner="onView"
            class="mb-3 text-white rounded-s-none bg-slate-600 dark:bg-indigo-600 max-w-32"
            wire:loading.attr="disabled" />
    </x-mary-form>

    <x-mary-modal wire:model="openModal" class="backdrop-blur" no-separator>
        <x-mary-form wire:submit.prevent="store" no-separator>
            <x-mary-errors title="Atenção!" :errors="$errors" icon="o-no-symbol" class="mb-4"
                description="Por favor, corrija os erros." />

            <div class="grid grid-cols-1">
                <div>
                    <x-mary-input label="Nome" wire:model="name" required />
                </div>
            </div>

            <div class="grid grid-cols-1">
                <div>
                    <x-mary-input label="E-mail" wire:model="email" required />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 mb-3 md:grid-cols-2">
                <div>
                    <x-mary-input label="Senha" wire:model="password" type="password" icon="o-key" required />
                </div>
                <div>
                    <x-mary-input label="Confirmar senha" wire:model="password_confirmation" type="password"
                        icon="o-key" required />
                </div>
            </div>

            <x-slot:actions>
                <x-mary-button label="Cancelar" wire:click="closeModal" wire:loading.attr="disabled" />
                <x-mary-button label="Salvar" class="text-white bg-yellow-400 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled" type="submit" spinner="store" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>
