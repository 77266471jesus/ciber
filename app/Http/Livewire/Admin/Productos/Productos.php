<?php

namespace App\Http\Livewire\Admin\Productos;

use App\Models\DetalleIngreso;
use App\Models\DetalleVenta;
use App\Models\Historial;
use App\Models\kardex;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Producto;
use App\Models\Subcategoria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Productos extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $listeners = ['render'];

    public $image, $nombre, $slug, $codigo;
    public $ingreso, $venta, $stock_inicial, $stock, $precio_compra, $precio_venta, $precio_unitario;
    public $search;
    public $producto, $identificador;
    public $sort = 'id';
    public $direction = 'desc';
    public $open_show = false;
    public $open_edit = false;
    public $open_condicion = false;
    public $open_delete = false;
    public $show_producto;
    public $condicion;
    public $delete;
    public $kardex, $kardex_delete;
    //registro
    public $user_id, $registro_id, $fecha;

    public function updatedNombre($value)
    {
        $this->slug = Str::slug($value);
    }
    protected $rules = [
        'codigo' =>  ['required', 'string', 'max:255'],
        'nombre' => ['required', 'string', 'max:255', 'unique:productos,nombre'],
        'slug' =>  ['required', 'string', 'max:500'],
        'producto.medida' =>  ['required', 'string', 'max:255'],
        'producto.marca' =>  ['required', 'string', 'max:255'],
        'stock_inicial' =>  ['required', 'numeric', 'max:999999999'],
        'precio_compra' =>  ['required', 'numeric', 'max:999999999'],
        'precio_venta' =>  ['required', 'numeric', 'max:999999999'],
        'producto.descripcion' =>  ['required', 'string', 'max:500'],
        'producto.subcategoria_id' =>  ['required'],
        'image' => [''],
    ];
    public function mount()
    {
        $this->show_producto = new Producto();
        $this->producto = new Producto();
        $this->delete = new Producto();
        $this->identificador = rand();
        $this->fecha = Carbon::now();
        $this->user_id = Auth::user()->id;
    }
    public function show(Producto $producto)
    {
        $this->show_producto = $producto;
        $this->open_show = true;
    }
    public function edit(Producto $producto)
    {
        $this->resetInput();
        $this->resetValidation();
        $this->producto = $producto;
        $this->nombre = $this->producto->nombre;
        $this->codigo = $this->producto->codigo;
        $this->slug = $this->producto->slug;
        $this->precio_compra = $this->producto->precio_compra;
        $this->precio_venta = $this->producto->precio_venta;
        $this->stock_inicial = $this->producto->stock_inicial;
        $this->identificador = rand();
        $this->open_edit = true;

        $this->ingreso = DetalleIngreso::join('productos', 'productos.id', '=', 'detalle_ingresos.producto_id')
            ->join('ingresos', 'ingresos.id', '=', 'detalle_ingresos.ingreso_id')
            ->where('ingresos.estado', 'aceptado')
            ->where('productos.id', $this->producto->id)
            ->sum('detalle_ingresos.cantidad');

        $this->venta = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_ventas.producto_id')
            ->join('ventas', 'ventas.id', '=', 'detalle_ventas.venta_id')
            ->where('ventas.estado', 'aceptado')
            ->where('productos.id', $this->producto->id)
            ->sum('detalle_ventas.cantidad');

        $this->kardex = kardex::where('inicio', 'inicio')
            ->where('producto_id', $this->producto->id)
            ->first();
    }
    public function update()
    {
        $rules = $this->rules;
        $rules['nombre'] = 'required|unique:productos,nombre,' . $this->producto->id;
        if ($this->image) {
            $rules['image'] = 'image';
            if ($this->producto->image) {
                Storage::disk('public')->delete($this->producto->image);
            }
            $this->producto->image = $this->image->store('productos', 'public');
        }
        $this->stock = $this->stock_inicial + $this->ingreso - $this->venta;
        if ($this->stock == 0) {
            $this->producto->condicion = 'desactivado';
        } else {
            $this->producto->condicion = 'activado';
        }
        $this->validate($rules);
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'editar',
            'detalle' => 'edito producto' . ' ' . $this->producto->nombre,
            'detalle_id' => $this->producto->id,
            'user_id' => $this->user_id,
        ]);
        $this->precio_unitario = $this->precio_compra - ($this->precio_compra * 0.13);
        $this->producto->nombre = $this->nombre;
        $this->producto->slug = $this->slug;
        $this->producto->codigo = $this->codigo;
        $this->producto->stock_inicial = $this->stock_inicial;
        $this->producto->precio_compra = $this->precio_compra;
        $this->producto->precio_venta = $this->precio_venta;
        $this->producto->precio_unitario = $this->precio_unitario;
        $this->producto->stock = $this->stock;
        $this->producto->save();
        $this->identificador = rand();
        $this->reset('open_edit');
        $this->kardex->costo_unitario = $this->precio_unitario;
        $this->kardex->cantidad_total = $this->stock_inicial;
        $this->kardex->precio_total = $this->stock_inicial * $this->precio_unitario;
        $this->kardex->cantidad = $this->stock_inicial;
        $this->kardex->save();
        $this->resetInput();
        $this->emit('alert', 'Modificado con Exito');
    }
    public function condicion(Producto $producto)
    {
        $this->producto = $producto;
        $this->open_condicion = true;
    }
    public function ActivarDesactivar()
    {
        if ($this->producto->condicion == 'activado') {
            $this->condicion = 'desactivado';
            Historial::create([
                'fecha' => $this->fecha,
                'accion' => 'desactivar',
                'detalle' => 'desactivo producto' . ' ' . $this->producto->nombre,
                'detalle_id' => $this->producto->id,
                'user_id' => $this->user_id,
            ]);
        } else {
            $this->condicion = 'activado';
            $this->condicion = 'activado';
            Historial::create([
                'fecha' => $this->fecha,
                'accion' => 'activar',
                'detalle' => 'activo producto' . ' ' . $this->producto->nombre,
                'detalle_id' => $this->producto->id,
                'user_id' => $this->user_id,
            ]);
        }
        $this->producto->condicion = $this->condicion;
        $this->producto->save();
        $this->open_condicion = false;
        if ($this->condicion == 'activado') {
            $this->emit('alert', 'Activado con Exito');
        } else {
            $this->emit('alert', 'Desactivado con Exito');
        }
        $this->condicion = null;
    }
    public function delete(Producto $producto)
    {
        $this->delete = $producto;
        $this->open_delete = true;
    }
    public function destroy()
    {
        if ($this->delete->image) {
            Storage::disk('public')->delete($this->delete->image);
        }
        $this->kardex_delete = kardex::where('producto_id', $this->delete->id)->get();
        foreach ($this->kardex_delete as $delete) {
            $delete->delete();
        }
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'eliminar',
            'detalle' => 'elimino producto' . ' ' . $this->delete->nombre,
            'detalle_id' => $this->delete->id,
            'user_id' => $this->user_id,
        ]);
        $this->delete->delete();
        $this->open_delete = false;
        $this->emit('alert', 'Eliminado con Exito');
    }

    public function render()
    {
        $productos = Producto::where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('marca', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
        $subcategorias = Subcategoria::select('id', 'nombre', 'condicion')
            ->get();
        return view('livewire.admin.productos.productos', compact('productos', 'subcategorias'));
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
        $this->precio_compra = null;
        $this->precio_venta = null;
    }
    public function cancel()
    {
        $this->open_delete = false;
        $this->open_condicion = false;
        $this->emit('cancelar', 'Cancelado');
    }
}
