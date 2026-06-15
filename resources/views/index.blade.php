@extends('layouts.pagina')
@section('titulo')

    {{-- chatbot --}}
    <div data-bot-id="126793">
    </div>

@section('content')
    <section class="mb-10">
        <div class="portada"
            style="background-image: linear-gradient(120deg, rgba(0, 0, 0, 0.699) 0%, rgba(3, 3, 3, 0.151) 100%), url('{{ asset('/images/pagina/fondo.jpg') }}'); background-size: cover; background-position: center;">
            <div class="w-48 md:w-64 absolute bottom-12 left-12 md:right-24 lg:right-48 transition-all">
                <img src="{{ asset('images/logo/logo_blanco_icon.png') }}" alt="" width="100%">
            </div>
            <div class="w-full h-full flex flex-col justify-center pl-10 md:pl-20">
                <div class="animate_fadeInDown">
                    <h1 class="texto_header_h1">
                        CÁMARAS DE SEGURIDAD Y VIGILANCIA
                    </h1>
                    <h2 class="texto_header_h2 ">
                        INVIERTE EN TU TRANQUILIDAD
                    </h2>
                </div>
            </div>
            <div class="w-full absolute bottom-0" style="height: 50px; overflow: hidden;">
                <svg viewBox="0 0 150 120" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                    <path d="M0.00,49.98 C150.00,150.00 349.20,-50.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
                        style="stroke: none; fill: #F2F2F2;">
                    </path>
                </svg>
            </div>
        </div>
    </section>
    <section class="service-body">

        <h1 class="text-xl py-2 text-blue-500">NUESTROS SERVICIOS</h1>
        <div class="separador"></div>
        <div class="flex flex-wrap justify-center items-center service pl-12 pr-2">
            <div class="galery-service"
                style="background-image: linear-gradient(120deg, rgba(234, 236, 236, 0.699) 0%, rgba(184, 193, 218, 0.301) 100%), url('{{ asset('/images/pagina/home1.jpg') }}'); background-size: cover; background-position: center;">
                <div class="flex flex-col items-center justify-center image-port">
                    <a href="{{route('telecomunicaciones')}}">
                        <img class="galery-icon" src="{{ asset('/images/pagina/camara_icon.png') }}">
                    </a>
                    <a href="{{route('telecomunicaciones')}}" class="text-white">
                        Telecomunicaciones
                    </a>
                </div>
            </div>
            <div class="galery-service"
                style="background-image: linear-gradient(120deg, rgba(234, 236, 236, 0.699) 0%, rgba(184, 193, 218, 0.301) 100%), url('{{ asset('/images/pagina/cpd1.jpg') }}'); background-size: cover; background-position: center;">
                <div class="flex flex-col items-center justify-center image-port">
                    <a href="{{route('centro.procesamiento.datos')}}">
                        <img class="galery-icon" src="{{ asset('/images/pagina/cpd_icon.png') }}">
                    </a>
                    <a href="{{route('centro.procesamiento.datos')}}" class="text-white">
                        Centro de procesamiento de datos
                    </a>
                </div>
            </div>
            <div class="galery-service"
                style="background-image: linear-gradient(120deg, rgba(234, 236, 236, 0.699) 0%, rgba(184, 193, 218, 0.301) 100%), url('{{ asset('/images/pagina/alarma.jpg') }}'); background-size: cover; background-position: center;">
                <div class="flex flex-col items-center justify-center image-port">
                    <a href="{{route('alarmas')}}">
                        <img class="galery-icon" src="{{ asset('/images/pagina/acceso_icon.png') }}">
                    </a>
                    <a href="{{route('alarmas')}}" class="text-white">
                        Alarmas CCTV y Acceso
                    </a>
                </div>
            </div>
            <div class="galery-service"
                style="background-image: linear-gradient(120deg, rgba(234, 236, 236, 0.699) 0%, rgba(184, 193, 218, 0.301) 100%), url('{{ asset('/images/pagina/elec2.jpg') }}'); background-size: cover; background-position: center;">
                <div class="flex flex-col items-center justify-center image-port">
                    <a href="{{route('sistemas.electricos')}}">
                        <img class="galery-icon" src="{{ asset('/images/pagina/cable_icon.png') }}">
                    </a>
                    <a href="{{route('sistemas.electricos')}}" class="text-white">
                        Sistemas Eléctricos
                    </a>
                </div>
            </div>
        </div>
        {{-- sobre Nosotros --}}
        <div class="mt-12 mx-6">
            <h1 class="text-xl py-2 text-blue-500">SOMOS UNA EMPRESA ORIENTADA A LA TECNOLOGÍA</h1>            
        </div>
        <div class="flex flex-col md:flex-row items-center w-full pl-12 pr-2 pb-12 transition-all">            
            <div class="w-full md:w-1/2 my-4">               
                <img src="{{ asset('images/pagina/mision.png') }}" alt="">
            </div>
            <div class="w-full md:w-1/2">
                <div class="flex items-center ml-4 mr-6 p-4 mt-4 shadow-lg hover:shadow-none transition-all">
                    <div class="flex flex-col items-start justify-start">
                        <div class="text-blue-500">
                            <h1>MISIÓN</h1>
                        </div>
                        <div class="text-justify">
                            <p>Garantizar un servicio de calidad con personal calificado, implementando nuevas tecnologías de vanguardia, asesoramiento personalizado y actualización permanente</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center ml-4 mr-6 p-4 mt-4 shadow-lg hover:shadow-none transition-all">
                    <div class="flex flex-col items-start justify-start">
                        <div class="text-blue-500">
                            <h1>VISIÓN</h1>
                        </div>
                        <div class="text-justify">
                            <p>Ser una de las mejores empresas reconocidas a nivel nacional en servicios y tecnología; Sólida, transparente y confiable ante nuestros clientes, con personal motivado, dinámico y pro activo</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="mt-12 mx-6">
                <h1 class="text-xl py-2 text-blue-500">NUESTROS PRODUCTOS.</h1>            
            </div>
        </div>
        {{-- area de porque con cibertel --}}
        <div class="flex flex-col md:flex-row items-center w-full pl-12 pr-2 py-12 transition-all">
            <div class="w-full md:w-1/2 my-4">
                <div class="pb-4">
                    <h2 class="font-bold text-2xl">¿PORQUE CON</h2>
                    <h2 class="font-bold text-2xl color_cibertel_texto">CIBERTEL S.R.L.?</h2>
                </div>
                <img src="{{ asset('images/pagina/logo2.png') }}" alt="">
            </div>
            <div class="w-full md:w-1/2">
                <div class="flex items-center ml-4 mr-6 p-4 shadow-lg hover:shadow-none transition-all">
                    <div class="text-5xl text-red-600 pr-2">
                        <i class='bx bxs-check-square'></i>
                    </div>
                    <div class="flex flex-col items-start justify-start">
                        <div class="text-red-500">
                            <h1>COSTO / BENEFICIO</h1>
                        </div>
                        <div class="text-justify">
                            <p>Ofrecemos servicios especializados de alta calidad. Garantizamos el mejor costo de beneficios
                                en Bolivia</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center ml-4 mr-6 p-4 shadow-lg hover:shadow-none transition-all">
                    <div class="text-5xl text-blue-600 pr-2">
                        <i class='bx bxs-chevron-right-circle'></i>
                    </div>
                    <div class="flex flex-col items-start justify-start">
                        <div class="text-blue-500">
                            <h1>MULTIPLES SERVICIOS</h1>
                        </div>
                        <div class="text-justify">
                            <p>Conjuntamos una amplia gama de servicios profesionales, simplificando así el proceso de
                                implementación de tecnología</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center ml-4 mr-6 p-4 shadow-lg hover:shadow-none transition-all">
                    <div class="text-5xl text-green-600 pr-2">
                        <i class='bx bxs-megaphone'></i>
                    </div>
                    <div class="flex flex-col items-start justify-start">
                        <div class="text-green-600">
                            <h1>RESULTADOS MEDIDOS</h1>
                        </div>
                        <div class="text-justify">
                            <p>Medimos con precisión los parámetros que tu empresa necesita conocer. Ofrecemos herramientas
                                de información en tiempo real</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    @endsection
