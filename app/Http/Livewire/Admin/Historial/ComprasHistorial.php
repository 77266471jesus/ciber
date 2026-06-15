<?php

namespace App\Http\Livewire\Admin\Historial;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class ComprasHistorial extends Component
{
    use WithPagination;
    public $sort = 'id';
    public $direction = 'desc';
    public $open_show = false;
    public $producto;
    public $search;

    public function mount()
    {
        $this->producto = new Producto();
    }
    public function show(Producto $producto)
    {
        $this->producto = $producto;
        $this->open_show = true;
    }

    public function render()
    {
        $productos = Producto::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('marca', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.admin.historial.compras-historial', compact('productos'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {

            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
