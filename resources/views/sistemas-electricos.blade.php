@extends('layouts.pagina')
@section('titulo')

@section('content')
    <section class="mb-10">
        <div class="portada_servicios"
            style="background-image: linear-gradient(120deg, rgba(0, 0, 0, 0.699) 0%, rgba(3, 3, 3, 0.651) 100%), url('{{ asset('/images/pagina/elec2.jpg') }}'); background-size: cover; background-position: center;">
            <div class="w-48 md:w-64 absolute bottom-20 left-12 md:right-24 lg:right-48 transition-all">
                <img src="{{ asset('images/logo/logo_blanco_icon.png') }}" alt="" width="100%">
            </div>
            <div class="w-full h-full flex flex-col items-center justify-center pl-10 md:pl-20">
                <div class="animate_fadeInDown">
                    <h2 class="texto_servicio_telecomunicaciones">                        
                        SISTEMAS ELECTRICOS
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
        <h1 class="mt-8 text-2xl text-blue-500 font-semibold">SISTEMAS ELECTRICOS</h1>
        <p class="my-2">Implementamos y certificamos instalaciones de Redes Eléctricas civiles e 
            industriales y mediante nuestros equipos UP´s y Generadores evitamos cortes de 
            energía eléctrica en su empresa.</p>
        <div class="body flex flex-col">
            <div class="parrafo">
                <div class="flex flex-col items-center content-center img mb-2">
                    <img class="mb-2" src="{{ asset('images/pagina/instalacacio_sist.jpg') }}" alt="">
                </div>
                <div class="my-0 md:my-10 mr-6">    
                    <h2 class="mb-2 text-xl text-blue-500 font-semibold text-center">INSTALACIONES ELÉCTRICAS, CIVILES E INDUSTRIALES</h2>               
                    <p class="text-justify">Cableado de puntos de red, eléctricos e instalaciones trifásicas para el uso masivo 
                        en industrias.
                    </p>
                    <h2 class="mb-2 text-xl text-blue-500 font-semibold text-center">FABRICACIÓN Y MONTAJE DE TABLEROS ELÉCTRICOS</h2>               
                    <p class="text-justify">Fabricación de tableros eléctricos de baja y alta tensión para la protección de cada 
                        uno de los circuitos en los que se divide la instalación a través de fusibles, 
                        protecciones magnetotérmicas y diferenciales.
                    </p>  
                </div>
            </div>
        </div>
        <div class="body flex flex-col">
            <div class="parrafo">
                <div class="flex flex-col items-center content-center img mb-2">
                    <img class="mb-2" src="{{ asset('images/pagina/mantenimiento_sist.jpg') }}" alt="">
                </div>
                <div class="my-0 md:my-10 mr-6">    
                    <h2 class="mb-2 text-xl text-blue-500 font-semibold text-center">INSTALACIÓN Y MONTAJE DE UP´s DE DISTINTAS CAPACIDADES</h2>               
                    <p class="text-justify">Soluciones inteligentes para proporcionar y respaldar energía en servidores de 
                        cómputo y en todo tipo de instalaciones donde el servicio es crítico.
                    </p>
                    <h2 class="mb-2 text-xl text-blue-500 font-semibold text-center">MANTENIMIENTO PREVENTIVOS Y CORRECTIVOS DE GRUPOS ELECTRÓGENOS</h2>               
                    <p class="text-justify">Comúnmente usados para el déficit de la generación de energía eléctrica cuando 
                        son frecuentes los cortes de suministro eléctrico.
                    </p>  
                </div>
            </div>
        </div>
    </section>
@endsection
