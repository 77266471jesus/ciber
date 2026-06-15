@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="bg-green-600">
        <div class="text-md h-6 flex flex-col justify-center items-center">
            {{ $title }}
        </div>

        <div class="mt-4 pb-4 bg-white px-6 ">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-modal>
