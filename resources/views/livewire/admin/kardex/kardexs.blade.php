<div>
    <h1 class="text-2xl font-bold pt-4 pb-8 pl-4 text-green-500">KARDEX</h1>
    <div wire:loading wire:target="resultado" class="absolute top-0 left-0"
        style="background: rgba(0, 0, 0, 0.384); height: 100vh; width: 100vw;">
        <div class="flex flex-col items-center justify-center w-full h-full">
            <div class="w-64">
                <img src="{{ asset('images/admin/loading.gif') }}" alt="">
            </div>
            <h1 class="text-white text-2xl font-bold">Cargando...</h1>
        </div>
    </div>
    <div wire:loading wire:target="kardex" class="absolute top-0 left-0"
        style="background: rgba(0, 0, 0, 0.384); height: 100vh; width: 100vw;">
        <div class="flex flex-col items-center justify-center w-full h-full">
            <div class="w-64">
                <img src="{{ asset('images/admin/loading.gif') }}" alt="">
            </div>
            <h1 class="text-white text-2xl font-bold">Cargando...</h1>
        </div>
    </div>
    <div class="mb-4 px-6">
        <button wire:click="kardex()" wire:loading.attr="disabled" wire:target="kardex()"
            class="text-gray-300 text-sm font-semibold focus:outline-none bg-green-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-green-700 transition-all">
            <i class='bx bx-clipboard'></i>
            <span>Generar Kardexs</span>
        </button>
        @if ($button->precio_total)
            <button wire:click="resultado()" wire:loading.attr="disabled" wire:target="resultado()"
                class="text-gray-300 text-sm font-semibold focus:outline-none bg-blue-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-blue-700 transition-all">
                <i class='bx bx-food-menu'></i>
                <span>Generar Estados</span>
            </button>
        @endif
    </div>
    @if ($estados == 2)
        <div class="flex items-center mb-4 px-6 space-x-2">
            <a href="{{ route('admin.estados.excel') }}"
                class="text-gray-300 text-md font-semibold focus:outline-none bg-green-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-green-700 transition-all">
                <i class='bx bxs-printer'></i>
                <span>Exportar Excel</span>
            </a>
            <a href="{{ route('admin.estados.pdf') }}" target="_blank"
                class="text-gray-300 text-md font-semibold focus:outline-none bg-red-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-red-700 transition-all">
                <i class='bx bxs-printer'></i>
                <span>Exportar PDF</span>
            </a>
        </div>
    @endif

    <div class="flex flex-row px-6 ">
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
                                <div class="text-sm text-gray-900">
                                    @can('admin.kardex')
                                        <div class="py-4 px-6">
                                            <a href="{{ route('admin.generar-kardex', $producto->id) }}"
                                                class="text-gray-300 text-sm font-semibold focus:outline-none bg-green-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-green-700 transition-all">
                                                <i class='bx bx-plus-circle'></i>
                                                <span>Generar Kardex</span>
                                            </a>
                                        </div>
                                    @endcan
                                </div>
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
