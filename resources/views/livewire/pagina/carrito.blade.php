<div>
    <x-jet-dropdown align="rigth" width="72">
        <x-slot name="trigger">
            @if ($detalleCotizacions->count())
                <div class="text-3xl px-2 text-gray-900 font-bold">
                    <i class='bx bx-cart-alt'></i>
                </div>
                <div class="absolute top-6 right-0">
                    <div class="text-xs text-white bg-red-500 rounded-lg py-1 px-1.5">
                        <span>{{ $detalleCotizacions->count() }}</span>
                    </div>
                </div>
            @else
                <div class="text-3xl px-2 text-gray-400">
                    <i class='bx bx-cart-alt'></i>
                </div>
            @endif
        </x-slot>
        <x-slot name="content">
            <div class="px-2 scroll_y_deslizar" style="max-height: 303px">
                <div class="p-1">
                    @if ($detalleCotizacions->count())
                        @can('pagina.cotizacion')
                            <a href="{{ route('carrito.cotizacion') }}"
                                class="text-center w-full bg-red-400 hover:bg-red-600 transition-all flex flex-col justify-center items-center text-gray-200 hover:text-white rounded-md my-2 p-1">
                                <div class="text-md flex items-center">
                                    <i class='bx bxs-right-arrow-circle'></i>
                                    <span class="uppercase ml-2">Ir a carrrito </span>
                                </div>
                            </a>
                        @endcan
                        <div
                            class="w-full border-2 border-gray-500 rounded-md flex flex-col items-center justify-center">
                            <div class="flex items-center space-x-2">
                                <h2>Total</h2>
                                <h2>{{ $total }} <span class="ml-1">Bs.</span> </h2>
                            </div>
                        </div>
                        @foreach ($detalleCotizacions as $detalleCotizacion)
                            <div
                                class="flex items-center space-x-2 border-b border-gray-300 transition-all bg-gray-100 hover:bg-gray-300 w-full">
                                <div class="w-12 bg-blue-100">
                                    <img src="{{ Storage::url($detalleCotizacion->producto->image) }}" alt=""
                                        class="rounded-2xl">
                                </div>
                                <div>
                                    <h1 class="uppercase text-justify text-xs  font-semibold">
                                        {{ $detalleCotizacion->producto->nombre }}
                                    </h1>
                                    <h2 class="text-xs">
                                        <span class="font-semibold">Marca:</span>
                                        <span>{{ $detalleCotizacion->producto->marca }}</span>
                                    </h2>
                                    <h2 class="text-xs">
                                        <span class="font-semibold">Precio:</span>
                                        <span>{{ $detalleCotizacion->subtotal }}</span>
                                    </h2>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </x-slot>
    </x-jet-dropdown>
</div>
