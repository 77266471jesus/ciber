<div>
    <h1 class="text-2xl font-bold pt-4 pb-8 pl-4 text-green-500 uppercase">REGISTRO DE ACTIVIDAD DE
        <span>{{ $producto->nombre }}</span>
    </h1>
    <div
        class="w-full px-6 transition-all pb-4 flex flex-col md:flex-row md:items-center space-y-3 md:space-y-0 space-x-0 md:space-x-2">
        <div class="w-full md:w-2/6">
            <select name="select" wire:model="consulta"
                class="w-full py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm outline-none">
                <option value="dia">DIA</option>
                <option value="mes">MES</option>
            </select>
        </div>
        @if ($consulta == 'dia')
            <div class="w-full md:w-2/6">
                <x-jet-input class="w-full" type="date" wire:model="fecha" />
            </div>
        @endif
        @if ($consulta == 'mes')
            <div class="w-full md:w-2/6">
                <x-jet-input class="w-full" type="month" wire:model="fecha" />
            </div>
        @endif
        @can('admin.historial.ventas.excel')
            <div class="w-full md:w-2/6">
                <a href="{{ route('admin.historialventa.excel', [$producto_id, $fecha]) }}"
                    class="text-gray-300 text-md font-semibold focus:outline-none bg-green-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-green-700 transition-all">
                    <i class='bx bxs-printer'></i>
                    <span>Excel {{ $fecha }} </span>
                </a>
            </div>
        @endcan
    </div>
    <div class="flex flex-row px-6">
        <input type="search" class="w-full border-2 border-gray-300 rounded-lg" wire:model="search"
            placeholder="Escriba lo que busca">
    </div>
    <x-table>
        @if ($detalleVentas->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('ventas.fecha')">
                            <span>FECHA</span>
                            @if ($sort == 'ventas.fecha')
                                @if ($direction == 'asc')
                                    <i class='pl-2 bx bx-sort-z-a'></i>
                                @else
                                    <i class='pl-2 bx bx-sort-a-z'></i>
                                @endif
                            @else
                                <i class='pl-2 bx bxs-sort-alt'></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('detalle_ventas.cantidad')">
                            <span>CANTIDAD</span>
                            @if ($sort == 'detalle_ventas.cantidad')
                                @if ($direction == 'asc')
                                    <i class='pl-2 bx bx-sort-z-a'></i>
                                @else
                                    <i class='pl-2 bx bx-sort-a-z'></i>
                                @endif
                            @else
                                <i class='pl-2 bx bxs-sort-alt'></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('detalle_ventas.precio_venta')">
                            <span>PRECIO VENTA</span>
                            @if ($sort == 'detalle_ventas.precio_venta')
                                @if ($direction == 'asc')
                                    <i class='pl-2 bx bx-sort-z-a'></i>
                                @else
                                    <i class='pl-2 bx bx-sort-a-z'></i>
                                @endif
                            @else
                                <i class='pl-2 bx bxs-sort-alt'></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('detalle_ventas.descuento')">
                            <span>DESCUENTO</span>
                            @if ($sort == 'detalle_ventas.descuento')
                                @if ($direction == 'asc')
                                    <i class='pl-2 bx bx-sort-z-a'></i>
                                @else
                                    <i class='pl-2 bx bx-sort-a-z'></i>
                                @endif
                            @else
                                <i class='pl-2 bx bxs-sort-alt'></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('detalle_ventas.subtotal')">
                            <span>TOTAL</span>
                            @if ($sort == 'detalle_ventas.subtotal')
                                @if ($direction == 'asc')
                                    <i class='pl-2 bx bx-sort-z-a'></i>
                                @else
                                    <i class='pl-2 bx bx-sort-a-z'></i>
                                @endif
                            @else
                                <i class='pl-2 bx bxs-sort-alt'></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('users.name')">
                            <span>USUARIO</span>
                            @if ($sort == 'users.name')
                                @if ($direction == 'asc')
                                    <i class='pl-2 bx bx-sort-z-a'></i>
                                @else
                                    <i class='pl-2 bx bx-sort-a-z'></i>
                                @endif
                            @else
                                <i class='pl-2 bx bxs-sort-alt'></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('ventas.tipo_comprobante')">
                            <span>VENTA</span>
                            @if ($sort == 'ventas.tipo_comprobante')
                                @if ($direction == 'asc')
                                    <i class='pl-2 bx bx-sort-z-a'></i>
                                @else
                                    <i class='pl-2 bx bx-sort-a-z'></i>
                                @endif
                            @else
                                <i class='pl-2 bx bxs-sort-alt'></i>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($detalleVentas as $detalleVenta)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $detalleVenta->fecha }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $detalleVenta->cantidad }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $detalleVenta->precio_venta }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $detalleVenta->descuento }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $detalleVenta->subtotal }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $detalleVenta->nombre }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm ">
                                    {{ $detalleVenta->tipo_comprobante }}
                                </div>
                                <div class="text-sm ">
                                    {{ $detalleVenta->comprobante }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-4">
                No existe registros
            </div>
        @endif
        @if ($detalleVentas->hasPages())
            <div class="px-6 py-3">
                {{ $detalleVentas->links() }}
            </div>
        @endif
    </x-table>

</div>
