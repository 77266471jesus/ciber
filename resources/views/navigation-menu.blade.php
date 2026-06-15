<nav class="z-50 w-full">
    @can('admin.escritorio')
        <div class="sidebar close">
            <x-admin>
            </x-admin>
        </div>
    @endcan
    <div class="home-section z-50">
        <div class="flex items-center">
            <div class="home-content">
                <i class='bx bx-menu text-white'></i>
                <span class="text"> </span>
            </div>
            @can('admin.escritorio')
                <div class="px-2">
                    @livewire('admin.alerta.alertas')
                </div>
            @endcan
        </div>
        <a href="{{ route('index') }}"
            class="flex items-center logo_menu_navbar_admin transition-all text-gray-300 hover:text-white">
            <div class="h-10 w-10 mr-2 logo_menu_navbar_admin_img">
                <img src="{{ asset('images/logo_2.png') }}" alt="" width="100%">
            </div>
            <div class="text-2xl logo_menu_navbar_admin_text">
                <h1 class="font-bold">SOSAMET</h1>
                <p class="text-xs font-semibold">ESTRUCTURAS METALICAS</p>
            </div>
        </a>
        <div class="relative pr-4 flex items-center">
            @can('admin.escritorio')
                <div class="px-2">
                    @livewire('pagina.productos-no-vendidos')
                </div>
            @endcan
            @can('admin.escritorio')
                <div class="px-2">
                    @livewire('admin.configuracion.notificacion')
                </div>
            @endcan
            <x-jet-dropdown align="right" width="48">
                <x-slot name="trigger">
                    @if (Auth::user()->image)
                        <button
                            class="flex text-sm text-white font-semibold border-2 items-center border-transparent rounded-full focus:outline-none focus:border-gray-300 transition p-2">
                            <img class="h-8 w-8 rounded-full object-cover"
                                src="{{ Storage::url(Auth::user()->image) }}">
                            <div class="flex items-center ml-1">
                                <span> {{ Auth::user()->user_name }}</span>
                                <i class='bx bx-chevron-down ml-1'></i>
                            </div>
                        </button>
                    @else
                        <button
                            class="flex text-sm text-white font-semibold border-2 items-center border-transparent rounded-full focus:outline-none focus:border-gray-300 transition p-2">
                            <div class="flex items-center ml-1">
                                <span> {{ Auth::user()->user_name }}</span>
                                <i class='bx bx-chevron-down ml-1'></i>
                            </div>
                        </button>
                    @endif
                </x-slot>

                <x-slot name="content">
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Administrar cuenta') }}
                    </div>

                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                        {{ __('Perfil') }}
                    </x-jet-dropdown-link>
                    @can('pagina.cotizacion')
                        <x-jet-dropdown-link href="{{ route('historial.cotizacion') }}">
                            {{ __('Cotizacion') }}
                        </x-jet-dropdown-link>
                    @endcan


                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-jet-dropdown-link>
                    @endif

                    <div class="border-t border-gray-100"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-jet-dropdown-link href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Cerrar sesión') }}
                        </x-jet-dropdown-link>
                    </form>
                </x-slot>
            </x-jet-dropdown>
        </div>
    </div>
</nav>
