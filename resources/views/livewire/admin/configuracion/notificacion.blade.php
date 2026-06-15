<div>
    <x-jet-dropdown align="center" width="72">
        <x-slot name="trigger">
            <div class="flex flex-col justify-center items-center w-10 h-10 relative pointer-events-auto">
                {{-- <i class='bx bx-bell text-2xl text-yellow-900 font-bold'></i> --}}
                @if ($productos->count())
                <i class='bx bx-info-circle text-2xl text-yellow-300 font-bold'></i>
                    {{-- <i class='bx bxs-bell-ring text-2xl text-yellow-300 font-bold'></i> --}}
                @else
                <i class='bx bx-info-circle text-2xl text-gray-300 font-bold'></i>
                    {{-- <i class='bx bxs-bell-ring text-2xl text-gray-300 font-bold'></i> --}}
                @endif
            </div>
            @if ($productos->count())
                <div class="absolute top-5 right-0">
                    <span class="text-red-600 font-semibold">{{ $productos->count() }}</span>
                </div>
            @endif
        </x-slot>
        <x-slot name="content">
            <div class="px-2 overflow-y-auto alerta_scroll" style="max-height: 303px">
                @if ($productos->count())
                    <div class="flex flex-col">
                        @foreach ($productos as $producto)
                            @if ($producto->stock <= $alto)
                                @if ($producto->stock <= $critico)
                                    <div
                                        class="flex flex-col border-b px-1 border-gray-400 text-sm text-gray-700 hover:text-black hover:font-semibold bg-red-200 hover:bg-gray-200 transition-all">
                                        <span class="text-black font-semibold">{{ $producto->nombre }}</span>
                                        <div class="flex items-center">
                                            <span class="mr-1 font-bold">Marca: </span>
                                            <span>{{ $producto->marca }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="mr-1 font-bold">Cantidad: </span>
                                            <span>{{ $producto->stock }}</span>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="flex flex-col border-b px-1 border-gray-400 text-sm text-gray-700 hover:text-black hover:font-semibold bg-yellow-200 hover:bg-gray-200 transition-all">
                                        <span class="text-black font-semibold">{{ $producto->nombre }}</span>
                                        <div class="flex items-center">
                                            <span class="mr-1 font-bold">Marca: </span>
                                            <span>{{ $producto->marca }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="mr-1 font-bold">Cantidad: </span>
                                            <span>{{ $producto->stock }}</span>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div
                                    class="flex flex-col border-b px-1 border-gray-400 text-sm text-gray-700 hover:text-black hover:font-semibold bg-green-200 hover:bg-gray-200 transition-all">
                                    <span class="text-black font-semibold">{{ $producto->nombre }}</span>
                                    <div class="flex items-center">
                                        <span class="mr-1 font-bold">Marca: </span>
                                        <span>{{ $producto->marca }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="mr-1 font-bold">Cantidad: </span>
                                        <span>{{ $producto->stock }}</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="text-gray-500 text-center">
                        <span>No hay notificación</span>
                    </div>
                @endif
            </div>
        </x-slot>
    </x-jet-dropdown>
</div>
