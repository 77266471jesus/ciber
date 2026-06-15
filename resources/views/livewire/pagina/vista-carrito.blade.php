<div>
    <div class="h-20 w-full color_menu_scroll mb-10">
    </div>
    <div class="mb-20 shadow-md w-full px-6">
        <div class="px-6 py-4 text-green-500 font-bold text-xl">
            <h1>CARRITO DE COTIZACIÓN</h1>
        </div>
        <x-table>
            <table class="min-w-full divide-y divide-gray-200 px-6">
                <thead class="bg-gray-300">
                    <tr>
                        <th scope="col"
                            class="cursor-pointer px-1 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                            <span></span>
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-1 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                            <span>PRODUCTO</span>
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-1 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                            <span>CANTIDAD</span>
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-1 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                            <span>PRECIO</span>
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-1 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                            <span>SUBTOTAL</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y-2 divide-gray-200">
                    @foreach ($detalleCotizacions as $detalleCotizacion)
                        @livewire('pagina.update-cotizacion', ['detalleCotizacion' => $detalleCotizacion], key($detalleCotizacion->id))
                    @endforeach
                </tbody>
            </table>
        </x-table>
        @if ($detalleCotizacions->count())
            <div class="flex justify-between pl-6 mb-4 mt-4 bg-green-300 mx-6">
                <div class="flex items-center space-x-2 font-bold">
                    <div>
                        <span>Total:</span>
                    </div>
                    <div>
                        <span>{{ $total_cotizacion }}</span>
                    </div>
                </div>
                <div>
                    <button wire:click.prevent="store" wire:loading.attr="disabled" wire:target="store"
                        class="text-gray-300 text-sm font-semibold focus:outline-none bg-red-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-red-700 transition-all">
                        <i class='bx bx-save'></i>
                        <span>Cotizar</span>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
