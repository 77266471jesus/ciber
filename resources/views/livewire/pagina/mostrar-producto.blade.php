<div>
    <div class="h-20 w-full color_menu_scroll">
    </div>
    <div class="w-full pl-12 pr-6 mb-12 mt-6">
        <div
            class="flex flex-col md:flex-row space-x-0 md:space-x-2 space-y-2 md:space-y-0 bg-white shadow-md rounded-md py-4">
            <div class="w-full md:w-1/2 flex flex-col justify-center items-center">
                <div class="w-4/5 p-4">
                    <img class="w-full rounded-md" src="{{ Storage::url($producto->image) }}" alt="">
                </div>
            </div>
            <div class="w-full md:w-1/2 pt-4 px-4">
                <h1 class="text-xl font-bold uppercase text-center py-2">{{ $producto->nombre }}</h1>
                <h2 class="py-2">
                    <span class="mr-2 text-green-600 font-semibold">CODIGO:</span>
                    <span class="text-gray-800">{{ $producto->codigo }}</span>
                </h2>
                <h2 class="py-2">
                    <span class="mr-2 text-green-600 font-semibold">MARCA:</span>
                    <span class="text-gray-800">{{ $producto->marca }}</span>
                </h2>
                <h2 class="py-2">
                    <span class="mr-2 text-green-600 font-semibold">CATEGORIA:</span>
                    <span class="text-gray-800">{{ $producto->subcategoria->categoria->nombre }}</span>
                </h2>
                <h2 class="py-2">
                    <span class="mr-2 text-green-600 font-semibold">SUBCATEGORIA:</span>
                    <span class="text-gray-800">{{ $producto->subcategoria->nombre }}</span>
                </h2>
                @can('admin.clientes.usuario')
                    <h2 class="py-2">
                        <span class="mr-2 text-green-600 font-semibold">PRECIO:</span>
                        <span class="text-gray-800">{{ $producto->precio_venta + $producto->precio_venta * 0.13 }}</span>
                    </h2>
                @endcan
                <div class="flex items-center py-2 text-blue-600 font-bold border-b-2 border-blue-400">
                    <i class='bx bx-error-alt mr-2 text-2xl'></i>
                    <h1>DESCRIPCIÓN DEL PRODUCTO</h1>
                </div>
                <h3 class="text-gray-800 py-4 text-justify">{{ $producto->descripcion }}</h3>
                <div>
                    @can('pagina.cotizacion')
                        <button wire:click="productos({{ $producto }})" wire:loading.attr="disabled"
                            wire:target="productos({{ $producto }})"
                            class="focus:outline-none bg-green-500 hover:bg-green-700 transition-all text-gray-200 hover:text-white flex items-center space-x-2 p-2 rounded-md">
                            <i class='bx bxs-cart-add text-lg'></i>
                            <span>Agregar Producto</span>
                        </button>
                    @endcan
                </div>
                @if (session()->has('message'))
                    <div wire:poll.4s
                        class="mb-4 bg-red-100 border border-red-400 text-red-900 px-6 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">{{ session('message') }}</strong><br>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
