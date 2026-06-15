<div>
    <h1 class="text-2xl font-bold py-4 pl-4 text-green-500">PROVEEDOR INGRESOS</h1>
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
            @if ($consulta == 'rango')
                <div>
                    <x-jet-label value="Fecha de Inicio" />
                    <x-jet-input class="w-full" type="date" wire:model="inicio" />
                    <x-jet-label value="Fecha de Fin" />
                    <x-jet-input class="w-full" type="date" wire:model="fin" />
                </div>
            @endif
        </div>
    </div>
    <div class="flex flex-col md:flex-row items-center">
        <div class="p-4 md:px-6 w-full">
            @if ($datalleCompras->count())
                <div class="shadow rounded p-4 border bg-white flex-1" style="height: 25rem;">
                    <livewire:livewire-column-chart key="{{ $columnChartModelCompras->reactiveKey() }}"
                        :column-chart-model="$columnChartModelCompras" />
                </div>
            @else
                <div class="shadow rounded p-4 border bg-white flex-1 w-full text-center text-lg font-semibold">
                    <h1>No Hay registro de Ingresos</h1>
                </div>
            @endif
        </div>
    </div>
</div>
