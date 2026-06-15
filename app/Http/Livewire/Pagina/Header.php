<?php

namespace App\Http\Livewire\Pagina;

use App\Models\Producto;
use Livewire\Component;

class Header extends Component
{
    public $search;

    public function render()
    {
        $productos = Producto::select('nombre', 'marca', 'image', 'slug')
        ->where('nombre', 'like', '%' . $this->search . '%')
        ->orwhere('marca', 'like', '%' . $this->search . '%')
        ->get();

        return view('livewire.pagina.header', compact('productos'));
    }

    public function cerrar()
    {
        $this->search = null; 
    }
}
