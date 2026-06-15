<div>
    <x-modal-simple wire:model="open_show">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                INFORMACION PROVEEDOR
                <span>{{ $proveedor->nombre }}</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="w-full px-4 flex items-start flex-col md:flex-row pt-4">
                <div class="w-full px-8">
                    {{-- nombre --}}
                    <div>
                        <x-jet-label value="Nombre Proveedor" />
                        <input type="text" value="{{ $proveedor->nombre }}" disabled
                            class="w-full rounded-md border-2 border-gray-300">
                    </div>
                    {{-- documento --}}
                    <x-jet-label value="Datos del Documento" />
                    <div class="flex flex-row items-start w-full">
                        <div class="w-2/5">
                            <input type="text" value="{{ $proveedor->tipo_documento }}" disabled
                                class="w-full rounded-md border-2 border-gray-300">
                        </div>
                        <div class="w-3/5">
                            <input type="text" value="{{ $proveedor->documento }}" disabled
                                class="w-full rounded-md border-2 border-gray-300">
                        </div>
                    </div>
                    {{-- email --}}
                    <div>
                        <x-jet-label value="Email" />
                        <input type="text" value="{{ $proveedor->email }}" disabled
                            class="w-full rounded-md border-2 border-gray-300">
                    </div>
                    {{-- telefono --}}
                    <div>
                        <x-jet-label value="Telefono" />
                        <input type="text" value="{{ $proveedor->telefono }}" disabled
                            class="w-full rounded-md border-2 border-gray-300">
                    </div>
                    {{-- direccion --}}
                    <div>
                        <x-jet-label value="Direccion" />
                        <input type="text" value="{{ $proveedor->direccion }}" disabled
                            class="w-full rounded-md border-2 border-gray-300">
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_show', false)">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-modal-simple>
</div>
