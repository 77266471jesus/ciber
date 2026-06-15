<div>
    <x-modal-simple wire:model="open_show">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                KARDEX FISICO VALORADO
            </div>
        </x-slot>

        <x-slot name="content">
            @if ($open_show)
                <div class="px-4">
                    <div class="w-full py-2">
                        <div class="text-center w-full text-xl font-bold text-green-600 py-4">
                            <h1>KARDEX VALORADO</h1>
                        </div>
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <div class="flex">
                                    <h2 class="text-green-700 font-semibold">Producto:</h2>
                                    <h3 class="ml-2 text-gray-700">{{ $producto->nombre }}</h3>
                                </div>
                                <div class="flex">
                                    <h2 class="text-green-700 font-semibold">Codigo:</h2>
                                    <h3 class="ml-2 text-gray-700">{{ $producto->codigo }}</h3>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex">
                                    <h2 class="text-green-700 font-semibold">Fecha:</h2>
                                    <h3 class="ml-2 text-gray-700">{{ $this->mes }}/<span>{{ $this->anio }}</span>
                                    </h3>
                                </div>
                                <div class="flex">
                                    <h2 class="text-green-700 font-semibold">Unidad Metrica:</h2>
                                    <h3 class="ml-2 text-gray-700"> {{ $producto->medida }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-table>
                    @if ($mesKardexs->count())
                        <table class="min-w-full divide-y divide-gray-200 mb-12">
                            <thead class="bg-gray-50 divide-y divide-gray-300">
                                <tr>
                                    <th scope="col" rowspan="2"
                                        class="border-r border-gray-300 cursor-pointer px-2 py-1 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>FECHA</span>
                                    </th>
                                    <th scope="col" rowspan="2"
                                        class="border-r border-gray-300 cursor-pointer px-2 py-1 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>DETALLE</span>
                                    </th>
                                    <th scope="col" rowspan="2"
                                        class="border-r border-gray-300 cursor-pointer px-2 py-1 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>C/U</span>
                                    </th>
                                    <th scope="col" colspan="2"
                                        class="border-r border-gray-300 cursor-pointer px-2 py-1 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>CANTIDAD</span>
                                    </th>
                                    <th scope="col" colspan="2"
                                        class="border-r border-gray-300 cursor-pointer px-2 py-1 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>PRECIO</span>
                                    </th>
                                    <th scope="col" colspan="2"
                                        class="border-r border-gray-300 cursor-pointer px-2 py-1 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>TOTALES</span>
                                    </th>
                                </tr>
                                <tr>                                    
                                    <th scope="col"
                                        class="border-r border-gray-300 cursor-pointer px-2 py-1 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>ENTRADA</span>
                                    </th>
                                    <th scope="col"
                                        class="border-r border-gray-300 cursor-pointer px-2 py-1 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>SALIDA</span>
                                    </th>
                                    <th scope="col"
                                        class="border-r border-gray-300 cursor-pointer px-2 py-1 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>ENTRADA</span>
                                    </th>
                                    <th scope="col"
                                        class="border-r border-gray-300 cursor-pointer px-2 py-1 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>SALIDA</span>
                                    </th>
                                    <th scope="col"
                                        class="border-r border-gray-300 cursor-pointer px-2 py-1 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>CANTIDAD</span>
                                    </th>
                                    <th scope="col"
                                        class="border-r border-gray-300 cursor-pointer px-2 py-1 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <span>PRECIO</span>
                                    </th>                                    
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-300">
                                @foreach ($mesKardexs as $Kardex)
                                    <tr>
                                        <td class="px-2 py-2 whitespace-nowrap border-r border-gray-300">
                                            <div class="text-sm text-gray-900">
                                                {{ $Kardex->fecha }}
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap border-r border-gray-300">
                                            <div class="text-sm text-gray-900">
                                                {{ $Kardex->detalle }}
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap border-r border-gray-300">
                                            <div class="text-sm text-gray-900">
                                                {{ $Kardex->costo_unitario }}
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap border-r border-gray-300">
                                            <div class="text-sm text-gray-900">
                                                {{ $Kardex->cantidad_entrada }}
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap border-r border-gray-300">
                                            <div class="text-sm text-gray-900">
                                                {{ $Kardex->cantidad_salida }}
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap border-r border-gray-300">
                                            <div class="text-sm text-gray-900">
                                                {{ $Kardex->precio_entrada }}
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap border-r border-gray-300">
                                            <div class="text-sm text-gray-900">
                                                {{ $Kardex->precio_salida }}
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap border-r border-gray-300">
                                            <div class="text-sm text-gray-900">
                                                {{ $Kardex->cantidad_total }}
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 whitespace-nowrap border-r border-gray-300">
                                            <div class="text-sm text-gray-900">
                                                {{ $Kardex->precio_total }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </x-table>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_show', false)">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-modal-simple>
</div>
