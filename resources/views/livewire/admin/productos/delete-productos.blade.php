<div>
    <x-modal-medio wire:model="open_delete">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                ELMINAR PRODUCTO <span class="uppercase"> {{$delete->nombre}}</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class=" flex items-center justify-center w-full">
                <span class="alert_delete">
                    <i class='bx bx-error-circle bx-tada'></i>
                </span>
                <div>
                    <h1 class="text-gray-700 text-3xl">
                        Estás seguro.?
                    </h1>
                    <h2 class="text-md text-gray-800">
                        ¡No podrás revertir esto!
                    </h2>
                </div>
            </div>
            
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click.prevent="cancel">
                CANCELAR
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="destroy" wire:loading.attr="disabled" wire:target="destroy"
                class="disabled:opacity-25">
                ELIMINAR
            </x-jet-danger-button>
        </x-slot>
    </x-modal-medio>
</div>