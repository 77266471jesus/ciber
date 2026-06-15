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
use Spatie\Permission\Models\Role;

class CreateUsers extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $user_name, $email, $password, $tipo_documento, $ci, $cargo, $telefono, $direccion, $image;
    public $open_create = false;
    public $identificador;
    //registro
    public $user_id, $registro_id, $fecha;

    public function mount()
    {
        $this->fecha = Carbon::now();
        $this->identificador = rand();
        $this->user_id = Auth::user()->id;
    }
    public function create()
    {
        $this->open_create = true;
    }
    public function store()
    {
        $this->password = $this->ci;
        if ($this->image) {
            $this->validate([
                'name' =>  ['required', 'string', 'max:255'],
                'user_name' =>  ['required', 'string', 'max:255', 'unique:users'],
                'tipo_documento' => ['required', 'string', 'max:255'],
                'ci' => ['required', 'numeric', 'unique:users', 'min:100000', 'max:999999999'],
                'email' => ['required', 'email', 'max:255', 'unique:users', 'unique:clientes,email'],
                'cargo' => ['required', 'string', 'max:255'],
                'telefono' => ['required', 'numeric', 'min:1000000', 'max:999999999'],
                'direccion' => ['required', 'string', 'max:255'],
                'image' => ['required', 'image'],
            ]);
            User::create([
                'name' => $this->name,
                'user_name' => $this->user_name,
                'password' => Hash::make($this->password),
                'tipo_documento' => $this->tipo_documento,
                'ci' => $this->ci,
                'email' => $this->email,
                'cargo' => $this->cargo,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
                'image' => $this->image->store('usuarios', 'public')
            ])->assignRole($this->cargo);
            $this->registro_id = User::latest('id')->select('id')->first()->id;
            Historial::create([
                'fecha' => $this->fecha,
                'accion' => 'crear',
                'detalle' => 'crear nuevo usuario' . ' ' . $this->name,
                'detalle_id' => $this->registro_id,
                'user_id' => $this->user_id,
            ]);
        } else {
            $this->validate([
                'name' =>  ['required', 'string', 'max:255'],
                'user_name' =>  ['required', 'string', 'max:255', 'unique:users'],
                'tipo_documento' => ['required', 'string', 'max:255'],
                'ci' => ['required', 'numeric', 'unique:users', 'min:100000', 'max:999999999'],
                'email' => ['required', 'email', 'max:255', 'unique:users', 'unique:clientes,email'],
                'cargo' => ['required', 'string', 'max:255'],
                'telefono' => ['required', 'numeric', 'min:1000000', 'max:999999999'],
                'direccion' => ['required', 'string', 'max:255'],
            ]);
            User::create([
                'name' => $this->name,
                'user_name' => $this->user_name,
                'password' => Hash::make($this->password),
                'tipo_documento' => $this->tipo_documento,
                'ci' => $this->ci,
                'email' => $this->email,
                'cargo' => $this->cargo,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
            ])->assignRole($this->cargo);
            $this->registro_id = User::latest('id')->select('id')->first()->id;
            Historial::create([
                'fecha' => $this->fecha,
                'accion' => 'crear',
                'detalle' => 'crear nuevo usuario'. ' ' . $this->name,
                'detalle_id' => $this->registro_id,
                'user_id' => $this->user_id,
            ]);
        }
        $this->emitTo('admin.usuarios.users', 'render');
        $this->reset('open_create');
        $this->resetInput();
        $this->identificador = rand();
        $this->emit('alert', 'Añadio un nuevo Usuario');
    }

    public function render()
    {
        $roles = Role::whereNotIn('name', ['Usuario'])->get();
        return view('livewire.admin.usuarios.create-users', compact('roles'));
    }
    public function cancel()
    {
        $this->resetInput();
        $this->resetValidation();
        $this->open_create = false;
    }
    private function resetInput()
    {
        $this->name = null;
        $this->user_name = null;
        $this->email = null;
        $this->password = null;
        $this->tipo_documento = null;
        $this->ci = null;
        $this->cargo = null;
        $this->telefono = null;
        $this->direccion = null;
        $this->image = null;
    }
}
