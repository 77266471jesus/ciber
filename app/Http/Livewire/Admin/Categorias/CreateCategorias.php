<?php

namespace App\Http\Livewire\Admin\Categorias;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Categoria;
use App\Models\Historial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateCategorias extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $nombre, $descripcion, $condicion, $slug, $image;
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
                'nombre' =>  ['required', 'string', 'max:255', 'unique:categorias'],
                'slug' => ['required', 'string', 'max:255'],
                'descripcion' =>  ['required', 'string', 'max:500'],
                'image' => ['image'],
            ]);
            Categoria::create([
                'nombre' => $this->nombre,
                'slug' => $this->slug,
                'descripcion' => $this->descripcion,
                'condicion' => $this->condicion,
                'image' => $this->image->store('categorias', 'public')
            ]);
            $this->registro_id = Categoria::latest('id')->select('id')->first()->id;
            Historial::create([
                'fecha' => $this->fecha,
                'accion' => 'crear',
                'detalle' => 'crear nueva categoria' . ' ' . $this->nombre,
                'detalle_id' => $this->registro_id,
                'user_id' => $this->user_id,
            ]);
        } else {
            $this->validate([
                'nombre' =>  ['required', 'string', 'max:255', 'unique:categorias'],
                'slug' => ['required', 'string', 'max:255'],
                'descripcion' =>  ['required', 'string', 'max:500'],
            ]);
            Categoria::create([
                'nombre' => $this->nombre,
                'slug' => $this->slug,
                'descripcion' => $this->descripcion,
                'condicion' => $this->condicion,
            ]);
            $this->registro_id = Categoria::latest('id')->select('id')->first()->id;
            Historial::create([
                'fecha' => $this->fecha,
                'accion' => 'crear',
                'detalle' => 'crear nueva categoria' . ' ' . $this->nombre,
                'detalle_id' => $this->registro_id,
                'user_id' => $this->user_id,
            ]);
        }

        $this->emitTo('admin.categorias.categorias', 'render');
        $this->reset('open_create');
        $this->resetInput();
        $this->identificador = rand();
        $this->emit('alert', 'Añadio una nueva Categoria');
    }
    public function render()
    {
        return view('livewire.admin.categorias.create-categorias');
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
    }
}
