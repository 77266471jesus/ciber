@props(['id' => null, 'maxWidth' => null])

<x-modal-midle :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="w-96 rounded-md">
        <div class="bg-red-500">
            <div class="text-md h-6 flex flex-col justify-center items-center">
                {{ $title }}
            </div>
    
            <div class="mt-4 bg-white px-2 md:px-6 ">
                {{ $content }}
            </div>
        </div>    
        <div class="flex flex-row justify-center px-6 py-4 text-right space-x-2">
            {{ $footer }}
        </div>
    </div>
</x-modal-midle>
