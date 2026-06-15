@extends('layouts.pagina')
@section('titulo')

@section('content')
    <section class="mb-10">
        <div class="portada_servicios"
            style="background-image: linear-gradient(120deg, rgba(0, 0, 0, 0.699) 0%, rgba(3, 3, 3, 0.651) 100%), url('{{ asset('/images/pagina/alarma.jpg') }}'); background-size: cover; background-position: center;">
            <div class="w-48 md:w-64 absolute bottom-20 left-12 md:right-24 lg:right-48 transition-all">
                <img src="{{ asset('images/logo/logo_blanco_icon.png') }}" alt="" width="100%">
            </div>
            <div class="w-full h-full flex flex-col items-center justify-center pl-10 md:pl-20">
                <div class="animate_fadeInDown">
                    <h2 class="texto_servicio_telecomunicaciones text-center">
                        ALARMAS CCTV <br>
                        Y ACCESO
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
        <h1 class="mt-8 text-2xl text-blue-500 font-semibold">ALARMAS CCTV Y ACCESO</h1>
        <p class="my-2">Alarmas de niveles más altos de protección para Bancos, Instalaciones Militares y
            gubernamentales de alta seguridad, residencias y todo lugar donde la seguridad es
            fundamental. CCTV Tecnología de vídeo vigilancia diseñada para supervisar una
            diversidad de ambientes y actividades, más conocido como circuito cerrado. Toda
            empresa u organismo, tiene sectores donde solo ciertas personas pueden ingresar,
            establecer y controlar estos niveles de acceso puede ser una tarea dificultosa a
            menos que se cuente con un sistema electrónico que facilite el proceso, en
            CIBERTEL S.R.L. tenemos una variedad de soluciones en cuanto a Control de
            Acceso.</p>
        <div class="body flex flex-col">
            <div class="parrafo">
                <div class="flex flex-col items-center content-center img mb-2">
                    <img class="mb-2" src="{{ asset('images/pagina/sistemas_alarmas.jpg') }}" alt="">
                </div>
                <div class="my-0 md:my-10 mr-6">
                    <h2 class="mb-2 text-xl text-blue-500 font-semibold text-center">SISTEMAS DE ALARMAS</h2>
                    <p class="text-justify">Ofrecemos los niveles más altos de protección para bancos, instalaciones
                        militares
                        y gubernamentales de alta seguridad, residencias y todo lugar donde la seguridad es fundamental.
                        Diseñados para facilitar su uso, su expansión instalación y
                        mantenimiento. Supervise el estado del sistema, reciba notificaciones, reporte los
                        eventos mediante Internet, correo electrónico, GPRS, GSM, mensaje de texto SMS,
                        mensajes vocales por línea telefónica terrestre o GSM.
                    </p>
                    <p class="text-justify">Alarmas contra robos, alarmas contra incendios, cercas eléctricas, sistemas
                        anti robo, rastreo satelital, rastreador vehicular.
                    </p>
                </div>
            </div>
        </div>
        <div class="body flex flex-col">
            <div class="parrafo">
                <div class="flex flex-col items-center content-center img mb-2">
                    <img class="mb-2" src="{{ asset('images/pagina/centrales_minitoreo.jpg') }}" alt="">
                </div>
                <div class="my-0 md:my-10 mr-6">
                    <h2 class="mb-2 text-xl text-blue-500 font-semibold text-center">CCTV CENTRALES DE MONITOREO</h2>
                    <p class="text-justify">Soluciones de vídeo seguridad en resoluciones de alta definición, la resolución de 
                        estas cámaras en rendimiento y calidad de imagen es similar a la de un sistema con 
                        cámaras 100% IP.
                    </p>
                    <p class="text-justify">La distancia de transmisión al ser una señal libre de interferencias, nos permite 
                        transmitir vídeo de distancias de hasta 1200 metros, señal inmune al ruido por 
                        interferencias de señales electromagnéticas, vídeo y audio e incluso señales de 
                        control a la vez por un solo cable coaxial.
                    </p>
                </div>
            </div>
        </div>
        <div class="body flex flex-col">
            <div class="parrafo">
                <div class="flex flex-col items-center content-center img mb-2">
                    <img class="mb-2" src="{{ asset('images/pagina/control_acceso.jpg') }}" alt="">
                </div>
                <div class="my-0 md:my-10 mr-6">
                    <h2 class="mb-2 text-xl text-blue-500 font-semibold text-center">CONTROL DE ACCESO</h2>
                    <p class="text-justify">Contamos con sistemas electrónicos que permiten efectuar el control con una alta 
                        precisión y con niveles de seguridad según requerimiento.
                    </p>
                    <p class="text-justify">Controles de acceso y asistencia, reconocimiento facial, vídeo porteros e 
                        intercomunicadores, automatizadores para portones, sistemas de audio y 
                        perifoneo, sistemas para hotel, cerraduras hoteleras, barreras de alto tráfico.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
