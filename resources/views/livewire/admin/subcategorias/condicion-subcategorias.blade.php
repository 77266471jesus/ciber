<div>
    <x-modal-medio wire:model="open_condicion">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                <h1>
                    @if ($subcategoria->condicion == 'activado')
                        <span>DESACTIVAR SUBCATEG0RIA </span>
                    @else
                        <span>ACTIVAR SUBCATEG0RIA </span>
                    @endif
                    <span class="uppercase"> {{ $subcategoria->nombre }}</span>
                </h1>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class=" flex items-center justify-center w-full">
                <span class="alert_delete">
                    @if ($subcategoria->condicion == 'activado')
                        <i class='bx bx-x-circle text-red-600'></i>
                    @else
                        <i class='bx bx-check-circle text-green-600'></i>
                    @endif
                </span>
                <div>
                    @if ($subcategoria->condicion == 'activado')
                        <h1 class="text-gray-700 font-semibold text-3xl">Estás seguro.?</h1>
                        <span class="text-gray-700 text-2xl">Desactivar</span>
                    @else
                        <h1 class="text-gray-700 font-semibold text-3xl">Estás seguro.?</h1>
                        <span class="text-gray-700 text-2xl">Activar</span>
                    @endif
                </div>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click.prevent="cancel">
                CANCELAR
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="ActivarDesactivar" wire:loading.attr="disabled" wire:target="ActivarDesactivar"
                class="disabled:opacity-25">
                @if ($subcategoria->condicion == 'activado')
                    <span>DESACTIVAR</span>
                @else
                    <span>ACTIVAR</span>
                @endif
            </x-jet-danger-button>
        </x-slot>
    </x-modal-medio>
</div>
