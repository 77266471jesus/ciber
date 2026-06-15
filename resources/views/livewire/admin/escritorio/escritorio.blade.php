<div>
    <div class="p-4 md:px-6 w-full flex flex-col md:flex-row md:justify-between md:space-x-2 ">
        <div class="w-full md:w-2/6 transition-all pb-4">
            <div>
                <x-jet-label value="Seleccionar Tipo de Rango" />
                <select name="select" wire:model="consulta"
                    class="w-full mb-2 py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm outline-none">
                    <option value="dia">DIA</option>
                    <option value="mes">MES</option>
                    <option value="anio">AÑO</option>
                    <option value="rango">RANGO POR DIAS</option>
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
            @if ($consulta == 'rango')
                <div>
                    <x-jet-label value="Fecha de Inicio" />
                    <x-jet-input class="w-full" type="date" wire:model="inicio" />
                    <x-jet-label value="Fecha de Fin" />
                    <x-jet-input class="w-full" type="date" wire:model="fin" />
                </div>
            @endif
        </div>
        <div class="bg-green-400 h-32 mb-6 w-full md:w-2/6 transition-all">
            <div class="p-2 text-white font-semibold">
                <h2>Ventas Acumuladas</h2>
                <h1>Bs. <span>{{ $ventasTotal }}</span></h1>
                @if ($consulta == 'dia')
                    <h2>Fecha: <span>{{ $dia }}</span></h1>
                @endif
                @if ($consulta == 'mes')
                    <h2>Fecha: <span>{{ $mes }}</span></h1>
                @endif
                @if ($consulta == 'anio')
                    <h2>Fecha: <span>{{ $anio }}</span></h1>
                @endif
                @if ($consulta == 'rango')
                    <h2>Fecha Inicio: <span>{{ $inicio }}</span></h1>
                        <h2>Fecha Fin: <span>{{ $fin }}</span></h1>
                @endif
                </h2>
            </div>
            @can('admin.create.venta')
                <a href="{{ route('admin.create.venta') }}"
                    class="focus:outline-none bg-green-500 w-full flex text-white justify-center transition-all hover:bg-green-600">
                    <span class="p-2">Ventas <i class='bx bxs-right-arrow-circle pl-2'></i></span>
                </a>
            @endcan
        </div>
        <div class="bg-red-400 h-32 w-full md:w-2/6 mb-6 transition-all">
            <div class="p-2 text-white font-semibold">
                <h2>Compras Acumuladas</h2>
                <h1>Bs. <span>{{ $ingresosTotal }}</span></h1>
                @if ($consulta == 'dia')
                    <h2>Fecha: <span>{{ $dia }}</span></h1>
                @endif
                @if ($consulta == 'mes')
                    <h2>Fecha: <span>{{ $mes }}</span></h1>
                @endif
                @if ($consulta == 'anio')
                    <h2>Fecha: <span>{{ $anio }}</span></h1>
                @endif
                @if ($consulta == 'rango')
                    <h2>Fecha Inicio: <span>{{ $inicio }}</span></h1>
                        <h2>Fecha Fin: <span>{{ $fin }}</span></h1>
                @endif
                </h2>
            </div>
            @can('admin.create-ingreso')
                <a href="{{ route('admin.create-ingreso') }}"
                    class="focus:outline-none bg-red-500 w-full flex text-white justify-center transition-all hover:bg-red-600">
                    <span class="p-2">Compras <i class='bx bxs-right-arrow-circle pl-2'></i></span>
                </a>
            @endcan
        </div>
    </div>
    <div class="flex flex-col md:flex-row items-center">
        <div class="p-4 md:px-6 w-full md:w-1/2">
            @if ($ventasTotal)
                @if ($ventas->count())
                    <div class="shadow rounded p-4 border bg-white flex-1" style="height: 20rem;">
                        <livewire:livewire-column-chart key="{{ $columnChartModelVentas->reactiveKey() }}"
                            :column-chart-model="$columnChartModelVentas" />
                    </div>
                @else
                    <div class="shadow rounded p-4 border bg-white flex-1 w-full text-center text-lg font-semibold">
                        <h1>No Hay registro de Ventas</h1>
                    </div>
                @endif
            @else
                <div class="shadow rounded p-4 border bg-white flex-1 w-full text-center text-lg font-semibold">
                    <div class="shadow rounded p-4 border bg-white flex-1 w-full text-center text-lg font-semibold">
                        <h1>No Hay registro de Ventas</h1>
                    </div>
                </div>
            @endif
        </div>
        <div class="p-4 md:px-6 w-full md:w-1/2">
            @if ($ingresosTotal)
                @if ($ingresos->count())
                    <div class="shadow rounded p-4 border bg-white flex-1" style="height: 20rem;">
                        <livewire:livewire-column-chart key="{{ $columnChartModelCompras->reactiveKey() }}"
                            :column-chart-model="$columnChartModelCompras" />
                    </div>
                @else
                    <div class="shadow rounded p-4 border bg-white flex-1 w-full text-center text-lg font-semibold">
                        <h1>No Hay registro de Ingresos</h1>
                    </div>
                @endif
            @else
                <div class="shadow rounded p-4 border bg-white flex-1 w-full text-center text-lg font-semibold">
                    <div class="shadow rounded p-4 border bg-white flex-1 w-full text-center text-lg font-semibold">
                        <h1>No Hay registro de Ingresos</h1>
                    </div>
                </div>
            @endif
        </div>
    </div>
