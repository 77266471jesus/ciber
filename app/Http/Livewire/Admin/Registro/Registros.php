<?php

namespace App\Http\Livewire\Admin\Registro;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Livewire\WithPagination;

class Registros extends Component
{
    use WithPagination;
    
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
        ->orwhere('user_name', 'like', '%' . $this->search . '%')
        ->orwhere('id', 'like', '%' . $this->search . '%')
        ->orwhere('email', 'like', '%' . $this->search . '%')
        ->orwhere('tipo_documento', 'like', '%' . $this->search . '%')
        ->orwhere('ci', 'like', '%' . $this->search . '%')
        ->orwhere('cargo', 'like', '%' . $this->search . '%')
        ->orwhere('telefono', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);

        return view('livewire.admin.registro.registros', compact('users'));
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
