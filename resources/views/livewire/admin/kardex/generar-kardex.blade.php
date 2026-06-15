<div>
    <h1 class="text-2xl font-bold pt-4 pb-8 pl-4 text-green-500">GENERACIÓN DE KARDEX POR MES</h1>
    <div wire:loading wire:target="generar" class="w-full absolute h-full top-0 left-0"
        style="background: rgba(0, 0, 0, 0.384); height: 100vh; width: 100vw;">
        <div class="flex flex-col items-center justify-center w-full h-full">
            <div class="w-64">
                <img src="{{ asset('images/admin/loading.gif') }}" alt="">
            </div>
            <h1 class="text-white text-2xl font-bold">Cargando...</h1>
        </div>
    </div>
    <div class="px-6">
        <div class="w-full text-left">
            <h1 class="text-md md:text-xl lg:text-2xl font-bold p-4 text-green-600">KARDEX FISICO VALORADO</h1>
        </div>
        @can('admin.kardex')
            @include('livewire.admin.kardex.show-kardex')
        @endcan
        @if ($years->count())
            <div class="flex flex-col items-center my-6">
                <x-jet-label value="Seleccionar Año" />
                <div class="flex items-center mt-2 justify-center">
                    <div>
                        <select name="select" wire:model="anio"
                            class="w-32 py-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm outline-none">
                            <option class="hidden">SELECCIONAR</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->year }}">{{ $year->year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button wire:click="generar()" wire:loading.attr="disabled" wire:target="generar()"
                            class="focus:outline-none rounded-md bg-blue-500 text-gray-100 hover:bg-blue-600 hover:text-white p-1 h-10">
                            Generar Kardex
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap w-full space-x-4 justify-center">
                @foreach ($months as $month)
                    <div class="flex items-center p-2 my-2 bg-white rounded-md">
                        <div class="pr-2">
                            <div class="w-20 pr-2">
                                <img src="{{ asset('images/admin/icon_kardex.png') }}" alt="" width="100%">
                            </div>
                            <h1 class="font-semibold">
                                <span class="text-green-900">{{ $month->month }}</span>
                                <span class="mx-2 text-gray-700">de:</span>
                                <span class="text-green-900">{{ $anio }}</span>
                            </h1>
                        </div>
                        <div>
                            <div class="flex flex-col space-y-1">
                                @if ($month->cantidad)
                                    @can('admin.kardex')
                                        <button wire:click="show({{ $month->month }})"
                                            class="focus:outline-none rounded-md bg-blue-500 text-gray-100 hover:bg-blue-600 hover:text-white p-1">
                                            Ver Kardex
                                        </button>
                                    @endcan
                                    @can('admin.kardex.pdf')
                                        <a href="{{ route('admin.kardex.pdf', [$producto_id, $anio, $month->month]) }}"
                                            target="_blank"
                                            class="focus:outline-none rounded-md bg-red-500 text-gray-100 hover:bg-red-600 hover:text-white p-1">
                                            Generar pdf
                                        </a>
                                    @endcan
                                    @can('admin.kardex.excel')
                                        <a href="{{ route('admin.kardex.excel', [$producto_id, $anio, $month->month]) }}"
                                            class="focus:outline-none rounded-md bg-green-500 text-gray-100 hover:bg-green-600 hover:text-white p-1">
                                            Generar excel
                                        </a>
                                    @endcan
                                @else
                                    <button wire:click="generar()" wire:loading.attr="disabled" wire:target="generar()"
                                        class="focus:outline-none rounded-md bg-blue-500 text-gray-100 hover:bg-blue-600 hover:text-white p-1">
                                        Generar Kardex
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="px-6 py-4">
                No existe registros
            </div>
        @endif
    </div>
</div>
