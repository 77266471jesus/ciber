<x-app-layout>
    <div class="w-full text-left">
        <h1 class="text-md md:text-xl lg:text-2xl font-bold p-4 text-green-600">LISTA DE ROLES</h1>
    </div>
    <div class="mt-4">
        @can('admin.roles.create')
            <div class="py-4 px-6">
                <a href="{{ route('admin.roles.create') }}"
                    class="text-gray-300 text-sm font-semibold focus:outline-none bg-blue-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-blue-700 transition-all">
                    <i class='bx bx-plus-circle'></i>
                    <span>Agregar Nuevo Rol</span>
                </a>
            </div>
        @endcan
        @if (session('info'))
            <div wire:poll.4s class="mb-4 bg-red-100 border border-red-400 text-red-900 px-6 py-3 rounded relative"
                role="alert">
                <strong class="font-bold">{{ session('info') }}</strong><br>
            </div>
        @endif
        @livewire('admin.roles.roles')
    </div>

</x-app-layout>
