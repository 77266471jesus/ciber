<div>
    <x-modal-simple wire:model="open_show">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                INFORMACION PRODUCTO
                <span>{{ $show_producto->nombre }}</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="w-full px-4 flex items-start flex-col md:flex-row pt-4">
                <div class="w-full md:w-1/2 px-0 md:px-4">
                    <div class="w-full flex justify-center">
                        <div>
                            <div class="w-64 h-64">
                                @if ($show_producto->image)
                                    <img class="mb-2 w-64 h-64" src="{{ Storage::url($show_producto->image) }}" alt="">
                                @else
                                    <img src="{{ asset('images/admin/sinfoto.png') }}" alt="" class="w-64 mb-2 h-64">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-center ">
                        {{-- nombre --}}
                        <x-jet-label value="Estado" />
                        @if ($show_producto->condicion == 'activado')
                            <span class="bg-green-300 px-4 py-2 rounded-md text-green-900 font-bold capitalize">
                                Activado
                            </span>
                        @else
                            <span class="bg-red-300 px-4 py-2 rounded-md text-red-900 font-bold capitalize">
                                Desactivado
                            </span>
                        @endif
                    </div>
                    {{-- nombre --}}
                    <x-jet-label value="Nombre de Producto" />
                    <input type="text" value="{{ $show_producto->nombre }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    {{-- slug --}}
                    <x-jet-label value="slug" />
                    <input type="text" value="{{ $show_producto->marca }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    {{-- codigo --}}
                    <div class="flex items-center justify-center w-full mt-6">
                        <div>
                            {!! DNS1D::getBarcodeSVG($show_producto->codigo, 'C39', 2, 66) !!}
                        </div>
                    </div>


                </div>
                <div class="w-full md:w-1/2">
                    {{-- Subcategoira --}}
                    <x-jet-label value="Subcategoira" />
                    @if ($show_producto->subcategoria_id == null)
                        <input type="text" value="Sin Categoria" disabled
                            class="w-full rounded-md border-2 border-gray-300">
                    @else
                        @foreach ($subcategorias as $subcategoria)
                            @if ($subcategoria->id == $show_producto->subcategoria_id)
                                <input type="text" value="{{ $subcategoria->nombre }}" disabled
                                    class="w-full rounded-md border-2 border-gray-300">
                            @endif
                        @endforeach
                    @endif
                    {{-- medida --}}
                    <x-jet-label value="Unidad de Medida" />
                    <input type="text" value="{{ $show_producto->medida }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    {{-- Stock Inical --}}
                    <x-jet-label value="Cantidad Inicial" />
                    <input type="text" value="{{ $show_producto->stock_inicial }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    {{-- Stock --}}
                    <x-jet-label value="Cantidad Disponible" />
                    <input type="text" value="{{ $show_producto->stock }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    {{-- Precio --}}
                    <x-jet-label value="Precio de compra" />
                    <input type="text" value="{{ $show_producto->precio_compra }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    {{-- Precio Unitario --}}
                    <x-jet-label value="Precio de Venta" />
                    <input type="text" value="{{ $show_producto->precio_venta }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    {{-- descrpcion --}}
                    <x-jet-label value="descripcion" />
                    <textarea rows="8" class="w-full border-2 border-gray-300 rounded-md focus:outline-none focus:shadow-none focus:border-none text-justify focus:ring-1 focus:ring-blue-200"
                        disabled>{{ $show_producto->descripcion }}</textarea>
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
