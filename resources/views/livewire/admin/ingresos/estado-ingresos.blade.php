<div>
    <x-modal-medio wire:model="open_estado">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                <h1>
                    @if ($ingreso->estado == 'aceptado')
                        <span>ANULAR INGRESO </span>
                    @else
                        <span>ACEPTAR INGRESO </span>
                    @endif
                </h1>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class=" flex items-center justify-center w-full">
                <span class="alert_delete">
                    @if ($ingreso->estado == 'aceptado')
                        <i class='bx bx-x-circle text-red-600'></i>
                    @else
                        <i class='bx bx-check-circle text-green-600'></i>
                    @endif
                </span>
                <div>
                    @if ($ingreso->estado == 'aceptado')
                        <h1 class="text-gray-700 font-semibold text-3xl">Estás seguro.?</h1>
                        <span class="text-gray-700 text-2xl">Anular</span>
                    @else
                        <h1 class="text-gray-700 font-semibold text-3xl">Estás seguro.?</h1>
                        <span class="text-gray-700 text-2xl">Aceptar</span>
                    @endif
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click.prevent="cancel">
                CANCELAR
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="AnularAceptar" wire:loading.attr="disabled" wire:target="AnularAceptar"
                class="disabled:opacity-25">
                @if ($ingreso->estado == 'aceptado')
                    <span>ANULAR</span>
                @else
                    <span>ACEPTAR</span>
                @endif
            </x-jet-danger-button>
        </x-slot>
    </x-modal-medio>
</div>
