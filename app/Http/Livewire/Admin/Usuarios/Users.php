<?php

namespace App\Http\Livewire\Admin\Usuarios;

use App\Models\Historial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $listeners = ['render'];

    public $user_name, $email, $ci, $image, $cargo;
    public $password;
    public $search;
    public $user, $identificador;
    public $sort = 'id';
    public $direction = 'desc';
    public $open_show = false;
    public $open_edit = false;
    public $open_password = false;
    public $open_delete = false;
    public $show_user;
    public $delete;
    //registro
    public $user_id, $registro_id, $fecha;

    // validacion 
    protected $rules = [
        'user.name' =>  ['required', 'string', 'max:255'],
        'user_name' =>  ['required', 'string', 'max:255'],
        'user.tipo_documento' => ['required', 'string', 'max:255'],
        'ci' => ['required', 'numeric', 'unique:users,ci', 'min:1000000', 'max:999999999'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'cargo' => ['required', 'string', 'max:255'],
        'user.telefono' => ['required', 'numeric', 'min:1000000', 'max:999999999'],
        'user.direccion' => ['required', 'string', 'max:255'],
        'image' => [''],
    ];
    public function mount()
    {
        $this->show_user = new User();
        $this->user = new User();
        $this->delete = new User();
        $this->fecha = Carbon::now();
        $this->identificador = rand();
        $this->user_id = Auth::user()->id;
    }
    public function show(User $user)
    {
        $this->show_user = $user;
        $this->open_show = true;
    }

    public function edit(User $user)
    {
        $this->resetValidation();
        $this->resetInput();
        $this->user = $user;
        $this->ci = $this->user->ci;
        $this->email = $this->user->email;
        $this->user_name = $this->user->user_name;
        $this->cargo = $this->user->cargo;
        $this->identificador = rand();
        $this->open_edit = true;
    }
    public function update()
    {
        if ($this->image) {
            $rules['image'] = 'image';
            if ($this->user->image) {
                Storage::disk('public')->delete($this->user->image);
            }
            $this->user->image = $this->image->store('usuarios', 'public');
        }
        $rules = $this->rules;
        $rules['email'] = 'required|email|unique:clientes,email,|unique:users,email,' . $this->user->id;
        $rules['ci'] = 'required|unique:users,ci,' . $this->user->id;
        $rules['user_name'] = 'required|unique:users,user_name,' . $this->user->id;
        $this->validate($rules);
        $this->user->removeRole($this->user->cargo);
        $this->user->email = $this->email;
        $this->user->ci = $this->ci;
        $this->user->cargo = $this->cargo;
        $this->user->user_name = $this->user_name;
        $this->user->assignRole($this->cargo);
        $this->user->save();
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'editar',
            'detalle' => 'edito usuario' . ' ' . $this->user_name,
            'detalle_id' => $this->user->id,
            'user_id' => $this->user_id,
        ]);
        $this->identificador = rand();
        $this->reset('open_edit');
        $this->resetInput();
        $this->emit('alert', 'Modificado con Exito');
    }
    public function password(User $user)
    {
        $this->user = $user;
        $this->ci = $this->user->ci;
        $this->open_password = true;
    }
    public function cambiar()
    {
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'contraseña',
            'detalle' => 'cambio contraseña usuario' . ' ' . $this->user->user_name,
            'detalle_id' => $this->user->id,
            'user_id' => $this->user_id,
        ]);
        $this->validate([
            'password' =>  ['required', 'string', 'max:8', 'max:255'],
        ]);
        $this->user->password = Hash::make($this->password);
        $this->user->save();
        $this->reset('open_password');
        $this->emit('alert', 'Contraseña Modificado con Exito');
    }
    public function restablecer()
    {
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'contraseña',
            'detalle' => 'restablecio contraseña usuario' . ' ' . $this->user->user_name,
            'detalle_id' => $this->user->id,
            'user_id' => $this->user_id,
        ]);
        $this->password = $this->ci;
        $this->user->password = Hash::make($this->password);
        $this->user->save();
        $this->reset('open_password');
        $this->emit('alert', 'Contraseña Restablecido con Exito');
    }
    public function delete(User $user)
    {
        $this->delete = $user;
        $this->open_delete = true;
    }
    public function destroy()
    {
        if ($this->user->image) {
            Storage::disk('public')->delete($this->delete->image);
        }
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'eliminar',
            'detalle' => 'elimino usuario' . ' ' . $this->delete->user_name,
            'detalle_id' => $this->delete->id,
            'user_id' => $this->user_id,
        ]);
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
        $users = User::whereNotIn('cargo', ['Usuario'])
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orwhere('user_name', 'like', '%' . $this->search . '%')
                    ->orwhere('id', 'like', '%' . $this->search . '%')
                    ->orwhere('email', 'like', '%' . $this->search . '%')
                    ->orwhere('tipo_documento', 'like', '%' . $this->search . '%')
                    ->orwhere('ci', 'like', '%' . $this->search . '%')
                    ->orwhere('cargo', 'like', '%' . $this->search . '%')
                    ->orwhere('telefono', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        $roles = Role::whereNotIn('name', ['Usuario'])->get();

        return view('livewire.admin.usuarios.index-users', compact('users', 'roles'));
    }

    private function resetInput()
    {
        $this->user_name = null;
        $this->email = null;
        $this->password = null;
        $this->ci = null;
        $this->image = null;
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
