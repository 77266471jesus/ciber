<div>
    <x-jet-dialog-modal wire:model="open_password">
        <x-slot name="title">
            <div class="text-left text-green-900 mt-3 font-bold uppercase ">
                CAMBIAR CONTRASEÑA DE<span class="ml-2">{{$user->name}}</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col px-6 pb-4">
                <x-jet-label value="Insertar Contraseña" />
                <x-jet-input class="mb-2 w-full" type="text" wire:model="password" />
                <x-jet-input-error for="password" />
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click.prevent="$set('open_password', false)">
                Cerrar
            </x-jet-secondary-button>
            <button wire:click="restablecer" wire:loading.attr="disabled" wire:target="restablecer"
                class="text-gray-100 mx-4 text-sm font-semibold focus:outline-none bg-yellow-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-yellow-700 transition-all">                
                <span>Restablecer</span>
            </button>
            <x-jet-danger-button wire:click="cambiar" wire:loading.attr="disabled" wire:target="cambiar"
                class="disabled:opacity-25">
                Modificar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
