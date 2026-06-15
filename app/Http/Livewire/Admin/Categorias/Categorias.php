<?php

namespace App\Http\Livewire\Admin\Categorias;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Categoria;
use App\Models\Historial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Categorias extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $listeners = ['render'];

    public $image, $nombre, $slug;
    public $search;
    public $categoria, $identificador;
    public $sort = 'id';
    public $direction = 'desc';
    public $open_show = false;
    public $open_edit = false;
    public $open_condicion = false;
    public $open_delete = false;
    public $show_categoria;
    public $condicion;
    public $delete;
    //registro
    public $user_id, $registro_id, $fecha;

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }
    protected $rules = [
        'nombre' =>  ['required', 'string', 'max:255', 'unique:categorias,nombre'],
        'slug' => ['required', 'string', 'max:255'],
        'categoria.descripcion' =>  ['required', 'string', 'max:500'],
        'image' => [''],
    ];
    public function mount()
    {
        $this->show_categoria = new Categoria();
        $this->categoria = new Categoria();
        $this->delete = new Categoria();
        $this->identificador = rand();
        $this->fecha = Carbon::now();        
        $this->user_id = Auth::user()->id;
    }
    public function show(Categoria $categoria)
    {
        $this->show_categoria = $categoria;
        $this->open_show = true;
    }

    public function edit(Categoria $categoria)
    {
        $this->resetInput();
        $this->resetValidation();
        $this->categoria = $categoria;
        $this->nombre = $this->categoria->nombre;
        $this->slug = $this->categoria->slug;
        $this->identificador = rand();
        $this->open_edit = true;
    }
    public function update()
    {
        $rules = $this->rules;
        $rules['nombre'] = 'required|unique:categorias,nombre,' . $this->categoria->id;
        if ($this->image) {
            $rules['image'] = 'image';
            if ($this->categoria->image) {
                Storage::disk('public')->delete($this->categoria->image);
            }
            $this->categoria->image = $this->image->store('categorias', 'public');
        }
        $this->validate($rules);
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'editar',
            'detalle' => 'edito categoria' . ' ' . $this->categoria->nombre,
            'detalle_id' => $this->categoria->id,
            'user_id' => $this->user_id,
        ]);
        $this->categoria->nombre = $this->nombre;
        $this->categoria->slug = $this->slug;
        $this->categoria->save();
        $this->identificador = rand();
        $this->reset('open_edit');
        $this->resetInput();
        $this->emit('alert', 'Modificado con Exito');
    }
    public function condicion(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->open_condicion = true;
    }
    public function ActivarDesactivar()
    {
        if ($this->categoria->condicion == 'activado') {
            $this->condicion = 'desactivado';
            Historial::create([
                'fecha' => $this->fecha,
                'accion' => 'desactivar',
                'detalle' => 'desactivo categoria' . ' ' . $this->categoria->nombre,
                'detalle_id' => $this->categoria->id,
                'user_id' => $this->user_id,
            ]);
        } else {
            $this->condicion = 'activado';  
            Historial::create([
                'fecha' => $this->fecha,
                'accion' => 'activar',
                'detalle' => 'activo categoria' . ' ' . $this->categoria->nombre,
                'detalle_id' => $this->categoria->id,
                'user_id' => $this->user_id,
            ]);   
        }
        $this->categoria->condicion = $this->condicion;
        $this->categoria->save();
        $this->open_condicion = false;
        if ($this->condicion == 'activado') {
            $this->emit('alert', 'Activado con Exito');
        } else {
            $this->emit('alert', 'Desactivado con Exito');
        }        
        $this->condicion = null;
    }
    public function delete(Categoria $categoria)
    {
        $this->delete = $categoria;
        $this->open_delete = true;
    }
    public function destroy()
    {
        if ($this->delete->image) {
            Storage::disk('public')->delete($this->delete->image);
        }
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'eliminar',
            'detalle' => 'elimino categoria' . ' ' . $this->delete->nombre,
            'detalle_id' => $this->delete->id,
            'user_id' => $this->user_id,
        ]);  
        $this->delete->delete();
        $this->open_delete = false;
        $this->emit('alert', 'Eliminado con Exito');
    }

    public function render()
    {
        $categorias = Categoria::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('descripcion', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(5);

        return view('livewire.admin.categorias.categorias', compact('categorias'));
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
    private function resetInput()
    {
        $this->nombre = null;
        $this->slug = null;
        $this->condicion = null;
        $this->image = null;
    }
    public function cancel()
    {
        $this->open_delete = false;
        $this->open_condicion = false;
        $this->emit('cancelar', 'Cancelado');
    }
}
