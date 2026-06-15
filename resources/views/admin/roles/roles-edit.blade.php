<x-app-layout>
    <div class="w-full text-left">
        <h1 class="text-md md:text-xl lg:text-2xl font-bold p-4 text-green-600">EDITAR ROL</h1>
    </div>
    <div>
        <div>
            <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                @csrf
                @method('put')
                <div class="w-full px-6 bg-white py-4">
                    <label class="text-md font-semibold">Nombre</label><br>
                    <div class="flex w-full items-center">
                        <input class="h-10 rounded-md" type="text" name="name" class="w-full rounded-md"
                            value="{{ $role->name }}">
                        <input
                            class="bg-blue-500 font-semibold border border-gray-100 text-gray-200 hover:bg-blue-600 rounded-md pointer-events p-2"
                            type="submit" value="Crear Rol">
                    </div>
                    <input class="hidden" type="text" name="guard_name" class="w-full rounded-md" value="web">
                    @error('name')
                        <small class="text-red-600">
                            {{ $message }}
                        </small>
                    @enderror
                    <h2 class="text-lg font-bold text-green-800 py-4">Lista de Permisos</h2>
                    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($permissions as $permission)
                            @foreach ($role->permissions as $item)
                                @if ($permission->id == $item->id)
                                    <div>
                                        <label class="w-full text-md font-bold text-gray-800" style="color: {{$permission->color}}">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                checked="checked" class="my-2">
                                            {{ $permission->description }}
                                        </label>
                                        @php
                                            $checked = true;
                                        @endphp
                                    </div>
                                @endif
                            @endforeach
                            @if ($checked == false)
                                <div>
                                    <label class="w-full text-md font-bold text-gray-800" style="color: {{$permission->color}}">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="my-2">
                                        {{ $permission->description }}
                                    </label>
                                </div>
                            @endif
                            @php
                                $checked = null;
                            @endphp
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
