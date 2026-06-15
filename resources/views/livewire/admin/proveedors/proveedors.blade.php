<div>
    <h1 class="text-2xl font-bold pt-4 pb-8 pl-4 text-green-500">PROVEEDORES</h1>
    @can('admin.proveedors')
        @include('livewire.admin.proveedors.show-proveedors')
    @endcan
    @can('admin.proveedors.update')
        @include('livewire.admin.proveedors.update-proveedors')
    @endcan
    <div class="flex items-center justify-start my-4">
        <div>
            @can('admin.proveedors.create')
                @livewire('admin.proveedors.create-proveedors')
            @endcan
        </div>
        <div>
            @can('admin.proveedors.excel')
                <a href="{{ route('admin.proveedors.excel') }}"
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
        @if ($proveedors->count())
            <table class="min-w-full divide-y divide-gray-200 mb-12">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only"></span>
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
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
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('nombre')">
                            <span>NOMBRE</span>
                            @if ($sort == 'nombre')
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
                            wire:click="order('documento')">
                            <span>DOCUMENTO</span>
                            @if ($sort == 'documento')
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
                            wire:click="order('direccion')">
                            <span>DIRECCIÓN</span>
                            @if ($sort == 'direccion')
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
                    @foreach ($proveedors as $proveedor)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @can('admin.proveedors')
                                        <x-button-show wire:click="show({{ $proveedor }})">
                                        </x-button-show>
                                    @endcan
                                    @can('admin.proveedors.update')
                                        <x-button-edit wire:click="edit({{ $proveedor }})">
                                        </x-button-edit>
                                    @endcan
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $proveedor->id }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $proveedor->nombre }}
                                </div>
                                <div class="text-sm text-gray-600">
                                    {{ $proveedor->email }}
                                </div>
                                <div class="text-sm text-gray-600">
                                    @if ($proveedor->telefono)
                                        <i class='bx bxs-phone'></i>
                                    @endif
                                    <span>{{ $proveedor->telefono }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $proveedor->tipo_documento }}
                                </div>
                                <div class="text-sm text-gray-600">
                                    {{ $proveedor->documento }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $proveedor->direccion }}
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
        @if ($proveedors->hasPages())
            <div class="px-6 py-3">
                {{ $proveedors->links() }}
            </div>
        @endif
    </x-table>

</div>
