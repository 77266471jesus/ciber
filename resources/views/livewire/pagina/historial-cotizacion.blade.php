<div>
    <h1 class="text-2xl font-bold pt-4 pb-8 pl-4 text-green-500">HISTORIAL DE COTIZACION</h1>

    <div class="flex flex-row px-6">
        <input type="search" class="w-full border-2 border-gray-300 rounded-lg" wire:model="search"
            placeholder="Escriba lo que busca">
    </div>
    <x-table>
        @if ($cotizacions->count())
            <table class="min-w-full divide-y divide-gray-200 mb-12">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="cursor-pointer px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('fecha')">
                            <span>FECHA</span>
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
                        <th scope="col"
                            class="cursor-pointer px-1 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <span>DESCARGAR</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($cotizacions as $cotizacion)
                        <tr>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $cotizacion->fecha }}
                                </div>
                            </td>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $cotizacion->total }}
                                </div>
                            </td>
                            <td class="px-1 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @can('pagina.cotizacion')
                                        <a href="{{ route('pagina.proforma', $cotizacion->id) }}"
                                            class="text-gray-300 text-md font-semibold focus:outline-none bg-green-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-green-700 transition-all">
                                            <i class='bx bxs-printer'></i>
                                        </a>
                                    @endcan
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
