<div>
    <x-mary-modal wire:model="openModal" class="backdrop-blur" title="Você tem certeza?" no-separator>
        <div class="text-red-600">
            @php
                if ($user) {
                    echo 'Atenção esta ação irá excluir o usuário <strong>' .
                        $user->name .
                        '</strong>, esta ação não podera ser desfeita.';
                }
            @endphp
        </div>
        <div>
            <small>
                Caso contrário, clique em "cancelar" ou pressione ESC para sair.
            </small>
            <br>
        </div>
        <x-slot:actions>
            <x-mary-form wire:submit="onDelete">
                <x-mary-button label="EXCLUIR" class="text-white bg-red-500 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled" type="submit" spinner="onDelete" />
            </x-mary-form>
            <x-mary-button label="Fechar" wire:click="closeModal" />
        </x-slot:actions>
    </x-mary-modal>
</div>
