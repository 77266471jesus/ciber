<?php

namespace App\Http\Livewire\Admin\Proveedors;

use App\Models\Historial;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Proveedor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Proveedors extends Component
{
    use WithPagination;

    protected $listeners = ['render'];

    public $search;
    public $nombre, $tipo_documento, $documento, $direccion, $telefono, $email;
    public $proveedor;
    public $sort = 'id';
    public $direction = 'desc';
    public $open_show = false;
    public $open_edit = false;
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
        $this->proveedor = new Proveedor();
        $this->fecha = Carbon::now();
        $this->user_id = Auth::user()->id;
    }
    public function show(Proveedor $proveedor)
    {
        $this->proveedor = $proveedor;
        $this->open_show = true;
    }
    public function edit(Proveedor $proveedor)
    {        
        $this->resetValidation();
        $this->proveedor = $proveedor;
        $this->nombre = $proveedor->nombre;
        $this->tipo_documento = $proveedor->tipo_documento;
        $this->documento = $proveedor->documento;
        $this->telefono = $proveedor->telefono;
        $this->email = $proveedor->email;
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
            $rules['email'] = 'required|email|max:255';
        }
        $this->validate($rules);
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'editar',
            'detalle' => 'edito proveedor' . ' ' . $this->proveedor->nombre,
            'detalle_id' => $this->proveedor->id,
            'user_id' => $this->user_id,
        ]);
        $this->proveedor->nombre = $this->nombre;
        $this->proveedor->tipo_documento = $this->tipo_documento;
        $this->proveedor->documento = $this->documento;
        $this->proveedor->direccion = $this->direccion;
        $this->proveedor->telefono = $this->telefono;
        $this->proveedor->email = $this->email;
        $this->proveedor->save();
        $this->reset('open_edit');
        $this->emit('alert', 'Modificado con Exito');
    }

    public function render()
    {
        $proveedors = Proveedor::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('tipo_documento', 'like', '%' . $this->search . '%')
            ->orwhere('documento', 'like', '%' . $this->search . '%')
            ->orwhere('direccion', 'like', '%' . $this->search . '%')
            ->orwhere('telefono', 'like', '%' . $this->search . '%')
            ->orwhere('email', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);            
            
        return view('livewire.admin.proveedors.proveedors', compact('proveedors'));
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
