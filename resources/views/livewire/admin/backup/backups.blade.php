<div>
    @include('livewire.admin.backup.delete-backup')
    <h1 class="text-2xl font-bold pt-4 pb-8 pl-4 text-green-500">BACKUP DE BASE DE DATOS</h1>
    <div class="w-full">
        <x-button-add wire:click="createBackup" wire:loading.attr="disabled" wire:target="createBackup"
            class="disabled:opacity-25">
            <span>Crear Backup</span>
        </x-button-add>
    </div>
    <div class="container py-12">
        <x-table-responsive>
            <div wire:loading wire:target="createBackup"
                class="mb-4 bg-green-100 border border-green-400 text-green-900 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Cargando..... </strong>
                <span class="block sm:inline">Espere hasta que termine el proceso</span>
            </div>
            <div wire:loading wire:target="updateBackupStatuses"
                class="mb-4 bg-green-100 border border-green-400 text-green-900 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Cargando..... </strong>
                <span class="block sm:inline">Actualizando información</span>
            </div>
            <div class="flex px-6 py-4 bg-blue-200">
                <x-button-enlace class="bg-blue-600 ml-auto cursor-pointer" wire:click="updateBackupStatuses"
                    wire:loading.attr="disabled" wire:target="updateBackupStatuses" class="disabled:opacity-25">
                    <svg xmlns="http://www.w3.org/2000/svg" width="0.7875rem" height="0.7875rem" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path class="heroicon-ui"
                            d="M6 18.7V21a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2H7.1A7 7 0 0 0 19 12a1 1 0 1 1 2 0 9 9 0 0 1-15 6.7zM18 5.3V3a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1h-5a1 1 0 0 1 0-2h2.9A7 7 0 0 0 5 12a1 1 0 1 1-2 0 9 9 0 0 1 15-6.7z" />
                    </svg>
                    <span class="mx-2">Actualizar</span>
                </x-button-enlace>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-600">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Ubicación
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Fecha y Hora
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Tamaño
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-blue-500">

                    @foreach ($files as $file)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">

                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 uppercase">
                                            {{ $file['path'] }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 uppercase">
                                            {{ $file['date'] }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 uppercase">
                                            {{ $file['size'] }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap  text-sm font-medium ">
                                <div class="space-x-2 flex items-center">
                                    <button wire:click.prevent="downloadFile('{{ $file['path'] }}')"
                                        class="focus:outline-none bg-green-600 hover:bg-green-800 text-gray-200 hover:text-white rounded-md px-1.5 py-2 transition-all flex items-center">
                                        <i class='bx bx-download text-xl'></i>
                                        <span class="ml-1">Descargar</span>
                                    </button>
                                    <button wire:click.prevent="showDeleteModal({{ $loop->index }})"
                                        data-modal-toggle="popup-modal"
                                        class="focus:outline-none bg-red-500 hover:bg-red-700 text-gray-200 hover:text-white rounded-md px-1.5 py-2 transition-all flex items-center">
                                        <i class='bx bx-trash-alt'></i>
                                        <span class="ml-1">Eliminar</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @if (!count($files))
                            <tr>
                                <td class="text-center" colspan="4">
                                    {{ 'No backups present' }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </x-table-responsive>

    </div>


    @push('script')
        <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>

        <script>
            document.addEventListener('livewire:load', function() {
                @this.updateBackupStatuses()

                @this.on('backupStatusesUpdated', function() {
                    @this.getFiles()
                })

                @this.on('showErrorToast', function(message) {
                    Toastify({
                        text: message,
                        duration: 10000,
                        gravity: 'bottom',
                        position: 'right',
                        backgroundColor: 'red',
                        className: 'toastify-custom',
                    }).showToast()
                })

                const backupFun = function(option = '') {
                    Toastify({
                        text: 'Creando un nuevo backup ...' + (option ? ' (' + option + ')' :
                            ''),
                        duration: 5000,
                        gravity: 'bottom',
                        position: 'right',
                        backgroundColor: '#1fb16e',
                        className: 'toastify-custom',
                    }).showToast()

                    @this.createBackup(option)
                }

                $('#create-backup').on('click', function() {
                    backupFun()
                })
                $('#create-backup-only-db').on('click', function() {
                    backupFun('only-db')
                })
                $('#create-backup-only-files').on('click', function() {
                    backupFun('only-files')
                })

                const deleteModal = $('#deleteModal')
                @this.on('showDeleteModal', function() {
                    deleteModal.modal('show')
                })
                @this.on('hideDeleteModal', function() {
                    deleteModal.modal('hide')
                })

                deleteModal.on('hidden.bs.modal', function() {
                    @this.deletingFile = null
                })
            })
        </script>

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @endpush


</div>
