<?php

namespace App\Http\Livewire\Pagina;

use App\Models\Cotizacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class HistorialCotizacion extends Component
{
    use WithPagination;

    protected $listeners = ['render'];

    public $search;
    public $sort = 'fecha';
    public $direction = 'desc';
    public $user_id, $fecha;

    public function mount()
    {
        $this->fecha = Carbon::now();
        $this->user_id = Auth::user()->id;
    }

    public function render()
    {
        $cotizacions = Cotizacion::where('fecha', 'like', '%' . $this->search . '%')
            ->where('user_id', $this->user_id)
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.pagina.historial-cotizacion', compact('cotizacions'));
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
