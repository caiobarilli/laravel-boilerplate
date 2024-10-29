<div>
    <x-mary-modal wire:model="openModal" class="backdrop-blur" no-separator>
        <x-mary-form wire:submit.prevent="onEdit" no-separator>
            <x-mary-errors title="Atenção!" :errors="$errors" class="mb-4" description="Por favor, corrija os erros."
                icon="o-no-symbol" />

            <div class="grid grid-cols-1">
                <div>
                    <x-mary-input id="edit-name" label="Nome" wire:model="name" required />
                </div>
            </div>

            <div class="grid grid-cols-1">
                <div>
                    <x-mary-input id="edit-email" label="E-mail" wire:model="email" required />
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 mb-3 md:grid-cols-2">
                <div>
                    <x-mary-input id="edit-password" label="Senha" wire:model="password" type="password" icon="o-key"
                        required />
                </div>
                <div>
                    <x-mary-input id="edit-password_confirmation" label="Confirmar senha"
                        wire:model="password_confirmation" type="password" icon="o-key" required />
                </div>
            </div>

            <x-slot:actions>
                <x-mary-button label="Cancelar" wire:click="closeModal" wire:loading.attr="disabled" />
                <x-mary-button label="Salvar" class="text-white bg-yellow-400 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled" type="submit" spinner="onEdit" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>
