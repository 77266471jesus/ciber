<div class="min-h-screen sm:justify-center flex flex-col items-center justify-center pt-6 sm:pt-0" style="background-image: linear-gradient(120deg, rgba(0, 0, 0, 0.699) 0%, rgba(3, 3, 3, 0.582) 100%), url('{{asset('/images/pagina/login_portada.png')}}'); background-size: cover; background-position: center;">
    <div class="flex items-center bg-white" style="height: 60vh">
        <div class="w-72 hidden md:block" style="background-image: linear-gradient(120deg, rgba(190, 190, 190, 0.178) 0%, rgba(255, 255, 255, 0.274) 100%), url('{{asset('/images/logo/fondo_verde.jpg')}}'); background-size: cover; background-position: center; height: 60vh;">
            <div class="w-full flex flex-col items-center justify-center" style="height: 60vh">
                {{ $logo }}
            </div>
        </div>
    
        <div class="w-96 sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</div>
