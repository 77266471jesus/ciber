<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/icon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/icon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/icon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/icon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/icon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/icon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/icon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/icon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/icon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/icon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/icon/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('images/icon/ms-icon-144x144.png') }}">
    <title>Cibertel S.R.L. @yield('titulo') </title>
    {{-- tailwind --}}
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">

    {{-- estilos de la plantilla --}}
    <link rel="stylesheet" href="{{ asset('css/pagina.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/servicios.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contacto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cotizacions.css') }}">

    {{-- scrip de la pagina --}}
    <script src="{{ asset('js/pagina.js') }}"></script>

    {{-- alpine js --}}
    <script src="{{ asset('vendor/alpinejs/dist/cdn.min.js') }}" defer></script>

    <!-- Scripts -->
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}

    {{-- Font Awesone --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <!-- Boxicons -->
    <link rel="stylesheet" href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}">

</head>

<body>
    <header id="navbar" class="z-50">
        <div x-data="{ open: false }" class="z-50">
            <div class="flex justify-between items-center">
                <div class="logo">
                    <a href="{{ route('index') }}">
                        <div class="flex items-center ml-2 h-full">
                            <div>
                                <img class="w-12" src="{{ asset('images/logo/LOGO-03.gif') }}" alt="">
                            </div>
                            <div class="hidden md:block">
                                <h1 class="text-sm h1-c font-medium tracking-wide">CI<span
                                        class="color-c">BER</span>TEL S.<span class="color-c">R.</span>L.
                                </h1>
                                <h2 class="h2-c"><span class="color-c">Revolucionando</span> con <span
                                        class="color-c">la</span> Tecnología</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="flex items-center header_cotizacion rounded-md">
                    <div class="w-full flex flex-col items-center justify-center">
                        @livewire('pagina.header')
                    </div>
                    @can('pagina.cotizacion')
                        @if (Route::has('login'))
                            @auth
                                <div class="w-10 flex flex-col items-center justify-center">
                                    @livewire('pagina.carrito')
                                </div>
                            @endauth
                        @endif
                    @endcan
                </div>
                <div class="hidden lg:block">
                    <div class="list flex items-center ">
                        <li><a href="{{ route('pagina.productos') }}" class="links"><span
                                    class="cool-link">Productos</span></a></li>
                        <li><a href="{{ route('servicios') }}" class="links"><span
                                    class="cool-link">Servicios</span></a></li>
                        <li><a href="{{ route('contacto') }}" class="links"><span
                                    class="cool-link">Contactos</span></a></li>
                        @if (Route::has('login'))
                            @auth
                                <div x-data="{ session: false }">
                                    <button x-on:click="session = !session"
                                        class="border-2 border-white rounded-md hover:border-blue-500 transition-none px-2 focus:outline-none text-white hover:text-blue-500 ">
                                        <a>
                                            <i class='bx bx-user-circle py-2 pr-2'></i>
                                            <span>{{ Auth::user()->user_name }}</span>
                                        </a>
                                    </button>
                                    <div x-show="session" x-transition.duration.500ms x-on:click.away="session = false">
                                        <div class="absolute w-48 bg-gray-200 mt-2 -ml-20 rounded-md">
                                            <a href="{{ route('profile.show') }}"
                                                class="inline-block py-1 px-8 hover:bg-blue-900 w-full session_text">
                                                <i class='bx bxs-user-circle'></i>
                                                <span>Perfil</span>
                                            </a>
                                            @can('admin.escritorio')
                                                <a href="{{ route('admin.escritorio') }}"
                                                    class="inline-block py-1 px-8 hover:bg-blue-900 w-full session_text">
                                                    <i class='bx bxs-dashboard'></i>
                                                    <span>Sistema</span>
                                                </a>
                                            @endcan
                                            @can('pagina.cotizacion')
                                                <a href="{{ route('historial.cotizacion') }}"
                                                    class="inline-block py-1 px-8 hover:bg-blue-900 w-full session_text">
                                                    <i class='bx bxs-dashboard'></i>
                                                    <span>Cotizaciones</span>
                                                </a>
                                            @endcan
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                                    class="inline-block py-1 px-8 hover:bg-blue-900 w-full session_text">
                                                    <i class='bx bx-power-off'></i>
                                                    <span>Cerrar Sesion</span>
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div x-data="{ session: false }">
                                    <button x-on:click="session = !session"
                                        class="border-2 border-white rounded-md hover:border-blue-500 transition-none px-2 focus:outline-none text-white hover:text-blue-500 ">
                                        <a>
                                            <i class='bx bx-menu-alt-left py-2 pr-2'></i></i>
                                            <span>Acceder</span>
                                        </a>
                                    </button>
                                    <div x-show="session" x-transition.duration.500ms x-on:click.away="session = false">
                                        <div class="absolute w-48 bg-gray-200 mt-2 -ml-20 rounded-md">
                                            <a href="{{ route('login') }}"
                                                class="inline-block py-1 px-8 hover:bg-blue-900 w-full session_text">
                                                <i class='bx bx-log-in-circle'></i>
                                                <span>Iniciar Sesion</span>
                                            </a>
                                            {{-- <a href="{{ route('register') }}"
                                                class="inline-block py-1 px-8 hover:bg-blue-900 w-full session_text">
                                                <i class='bx bxs-file-plus'></i>
                                                <span>Register</span>
                                            </a> --}}
                                        </div>
                                    </div>
                                </div>
                            @endauth
                        @endif

                    </div>
                </div>
                <div class="block lg:hidden menubar ">
                    <button @click="open = !open" class="focus:outline-none ">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            <!-- responsivo para dispositivos mobiles  -->
            <div class="flex flex-col content-center justify-center">
                <div class="block lg:hidden">
                    <div x-show.transition.orin.top.left="open" class="flex flex-col items-center menuresp">
                        <a href="{{ route('pagina.productos') }}" class="links_reps"> Productos</a>
                        <div class="lg\:border-gray-100 border-b w-4/5 h-2"></div>
                        <a href="{{ route('servicios') }}" class="links_reps"> Servicios</a>
                        <div class="lg\:border-gray-100 border-b w-4/5 h-2"></div>
                        <a href="{{ route('contacto') }}" class="links_reps"> Contactos</a>
                        <div class="lg\:border-gray-100 border-b w-4/5 h-2"></div>
                        {{-- <a href="#" class="links_reps"><i class="fas fa-key"></i> Login</a> --}}
                        @if (Route::has('login'))
                            @auth
                                <div x-data="{ session: false }">
                                    <button x-on:click="session = !session"
                                        class="links_reps focus:outline-none focus:text-blue-500">
                                        <a>
                                            <i class='bx bx-user-circle py-2 pr-2'></i>
                                            <span>{{ Auth::user()->user_name }}</span>
                                        </a>
                                    </button>
                                    <div x-show="session" x-transition.duration.500ms x-on:click.away="session = false">
                                        <div class="relative w-full">
                                            <div class="lg:border-gray-100 border-b w-full h-2"></div>
                                            <a href="{{ route('profile.show') }}"
                                                class="inline-block text-center text-white hover:text-blue-500 py-2 px-8 w-full">
                                                <i class='bx bxs-user-circle'></i>
                                                <span>Perfil</span>
                                            </a>
                                            <div class="lg:border-gray-100 border-b w-full h-2"></div>
                                            @can('admin.escritorio')
                                                <a href="{{ route('admin.escritorio') }}"
                                                    class="inline-block text-center text-white hover:text-blue-500 py-2 px-8 w-full">
                                                    <i class='bx bxs-dashboard'></i>
                                                    <span>Sistema</span>
                                                </a>
                                            @endcan
                                            @can('pagina.cotizacion')
                                                <a href="{{ route('historial.cotizacion') }}"
                                                    class="inline-block text-center text-white hover:text-blue-500 py-2 px-8 w-full">
                                                    <i class='bx bxs-dashboard'></i>
                                                    <span>Cotizaciones</span>
                                                </a>
                                            @endcan
                                            <div class="lg:border-gray-100 border-b w-full h-2"></div>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                                    class="inline-block text-center text-white hover:text-blue-500 py-2 px-8 w-full">
                                                    <i class='bx bx-power-off'></i>
                                                    <span>Cerrar Sesion</span>
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div x-data="{ session: false }">
                                    <button x-on:click="session = !session"
                                        class="links_reps focus:outline-none focus:text-blue-500">
                                        <a>
                                            <i class='bx bx-log-in-circle'></i>
                                            <span>Acceder</span>
                                        </a>
                                    </button>
                                    <div x-show="session" x-transition.duration.500ms x-on:click.away="session = false">
                                        <div class="relative w-full">
                                            <div class="lg:border-gray-100 border-b w-full h-2"></div>
                                            <a href="{{ route('login') }}"
                                                class="inline-block text-center text-white hover:text-blue-500 py-2 px-8 w-full">
                                                <i class='bx bx-log-in-circle'></i>
                                                <span>Iniciar Sesion</span>
                                            </a>
                                            {{-- <div class="lg:border-gray-100 border-b w-full h-2"></div>
                                            <a href="{{ route('register') }}"
                                                class="inline-block text-center text-white hover:text-blue-500 py-2 px-8 w-full">
                                                <i class='bx bxs-file-plus'></i>
                                                <span>Register</span>
                                            </a> --}}
                                        </div>
                                    </div>
                                </div>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </header>
    <div class="cont-social">
        <ul>
            <li>
                <a href="https://www.facebook.com/DESARROLLO.CIBERTEL" target=”_blank”>
                    <span>facebook</span>
                </a>
                <i class='bx bxl-facebook facebook icon-cont'></i>
            </li>
            <li>
                <a href="https://twitter.com/" target=”_blank”>
                    <span>Twitter</span>
                </a>
                <i class='bx bxl-twitter twitter icon-cont'></i>
            </li>
            <li>
                <a href="https://www.youtube.com/channel/UC9S---bJFLUZOVvo6cpDm7g?view_as=subscriber" target=”_blank”>
                    <span>You Tube</span>
                </a>
                <i class='bx bxl-youtube youtube icon-cont'></i>
            </li>
            <li>
                <a href="https://wa.me/message/JS5QUN47OUOKI1" target=”_blank”>
                    <span>Whatsapp</span>
                </a>
                <i class='bx bxl-whatsapp whatsapp icon-cont'></i>
            </li>
            <li>
                <a href="https://www.instagram.com/" target=”_blank”>
                    <span>Instagram</span>
                </a>
                <i class='bx bxl-instagram instagram icon-cont'></i>
            </li>
        </ul>
    </div>
    {{-- chatbot --}}
    @livewire('pagina.chatbot')

    @section('content')

    @show


    <x-footer>
    </x-footer>
    <script src="{{ asset('/js/script.js') }}"></script>
    @livewireScripts
    <script src="https://account.snatchbot.me/script.js"></script>
    <script>
        Livewire.on('chatbot', function(message) {
            window.sntchChat.Init(126793)
        });        
    </script>
    {{-- <script>
        var botmanWidget = {
            aboutText: 'ssdsd',
            introMessage: "<img draggable="false" role="img" class="emoji" alt="✋" src="https://s.w.org/images/core/emoji/14.0.0/svg/270b.svg"> Hi! I'm form Tutsmake.org"
        };
    </script> --}}
    {{-- Sweet Alert 2 --}}
    <script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script>
        Livewire.on('alert', function(message) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 2000
            })
        });
        Livewire.on('cancelar', function(message) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: message,
                showConfirmButton: false,
                timer: 2000
            })
        });
    </script>

    {{-- <script src="{{ asset('/vendor/botman/build/js/widget.js') }}"></script> --}}
</body>

</html>
