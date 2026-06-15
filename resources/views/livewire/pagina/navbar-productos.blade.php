<div x-data="{ close: false }">
    <nav class="fixed z-40">
        <div class="menu-admin" x-bind:class="{ 'close': close }">
            <div class="menu-admin-content">
                @if ($listen_subcategorias == 'desactivado')
                    <div class="hidden md:block border-b border-gray-500">
                        <div class="w-full flex flex-col items-center h-14 py-1 justify-center ">
                            <button wire:click="categorias"
                                class="font-medium flex items-center justify-center w-full h-full text-gray-600 hover:text-black transition-all">
                                <span class="text-md mx-4">Menu </span>
                            </button>
                        </div>
                    </div>
                    @if ($categorias->count())
                        {{-- links categoria --}}
                        <div class="nav-links-cont">
                            @foreach ($categorias as $categoria)
                                <div class="relative border-b border-gray-500">
                                    <button wire:click="subcategorias({{ $categoria }})"
                                        class="flex items-center w-full justify-between px-4 link-color relative focus:outline-none">
                                        <span class="text-md py-3">{{ $categoria->nombre }}</span>
                                        <i class='bx bx-chevrons-right text-2xl'></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="border-b border-gray-500">
                            <div class="w-full flex flex-col items-center h-14 py-1 justify-center ">
                                <button
                                    class="font-medium inline-block focus:outline-none w-full h-full text-gray-600 hover:text-black transition-all">
                                    <span class="text-md">Sin Registros</span>
                                </button>
                            </div>
                        </div>
                    @endif
                @endif
                @if ($listen_subcategorias == 'activado')
                    <div class="hidden md:block border-b border-gray-500">
                        <div class="w-full flex flex-col items-center h-14 py-1 justify-center ">
                            <button wire:click="categorias"
                                class="font-medium flex items-center justify-center w-full h-full text-gray-600 hover:text-black transition-all focus:outline-none">
                                <i class='bx bx-chevrons-left text-2xl'></i>
                                <span class="text-md mx-4">Volver </span>
                            </button>
                        </div>
                    </div>
                    @if ($subcategorias->count())
                        {{-- links categoria --}}
                        <div class="nav-links-cont">
                            @foreach ($subcategorias as $subcategoria)
                                <div class="relative border-b border-gray-500">
                                    <button wire:click="productos({{ $subcategoria }})"
                                        class="flex items-center w-full justify-between px-4 link-color relative focus:outline-none">
                                        <span class="text-md py-3">{{ $subcategoria->nombre }}</span>
                                        <i class='bx bx-chevrons-right text-2xl'></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="border-b border-gray-500">
                            <div class="w-full flex flex-col items-center h-14 py-1 justify-center ">
                                <button wire:click="categorias"
                                    class="font-medium flex items-center justify-center w-full h-full text-gray-600 hover:text-black transition-all focus:outline-none">
                                    <i class='bx bx-chevrons-left text-2xl'></i>
                                    <span class="text-md mx-4">Sin Registros </span>
                                </button>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="nav-menu-user flex justify-between items-center">
            <div class="px-2 text-black text-xl font-bold">
                <button class="p-4 rounded-md focus:outline-none" x-on:click="close = !close">
                    <div class="flex">
                        <i class="fas fa-bars mr-2"></i>
                        <span class="text-sm">CATEGORIAS</span>
                    </div>
                </button>
            </div>
        </div>
    </nav>
</div>