<div>
    @can('admin.usuarios.create')
        <div class="px-6">
            <x-button-add wire:click="create">
                <span>Agregar</span>
            </x-button-add>
        </div>
    @endcan
    <x-modal-simple wire:model="open_create">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                AGREGAR USUARIO
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="w-full px-4 flex items-start flex-col md:flex-row pt-4">
                <div class="w-full md:w-1/2 px-0 md:px-4">
                    <div class="w-full flex justify-center mb-10">
                        <div>
                            <div wire:loading wire:target="image"
                                class="mb-4 bg-red-100 border border-red-400 text-red-900 px-4 py-3 rounded relative"
                                role="alert">
                                <strong class="font-bold">Imagen Cargando</strong>
                                <span class="block sm:inline">Espere...</span>
                            </div>
                            <div class="w-64 h-64">
                                @if ($image)
                                    <img class="w-64 h-64" src="{{ $image->temporaryUrl() }}" alt="">
                                @else
                                    <img src="{{ asset('images/admin/user.png') }}" alt="" class="w-64 h-64">
                                @endif
                                <input type="file" wire:model="image" id="{{ $identificador }}">
                                <x-jet-input-error for="image" class="" />
                            </div>
                        </div>
                    </div>
                    {{-- nombre --}}
                    <x-jet-label value="Insertar Nombre Completo" />
                    <x-jet-input class="mb-2 w-full" type="text" wire:model.defer="name" />
                    <x-jet-input-error for="name" />
                    {{-- nombre de usaurio --}}
                    <x-jet-label value="Insertar Nombre de Usuario Unico" />
                    <x-jet-input class="mb-2 w-full" type="text" wire:model.defer="user_name" />
                    <x-jet-input-error for="user_name" />
                </div>
                <div class="w-full md:w-1/2">
                    {{-- documento --}}
                    <x-jet-label value="Introducir datos de documento" />
                    <div class="flex flex-row items-start w-full">
                        <div class="w-2/5">
                            <select name="select" wire:model.defer="tipo_documento"
                                class="w-full mb-2 py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm outline-none">
                                <option class="hidden">SELECIONAR</option>
                                <option value="c.i.">CARNET DE IDENTIDAD</option>
                                <option value="nit">NIT</option>
                            </select>
                            <x-jet-input-error for="tipo_documento" />
                        </div>
                        <div class="w-3/5">
                            <x-jet-input class="mb-2 w-full" type="text" placeholder="N° DOCUMENTACION"
                                wire:model.defer="ci" />
                            <x-jet-input-error for="ci" />
                        </div>
                    </div>
                    {{-- email --}}
                    <x-jet-label value="Insertar Correo/Email" />
                    <x-jet-input class="mb-2 w-full" type="email" wire:model.defer="email" />
                    <x-jet-input-error for="email" />
                    {{-- cargo --}}
                    <x-jet-label value="Insertar Cargo del Personal" />
                    <select name="select" wire:model="cargo"
                        class="w-full mb-2 py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm outline-none">
                        <option class="hidden">SELECIONAR</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="cargo" />
                    {{-- telefono --}}
                    <x-jet-label value="Insertar Telefono" />
                    <x-jet-input class="mb-2 w-full" type="text" wire:model.defer="telefono" />
                    <x-jet-input-error for="telefono" />
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
            <x-jet-danger-button wire:click="store" wire:loading.attr="disabled" wire:target="store, image"
                class="disabled:opacity-25">
                Añadir Personal
            </x-jet-danger-button>
        </x-slot>
    </x-modal-simple>
</div>
