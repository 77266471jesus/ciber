<footer class="bg-black">
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 pl-12 py-4 text-white">
        <div>
            <div class="w-64">
                <img src="{{ asset('images/logo/LOGO-CIBERTEL-BLANCO.png') }}" alt="" width="100%">
            </div>
            <h1 class="font-semibold py-2">INFORMACIÓN DE CONTACTO</h1>
            <div class="flex flex-col">
                <a class="py-1 transition-all text-gray-200 hover:text-blue-600 flex" target="_blank">
                    <i class='bx bx-phone text-lg pr-2'></i>
                    <span class="text-sm"> 77735173 - 77731201 - 79660357</span>
                </a>
                <a class="py-1 transition-all text-gray-200 hover:text-blue-600 flex" target="_blank">
                    <i class='bx bxl-gmail text-lg pr-2'></i>
                    <span class="text-sm">cibertel.smart@gmail.com</span>
                </a>
                <a class="py-1 transition-all text-gray-200 hover:text-blue-600 flex" target="_blank">
                    <i class='bx bx-map text-lg pr-2'></i>
                    <span class="text-sm">Avenida 6 de marzo N° 222, Edificio Luisa, Piso 2, Of. 200, Zona
                        Villa Bolívar B</span>
                </a>
            </div>
        </div>
        <div>
            <h1 class="font-semibold py-2">MAPA DE UBICACIÓN</h1>
            <div class="py-2">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d338.10274084152957!2d-68.16543838237378!3d-16.516207194358078!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915edf9fe823b89f%3A0x31df3426375f9290!2sGaleria%20Luna!5e0!3m2!1ses!2sbo!4v1650309503044!5m2!1ses!2sbo"
                    width="240" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <span class="text-sm">La Paz - El Alto</span>
        </div>
        <div>
            <div class="flex flex-col items-start">
                <h1 class="font-semibold py-2">HORARIO DE ATENCION</h1>
                <span class="text-sm">Lunes a Viernes <br> 09:00 – 17:30 <br> Sábados <br>09:00 – 14:00</span>
                <h1 class="font-semibold py-2">SERVICIOS</h1>
            </div>
            <div class="flex flex-col">
                <a href="{{route('telecomunicaciones')}}" class="py-1 transition-all text-gray-400 hover:text-white flex">
                    <span class="text-sm">Telecomunicaciones</span>
                </a>
                <a href="{{route('sistemas.electricos')}}" class="py-1 transition-all text-gray-400 hover:text-white flex">
                    <span class="text-sm">Sistemas Eléctricos</span>
                </a>
                <a href="{{route('centro.procesamiento.datos')}}" class="py-1 transition-all text-gray-400 hover:text-white flex">
                    <span class="text-sm">Centro de procesamiento de datos</span>
                </a>
                <a href="{{route('alarmas')}}" class="py-1 transition-all text-gray-400 hover:text-white flex">
                    <span class="text-sm">Alarmas CCTV y Acceso</span>
                </a>
            </div>
        </div>
        <div>
            <h1 class="font-semibold py-2">CIBERTEL S.R.L.</h1>
            <div class="flex flex-col">
                <a href="{{route('index')}}" class="py-1 transition-all text-gray-400 hover:text-white flex">
                    <span class="text-sm">Inicio</span>
                </a>
                <a href="{{route('servicios')}}" class="py-1 transition-all text-gray-400 hover:text-white flex">
                    <span class="text-sm">Servicios</span>
                </a>
                <a href="{{route('pagina.productos')}}" class="py-1 transition-all text-gray-400 hover:text-white flex">
                    <span class="text-sm">Productos</span>
                </a>
                <a href="{{route('contacto')}}" class="py-1 transition-all text-gray-400 hover:text-white flex">
                    <span class="text-sm">Contactanos</span>
                </a>
            </div>
            <h1 class="font-semibold py-2">SIGUENOS</h1>
            <div class="flex items-center space-x-2 py-2">
                <a href="https://www.facebook.com/DESARROLLO.CIBERTEL" target=”_blank”
                    class="px-3 py-1.5 rounded-md text-gray-300 hover:text-gray-900 bg-gray-900 hover:bg-gray-300 transition-all"
                    target="_blank">
                    <i class='bx bxl-facebook'></i>
                </a>
                <a href="https://twitter.com/" target=”_blank”
                    class="px-3 py-1.5 rounded-md text-gray-300 hover:text-gray-900 bg-gray-900 hover:bg-gray-300 transition-all"
                    target="_blank">
                    <i class='bx bxl-twitter'></i>
                </a>
                <a href="https://www.youtube.com/channel/UC9S---bJFLUZOVvo6cpDm7g?view_as=subscriber" target=”_blank”
                    class="px-3 py-1.5 rounded-md text-gray-300 hover:text-gray-900 bg-gray-900 hover:bg-gray-300 transition-all"
                    target="_blank">
                    <i class='bx bxl-youtube'></i>
                </a>
                <a href="https://wa.me/message/JS5QUN47OUOKI1" target=”_blank”
                    class="px-3 py-1.5 rounded-md text-gray-300 hover:text-gray-900 bg-gray-900 hover:bg-gray-300 transition-all"
                    target="_blank">
                    <i class='bx bxl-whatsapp '></i>
                </a>
                <a href="https://www.instagram.com/" target=”_blank”
                    class="px-3 py-1.5 rounded-md text-gray-300 hover:text-gray-900 bg-gray-900 hover:bg-gray-300 transition-all"
                    target="_blank">
                    <i class='bx bxl-instagram '></i>
                </a>
            </div>
        </div>
    </div>
    <div class="w-full text-white text-center py-2 text-sm">
        <h3 class="no_seleccionable">
            <span>© 2022 Copyright: Desarrollado por CIBERTEL S.R.L.</span>
        </h3>
    </div>
</footer>
