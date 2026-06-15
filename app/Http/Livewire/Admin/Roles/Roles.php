<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class Roles extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'id';
    public $direction = 'asc';
    public $open_delete = false;
    public $delete;

    public function mount()
    {        
        $this->delete = new Role();
    }
    public function delete(Role $role){
        $this->delete = $role;
        $this->open_delete = true;
    }
    public function destroy(){
        $this->delete->delete();
        $this->open_delete = false;
        $this->emit('alert', 'Eliminado con Exito');
    }
    public function cancel()
    {        
        $this->open_delete = false;
        $this->emit('cancelar', 'Cancelado');        
    }

    public function render()
    {
        $roles = Role::where('name', 'like', '%' . $this->search . '%')
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);

        return view('livewire.admin.roles.roles', compact('roles'));
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
