<div>
    @can('admin.clientes.create')
        <div class="px-6">
            <x-button-add wire:click="create">
                <span>Agregar</span>
            </x-button-add>
        </div>
    @endcan
    <x-modal-simple wire:model="open_create">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                AGREGAR CLIENTE
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="w-full px-4 flex items-start flex-col md:flex-row pt-4">
                <div class="w-full px-8">
                    {{-- nombre --}}
                    <x-jet-label value="Insertar Nombre del Proveedor" />
                    <x-jet-input class="mb-2 w-full" type="text" wire:model.defer="nombre" />
                    <x-jet-input-error for="nombre" />
                    {{-- documento --}}
                    <x-jet-label value="Introducir datos de documento" />
                    <div class="flex flex-row items-start w-full">
                        <div class="w-2/5">
                            <select name="select" wire:model.defer="tipo_documento"
                                class="w-full mb-2 py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm outline-none">
                                <option class="hidden">SELECIONAR</option>
                                <option value="carnet">C.I.</option>
                                <option value="nit">NIT</option>
                            </select>
                            <x-jet-input-error for="tipo_documento" />
                        </div>
                        <div class="w-3/5">
                            <x-jet-input class="mb-2 w-full" type="text" placeholder="N° DOCUMENTACION"
                                wire:model.defer="documento" />
                            <x-jet-input-error for="documento" />
                        </div>
                    </div>
                    {{-- telefono --}}
                    <x-jet-label value="Insertar Telefono" />
                    <x-jet-input class="mb-2 w-full" type="text" wire:model.defer="telefono" />
                    <x-jet-input-error for="telefono" />
                    {{-- email --}}
                    <x-jet-label value="Insertar Correo/Email" />
                    <x-jet-input class="mb-2 w-full" type="email" wire:model.defer="email" />
                    <x-jet-input-error for="email" />
                    {{-- direccion --}}
                    <x-jet-label value="Insertar Direccion" />
                    <x-jet-input class="mb-2 w-full" type="text" wire:model.defer="direccion" />
                    <x-jet-input-error for="direccion" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click.prevent="cancel()">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="store" wire:loading.attr="disabled" wire:target="store"
                class="disabled:opacity-25">
                Añadir Cliente
            </x-jet-danger-button>
        </x-slot>
    </x-modal-simple>
</div>
