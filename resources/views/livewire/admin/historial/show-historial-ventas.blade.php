<div>
    <x-modal-simple wire:model="open_show">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                HISTORIAL DEL PRODUCTO
                <span>{{ $producto->nombre }}</span>
            </div>
        </x-slot>

        <x-slot name="content">
            @if ($open_show)
                <div class="w-full text-center py-6">
                    <h1 class="text-xl font-bold">DETALLE VENTAS</h1>
                </div>
                <div class="flex flex-col md:flex-row w-full text-sm">
                    <div class="w-full md:w-1/2 px-4">
                        <div class="flex">
                            <h1 class="font-semibold">Producto:</h1>
                            <span class="ml-2">{{ $producto->nombre }}</span>
                        </div>
                        <div class="flex">
                            <h1 class="font-semibold">Codigo:</h1>
                            <span class="ml-2">{{ $producto->codigo }}</span>
                        </div>
                        <div class="flex">
                            <h1 class="font-semibold">Fecha de Ingreso:</h1>
                            <span class="ml-2">{{ $producto->created_at }}</span>
                        </div>
                        <div class="flex">
                            <h1 class="font-semibold">Descripción:</h1>
                        </div>
                        <div class="flex">
                            <span class="text-justify">{{ $producto->descripcion }}</span>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-4">
                        <div class="flex">
                            <h1 class="font-semibold">Marca:</h1>
                            <span class="ml-2">{{ $producto->marca }}</span>
                        </div>
                        <div class="flex">
                            <h1 class="font-semibold">Categoria:</h1>
                            <span class="ml-2">{{ $producto->subcategoria->categoria->nombre }}</span>
                        </div>
                        <div class="flex">
                            <h1 class="font-semibold">Subcategoria:</h1>
                            <span class="ml-2">{{ $producto->subcategoria->nombre }}</span>
                        </div>
                        <div class="flex">
                            <h1 class="font-semibold">Precio:</h1>
                            <span class="ml-2">{{ $producto->precio }}</span>
                        </div>
                        <div class="flex">
                            <h1 class="font-semibold">Stock Inicial:</h1>
                            <span class="ml-2">{{ $producto->stock_inicial }}</span>
                        </div>
                        <div class="flex">
                            <h1 class="font-semibold">Cantidad Disponoble:</h1>
                            <span class="ml-2">{{ $producto->stock }}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <x-table>
                        <table class="min-w-full divide-y divide-gray-200 mb-12">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="cursor-pointer px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>N°</span>
                                    </th>
                                    <th scope="col"
                                        class="cursor-pointer px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>Fecha</span>
                                    </th>
                                    <th scope="col"
                                        class="cursor-pointer px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>Cantidad</span>
                                    </th>
                                    <th scope="col"
                                        class="cursor-pointer px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>Precio Venta</span>
                                    </th>
                                    <th scope="col"
                                        class="cursor-pointer px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>Descuento</span>
                                    </th>
                                    <th scope="col"
                                        class="cursor-pointer px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>Subtotal</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($producto->detalleVentas as $detalle)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $detalle->id }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $detalle->venta->estado }}
                                            </div>
                                            <div class="text-sm text-gray-900">
                                                {{ $detalle->venta->fecha }}
                                            </div>                                            
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $detalle->cantidad }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $detalle->precio_venta }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $detalle->descuento }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $detalle->subtotal }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </x-table>
                </div>
            @endif
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_show', false)">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-modal-simple>
</div>
