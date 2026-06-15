<div>
    <x-modal-simple wire:model="open_show">
        <x-slot name="title">
            <div class="text-center text-gray-100 mt-3 font-bold">
                INFORMACION USUARIO
                <span>{{ $show_user->name }}</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="w-full px-4 flex items-start flex-col md:flex-row pt-4">
                <div class="w-full md:w-1/2 px-0 md:px-4">
                    <div class="w-full flex justify-center">
                        <div>
                            <div class="w-64 h-64">
                                @if ($show_user->image)
                                    <img class="mb-2 w-64 h-64" src="{{ Storage::url($show_user->image) }}" alt="">
                                @else
                                    <img src="{{ asset('images/admin/user.png') }}" alt="" class="w-64 mb-2 h-64">
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- nombre --}}
                    <x-jet-label value="Nombre Usuario" />
                    <input type="text" value="{{ $show_user->user_name }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    <x-jet-label value="Password" />
                    <input type="password" value="{{ $show_user->password }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                </div>
                <div class="w-full md:w-1/2">
                    {{-- nombre --}}
                    <x-jet-label value="Nombre Completo" />
                    <input type="text" value="{{ $show_user->name }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    {{-- documento --}}
                    <x-jet-label value="Datos de Documento de Identidad" />
                    <div class="flex flex-row items-start w-full">
                        <div class="w-2/5">
                            <input type="text" value="{{ $show_user->tipo_documento }}" disabled
                                class="w-full rounded-md border-2 border-gray-300">
                        </div>
                        <div class="w-3/5">
                            <input type="text" value="{{ $show_user->ci }}" disabled
                                class="w-full rounded-md border-2 border-gray-300">
                        </div>
                    </div>
                    {{-- email --}}
                    <x-jet-label value="Email" />
                    <input type="text" value="{{ $show_user->email }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    {{-- cargo --}}
                    <x-jet-label value="Cargo" />
                    <input type="text" value="{{ $show_user->cargo }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    {{-- telefono --}}
                    <x-jet-label value="Telefono" />
                    <input type="text" value="{{ $show_user->telefono }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                    {{-- direccion --}}
                    <x-jet-label value="Direccion" />
                    <input type="text" value="{{ $show_user->direccion }}" disabled
                        class="w-full rounded-md border-2 border-gray-300">
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_show', false)">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-modal-simple>
</div>
