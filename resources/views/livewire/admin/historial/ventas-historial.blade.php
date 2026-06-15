<div>
    <h1 class="text-2xl font-bold pt-4 pb-8 pl-4 text-green-500 uppercase">HISTORIAL DE VENTAS</h1>
    <div class="flex flex-row px-6">
        <input type="search" class="w-full border-2 border-gray-300 rounded-lg" wire:model="search"
            placeholder="Escriba lo que busca">
    </div>
    <x-table>
        @if ($productos->count())
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
                            wire:click="order('marca')">
                            <span>MARCA</span>
                            @if ($sort == 'marca')
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
                    @foreach ($productos as $producto)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @can('admin.historial.ventas')
                                    <div class="text-sm text-gray-900">
                                        <div class="text-sm text-gray-900">
                                            <a href="{{ route('admin.ver.ventas.historial', $producto->id) }}"
                                                class="text-gray-300 text-sm font-semibold focus:outline-none bg-green-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-green-700 transition-all">
                                                <i class='bx bx-show' ></i> 
                                                <span>Ver Historial</span>
                                            </a>
                                        </div>
                                    </div>
                                @endcan
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $producto->id }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        @if ($producto->image)
                                            <img class="h-12 w-12 rounded-full"
                                                src="{{ Storage::url($producto->image) }}" alt="">
                                        @else
                                            <img class="h-12 w-12 rounded-full"
                                                src="{{ asset('images/admin/sinfoto.png') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $producto->nombre }}
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <i class='ml-1 text-black'>Categoria:</i>
                                            @if ($producto->subcategoria)
                                                @if ($producto->subcategoria->categoria == null)
                                                    <span>Sin Categoria</span>
                                                @else
                                                    <span>{{ $producto->subcategoria->categoria->nombre }}</span>
                                                @endif
                                            @else
                                                <span>Sin Categoria</span>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <i class='ml-1 text-black'>Subcategoria:</i>
                                            @if ($producto->subcategoria == null)
                                                <span>Sin Subcategoria</span>
                                            @else
                                                <span>{{ $producto->subcategoria->nombre }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $producto->marca }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($producto->condicion == 'activado')
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
        @if ($productos->hasPages())
            <div class="px-6 py-3">
                {{ $productos->links() }}
            </div>
        @endif
    </x-table>

</div>
