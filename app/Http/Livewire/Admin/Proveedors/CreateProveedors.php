<?php

namespace App\Http\Livewire\Admin\Proveedors;

use App\Models\Historial;
use App\Models\Proveedor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateProveedors extends Component
{
    public $nombre, $tipo_documento, $documento, $direccion, $telefono, $email;
    public $open_create = false;
    //registro
    public $user_id, $registro_id, $fecha;

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
        $this->fecha = Carbon::now();
        $this->user_id = Auth::user()->id;
    }
   
    public function create()
    {
        $this->open_create = true;
    }
    public function store()
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
            $rules['email'] = 'required|email|max:255';
        }
        $this->validate($rules);
        Proveedor::create([
            'nombre' => $this->nombre,
            'tipo_documento' => $this->tipo_documento,
            'documento' => $this->documento,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'email' => $this->email,
        ]);
        $this->registro_id = Proveedor::latest('id')->select('id')->first()->id;
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'crear',
            'detalle' => 'crear nueva proveedor' . ' ' . $this->nombre,
            'detalle_id' => $this->registro_id,
            'user_id' => $this->user_id,
        ]);
        $this->reset('open_create');
        $this->resetInput();
        $this->emitTo('admin.proveedors.proveedors', 'render');
        $this->emit('alert', 'Añadio un nuevo Proveedor');
    }

    public function render()
    {
        return view('livewire.admin.proveedors.create-proveedors');
    }

    public function cancel()
    {
        $this->resetInput();
        $this->resetValidation();
        $this->open_create = false;
    }
    private function resetInput()
    {
        $this->nombre = null;
        $this->tipo_documento = null;
        $this->documento = null;
        $this->direccion = null;
        $this->telefono = null;
        $this->email = null;
    }
}
