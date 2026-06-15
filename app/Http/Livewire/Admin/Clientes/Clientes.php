<?php

namespace App\Http\Livewire\Admin\Clientes;

use App\Models\Cliente;
use App\Models\Historial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;

    protected $listeners = ['render'];

    public $search;
    public $nombre, $tipo_documento, $documento, $direccion, $telefono, $email;
    public $cliente;
    public $sort = 'id';
    public $direction = 'desc';
    public $open_show = false;
    public $open_edit = false;
    //registro
    public $user_id, $registro_id, $fecha;
    public $cargo = 'Usuario';
    public $users, $cliente_usuario;

    protected $rules = [
        'nombre' =>  ['required', 'string', 'max:255'],
        'tipo_documento' => [''],
        'documento' => [''],
        'direccion' => [''],
        'telefono' => [''],
        'email' => [''],
    ];
    public function mount()
    {
        $this->cliente = new Cliente();
        $this->fecha = Carbon::now();
        $this->user_id = Auth::user()->id;
    }
    public function show(Cliente $cliente)
    {
        $this->cliente = $cliente;
        $this->open_show = true;
    }

    public function edit(Cliente $cliente)
    {
        $this->resetValidation();
        $this->cliente = $cliente;
        $this->nombre = $cliente->nombre;
        $this->tipo_documento = $cliente->tipo_documento;
        $this->documento = $cliente->documento;
        $this->telefono = $cliente->telefono;
        $this->email = $cliente->email;
        $this->direccion = $cliente->direccion;
        $this->open_edit = true;
    }
    public function update()
    {
        $rules = $this->rules;
        if ($this->tipo_documento) {
            $rules['tipo_documento'] = 'required|string|max:255';
            $rules['documento'] = 'required|numeric|min:10000|max:999999999';
        }
        if ($this->documento) {
            $rules['tipo_documento'] = 'required|string|max:255';
            $rules['documento'] = 'required|numeric|min:10000|max:999999999';
        }
        if ($this->direccion) {
            $rules['direccion'] = 'required|string|max:255';
        }
        if ($this->telefono) {
            $rules['telefono'] = 'required|numeric|min:100000|max:999999999';
        }
        if ($this->email) {
            $rules['email'] = 'required|email|unique:users,email|unique:clientes,email,' . $this->cliente->id;
        }
        $this->validate($rules);
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'editar',
            'detalle' => 'edito cliente' . ' ' . $this->cliente->nombre,
            'detalle_id' => $this->cliente->id,
            'user_id' => $this->user_id,
        ]);
        $this->cliente->nombre = $this->nombre;
        $this->cliente->tipo_documento = $this->tipo_documento;
        $this->cliente->documento = $this->documento;
        $this->cliente->direccion = $this->direccion;
        $this->cliente->telefono = $this->telefono;
        $this->cliente->email = $this->email;
        $this->cliente->save();
        $this->reset('open_edit');
        $this->emit('alert', 'Modificado con Exito');
    }
    public function usuario(Cliente $cliente)
    {
        $this->cliente = $cliente;
        User::create([
            'name' => $this->cliente->nombre,
            'user_name' => $this->cliente->email,
            'password' => Hash::make($this->cliente->documento),
            'tipo_documento' => $this->cliente->tipo_documento,
            'ci' => $this->cliente->documento,
            'email' => $this->cliente->email,
            'cargo' => $this->cargo,
            'telefono' => $this->cliente->telefono,
            'direccion' => $this->cliente->direccion,
        ])->assignRole($this->cargo);
        $this->registro_id = User::latest('id')->select('id')->first()->id;
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'crear',
            'detalle' => 'crear nuevo usuario' . ' ' . $this->cliente->nombre,
            'detalle_id' => $this->registro_id,
            'user_id' => $this->user_id,
        ]);
        $this->emitTo('admin.usuarios.users', 'render');
        $this->emit('alert', 'Añadio un nuevo Cliente-Usuario');
    }

    public function render()
    {
        $this->users = User::whereIn('cargo', ['Usuario'])->pluck('email');        
        $this->cliente_usuario = Cliente::whereIn('email', $this->users)->pluck('id');        

        $clientes = Cliente::whereNotIn('id', $this->cliente_usuario)
            ->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                    ->orwhere('tipo_documento', 'like', '%' . $this->search . '%')
                    ->orwhere('documento', 'like', '%' . $this->search . '%')
                    ->orwhere('direccion', 'like', '%' . $this->search . '%')
                    ->orwhere('telefono', 'like', '%' . $this->search . '%')
                    ->orwhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.admin.clientes.clientes', compact('clientes'));
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
