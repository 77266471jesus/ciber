@extends('layouts.pagina')
@section('titulo')

@section('content')
    <section class="mb-10">
        <div class="portada_servicios"
            style="background-image: linear-gradient(120deg, rgba(0, 0, 0, 0.699) 0%, rgba(3, 3, 3, 0.651) 100%), url('{{ asset('/images/pagina/home1.jpg') }}'); background-size: cover; background-position: center;">
            <div class="w-48 md:w-64 absolute bottom-20 left-12 md:right-24 lg:right-48 transition-all">
                <img src="{{ asset('images/logo/logo_blanco_icon.png') }}" alt="" width="100%">
            </div>
            <div class="w-full h-full flex flex-col items-center justify-center pl-10 md:pl-20">
                <div class="animate_fadeInDown">
                    <h2 class="texto_servicio_h2">
                        SERVICIOS
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
        <h1 class="mt-8 text-2xl text-blue-500 font-semibold">CIBERTEL OFRECE</h1>
        <p class="my-2">Provisión, instalación y servicio de mantenimiento de equipos en:</p>
        <div class="body flex flex-col">
            <div class="parrafo">
                <div class="flex flex-col items-center content-center img mb-2">
                    <img class="mb-2" src="{{ asset('images/pagina/telecomunicaciones.jpg') }}" alt="">
                </div>
                <div class="my-0 md:my-10 mr-6">
                    <h2 class="mb-2 text-xl text-black font-semibold text-center">Telecomunicaciones</h2>
                    <p class="text-justify">CiberTel S.R.L. cuenta con equipos altamente especializados en la Instalación
                        y
                        mantenimiento de enlaces de microondas; Instalación de radio bases 2G, 3G y 4G;
                        Modernización y SWAP de tecnologías; Instalación de plantas de energías y bancos de
                        baterías; Tendido y mantenimiento de fibra óptica.
                        <a href="{{route('telecomunicaciones')}}" class="text-blue-800 hover:text-blue-500 p-2 text-lg">
                            Saber más
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="body flex flex-col">
            <div class="parrafo">
                <div class="flex flex-col items-center content-center img mb-2">
                    <img class="mb-2" src="{{ asset('images/pagina/centro_proceso_datos.jpeg') }}" alt="">
                </div>
                <div class="my-0 md:my-10 mr-6">
                    <h2 class="mb-2 text-xl text-black font-semibold text-center">Centro de procesamiento de datos</h2>
                    <p class="text-justify">Los centros de datos son una parte fundamental de las empresas. Al igual que
                        dos ordenadores
                        conectados en una red local, los servidores de Internet envían información a diferentes dispositivos
                        y equipos a través de conexiones de red.
                        <br>Instalamos y proveemos infraestructura para Data Center de última tecnología
                        acorde a normas internacionales.

                        <a href="{{route('centro.procesamiento.datos')}}" class="text-blue-800 hover:text-blue-500 p-2 text-lg">
                            Saber más
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="body flex flex-col">
            <div class="parrafo">
                <div class="flex flex-col items-center content-center img mb-2">
                    <img class="mb-2" src="{{ asset('images/pagina/elec2.jpg') }}" alt="">
                </div>
                <div class="my-0 md:my-10 mr-6">
                    <h2 class="mb-2 text-xl text-black font-semibold text-center">Sistemas Eléctricos</h2>
                    <p class="text-justify">El sistema eléctrico se define como el conjunto de instalaciones, conductores
                        y equipos necesarios para la generación, el transporte y la distribución de la energía eléctrica. Se
                        divide en tres subsistemas principales: generación, transporte y distribución <br>
                        Implementamos y certificamos instalaciones de Redes Eléctricas civiles e
                        industriales y mediante nuestros equipos UP´s y Generadores evitamos cortes de
                        energía eléctrica en su empresa.
                        <a href="{{route('sistemas.electricos')}}" class="text-blue-800 hover:text-blue-500 p-2 text-lg">
                            Saber más
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="body flex flex-col">
            <div class="parrafo">
                <div class="flex flex-col items-center content-center img mb-2">
                    <img class="mb-2" src="{{ asset('images/pagina/alarma.jpg') }}" alt="">
                </div>
                <div class="my-0 md:my-10 mr-6">
                    <h2 class="mb-2 text-xl text-black font-semibold text-center">Alarmas CCTV y Acceso</h2>
                    <p class="text-justify">Alarmas de niveles más altos de protección para Bancos, Instalaciones
                        Militares y
                        gubernamentales de alta seguridad, residencias y todo lugar donde la seguridad es
                        fundamental. CCTV Tecnología de vídeo vigilancia diseñada para supervisar una
                        diversidad de ambientes y actividades, más conocido como circuito cerrado. Toda
                        empresa u organismo, tiene sectores donde solo ciertas personas pueden ingresar,
                        establecer y controlar estos niveles de acceso puede ser una tarea dificultosa a
                        menos que se cuente con un sistema electrónico que facilite el proceso, en
                        CIBERTEL S.R.L. tenemos una variedad de soluciones en cuanto a Control de
                        Acceso.
                        <a href="{{route('alarmas')}}" class="text-blue-800 hover:text-blue-500 p-2 text-lg">
                            Saber más
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>






@endsection
