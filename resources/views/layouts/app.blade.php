<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('images/icon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('images/icon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('images/icon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/icon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('images/icon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('images/icon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('images/icon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('images/icon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/icon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('images/icon/android-icon-192x192.png')}}">    
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/icon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/icon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/icon/manifest.json')}}">
    <meta name="msapplication-TileImage" content="{{asset('images/icon/ms-icon-144x144.png')}}">
    <title>Cibertel S.R.L. @yield('titulo') </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Menu Plantilla -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productos.css') }}">

    <!-- Menu Plantilla -->
    <link rel="stylesheet" href="{{ asset('css/resource.css') }}">

    <!-- Tailwind -->
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">

    <!-- Boxicons -->
    <link rel="stylesheet" href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}">

    {{-- filepond --}}
    <link rel="stylesheet" href="{{ asset('vendor/filepond/dist/filepond.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    {{-- Boxicons --}}
    <script src="{{ asset('vendor/boxicons/dist/boxicons.js') }}"></script>

    {{-- filepond --}}
    <script src="{{ asset('vendor/filepond/dist/filepond.js') }}"></script>


</head>

<body class="font-sans antialiased">
    {{-- <x-jet-banner /> --}}

    <div class="min-h-screen bg-gray-100 w-full">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="pl-2 md:pl-20 pt-16">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    @stack('script')
    {{-- admin js --}}
    <script src="{{ asset('js/admin.js') }}"></script>

    {{-- apexcharts-bundle --}}
    <script src="{{ asset('vendor/apexcharts-bundle/dist/apexcharts.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}

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
    @livewireChartsScripts
</body>

</html>
