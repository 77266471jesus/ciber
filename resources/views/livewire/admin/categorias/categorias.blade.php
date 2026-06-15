<div>
    <h1 class="text-2xl font-bold pt-4 pb-8 pl-4 text-green-500">CATEGORIAS</h1>
    @can('admin.categorias')
        @include('livewire.admin.categorias.show-categorias')
    @endcan
    @can('admin.categorias.update')
        @include('livewire.admin.categorias.update-categorias')
    @endcan
    @can('admin.categorias.estado')
        @include('livewire.admin.categorias.condicion-categorias')
    @endcan
    @can('admin.categorias.delete')
        @include('livewire.admin.categorias.delete-categorias')
    @endcan
    <div class="flex items-center justify-start my-4">
        <div>
            @can('admin.categorias.create')
                @livewire('admin.categorias.create-categorias')
            @endcan
        </div>
        <div>
            @can('admin.categorias.excel')
                <a href="{{ route('admin.categorias.excel') }}"
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
        @if ($categorias->count())
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
                            wire:click="order('condicion')">
                            <span>ESTADO</span>
                            @if ($sort == 'condicion')
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
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @can('admin.categorias')
                                        <x-button-show wire:click="show({{ $categoria }})">
                                        </x-button-show>
                                    @endcan
                                    @can('admin.categorias.update')
                                        <x-button-edit wire:click="edit({{ $categoria }})">
                                        </x-button-edit>
                                    @endcan
                                    @can('admin.categorias.estado')
                                        @if ($categoria->condicion == 'activado')
                                            <x-button-desactivar wire:click="condicion({{ $categoria }})"
                                                wire:loading.attr="disabled">
                                            </x-button-desactivar>
                                        @else
                                            <x-button-activar wire:click="condicion({{ $categoria }})"
                                                wire:loading.attr="disabled">
                                            </x-button-activar>
                                        @endif
                                    @endcan
                                    {{-- @can('admin.categorias.delete')
                                        <x-button-delete wire:click="delete({{ $categoria }})"
                                            wire:loading.attr="disabled">
                                        </x-button-delete>
                                    @endcan --}}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $categoria->id }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        @if ($categoria->image)
                                            <img class="h-12 w-12 rounded-full"
                                                src="{{ Storage::url($categoria->image) }}" alt="">
                                        @else
                                            <img class="h-12 w-12 rounded-full"
                                                src="{{ asset('images/admin/sinfoto.png') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $categoria->nombre }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($categoria->condicion == 'activado')
                                    <span class="bg-green-300 px-2 py-1 rounded-md text-green-900 capitalize">
                                        Activado
                                    </span>
                                @else
                                    <span class="bg-red-300 px-2 py-1 rounded-md text-red-900 capitalize">
                                        Desactivado
                                    </span>
                                @endif
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
        @if ($categorias->hasPages())
            <div class="px-6 py-3">
                {{ $categorias->links() }}
            </div>
        @endif
    </x-table>

</div>
