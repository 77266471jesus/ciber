<div>
    <h1 class="text-2xl font-bold pt-4 pb-8 pl-4 text-green-500">CLIENTES - USUARIOS</h1>
    @can('admin.usuarios')
        @include('livewire.admin.usuarios.show-users')
    @endcan

    @can('admin.usuarios.update')
        @include('livewire.admin.usuarios.update-users')
    @endcan
    @can('admin.usuarios.password')
        @include('livewire.admin.usuarios.password-users')
    @endcan
    @can('admin.usuarios.delete')
        @include('livewire.admin.usuarios.delete-users')
    @endcan
    <div class="flex flex-row px-6">
        <input type="search" class="w-full border-2 border-gray-300 rounded-lg" wire:model="search"
            placeholder="Escriba lo que busca">
    </div>
    <x-table>
        @if ($users->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only"></span>
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('id')">
                            <span>#</span>
                            @if ($sort == 'id')
                                @if ($direction == 'asc')
                                    <i class='pl-2 bx bx-sort-z-a'></i>
                                @else
                                    <i class='pl-2 bx bx-sort-a-z'></i>
                                @endif
                            @else
                                <i class='pl-2 bx bxs-sort-alt'></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('name')">
                            <span>NOMBRE</span>
                            @if ($sort == 'name')
                                @if ($direction == 'asc')
                                    <i class='pl-2 bx bx-sort-z-a'></i>
                                @else
                                    <i class='pl-2 bx bx-sort-a-z'></i>
                                @endif
                            @else
                                <i class='pl-2 bx bxs-sort-alt'></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('user_name')">
                            <span>USUARIO</span>
                            @if ($sort == 'user_name')
                                @if ($direction == 'asc')
                                    <i class='pl-2 bx bx-sort-z-a'></i>
                                @else
                                    <i class='pl-2 bx bx-sort-a-z'></i>
                                @endif
                            @else
                                <i class='pl-2 bx bxs-sort-alt'></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('tipo_documento')">
                            <span>C.I.</span>
                            @if ($sort == 'tipo_documento')
                                @if ($direction == 'asc')
                                    <i class='pl-2 bx bx-sort-z-a'></i>
                                @else
                                    <i class='pl-2 bx bx-sort-a-z'></i>
                                @endif
                            @else
                                <i class='pl-2 bx bxs-sort-alt'></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            wire:click="order('cargo')">
                            <span>CARGO</span>
                            @if ($sort == 'cargo')
                                @if ($direction == 'asc')
                                    <i class='pl-2 bx bx-sort-z-a'></i>
                                @else
                                    <i class='pl-2 bx bx-sort-a-z'></i>
                                @endif
                            @else
                                <i class='pl-2 bx bxs-sort-alt'></i>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @can('admin.usuarios')
                                        <x-button-show wire:click="show({{ $user }})">
                                        </x-button-show>
                                    @endcan
                                    @can('admin.usuarios.update')
                                        <x-button-edit wire:click="edit({{ $user }})">
                                        </x-button-edit>
                                    @endcan
                                    @can('admin.usuarios.password')
                                        <x-button-password wire:click="password({{ $user }})"
                                            wire:loading.attr="disabled">
                                        </x-button-password>
                                    @endcan
                                    {{-- @can('admin.usuarios.delete')
                                        <x-button-delete wire:click="delete({{ $user }})"
                                            wire:loading.attr="disabled">
                                        </x-button-delete>
                                    @endcan --}}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $user->id }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        @if ($user->image)
                                            <img class="h-12 w-12 rounded-full" src="{{ Storage::url($user->image) }}"
                                                alt="">
                                        @else
                                            <img class="h-12 w-12 rounded-full"
                                                src="{{ asset('images/admin/user.png') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            {{ $user->email }}
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <i class='bx bxs-phone'></i>
                                            <span>{{ $user->telefono }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $user->user_name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm ">
                                    {{ $user->tipo_documento }}
                                </div>
                                <div class="text-sm ">
                                    {{ $user->ci }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $user->cargo }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-4">
                No existe registros
            </div>
        @endif
        @if ($users->hasPages())
            <div class="px-6 py-3">
                {{ $users->links() }}
            </div>
        @endif
    </x-table>

</div>
