<a {{ $attributes->merge(['type' => 'button', 'class' => 'flex items-center text-gray-300 text-sm font-semibold focus:outline-none bg-blue-600 rounded px-4 py-2 space-x-1 hover:text-white hover:bg-blue-700 transition-all']) }}>
    <i class='bx bx-plus-circle'></i>
    {{ $slot }}    
</a>