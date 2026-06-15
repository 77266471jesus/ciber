<div>
    <div class="h-20 w-full color_menu_scroll">
    </div>
    @include('livewire.pagina.navbar-productos')
    <div class="mt-20">
        <div class="w-full flex flex-col items-center justify-center">
            <div class="flex flex-row px-6 w-full md:w-1/2 h-12">
                <input type="search" class="w-full input_search border-2 border-gray-300 rounded-lg" wire:model="search"
                    placeholder="Buscar producto">
                <i class='bx bx-search-alt input_icon'></i>
            </div>
        </div>
    </div>
    <div class="w-full pl-12 pr-6 mb-12 mt-6">
        <div class="flex flex-wrap items-center justify-center space-x-2 space-y-2 py-4">
            @if ($productos->count())
                @foreach ($productos as $producto)
                    <div class="flex flex-col w-48 bg-white transition-all h-72">
                        <a href="{{ route('pagina.producto_slug', $producto->slug) }}"
                        class="w-full flex flex-col items-center justify-center pt-2">
                            <div class="w-40 h-40 flex flex-col items-center justify-center">
                                <img class="w-full" src="{{ Storage::url($producto->image) }}" alt="">
                            </div>
                        </a>
                        <a href="{{ route('pagina.producto_slug', $producto->slug) }}"
                        class="p-2 mt-2 uppercase text-sm text-gray-800 hover:text-red-500 transition-all">
                            <h1 class="font-semibold">{{ substr( $producto->nombre, 0, 50) . "..."  }}</h1>
                            <h1 class="text-xs">{{ $producto->marca }}</h1>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="px-6 py-4 bg-white">
                    No existe registros
                </div>
            @endif           
        </div>
        @if ($productos->hasPages())
                <div class="px-6 py-3">
                    {{ $productos->links() }}
                </div>
            @endif
    </div>
</div>
