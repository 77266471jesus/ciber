<div>
    <x-modal-medio wire:model="modal_delete">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                ELMINAR BACKUP 
            </div>
        </x-slot>

        <x-slot name="content">
            <div class=" flex items-center justify-center w-full">
                <span class="alert_delete">
                    <i class='bx bx-error-circle bx-tada'></i>
                </span>
                <div>
                    <h1 class="text-gray-700 text-2xl">
                        Estás seguro de eliminar.?
                    </h1>
                    @if ($deletingFile)
                        <h2 class="text-md text-gray-800 font-bold">
                            {{ $deletingFile['date'] }} ?
                        </h2>
                    @endif
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click.prevent="cancel">
                CANCELAR
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="deleteFile" wire:loading.attr="disabled" wire:target="deleteFile"
                class="disabled:opacity-25">
                ELIMINAR
            </x-jet-danger-button>
        </x-slot>
    </x-modal-medio>
</div>
