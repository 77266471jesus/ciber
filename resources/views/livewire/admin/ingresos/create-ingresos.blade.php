<div>
    <h1 class="text-2xl font-bold py-4 pl-4 text-green-500">INGRESO DE PRODUCTOS</h1>
    <div class="p-4 flex flex-row justify-start space-x-2">
        <label class="hover:bg-gray-200 cursor-pointer" for="asc" wire:click="anular">
            <input type="radio" id="asc" name="mostrar">
            <span class="pl-2">Proveedor Nuevo</span>
        </label>
        <label class="hover:bg-gray-200 cursor-pointer" for="desc" wire:click="activar">
            <input type="radio" checked="checked" id="desc" name="mostrar">
            <span class="pl-2">Proveedor Existente</span>
        </label>
    </div>
    <div class="w-full flex flex-col md:flex-row pl-4">
        <div class="flex items-center px-2 w-full md:w-3/5">
            <div class="flex flex-row h-12 w-full">
                <input type="search" class="w-full input_search border-2 border-gray-300 rounded-lg" wire:model="buscar"
                    placeholder="Buscar Proveedor">
                <i class='bx bx-search-alt input_icon'></i>
            </div>
            <div class="bg-red-500 rounded-md">
                <button wire:click="cerrar" class="h-12 focus:outline-none text-white text-2xl w-12">
                    <i class='bx bx-x'></i>
                </button>
            </div>
        </div>
        @if ($listen_proveedor == 'activar')
            @if ($open_proveedor)
                @if ($buscar)
                    @if ($proveedors->count())
                        <div class="w-72 md:w-96 px-2 bg-white max-h-56 overflow-y-auto absolute mt-12 pb-2 ">
                            @foreach ($proveedors as $proveedor)
                                <button wire:click="proveedor({{ $proveedor }})"
                                    class="focus:outline-none border-b-2 border-gray-200 flex flex-col w-full text-left pl-2 text-gray-700 bg-green-300 my-1">
                                    <span> {{ $proveedor->nombre }}</span>
                                    @if ($proveedor->tipo_documento)
                                        <p> <span>{{ $proveedor->tipo_documento }}</span>
                                            {{ $proveedor->documento }}
                                        </p>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    @else
                        <div class="w-72 md:w-96 px-2 bg-white max-h-56 overflow-y-auto absolute mt-12 pb-2 ">
                            <button wire:click="cerrar"
                                class="focus:outline-none border-b-2 border-gray-200 flex flex-col w-full text-left pl-2 text-gray-700 bg-green-300 my-1">
                                <span class="p-2">No esxite Proveedor</span>
                            </button>
                        </div>
                    @endif
                @endif
            @endif
        @endif
    </div>
    <div class="w-full flex flex-col md:flex-row pl-4">
        @if ($listen_proveedor == 'activar')
            <div class="w-full md:w-3/5 px-2">
                <x-jet-label value="Proveedor" />
                <x-jet-input class="mb-2 w-full bg-gray-200" type="search" wire:model="nombre" disabled/>
                <x-jet-input-error for="nombre" />
            </div>
        @else
            <div class="w-full md:w-3/5 px-2">
                <x-jet-label value="Proveedor" />
                <x-jet-input class="mb-2 w-full" type="search" wire:model="nombre" />
                <x-jet-input-error for="nombre" />
            </div>
        @endif
        <div class="w-full md:w-2/5 px-2 md:pl-12 ">
            <x-jet-label value="Fecha" />
            <x-jet-input class="mb-2 w-full bg-gray-200" type="datetime" wire:model="fecha" disabled/>
            <x-jet-input-error for="fecha" />
        </div>
    </div>
    <div class="w-full flex flex-col md:flex-row pl-4">
        <div class="w-full md:w-3/5 px-2">
            <x-jet-label value="Tipo de Comprobante" />
            <select name="select" wire:model.defer="tipo_comprobante"
                class="w-full mb-2 py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm outline-none">
                <option class="hidden">SELECIONAR</option>
                <option value="factura">FACTURA</option>
                <option value="recibo">RECIBO</option>
                <option value="boleta">BOLETA</option>
                <option value="nota de venta">NOTA DE VENTA</option>
            </select>
            <x-jet-input-error for="tipo_comprobante" />
        </div>
        <div class="w-full md:w-2/5 px-2 md:pl-12 ">
            <x-jet-label value="Numero de Comprobante" />
            <x-jet-input class="mb-2 w-full" type="number" wire:model.defer="comprobante" />
            <x-jet-input-error for="comprobante" />
        </div>
    </div>
    @if ($listen_proveedor == 'activar')
        <div class="w-full flex flex-col md:flex-row pl-4">
            <div class="w-full md:w-3/5 px-2">
                <x-jet-label value="Documento Proveedor" />
                <x-jet-input class="mb-2 w-full bg-gray-200" type="text" wire:model="tipo_documento" disabled />
                <x-jet-input-error for="tipo_documento" />
            </div>
            <div class="w-full md:w-2/5 px-2 md:pl-12 ">
                <x-jet-label value="N° Documento Proveedor" />
                <x-jet-input class="mb-2 w-full bg-gray-200" type="number" wire:model="documento" disabled />
                <x-jet-input-error for="documento" />
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 pl-4 space-x-0 md:space-x-2">
            <div class="px-2 md:px-0">
                {{-- telefono --}}
                <x-jet-label value="Insertar Telefono" />
                <x-jet-input class="mb-2 w-full bg-gray-200" type="text" wire:model="telefono" disabled />
                <x-jet-input-error for="telefono" />
            </div>
            <div class="px-2 md:px-0">
                {{-- email --}}
                <x-jet-label value="Insertar Correo/Email" />
                <x-jet-input class="mb-2 w-full bg-gray-200" type="email" wire:model="email" disabled />
                <x-jet-input-error for="email" />
            </div>
            <div class="px-2 md:px-0">
                {{-- direccion --}}
                <x-jet-label value="Insertar Direccion" />
                <x-jet-input class="mb-2 w-full bg-gray-200" type="text" wire:model="direccion" disabled />
                <x-jet-input-error for="direccion" />
            </div>
        </div>
    @else
        <div class="w-full flex flex-col md:flex-row pl-4">
            <div class="w-full md:w-3/5 px-2">
                <x-jet-label value="Documento Proveedor" />
                <select name="select" wire:model="tipo_documento"
                    class="w-full mb-2 py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm outline-none">
                    <option class="hidden">SELECIONAR</option>
                    <option value="c.i.">C.I.</option>
                    <option value="nit">NIT</option>
                </select>
                <x-jet-input-error for="tipo_documento" />
            </div>
            <div class="w-full md:w-2/5 px-2 md:pl-12 ">
                <x-jet-label value="N° Documento Proveedor" />
                <x-jet-input class="mb-2 w-full" type="number" wire:model="documento" />
                <x-jet-input-error for="documento" />
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 pl-4 space-x-0 md:space-x-2">
            <div class="px-2 md:px-0">
                {{-- telefono --}}
                <x-jet-label value="Insertar Telefono" />
                <x-jet-input class="mb-2 w-full" type="text" wire:model="telefono" />
                <x-jet-input-error for="telefono" />
            </div>
            <div class="px-2 md:px-0">
                {{-- email --}}
                <x-jet-label value="Insertar Correo/Email" />
                <x-jet-input class="mb-2 w-full" type="email" wire:model="email" />
                <x-jet-input-error for="email" />
            </div>
            <div class="px-2 md:px-0">
                {{-- direccion --}}
                <x-jet-label value="Insertar Direccion" />
                <x-jet-input class="mb-2 w-full" type="text" wire:model="direccion" />
                <x-jet-input-error for="direccion" />
            </div>
        </div>
    @endif
    <div class="px-6 mb-4">
        <button wire:click.prevent="$set('open_productos', true)"
            class="text-gray-300 text-sm font-semibold focus:outline-none bg-blue-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-blue-700 transition-all">
            <i class='bx bx-plus-circle'></i>
            <span>Agregar Producto</span>
            <button>
    </div>
    @if (session()->has('message'))
        <div wire:poll.4s class="mb-4 bg-red-100 border border-red-400 text-red-900 px-6 py-3 rounded relative"
            role="alert">
            <strong class="font-bold">{{ session('message') }}</strong><br>
            <span class="block sm:inline">Ninguno Seleecionado </span>
        </div>
    @endif
    @include('livewire.admin.ingresos.modal-productos')

    <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-green-400">
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
                @foreach ($detalleIngresos as $detalleIngreso)
                    @livewire('admin.ingresos.update', ['detalleIngreso' => $detalleIngreso], key($detalleIngreso->id))
                @endforeach
            </tbody>
        </table>
    </x-table>
    <div class="w-full px-6 pt-2 pb-4">
        <div class="font-semibold flex justify-end py-2 px-2 bg-green-500 pr-4">
            <h1 class="ml-6">TOTAL:</h1>
            <span>{{ $total_compra }}.</span>
        </div>
    </div>
    <div class="flex justify-between px-6 mb-4">
        <div>
            <button wire:click.prevent="cancelar" wire:loading.attr="disabled" wire:target="cancelar"
                class="text-gray-300 text-sm font-semibold focus:outline-none bg-red-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-red-700 transition-all">
                <i class='bx bx-x-circle'></i>
                <span>Cancelar</span>
                <button>
        </div>
        <div>
            <button wire:click.prevent="store" wire:loading.attr="disabled" wire:target="store"
                class="text-gray-300 text-sm font-semibold focus:outline-none bg-green-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-green-700 transition-all">
                <i class='bx bx-save'></i>
                <span>Guardar</span>
                <button>
        </div>
    </div>
</div>
