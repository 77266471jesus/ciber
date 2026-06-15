<div>
    <x-modal-simple wire:model="open_show">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                INFORMACION DEL INGRESO
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="w-full px-4 flex items-start flex-col md:flex-row pt-4">
                @if ($open_show)
                    <div class="w-full px-4">
                        <div class="w-full flex flex-col md:flex-row">
                            <div class="w-full md:w-3/5 px-2">
                                <x-jet-label value="Proveedor" />
                                <input type="text" value="{{ $show_ingreso->proveedor->nombre }}" disabled
                                    class="w-full rounded-md border-2 border-gray-300">
                            </div>
                            <div class="w-full md:w-2/5 px-2 md:pl-12 ">
                                <x-jet-label value="Fecha" />
                                <input type="text" value="{{ $show_ingreso->fecha }}" disabled
                                    class="w-full rounded-md border-2 border-gray-300">
                            </div>
                        </div>
                        <div class="w-full flex flex-col md:flex-row">
                            <div class="w-full md:w-3/5 px-2">
                                <x-jet-label value="Tipo Comprobante" />
                                <input type="text" value="{{ $show_ingreso->tipo_comprobante }}" disabled
                                    class="w-full rounded-md border-2 border-gray-300">
                            </div>
                            <div class="w-full md:w-2/5 px-2 md:pl-12 ">
                                <x-jet-label value="Numero de Comprobante" />
                                <input type="text" value="{{ $show_ingreso->comprobante }}" disabled
                                    class="w-full rounded-md border-2 border-gray-300">
                            </div>
                        </div>
                        <div class="w-full flex flex-col md:flex-row">
                            <div class="w-full md:w-3/5 px-2">
                                <x-jet-label value="Documento Proveedor" />
                                <input type="text" value="{{ $show_ingreso->proveedor->tipo_documento }}" disabled
                                    class="w-full rounded-md border-2 border-gray-300">
                            </div>
                            <div class="w-full md:w-2/5 px-2 md:pl-12 ">
                                <x-jet-label value="N° Documento Proveedor" />
                                <input type="text" value="{{ $show_ingreso->proveedor->documento }}" disabled
                                    class="w-full rounded-md border-2 border-gray-300">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 space-x-0 md:space-x-2">
                            <div class="px-2 md:px-0">
                                {{-- telefono --}}
                                <x-jet-label value="Telefono" />
                                <input type="text" value="{{ $show_ingreso->proveedor->telefono }}" disabled
                                    class="w-full rounded-md border-2 border-gray-300">
                            </div>
                            <div class="px-2 md:px-0">
                                {{-- email --}}
                                <x-jet-label value="Correo/Email" />
                                <input type="text" value="{{ $show_ingreso->proveedor->email }}" disabled
                                    class="w-full rounded-md border-2 border-gray-300">
                            </div>
                            <div class="px-2 md:px-0">
                                {{-- direccion --}}
                                <x-jet-label value="Direccion" />
                                <input type="text" value="{{ $show_ingreso->proveedor->direccion }}" disabled
                                    class="w-full rounded-md border-2 border-gray-300">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 space-x-0 md:space-x-2 pb-4">
                            <div class="px-2 md:px-0">
                                {{-- direccion --}}
                                <x-jet-label value="Impuesto" />
                                <input type="text" value="{{ $show_ingreso->impuesto }}" disabled
                                    class="w-full rounded-md border-2 border-gray-300">
                            </div>
                        </div>
                        <x-table>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-green-400">
                                    <tr>                                        
                                        <th scope="col"
                                            class="cursor-pointer px-1 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                            <span>PRODUCTO</span>
                                        </th>
                                        <th scope="col"
                                            class="cursor-pointer px-1 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                            <span>CANTTIDAD</span>
                                        </th>
                                        <th scope="col"
                                            class="cursor-pointer px-1 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                            <span>PRECIO COMPRA</span>
                                        </th>
                                        <th scope="col"
                                            class="cursor-pointer px-1 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                            <span>PRECIO VENTA</span>
                                        </th>
                                        <th scope="col"
                                            class="cursor-pointer px-1 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                            <span>SUBTOTAL</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y-2 divide-gray-200">
                                    @foreach ($show_ingreso->detalleingreso as $detalle)
                                        <tr>                                            
                                            <td class="px-1 py-1 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $detalle->producto->nombre }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-sm text-gray-900">
                                                    {{ $detalle->cantidad}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-sm text-gray-900">
                                                    {{ $detalle->precio_compra}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-sm text-gray-900">
                                                    {{ $detalle->precio_venta}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-sm text-gray-900">
                                                    {{ $detalle->subtotal}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </x-table>
                        <div class="w-full px-6 pt-2 pb-4">
                            <div class="font-semibold flex justify-end py-2 px-2 bg-green-400 pr-4">
                                <h1 class="ml-6">TOTAL:</h1>
                                <span>{{ $show_ingreso->total_compra }}.</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_show', false)">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-modal-simple>
</div>
