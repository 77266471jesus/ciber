<?php

namespace App\Http\Livewire\Admin\Cotizacion;

use App\Models\Cotizacion;
use Livewire\Component;
use Livewire\WithPagination;

class Cotizacions extends Component
{
    use WithPagination;

    protected $listeners = ['render'];

    public $search;
    public $show_cotizacion;
    public $sort = 'id';
    public $direction = 'desc';
    public $open_show = false;
    //registro
    public $registro_id;

    public function mount()
    {
        $this->show_cotizacion = new Cotizacion();
    }
    public function show(Cotizacion $cotizacion)
    {
        $this->show_cotizacion = $cotizacion;
        $this->open_show = true;
    }

    public function render()
    {
        $cotizacions = Cotizacion::selectRaw('cotizacions.id as id, cotizacions.comprobante as comprobante, cotizacions.fecha as fecha, 
        cotizacions.impuesto as impuesto, cotizacions.total_cotizacion as total_cotizacion,  cotizacions.total as total, users.name as usuario, clientes.nombre as cliente')
            ->join('users', 'cotizacions.user_id', '=', 'users.id')
            ->join('clientes', 'cotizacions.cliente_id', '=', 'clientes.id')
            ->where('comprobante', 'like', '%' . $this->search . '%')
            ->orwhere('fecha', 'like', '%' . $this->search . '%')
            ->orwhere('users.name', 'like', '%' . $this->search . '%')
            ->orwhere('clientes.nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.admin.cotizacion.cotizacions', compact('cotizacions'));
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
