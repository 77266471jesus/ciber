<div>
    <h1 class="text-2xl font-bold pt-4 pb-8 pl-4 text-green-500">COTIZACION</h1>
    @can('admin.cotizacion')
        @include('livewire.admin.cotizacion.show-cotizacions')
    @endcan
    <div class="flex items-center justify-start my-4">
        <div>
            @can('admin.create.cotizacion')
                <div class="px-6">
                    <a href="{{ route('admin.create.cotizacion') }}"
                        class="text-gray-300 text-sm font-semibold focus:outline-none bg-blue-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-blue-700 transition-all">
                        <i class='bx bx-plus-circle'></i>
                        <span>Agregar</span>
                    </a>
                </div>
            @endcan
        </div>
        <div>
            @can('admin.cotizacion.excel')
                <a href="{{ route('admin.cotizacions.excel') }}"
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
        @if ($cotizacions->count())
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
                            wire:click="order('comprobante')">
                            <span>COMPROBANTE</span>
                            @if ($sort == 'comprobante')
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
                            wire:click="order('total')">
                            <span>TOTAL</span>
                            @if ($sort == 'total')
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
                    @foreach ($cotizacions as $cotizacion)
                        <tr>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @can('admin.cotizacion')
                                        <x-button-show wire:click="show({{ $cotizacion }})">
                                        </x-button-show>
                                    @endcan
                                    @can('admin.proforma')
                                        <a href="{{ route('admin.proforma', $cotizacion->id) }}" target="_blank"
                                            class="text-gray-300 text-md font-semibold focus:outline-none bg-green-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-green-700 transition-all">
                                            <i class='bx bxs-printer'></i>
                                        </a>
                                    @endcan
                                </div>
                            </td>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $cotizacion->id }}
                                </div>
                            </td>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $cotizacion->cliente }}
                                </div>
                            </td>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $cotizacion->usuario }}
                                </div>
                            </td>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $cotizacion->comprobante }}
                                </div>
                            </td>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $cotizacion->total }}
                                </div>
                                <div class="text-sm text-gray-600">
                                    <span>fecha: </span>
                                    {{ $cotizacion->fecha }}
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
        @if ($cotizacions->hasPages())
            <div class="px-6 py-3">
                {{ $cotizacions->links() }}
            </div>
        @endif
    </x-table>

</div>
