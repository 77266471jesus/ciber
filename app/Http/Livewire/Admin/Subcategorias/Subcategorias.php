<?php

namespace App\Http\Livewire\Admin\Subcategorias;

use App\Models\Categoria;
use App\Models\Historial;
use App\Models\Subcategoria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Subcategorias extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $listeners = ['render'];

    public $image, $nombre, $slug, $categoria_id;
    public $search;
    public $subcategoria, $identificador;
    public $sort = 'id';
    public $direction = 'desc';
    public $open_show = false;
    public $open_edit = false;
    public $open_condicion = false;
    public $open_delete = false;
    public $show_subcategoria;
    public $condicion;
    public $delete;
    //registro
    public $user_id, $registro_id, $fecha;

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }
    protected $rules = [
        'nombre' =>  ['required', 'string', 'max:255', 'unique:subcategorias,nombre'],
        'slug' => ['required', 'string', 'max:255'],
        'subcategoria.descripcion' =>  ['required', 'string', 'max:500'],
        'subcategoria.categoria_id' =>  ['required'],
        'image' => [''],
    ];
    public function mount()
    {
        $this->show_subcategoria = new Subcategoria();
        $this->subcategoria = new Subcategoria();
        $this->delete = new Subcategoria();
        $this->identificador = rand();
        $this->fecha = Carbon::now();
        $this->user_id = Auth::user()->id;
    }
    public function show(Subcategoria $subcategoria)
    {
        $this->show_subcategoria = $subcategoria;
        $this->open_show = true;
    }

    public function edit(Subcategoria $subcategoria)
    {
        $this->resetInput();
        $this->resetValidation();
        $this->subcategoria = $subcategoria;
        $this->nombre = $this->subcategoria->nombre;
        $this->slug = $this->subcategoria->slug;
        $this->identificador = rand();
        $this->open_edit = true;
    }
    public function update()
    {
        $rules = $this->rules;
        $rules['nombre'] = 'required|unique:subcategorias,nombre,' . $this->subcategoria->id;
        if ($this->image) {
            $rules['image'] = 'image';
            if ($this->subcategoria->image) {
                Storage::disk('public')->delete($this->subcategoria->image);
            }
            $this->subcategoria->image = $this->image->store('subcategorias', 'public');
        }
        $this->validate($rules);
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'editar',
            'detalle' => 'edito subcategoria' . ' ' . $this->subcategoria->nombre,
            'detalle_id' => $this->subcategoria->id,
            'user_id' => $this->user_id,
        ]);
        $this->subcategoria->nombre = $this->nombre;
        $this->subcategoria->slug = $this->slug;
        $this->subcategoria->save();
        $this->identificador = rand();
        $this->reset('open_edit');
        $this->resetInput();
        $this->emit('alert', 'Modificado con Exito');
    }
    public function condicion(Subcategoria $subcategoria)
    {
        $this->subcategoria = $subcategoria;
        $this->open_condicion = true;
    }
    public function ActivarDesactivar()
    {
        if ($this->subcategoria->condicion == 'activado') {
            $this->condicion = 'desactivado';
            Historial::create([
                'fecha' => $this->fecha,
                'accion' => 'desactivar',
                'detalle' => 'desactivo subcategoria' . ' ' . $this->subcategoria->nombre,
                'detalle_id' => $this->subcategoria->id,
                'user_id' => $this->user_id,
            ]);
        } else {
            $this->condicion = 'activado';
            $this->condicion = 'activado';
            Historial::create([
                'fecha' => $this->fecha,
                'accion' => 'activar',
                'detalle' => 'activo subcategoria' . ' ' . $this->subcategoria->nombre,
                'detalle_id' => $this->subcategoria->id,
                'user_id' => $this->user_id,
            ]);
        }
        $this->subcategoria->condicion = $this->condicion;
        $this->subcategoria->save();
        $this->open_condicion = false;
        if ($this->condicion == 'activado') {
            $this->emit('alert', 'Activado con Exito');
        } else {
            $this->emit('alert', 'Desactivado con Exito');
        }
        $this->condicion = null;
    }
    public function delete(Subcategoria $subcategoria)
    {
        $this->delete = $subcategoria;
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
        $subcategorias = Subcategoria::where('nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
        $categorias = Categoria::select('id', 'nombre', 'condicion')
            ->get();

        return view('livewire.admin.subcategorias.subcategorias', compact('subcategorias', 'categorias'));
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
        $this->categoria_id = null;
    }
    public function cancel()
    {
        $this->open_delete = false;
        $this->open_condicion = false;
        $this->emit('cancelar', 'Cancelado');
    }
}
