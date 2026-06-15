<div>
    <h1 class="text-2xl font-bold pt-4 pb-8 pl-4 text-green-500">VENTAS</h1>
    @can('admin.ventas')
        @include('livewire.admin.ventas.show-ventas')
    @endcan
    @can('admin.ventas.estado')
        @include('livewire.admin.ventas.estado-ventas')
    @endcan
    <div class="flex items-center justify-start my-4">
        <div>
            @can('admin.create.venta')
                <div class="px-6">
                    <a href="{{ route('admin.create.venta') }}"
                        class="text-gray-300 text-sm font-semibold focus:outline-none bg-blue-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-blue-700 transition-all">
                        <i class='bx bx-plus-circle'></i>
                        <span>Agregar</span>
                    </a>
                </div>
            @endcan
        </div>
        <div>
            @can('admin.ventas.excel')
                <a href="{{ route('admin.ventas.excel') }}"
                    class="text-gray-300 text-md font-semibold focus:outline-none bg-green-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-green-700 transition-all">
                    <i class='bx bxs-printer'></i>
                    <span>Exportar Excel</span>
                </a>
            @endcan
        </div>
    </div>
    <div class="flex flex-row px-6">
        <input type="search" class="w-full border-2 border-gray-300 rounded-lg" wire:model="search"
            placeholder="Escriba lo que busca">
    </div>
    <x-table>
        @if ($ventas->count())
            <table class="min-w-full divide-y divide-gray-200 mb-12">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="relative px-1 py-2">
                            <span class="sr-only"></span>
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('id')">
                            <span>#</span>
                            @if ($sort == 'id')
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
                            class="cursor-pointer px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('clientes.nombre')">
                            <span>CLIENTE</span>
                            @if ($sort == 'clientes.nombre')
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
                            class="cursor-pointer px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
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
                            class="cursor-pointer px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('tipo_comprobante')">
                            <span>COMPROBANTE</span>
                            @if ($sort == 'tipo_comprobante')
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
                            class="cursor-pointer px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('fecha')">
                            <span>TOTAL</span>
                            @if ($sort == 'fecha')
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
                            class="cursor-pointer px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('estado')">
                            <span>ESTADO</span>
                            @if ($sort == 'estado')
                                @if ($direction == 'estado')
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
                    @foreach ($ventas as $venta)
                        <tr>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @can('admin.ventas')
                                        <x-button-show wire:click="show({{ $venta }})">
                                        </x-button-show>
                                    @endcan
                                    @can('admin.ventas.estado')
                                        @if ($fecha->format('Y-m-d') < $venta->fecha)
                                            <x-button-desactivar wire:click="estado({{ $venta }})"
                                                wire:loading.attr="disabled">
                                            </x-button-desactivar>
                                        @endif
                                    @endcan
                                    @if ($venta->estado == 'aceptado')
                                        @if ($venta->tipo_comprobante == 'factura')
                                            @can('admin.factura')
                                                <a href="{{ route('admin.factura', $venta->id) }}" target="_blank"
                                                    class="text-gray-300 text-md font-semibold focus:outline-none bg-green-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-green-700 transition-all">
                                                    <i class='bx bxs-printer'></i>
                                                </a>
                                            @endcan
                                        @endif
                                        @if ($venta->tipo_comprobante == 'boleta')
                                            @can('admin.boleta')
                                                <a href="{{ route('admin.boleta', $venta->id) }}" target="_blank"
                                                    class="text-gray-300 text-md font-semibold focus:outline-none bg-green-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-green-700 transition-all">
                                                    <i class='bx bxs-printer'></i>
                                                </a>
                                            @endcan
                                        @endif
                                    @endif
                                </div>
                            </td>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $venta->id }}
                                </div>
                            </td>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $venta->cliente }}
                                </div>
                            </td>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $venta->usuario }}
                                </div>
                            </td>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $venta->tipo_comprobante }}
                                </div>
                                <div class="text-sm text-gray-600">
                                    <span>00</span>{{ $venta->comprobante }}
                                </div>
                            </td>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $venta->total_venta }}
                                </div>
                                <div class="text-sm text-gray-600">
                                    <span>fecha: </span>
                                    {{ $venta->fecha }}
                                </div>
                            </td>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @if ($venta->estado == 'aceptado')
                                        <span class="bg-green-300 px-2 py-1 rounded-md text-green-900 capitalize">
                                            {{ $venta->estado }}
                                        </span>
                                    @else
                                        <span class="bg-red-300 px-2 py-1 rounded-md text-red-900 capitalize">
                                            {{ $venta->estado }}
                                        </span>
                                    @endif
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
        @if ($ventas->hasPages())
            <div class="px-6 py-3">
                {{ $ventas->links() }}
            </div>
        @endif
    </x-table>

</div>
