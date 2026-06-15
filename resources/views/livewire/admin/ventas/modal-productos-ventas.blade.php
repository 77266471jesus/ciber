<div>
    <x-jet-dialog-modal wire:model="open_productos">
        <x-slot name="title">
            <div class="text-left text-green-900 mt-3 font-bold">
                AGREGAR PRODUCTOS
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-row px-6 pb-4">
                <span class="text-gray-600 font-semibold mr-2">BUSCAR:</span>
                <input type="search" class="w-full h-8 border-2 border-gray-300" wire:model="search"
                    placeholder="Escriba lo que busca">
            </div>
            <x-table>
                @if ($productos->count())
                    <table class="min-w-full divide-y divide-gray-200 mb-12">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="cursor-pointer px-1 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    <span>AÑADIR</span>                                   
                                </th>
                                <th scope="col"
                                    class="cursor-pointer px-1 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    <span>PRODUCTO</span>                                   
                                </th>                               
                                <th scope="col"
                                    class="cursor-pointer px-1 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    <span>STOCK</span>                                   
                                </th>
                                <th scope="col"
                                    class="cursor-pointer px-1 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    <span>PRECIO</span>                                   
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($productos as $producto)
                                <tr>
                                    <td class="px-1 py-1 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <button wire:click="productos({{ $producto }})"
                                                class="text-gray-300 text-sm font-semibold focus:outline-none bg-yellow-400 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-yellow-500 transition-all">
                                                <i class='bx bxs-cart-add'></i>                                               
                                            <button>
                                        </div>
                                    </td>
                                    <td class="px-1 py-1 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="hidden md:block flex-shrink-0 h-12 w-12">
                                                @if ($producto->image)
                                                    <img class="h-12 w-12 rounded-full"
                                                        src="{{ Storage::url($producto->image) }}" alt="">
                                                @else
                                                    <img class="h-12 w-12 rounded-full"
                                                        src="{{ asset('images/admin/sinfoto.png') }}" alt="">
                                                @endif
                                            </div>
                                            <div class="ml-4 w-72">
                                                <div class="text-xs font-medium text-black truncate ">
                                                    {{ $producto->nombre }}
                                                </div>                                                
                                                <div class="text-sm text-gray-600">
                                                    <i class='ml-1 text-black'></i>
                                                        <span>{{ $producto->marca }}</span>                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </td>                                    
                                    <td class="px-1 py-1 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $producto->stock }}
                                        </div>
                                    </td>
                                    <td class="px-1 py-1 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $producto->precio_venta }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="px-6 py-2">
                        No existe registros
                    </div>
                @endif
                @if ($productos->hasPages())
                    <div class="px-6 py-1">
                        {{ $productos->links() }}
                    </div>
                @endif
            </x-table>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click.prevent="$set('open_productos', false)">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
