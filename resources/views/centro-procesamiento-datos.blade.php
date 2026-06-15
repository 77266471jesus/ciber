@extends('layouts.pagina')
@section('titulo')

@section('content')
    <section class="mb-10">
        <div class="portada_servicios"
            style="background-image: linear-gradient(120deg, rgba(0, 0, 0, 0.699) 0%, rgba(3, 3, 3, 0.651) 100%), url('{{ asset('/images/pagina/centro_proceso_datos.jpeg') }}'); background-size: cover; background-position: center;">
            <div class="w-48 md:w-64 absolute bottom-20 left-12 md:right-24 lg:right-48 transition-all">
                <img src="{{ asset('images/logo/logo_blanco_icon.png') }}" alt="" width="100%">
            </div>
            <div class="w-full h-full flex flex-col items-center justify-center pl-10 md:pl-20">
                <div class="animate_fadeInDown">
                    <h2 class="texto_servicio_telecomunicaciones text-center">
                        CENTRO DE <br>
                        PROCESAMIENTO
                        <br>
                        DE DATOS
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
        <h1 class="mt-8 text-2xl text-blue-500 font-semibold">CENTRO DE PROCESAMIENTO DE DATOS</h1>
        <p class="my-2">Instalamos y proveemos infraestructura para Data Center de última tecnología 
            acorde a normas internacionales.</p>
        <div class="body flex flex-col">
            <div class="parrafo">
                <h2 class="mb-2 mt-2 text-xl text-black font-semibold text-center">INSTALACION DE DATA CENTER</h2>
                <div class="flex flex-col items-center content-center img mb-2">
                    <img class="mb-2" src="{{ asset('images/pagina/instalacion_cpd.jpg') }}" alt="">
                </div>
                <div class="my-0 md:my-10 mr-6">                   
                    <p class="text-justify">Espacio habilitado para almacenar los recursos de hardware necesarios para el 
                        almacenamiento de datos, el servidor pero también toda una serie de 
                        complementos como ser switches, routers, cables y pach cord que permiten 
                        garantizar la seguridad y buen funcionamiento de los mismos.
                    </p>
                </div>
            </div>
        </div>
        <div class="body flex flex-col">
            <div class="parrafo">
                <div class="flex flex-col items-center content-center img mb-2">
                    <img class="mb-2" src="{{ asset('images/pagina/infraestructura_cpd.jpg') }}" alt="">
                </div>
                <div class="my-0 md:my-10 mr-6">
                    <h2 class="mb-2 text-xl text-black font-semibold text-center">PROVISION DE INFRAESTRUCTURA DE DATA CENTER</h2>
                    <p class="text-justify">Nuestra experiencia es una garantía de que el centro de datos está totalmente 
                        optimizado para cumplir con los requerimientos de su organización. Trabajamos 
                        con usted para conseguir que el centro de datos sea un activo completamente 
                        equipado y operacionalmente eficiente: una arquitectura excelente junto con las 
                        mejores soluciones de gestión y modelos operacionales y de servicio adaptados a 
                        sus necesidades.
                    </p>                    
                </div>
            </div>
        </div>
    </section>
@endsection
