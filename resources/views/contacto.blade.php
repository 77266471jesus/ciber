@extends('layouts.pagina')
@section('titulo')

@section('content')
    <div class="h-20 w-full color_menu_scroll">
    </div>
    <section class="form-cont">
        <h2 class="text-gray-400 text-center">¿Dudas o Consultas?</h2>
        <h2 class="mb-12 mt-4 text-2xl font-bold">CONTACTANOS</h2>
        <div class="grid grid-cols-1 md:grid-cols-5">
            <div class="col-span-2">
                <div class="flex">
                    <span class="form-icon"><i class="far fa-clock"></i></span>
                    <div>
                        <h1>ATENCIÓN POR GUARDIA PERMANENTE</h1>
                        <p>09:00 – 17:30</p>
                    </div>
                </div>
                <div class="flex">
                    <span class="form-icon"><i class="far fa-calendar-alt"></i></span>
                    <div>
                        <h1>ATENCIÓN POR TURNO PROGRAMADO</h1>
                        <p>09:00 – 14:00</p>
                    </div>
                </div>
                <div class="flex">
                    <span class="form-icon"><i class="fas fa-map-marker-alt"></i></span>
                    <div>
                        <h1>DIRECCIÓN</h1>
                        <p> Avenida 6 de marzo N° 222, Edificio Luisa, Piso 2, Of. 200, Zona Villa Bolívar B</p>
                        {{-- <p><i class="fas fa-bus-alt"></i> {{$item->direccion}}</p> --}}
                    </div>
                </div>
            </div>
            <!-- formulario-->
            <div class="col-span-3">
                @if ($errors->any())

                    <div class="bg-red-200 border-yellow-600 text-yellow-600 border-l-4 p-2" role="alert">
                        <p class="font-bold">
                            Error de validación
                        </p>
                        <p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </p>
                    </div>

                @endif
                <form action="{{ route('contactanos.store') }}" method="POST">
                    @csrf
                    <input id="" type="text" name="nombre" placeholder="Nombre"
                        class="px-4 py-2 my-2 w-full rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        value="{{ old('nombre') }}">

                    <input id="" type="text" name="apellido" placeholder="Apellido"
                        class="px-4 py-2 my-2 w-full rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        value="{{ old('apellido') }}">

                    <div class="flex">
                        <input id="" type="number" name="telefono" placeholder="Telefono"
                            class="px-4 py-2 my-2 mx-1 w-1/2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            value="{{ old('telefono') }}">

                        <input id="" type="email" name="email" placeholder="Email"
                            class="px-4 py-2 my-2 mx-1 w-1/2 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            value="{{ old('email') }}">

                    </div>
                    <textarea cols="30" rows="10" name="mensaje"
                        class="px-4 py-2 my-2 w-full h-40 rounded-md border border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                            </textarea>

                    <button
                        class="p-2 pl-5 pr-5 bg-transparent border-2 text-left border-blue-700 text-blue-500 text-lg rounded-lg transition-colors duration-700 transform hover:bg-blue-600 hover:text-gray-100 focus:border-4 focus:border-indigo-300">
                        Enviar
                    </button>
                </form>

                @if (session('info'))
                    <script>
                        alert("{{ session('info') }}");
                    </script>
                @endif
            </div>
            <!-- fin formulario-->
        </div>
    </section>
    <section>
        <div class="w-full my-20" style="height = 90vh">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d338.10274084152957!2d-68.16543838237378!3d-16.516207194358078!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915edf9fe823b89f%3A0x31df3426375f9290!2sGaleria%20Luna!5e0!3m2!1ses!2sbo!4v1650309503044!5m2!1ses!2sbo"
                width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

@endsection
