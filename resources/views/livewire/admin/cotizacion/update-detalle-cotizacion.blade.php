<tr>
    <td class="px-1 py-1 whitespace-nowrap">
        <div class="text-sm text-gray-900">
            <button wire:click="destroy()" wire:loading.attr="disabled"
                class="text-gray-300 text-sm font-semibold focus:outline-none bg-red-600 rounded px-2.5 py-1.5 space-x-1 hover:text-white hover:bg-red-700 transition-all">
                <i class='bx bx-x'></i>
                <button>
        </div>
    </td>
    <td class="px-1 py-1 whitespace-nowrap">
        <div class="text-sm text-gray-900">
            {{ $detalleCotizacion->producto->nombre }}
        </div>
    </td>
    <td>
        <div class="text-sm text-gray-900">
            <input type="number" class="w-20 h-8 border-2 border-gray-300" wire:model="cantidad">
            <x-jet-input-error for="cantidad" />
        </div>
    </td>
    <td>
        <div class="text-sm text-gray-900">
            <input type="number" class="w-20 h-8 border-2 border-gray-300 bg-gray-100" wire:model="venta" disabled>
            <x-jet-input-error for="venta" />
        </div>
    </td>
    <td>
        <div class="text-sm text-gray-900">
            <input type="number" class="w-20 h-8 border-2 border-gray-300" wire:model="descuento">
            <x-jet-input-error for="descuento" />
        </div>
    </td>
    <td>
        <div class="flex items-center">
            <div class="text-sm text-gray-900">
                <span>{{$detalleCotizacion->subtotal}}</span>
            </div>
            <div class="ml-2">
                <button class="focus:outline-none text-lg" wire:click="update" wire:loading.attr="disabled" wire:target="update">
                    <i class='bx bx-refresh'></i>
                </button>
            </div>           
        </div>
    </td>
</tr>
