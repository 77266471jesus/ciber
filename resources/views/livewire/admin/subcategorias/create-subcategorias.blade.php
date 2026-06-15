<div>
    @can('admin.subcategorias.create')
        <div class="px-6">
            <x-button-add wire:click="create">
                <span>Agregar</span>
            </x-button-add>
        </div>
    @endcan
    <x-modal-simple wire:model="open_create">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                AGREGAR SUBCATEGORIA
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
                                    <img src="{{ asset('images/admin/sinfoto.png') }}" alt="" class="w-64 h-64">
                                @endif
                                <input type="file" wire:model="image" id="{{ $identificador }}">
                                <x-jet-input-error for="image" class="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    {{-- categoria --}}
                    <x-jet-label value="Seleccionar Categoria" />
                    <select name="select" wire:model.defer="categoria_id"
                        class="w-full mb-2 py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm outline-none">
                        <option class="hidden">SELECIONAR</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" class="uppercase">{{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="categoria_id" />
                    {{-- nombre --}}
                    <x-jet-label value="Insertar Nombre de la Subategoria" />
                    <x-jet-input class="mb-2 w-full" type="text" wire:model="nombre" />
                    <x-jet-input-error for="nombre" />
                    {{-- slug --}}
                    <x-jet-label value="slug" />
                    <x-jet-input class="mb-2 w-full bg-gray-200" disabled type="text" wire:model="slug" />
                    <x-jet-input-error for="slug" />
                    {{-- descripcion --}}
                    <x-jet-label value="Insertar Descripcion" />
                    <textarea rows="5" class="w-full border-2 border-gray-200 rounded-md focus:outline-none focus:shadow-none focus:border-none text-justify focus:ring-1 focus:ring-blue-200"
                        wire:model.defer="descripcion"></textarea>
                    <x-jet-input-error for="descripcion" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click.prevent="cancel()">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="store" wire:loading.attr="disabled" wire:target="store, image"
                class="disabled:opacity-25">
                Añadir Categoria
            </x-jet-danger-button>
        </x-slot>
    </x-modal-simple>
</div>
