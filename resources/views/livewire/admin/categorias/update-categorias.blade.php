<div>
    <x-modal-simple wire:model="open_edit">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                EDITAR CATEGORIA <span>{{ $categoria->nombre }}</span>
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
                                    <img class="mb-2 w-64 h-64" src="{{ $image->temporaryUrl() }}" alt="">
                                @else
                                    @if ($categoria->image)
                                        <img class="mb-2 w-64 h-64" src="{{ Storage::url($categoria->image) }}" alt="">
                                    @else
                                        <img src="{{ asset('images/admin/sinfoto.png') }}" alt="" class="w-64 h-64">
                                    @endif
                                @endif
                                <input type="file" wire:model="image" id="{{ $identificador }}">
                                <x-jet-input-error for="image" class="" />
                            </div>
                        </div>
                    </div>                                                 
                </div>
                <div class="w-full md:w-1/2">
                    {{-- nombre --}}
                    <x-jet-label value="Insertar Nombre de la Categoria" />
                    <x-jet-input class="mb-2 w-full" type="text" wire:model="nombre" />
                    <x-jet-input-error for="nombre" />
                    {{-- slug --}}
                    <x-jet-label value="slug" />
                    <x-jet-input class="mb-2 w-full bg-gray-200" disabled type="text" wire:model="slug" />
                    <x-jet-input-error for="slug" />
                    {{-- descripcion --}}
                    <x-jet-label value="Insertar Descripcion" />
                    <textarea rows="5" class="w-full border-2 border-gray-200 rounded-md focus:outline-none focus:shadow-none focus:border-none text-justify focus:ring-1 focus:ring-blue-200" 
                        wire:model.defer="categoria.descripcion"></textarea>
                    <x-jet-input-error for="categoria.descripcion" />
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click.prevent="$set('open_edit', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update"
                class="disabled:opacity-25">
                Modificar
            </x-jet-danger-button>
        </x-slot>
    </x-modal-simple>
</div>
