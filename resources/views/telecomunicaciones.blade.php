@extends('layouts.pagina')
@section('titulo')

@section('content')
    <section class="mb-10">
        <div class="portada_servicios"
            style="background-image: linear-gradient(120deg, rgba(0, 0, 0, 0.699) 0%, rgba(3, 3, 3, 0.651) 100%), url('{{ asset('/images/pagina/telecomunicaciones.jpg') }}'); background-size: cover; background-position: center;">
            <div class="w-48 md:w-64 absolute bottom-20 left-12 md:right-24 lg:right-48 transition-all">
                <img src="{{ asset('images/logo/logo_blanco_icon.png') }}" alt="" width="100%">
            </div>
            <div class="w-full h-full flex flex-col items-center justify-center pl-10 md:pl-20">
                <div class="animate_fadeInDown">
                    <h2 class="texto_servicio_telecomunicaciones">
                        TELECOMUNICACIONES
                    </h2>
                </div>
            </div>
            <div class="w-full absolute bottom-0" style="height: 20vh; overflow: hidden;">
                <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                    <path d="M-1.41,87.34 C223.75,51.81 237.30,51.81 505.36,1.50 L500.00,150.00 L0.00,150.00 Z"
                        style="stroke: none; fill: #F2F2F2;">
                    </path>
                </svg>
            </div>
        </div>
    </section>
    <section class="servicios_content_principal px-12 md:px-24">
        <h1 class="mt-8 text-2xl text-blue-500 font-semibold">TELECOMUNICACIONES</h1>
        <p class="my-2">CiberTel S.R.L. cuenta con equipos altamente especializados en la Instalación y 
            mantenimiento de enlaces de microondas; Instalación de radio bases 2G, 3G y 4G; 
            Modernización y SWAP de tecnologías; Instalación de plantas de energías y bancos de 
            baterías; Tendido y mantenimiento de fibra óptica.</p>
        <div class="body flex flex-col">
            <div class="parrafo">
                <div class="flex flex-col items-center content-center img mb-2">
                    <img class="mb-2" src="{{ asset('images/pagina/radio_bases.jpg') }}" alt="">
                </div>
                <div class="my-0 md:my-10 mr-6">                   
                    <p class="text-justify">En las áreas de infraestructura e ingeniería de redes, ofrecemos un servicio integral, 
                        siendo especialistas en:
                    </p>
                    <div class="flex items-start mb-2 mt-4 esp-hover">
                        <span class="icon-trayectoria"><i class="fas fa-check"></i></span>
                        <p class="text-left">Diseño e instalación de sistemas de energía y aterramiento en estaciones de 
                            comunicaciones</p>
                    </div>
                    <div class="flex items-start mb-2 mt-4 esp-hover">
                        <span class="icon-trayectoria"><i class="fas fa-check"></i></span>
                        <p class="text-left">Servicio de Operación y Mantenimiento de Radio Bases.</p>
                    </div>
                    <div class="flex items-start mb-2 mt-4 esp-hover">
                        <span class="icon-trayectoria"><i class="fas fa-check"></i></span>
                        <p class="text-left">Mediciones de Campo (Drive Test), Site Surveys y Mediciones de Campo 
                            Electromagnético.</p>
                    </div>
                    <div class="flex items-start mb-2 mt-4 esp-hover">
                        <span class="icon-trayectoria"><i class="fas fa-check"></i></span>
                        <p class="text-left">Instalación de sistemas de comunicación y datos, cableado estructurados y 
                            fibra óptica.</p>
                    </div>
                    <div class="flex items-start mb-2 mt-4 esp-hover">
                        <span class="icon-trayectoria"><i class="fas fa-check"></i></span>
                        <p class="text-left">Provisión de Banco de Baterías, y sistemas de suministro de energía 
                            ininterrumpida (UPS) para centros de datos y radio bases.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="body flex flex-col">
            <div class="parrafo">
                <div class="flex flex-col items-center content-center img mb-2">
                    <img class="mb-2" src="{{ asset('images/pagina/redes_empresariales.jpg') }}" alt="">
                </div>
                <div class="my-0 md:my-10 mr-6">
                    {{-- <h2 class="mb-2 text-xl text-black font-semibold text-center">Telecomunicaciones</h2> --}}
                    <p class="text-justify">En el área de Networking y comunicaciones somos especialistas en:
                    </p>
                    <div class="flex items-start mb-2 mt-4 esp-hover">
                        <span class="icon-trayectoria"><i class="fas fa-check"></i></span>
                        <p class="text-left">Redes LAN, WAN.</p>
                    </div>
                    <div class="flex items-start mb-2 mt-4 esp-hover">
                        <span class="icon-trayectoria"><i class="fas fa-check"></i></span>
                        <p class="text-left">Videoconferencias y Tele presencia.</p>
                    </div>
                    <div class="flex items-start mb-2 mt-4 esp-hover">
                        <span class="icon-trayectoria"><i class="fas fa-check"></i></span>
                        <p class="text-left">Redes empresariales (SW&ROUTER).</p>
                    </div>
                    <div class="flex items-start mb-2 mt-4 esp-hover">
                        <span class="icon-trayectoria"><i class="fas fa-check"></i></span>
                        <p class="text-left">Soluciones de almacenamiento.</p>
                    </div>
                    <div class="flex items-start mb-2 mt-4 esp-hover">
                        <span class="icon-trayectoria"><i class="fas fa-check"></i></span>
                        <p class="text-left">Seguridad informática.</p>
                    </div>
                    <div class="flex items-start mb-2 mt-4 esp-hover">
                        <span class="icon-trayectoria"><i class="fas fa-check"></i></span>
                        <p class="text-left">Redes Inalámbricas.</p>
                    </div>
                    <div class="flex items-start mb-2 mt-4 esp-hover">
                        <span class="icon-trayectoria"><i class="fas fa-check"></i></span>
                        <p class="text-left"> Provisión e Instalación de equipamiento.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
