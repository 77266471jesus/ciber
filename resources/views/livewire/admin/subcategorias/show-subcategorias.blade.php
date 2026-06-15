<div>
    <x-modal-simple wire:model="open_show">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                INFORMACION SUBCATEGORIA
                <span>{{ $show_subcategoria->nombre }}</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="w-full px-4 flex items-start flex-col md:flex-row pt-4">
                <div class="w-full md:w-1/2 px-0 md:px-4">
                    <div class="w-full flex justify-center">
                        <div>
                            <div class="w-64 h-64">
                                @if ($show_subcategoria->image)
                                    <img class="mb-2 w-64 h-64" src="{{ Storage::url($show_subcategoria->image) }}"
                                        alt="">
                                @else
                                    <img src="{{ asset('images/admin/sinfoto.png') }}" alt="" class="w-64 mb-2 h-64">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-center ">
                        {{-- nombre --}}
                        <x-jet-label value="Estado" />
                        @if ($show_subcategoria->condicion == 'activado')
                            <span class="bg-green-300 px-4 py-2 rounded-md text-green-900 font-bold capitalize">
                                Activado
                            </span>
                        @else
                            <span class="bg-red-300 px-4 py-2 rounded-md text-red-900 font-bold capitalize">
                                Desactivado
                            </span>
                        @endif
                    </div>

                </div>
                <div class="w-full md:w-1/2">
                    {{-- categoria --}}
                    <x-jet-label value="Categoria" />
                    @if ($show_subcategoria->categoria_id == null)
                        <input type="text" value="Sin Categoria" disabled
                            class="w-full rounded-md border-2 border-gray-300">
                    @else
                        @foreach ($categorias as $categoria)
                            @if ($categoria->id == $show_subcategoria->categoria_id)
                                <input type="text" value="{{ $categoria->nombre }}" disabled
                                    class="w-full rounded-md border-2 border-gray-300">
                            @endif
                        @endforeach
                    @endif
                    {{-- nombre --}}
                    <x-jet-label value="Nombre de la Categoria" />
                    <input type="text" value="{{ $show_subcategoria->nombre }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    {{-- slug --}}
                    <x-jet-label value="slug" />
                    <input type="text" value="{{ $show_subcategoria->slug }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    {{-- descrpcion --}}
                    <x-jet-label value="descripcion" />
                    <textarea rows="5" class="w-full border-2 border-gray-200 rounded-md focus:outline-none focus:shadow-none focus:border-none text-justify focus:ring-1 focus:ring-blue-200"
                        disabled>{{ $show_subcategoria->descripcion }}</textarea>
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
