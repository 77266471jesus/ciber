<div>
    <div class="flex flex-row h-12 cotizacion_busqueda">
        <input type="search" class="w-full input_search border-2 border-gray-300 rounded-lg focus:outline-none"
            wire:model="search" placeholder="Buscar producto">
        <i class='bx bx-search-alt input_icon'></i>
    </div>
    @if ($search)
        <div class="absolute cotizacion_productos bg-gray-100 mt-2 rounded-md">
            <div class="p-2">
                @if ($productos->count())
                    @foreach ($productos as $producto)
                        <a  href="{{ route('pagina.producto_slug', $producto->slug) }}"
                        class="flex items-center space-x-2 border-b border-gray-300 transition-all bg-gray-100 hover:bg-gray-300 w-full">
                            <div class="w-20 bg-blue-100">
                                <img src="{{ Storage::url($producto->image) }}" alt="" class="rounded-2xl">
                            </div>
                            <div>
                                <h1 class="uppercase text-justify text-sm  font-semibold">{{ $producto->nombre }}</h1>
                                <h2 class="text-xs">
                                    <span class="font-semibold">Marca:</span>
                                    <span>{{ $producto->marca }}</span>
                                </h2>
                            </div>
                        </a>
                    @endforeach
                @else
                    <button wire:click="cerrar()"
                        class="focus:outline-none flex items-center space-x-2 border-b border-gray-300 transition-all bg-gray-100 hover:bg-gray-300 w-full">
                        <div class="w-12 bg-blue-100">
                            <img src="{{ asset('images/sinfoto.png') }}" alt="" class="rounded-2xl">
                        </div>
                        <div>
                            <h1 class="uppercase text-justify text-sm  font-semibold">No Encontrado</h1>
                            <h2 class="text-xs">
                                <span class="font-semibold">No se encuentra producto existente</span>
                            </h2>
                        </div>
                    </button>
                @endif
            </div>
        </div>
    @endif
</div>
