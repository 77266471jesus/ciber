<div>
    <h1 class="text-2xl font-bold py-4 pl-4 text-green-500">VENTA DE PRODUCTOS</h1>
    <div class="p-4 flex flex-row justify-start space-x-2">
        <label class="hover:bg-gray-200 cursor-pointer" for="asc" wire:click="anular">
            <input type="radio" id="asc" name="mostrar">
            <span class="pl-2">Cliente Nuevo</span>
        </label>
        <label class="hover:bg-gray-200 cursor-pointer" for="desc" wire:click="activar">
            <input type="radio" checked="checked" id="desc" name="mostrar">
            <span class="pl-2">Cliente Existente</span>
        </label>
    </div>
    <div class="w-full flex flex-col md:flex-row pl-4">
        <div class="flex items-center px-2 w-full md:w-3/5">
            <div class="flex flex-row h-12 w-full">
                <input type="search" class="w-full input_search border-2 border-gray-300 rounded-lg" wire:model="buscar"
                    placeholder="Buscar cliente">
                <i class='bx bx-search-alt input_icon'></i>
            </div>
            <div class="bg-red-500 rounded-md">
                <button wire:click="cerrar" class="h-12 focus:outline-none text-white text-2xl w-12">
                    <i class='bx bx-x'></i>
                </button>
            </div>
        </div>
        @if ($listen_cliente == 'activar')
            @if ($open_cliente)
                @if ($buscar)
                    @if ($clientes->count())
                        <div class="w-72 md:w-96 px-2 bg-white max-h-56 overflow-y-auto absolute mt-12 pb-2 ">
                            @foreach ($clientes as $cliente)
                                <button wire:click="cliente({{ $cliente }})"
                                    class="focus:outline-none border-b-2 border-gray-200 flex flex-col w-full text-left pl-2 text-gray-700 bg-green-300 my-1">
                                    <span> {{ $cliente->nombre }}</span>
                                    @if ($cliente->tipo_documento)
                                        <p> <span>{{ $cliente->tipo_documento }}</span>
                                            {{ $cliente->documento }}
                                        </p>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    @else
                        <div class="w-72 md:w-96 px-2 bg-white max-h-56 overflow-y-auto absolute mt-12 pb-2 ">
                            <button wire:click="cerrar"
                                class="focus:outline-none border-b-2 border-gray-200 flex flex-col w-full text-left pl-2 text-gray-700 bg-green-300 my-1">
                                <span class="p-2">No esxite Cliente</span>
                            </button>
                        </div>
                    @endif
                @endif
            @endif
        @endif
    </div>
    <div class="w-full flex flex-col md:flex-row pl-4">
        @if ($listen_cliente == 'activar')
            <div class="w-full md:w-3/5 px-2">
                <x-jet-label value="Cliente" />
                <x-jet-input class="mb-2 w-full bg-gray-200" type="search" wire:model="nombre" disabled/>
                <x-jet-input-error for="nombre" />
            </div>
        @else
            <div class="w-full md:w-3/5 px-2">
                <x-jet-label value="Cliente" />
                <x-jet-input class="mb-2 w-full" type="search" wire:model="nombre" />
                <x-jet-input-error for="nombre" />
            </div>
        @endif
        <div class="w-full md:w-2/5 px-2 md:pl-12 ">
            <x-jet-label value="Fecha" />
            <x-jet-input class="mb-2 w-full bg-gray-200" type="date" wire:model="fecha" />
            <x-jet-input-error for="fecha" />
        </div>
    </div>
    {{-- <div class="w-full flex flex-col md:flex-row pl-4">
        <div class="w-full md:w-3/5 px-2">
            <x-jet-label value="Tipo Comprobante" />
            <select name="select" wire:model.defer="tipo_comprobante"
                class="w-full mb-2 py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm outline-none">
                <option class="hidden">SELECIONAR</option>
                <option value="factura">FACTURA</option>
                <option value="boleta">BOLETA</option>
            </select>
            <x-jet-input-error for="tipo_comprobante" />
        </div>
        <div class="w-full md:w-2/5 px-2 md:pl-12 ">
            <x-jet-label value="Insertar Impuesto" />
            <x-jet-input class="mb-2 w-full" type="number" wire:model="impuesto" />
            <x-jet-input-error for="impuesto" />
        </div>
    </div> --}}
    @if ($listen_cliente == 'activar')
        <div class="w-full flex flex-col md:flex-row pl-4">
            <div class="w-full md:w-3/5 px-2">
                <x-jet-label value="Documento Cliente" />
                <x-jet-input class="mb-2 w-full bg-gray-200" type="text" wire:model="tipo_documento" disabled />
                <x-jet-input-error for="tipo_documento" />
            </div>
            <div class="w-full md:w-2/5 px-2 md:pl-12 ">
                <x-jet-label value="N° Documento Cliente" />
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
                <x-jet-label value="Documento Cliente" />
                <select name="select" wire:model="tipo_documento"
                    class="w-full mb-2 py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm outline-none">
                    <option class="hidden">SELECIONAR</option>
                    <option value="c.i.">C.I.</option>
                    <option value="nit">NIT</option>
                </select>
                <x-jet-input-error for="tipo_documento" />
            </div>
            <div class="w-full md:w-2/5 px-2 md:pl-12 ">
                <x-jet-label value="N° Documento Cliente" />
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
    @include('livewire.admin.ventas.modal-productos-ventas')

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
                        <span>PRECIO VENTA</span>
                    </th>
                    <th scope="col"
                        class="cursor-pointer px-1 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                        <span>DESCUENTO</span>
                    </th>
                    <th scope="col"
                        class="cursor-pointer px-1 py-3 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                        <span>SUBTOTAL</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y-2 divide-gray-200">
                @foreach ($detalleVentas as $detalleVenta)
                    @livewire('admin.ventas.update-detalle', ['detalleVenta' => $detalleVenta], key($detalleVenta->id))
                @endforeach
            </tbody>
        </table>
    </x-table>
    <div class="w-full px-6 pt-2">
        <div class="font-semibold flex justify-between py-2 px-2 bg-green-500 pr-4">
            <h1 class="ml-6">TOTAL VENTA:</h1>
            <span>{{ $total_venta }}.</span>
        </div>
        <div class="font-semibold flex justify-between py-2 px-2 bg-green-500 pr-4">
            <h1 class="ml-6">TOTAL:</h1>
            <span>{{ $total }}.</span>
        </div>
        <div class="flex justify-between px-6 mb-4 mt-4">
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
