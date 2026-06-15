<div>
    <div class="mt-4">
        <div class="flex flex-row px-6">
            <input type="search" class="w-full border-2 border-gray-300 rounded-lg" wire:model="search"
                placeholder="Escriba lo que busca">
        </div>
        @can('admin.roles.delete')
            @include('livewire.admin.roles.delete-roles')
        @endcan
        <x-table>
            @if ($roles->count())
                <table class="min-w-full divide-y divide-gray-200 mb-12">
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
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($roles as $role)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($role->id != 1)
                                        <div class="text-sm text-gray-900 flex items-center">
                                            @can('admin.roles.update')
                                                <a href="{{ route('admin.roles.edit', $role) }}"
                                                    class="mx-1 text-gray-200 text-lg font-semibold focus:outline-none bg-green-600 rounded px-2.5 py-1 space-x-1 hover:text-white hover:bg-green-700 transition-all">
                                                    <i class='bx bx-edit'></i>
                                                    <span>editar</span>
                                                </a>
                                            @endcan
                                            {{-- @can('admin.roles.delete')
                                                <x-button-delete wire:click="delete({{ $role }})"
                                                    wire:loading.attr="disabled">
                                                </x-button-delete>
                                            @endcan --}}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $role->id }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $role->name }}
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
            @if ($roles->hasPages())
                <div class="px-6 py-3">
                    {{ $roles->links() }}
                </div>
            @endif
        </x-table>
    </div>
</div>
