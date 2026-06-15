<div>
    <h1 class="text-2xl font-bold py-4 pl-4 text-green-500">HISTORIAL DE PRODUCTO POR FECHA</h1>
    <div class="p-4 md:px-6 w-full flex flex-col md:flex-row md:justify-between md:space-x-6 ">
        <div class="w-full md:w-1/2 transition-all pb-4">
            <div>
                <x-jet-label value="Seleccionar Tipo de Rango" />
                <select name="select" wire:model="consulta"
                    class="w-full mb-2 py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm outline-none">
                    <option value="dia">DIA</option>
                    <option value="mes">MES</option>
                    <option value="anio">AÑO</option>
                </select>
            </div>
            @if ($consulta == 'dia')
                <div>
                    <x-jet-label value="Fecha de Consulta" />
                    <x-jet-input class="w-full" type="date" wire:model="dia" />
                </div>
            @endif
            @if ($consulta == 'mes')
                <div>
                    <x-jet-label value="Fecha de Consulta" />
                    <x-jet-input class="w-full" type="month" wire:model="mes" />
                </div>
            @endif
            @if ($consulta == 'anio')
                <div>
                    <x-jet-label value="Seleccionar Año" />
                    <select name="select" wire:model="anio"
                        class="w-full mb-2 py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm outline-none">
                        <option class="hidden">SELECCIONAR</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->year }}">{{ $year->year }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
        <div class="h-32 w-full md:w-1/2 mb-6 transition-all">
            <x-jet-label value="Producto" />
            <x-jet-input class="mb-2 w-full" type="search" wire:model="nombre" placeholder="Buscar Producto" />
            <x-jet-input-error for="seleccion" />
            @if ($open_producto)
                @if ($nombre)
                    @if ($productos->count())
                        <div class="w-72 md:w-96 px-2 bg-white max-h-56 overflow-y-auto absolute -mt-2 pb-2 ">
                            @foreach ($productos as $producto)
                                <button wire:click="producto({{ $producto }})"
                                    class="focus:outline-none border-b-2 border-gray-200 flex flex-col w-full text-left pl-2 text-gray-700 bg-green-300 my-1">
                                    <span> {{ $producto->nombre }}</span>
                                    <p> <span class="mr-2">Marca: </span>
                                        {{ $producto->marca }}
                                    </p>
                                </button>
                            @endforeach
                        </div>
                    @endif
                @endif
            @endif
            @if ($seleccion)
                <div class="bg-white p-2 border-2 border-gray-300 rounded-md">
                    <h3 class="text-green-700 font-semibold">Producto: <span
                            class="ml-2 text-gray-700">{{ $seleccion }}</span></h3>
                    <h3 class="text-green-700 font-semibold">Marca: <span
                            class="ml-2 text-gray-700">{{ $producto->marca }}</span></h3>
                    <h3 class="text-green-700 font-semibold">Categotia: <span
                            class="ml-2 text-gray-700">{{ $producto->subcategoria->categoria->nombre }}</span></h3>
                    <h3 class="text-green-700 font-semibold">Subcategoria: <span
                            class="ml-2 text-gray-700">{{ $producto->subcategoria->nombre }}</span></h3>
                </div>
            @endif
        </div>
    </div>
    @if ($seleccion)
    <div class="flex flex-col md:flex-row items-center mt-4">
        <div class="p-4 md:px-6 w-full md:w-1/2">
            @if ($detalleVentas->count())
                <div class="shadow rounded p-4 border bg-white flex-1" style="height: 25rem;">
                    <livewire:livewire-column-chart key="{{ $columnChartModelVentas->reactiveKey() }}"
                        :column-chart-model="$columnChartModelVentas" />
                </div>
            @else
                <div class="shadow rounded p-4 border bg-white flex-1 w-full text-center text-lg font-semibold">
                    <h1>No Hay registro de Ventas</h1>
                </div>
            @endif
        </div>
        <div class="p-4 md:px-6 w-full md:w-1/2">
            @if ($datalleCompras->count())
                <div class="shadow rounded p-4 border bg-white flex-1" style="height: 25rem;">
                    <livewire:livewire-column-chart key="{{ $columnChartModelCompras->reactiveKey() }}"
                        :column-chart-model="$columnChartModelCompras" />
                </div>
            @else
                <div class="shadow rounded p-4 border bg-white flex-1 w-full text-center text-lg font-semibold">
                    <h1>No Hay registro de Compras</h1>
                </div>
            @endif
        </div>
    </div>
    @else
    <div class="shadow rounded p-4 border bg-white flex-1 w-full text-center text-lg font-semibold">
        <h1>No se ha seleccionado un producto</h1>
    </div>
    @endif
