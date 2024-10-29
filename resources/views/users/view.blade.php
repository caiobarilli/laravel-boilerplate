<div>
    <x-mary-modal wire:model="openModal" class="backdrop-blur">
        @if ($user)
            <x-mary-form no-separator>
                <div class="grid grid-cols-1">
                    <div>
                        <x-mary-input wire:model="name" value="{{ $user->name }}" disabled />
                    </div>
                </div>

                <div class="grid grid-cols-1">
                    <div>
                        <x-mary-input wire:model="email" value="{{ $user->email }}" disabled />
                    </div>
                </div>

                <x-slot:actions>
                    <x-mary-button label="Cancelar" wire:click="closeModal" />
                </x-slot:actions>
            </x-mary-form>
        @endif
    </x-mary-modal>
</div>
