<?php

namespace App\Http\Livewire\Admin\Productos;

use App\Models\Historial;
use App\Models\kardex;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Subcategoria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateProductos extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $nombre, $slug, $medida, $marca, $stock_inicial, $stock, $descripcion, $condicion, $image, $subcategoria_id;
    public $precio_compra, $precio_venta, $precio_unitario;
    public $codigo, $codigo_id;
    public $open_create = false;
    public $identificador, $fecha, $producto_id;
    //registro
    public $user_id, $registro_id;

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }
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
        $this->validate([
            'nombre' => ['required', 'string', 'max:255', 'unique:productos'],
            'slug' =>  ['required', 'string', 'max:500'],
            'medida' =>  ['required', 'string', 'max:255'],
            'marca' =>  ['required', 'string', 'max:255'],
            'stock_inicial' =>  ['required', 'numeric', 'max:999999999'],
            'precio_compra' => ['required', 'numeric', 'max:999999999'],
            'precio_venta' => ['required', 'numeric', 'max:999999999'],
            'descripcion' =>  ['required', 'string', 'max:500'],            
            'subcategoria_id' =>  ['required'],
            'image' => ['required', 'image'],
        ]);
        $this->codigo_id = Producto::latest('id')->value('id') ?? 0;
        $this->codigo = 'CCO8D0' . ($this->codigo_id + 1);
        $this->condicion = 'activado';
        $this->precio_unitario = $this->precio_compra - ($this->precio_compra * 0.13);
        $this->stock = $this->stock_inicial;
        Producto::create([
            'codigo' =>  $this->codigo,
            'nombre' => $this->nombre,
            'slug' =>  $this->slug,
            'medida' =>  $this->medida,
            'marca' =>  $this->marca,
            'stock' =>  $this->stock,
            'stock_inicial' =>  $this->stock_inicial,
            'precio_compra' =>  $this->precio_compra,
            'precio_venta' =>  $this->precio_venta,
            'precio_unitario' => $this->precio_unitario,
            'descripcion' =>  $this->descripcion, 
            'condicion' =>  $this->condicion,           
            'subcategoria_id' =>  $this->subcategoria_id,
            'image' => $this->image->store('productos', 'public'),
        ]); 
        $this->producto_id = Producto::latest('id')->select('id')->first()->id;
        kardex::create([
            'fecha' => $this->fecha,
            'detalle' => 'Inicio de actividad de producto',
            'costo_unitario' =>  $this->precio_unitario,
            'cantidad_entrada' => null,
            'cantidad_salida' => null,
            'precio_entrada' =>  null,
            'precio_salida' => null,
            'cantidad_total' => $this->stock_inicial,
            'precio_total' => $this->precio_unitario * $this->stock_inicial,
            'cantidad' => $this->stock_inicial,
            'producto_id' => $this->producto_id,
            'venta_id' => null,
            'cantidad' => $this->stock_inicial,
            'estado' => 'ingreso',
            'inicio' => 'inicio',
        ]);
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'crear',
            'detalle' => 'crear nueva producto' . ' ' . $this->nombre,
            'detalle_id' => $this->producto_id,
            'user_id' => $this->user_id,
        ]);       
        $this->emitTo('admin.productos.productos', 'render');
        $this->reset('open_create');
        $this->resetInput();
        $this->identificador = rand();
        $this->emit('alert', 'Añadio un nuevo Producto');
    }

    public function render()
    {
        $subcategorias = Subcategoria::select('id', 'nombre')
        ->where('condicion', 'activado')
        ->get();

        return view('livewire.admin.productos.create-productos', compact('subcategorias'));
    }

    public function cancel()
    {
        $this->resetInput();
        $this->resetValidation();
        $this->open_create = false;
    }
    public function resetInput()
    {
        $this->codigo = null;
        $this->nombre = null;
        $this->slug = null;
        $this->medida = null;
        $this->marca = null;
        $this->stock = null;
        $this->precio_compra = null;
        $this->precio_venta = null;
        $this->precio_unitario = null;
        $this->descripcion = null;
        $this->condicion = null;        
        $this->image = null;
        $this->subcategoria_id = null;
        $this->stock_inicial = null;        
    }
}
