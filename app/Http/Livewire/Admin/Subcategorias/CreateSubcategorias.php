<?php

namespace App\Http\Livewire\Admin\Subcategorias;

use App\Models\Categoria;
use App\Models\Historial;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Subcategoria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateSubcategorias extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $nombre, $descripcion, $condicion, $slug, $image, $categoria_id;
    public $open_create = false;
    public $identificador;
    //registro
    public $user_id, $registro_id, $fecha;

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }
    public function mount()
    {
        $this->identificador = rand();
        $this->fecha = Carbon::now();        
        $this->user_id = Auth::user()->id;
    }
    public function create()
    {
        $this->open_create = true;
    }
    public function store()
    {
        $this->condicion = 'activado';
        if ($this->image) {
            $this->validate([
                'nombre' =>  ['required', 'string', 'max:255', 'unique:subcategorias'],
                'slug' => ['required', 'string', 'max:255'],
                'descripcion' =>  ['required', 'string', 'max:500'],
                'categoria_id' =>  ['required'],
                'image' => ['image'],
            ]);
            Subcategoria::create([
                'nombre' => $this->nombre,
                'slug' => $this->slug,
                'descripcion' => $this->descripcion,
                'condicion' => $this->condicion,
                'categoria_id' => $this->categoria_id,
                'image' => $this->image->store('subcategorias', 'public')
            ]);
            $this->registro_id = Subcategoria::latest('id')->select('id')->first()->id;
            Historial::create([
                'fecha' => $this->fecha,
                'accion' => 'crear',
                'detalle' => 'crear nueva subcategoria' . ' ' . $this->nombre,
                'detalle_id' => $this->registro_id,
                'user_id' => $this->user_id,
            ]);
        } else {
            $this->validate([
                'nombre' =>  ['required', 'string', 'max:255', 'unique:subcategorias'],
                'slug' => ['required', 'string', 'max:255'],
                'categoria_id' =>  ['required'],
                'descripcion' =>  ['required', 'string', 'max:500'],
            ]);
            Subcategoria::create([
                'nombre' => $this->nombre,
                'slug' => $this->slug,
                'descripcion' => $this->descripcion,
                'categoria_id' => $this->categoria_id,
                'condicion' => $this->condicion,
            ]);
            $this->registro_id = Subcategoria::latest('id')->select('id')->first()->id;
            Historial::create([
                'fecha' => $this->fecha,
                'accion' => 'crear',
                'detalle' => 'crear nueva subcategoria' . ' ' . $this->nombre,
                'detalle_id' => $this->registro_id,
                'user_id' => $this->user_id,
            ]);
        }

        $this->emitTo('admin.subcategorias.subcategorias', 'render');
        $this->reset('open_create');
        $this->resetInput();
        $this->identificador = rand();
        $this->emit('alert', 'Añadio una nueva Subcategoria');
    }

    public function render()
    {
        $categorias = Categoria::select('id', 'nombre')
        ->where('condicion', 'activado')
        ->get();
        return view('livewire.admin.subcategorias.create-subcategorias', compact('categorias'));
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
        $this->slug = null;
        $this->descripcion = null;
        $this->condicion = null;
        $this->image = null;
        $this->categoria_id = null;
    }
}
