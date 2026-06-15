<?php

namespace App\Http\Livewire\Admin\Registro;

use App\Models\Historial;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class VerRegistros extends Component
{
    use WithPagination;
    
    public $user_id, $user;
    public $fecha, $date;
    public $search;
    public $sort = 'fecha';
    public $direction = 'desc';
    public $consulta = 'mes';

    public function mount($user_id)
    {
        $this->date = Carbon::now();
        $this->fecha = $this->date->format('Y-m');
        $this->user_id = $user_id;
        $this->user = User::find($this->user_id);
    }
    public function render()
    {
        $historials = Historial::where('fecha', 'LIKE', '%' . $this->fecha . '%')
        ->where('user_id', $this->user_id)
        ->where(function ($query) {
            $query->where('accion', 'LIKE', '%' . $this->search . '%')
                ->orWhere('detalle', 'LIKE', '%' . $this->search . '%')
                ->orWhere('detalle_id', 'LIKE', '%' . $this->search . '%');
        })
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);

        return view('livewire.admin.registro.ver-registros', compact('historials'));
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
