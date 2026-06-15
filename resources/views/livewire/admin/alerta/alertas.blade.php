<div x-data="{ alerta: false }">
    <button class="focus:outline-none p-4" x-on:click="alerta = !alerta">
        <i class='bx bxs-cog text-white text-2xl font-bold'></i>
    </button>
    <div x-show="alerta" x-transition.duration.500ms x-on:click.away="alerta = false"
        class="w-64 h-60 bg-white shadow absolute rounded-md">
        <div class="flex flex-col p-4 ">
            <div>
                <div class="flex space-x-2 px-2">
                    <div class="h-10 w-24 bg-green-500 rounded-md">
                        <div class="flex flex-col h-full w-full items-center justify-center">
                            <span class="text-white font-bold">Moderado</span>
                        </div>
                    </div>
                    <div>
                        <x-jet-input class="mb-2 w-24 bg-white" type="number" wire:model="moderado" />
                    </div>
                </div>
                <x-jet-input-error for="moderado" />
            </div>
            <div>
                <div class="flex space-x-2 px-2">
                    <div class="h-10 w-24 bg-yellow-500 rounded-md">
                        <div class="flex flex-col h-full w-full items-center justify-center">
                            <span class="text-white font-bold">Alto</span>
                        </div>
                    </div>
                    <div>
                        <x-jet-input class="mb-2 w-24 bg-white" type="number" wire:model="alto" />
                    </div>
                </div>
                <x-jet-input-error for="alto" />
            </div>
            <div>
                <div class="flex space-x-2 px-2">
                    <div class="h-10 w-24 bg-red-500 rounded-md">
                        <div class="flex flex-col h-full w-full items-center justify-center">
                            <span class="text-white font-bold">Critico</span>
                        </div>
                    </div>
                    <div>
                        <x-jet-input class="mb-2 w-24 bg-white" type="number" wire:model="critico" />

                    </div>
                </div>
                <x-jet-input-error for="critico" />
            </div>
        </div>
        <div class="border-t-2 border-gray-300 flex flex-cold items-center justify-end px-4 py-2 w-full ">
            <div class="flex justify-between space-x-2">
                @if (session()->has('message'))
                    <div wire:poll.2s class="p-2 rounded-md bg-green-500 text-white">
                        {{ session('message') }}
                    </div>
                @endif
                <button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                    class="focus:outline-none p-2 rounded-md bg-blue-500 hover:bg-blue-700 text-gray-200 hover:text-white transition-all">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>
