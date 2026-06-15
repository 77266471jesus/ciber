<?php

namespace App\Http\Livewire\Admin\Ingresos;

use App\Models\DetalleIngreso;
use App\Models\Historial;
use App\Models\Ingreso;
use App\Models\kardex;
use App\Models\Producto;
use App\Models\Proveedor;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CreateIngresos extends Component
{
    use WithPagination;

    public $date, $search, $buscar;
    // detalle ingreso 
    public $cantidad, $precio_compra, $precio_venta, $producto_id, $ingreso_id;
    //ingreso
    public $tipo_comprobante, $comprobante, $fecha, $total_compra, $proveedor_id, $user_id, $estado;
    public $impuesto = 13;
    // provedor
    public $nombre, $tipo_documento, $documento, $telefono, $email, $direccion;
    public $proveedor;
    public $listen_proveedor = 'activar';
    public $open_proveedor = true;
    public $open_productos;
    public $producto, $detalleIngreso, $Items, $producto_seleccionado;
    public $products_stock;
    //registro
    public $registro_id;

    protected $listeners = ['render'];
    protected $rules = [
        'nombre' =>  ['required', 'string', 'max:255'],
        'tipo_documento' => [''],
        'documento' => [''],
        'direccion' => [''],
        'telefono' => [''],
        'email' => [''],
        'fecha' => ['required'],
        // 'impuesto' => ['required', 'numeric', 'min:1', 'max:999999999'],
        'tipo_comprobante' => ['required', 'string', 'max:255'],
        'comprobante' => ['required', 'numeric', 'min:1', 'max:999999999'],
    ];

    public function mount()
    {
        $this->fecha = Carbon::now();
        $this->proveedor = new Proveedor();
        $this->producto = new Producto();
        $this->detalleIngreso = new DetalleIngreso();
        $this->user_id = Auth::user()->id;
    }
    public function updatedBuscar()
    {
        $this->open_proveedor = true;
    }
    public function proveedor(Proveedor $proveedor)
    {
        $this->proveedor = $proveedor;
        $this->proveedor_id = $this->proveedor->id;
        $this->nombre = $this->proveedor->nombre;
        $this->tipo_documento = $this->proveedor->tipo_documento;
        $this->documento = $this->proveedor->documento;
        $this->telefono = $this->proveedor->telefono;
        $this->email = $this->proveedor->email;
        $this->direccion = $this->proveedor->direccion;
        $this->open_proveedor = false;
        $this->listen_proveedor = 'activar';
    }
    public function cerrar()
    {
        $this->open_proveedor = false;
    }
    public function anular()
    {
        $this->open_proveedor = false;
        $this->listen_proveedor = 'anular';
        $this->resetInput();
    }
    public function activar()
    {
        $this->open_proveedor = true;
        $this->listen_proveedor = 'activar';
    }
    public function productos(Producto $producto)
    {
        $this->producto = $producto;
        DetalleIngreso::create([
            'cantidad' =>  1,
            'precio_compra' => $this->producto->precio_compra,
            'precio_venta' =>  $this->producto->precio_venta,
            'subtotal' =>  $this->producto->precio_compra,
            'producto_id' =>  $this->producto->id,
            'user_id' =>  $this->user_id,
        ]);
    }
    public function store()
    {
        if ($this->producto_seleccionado) {
            $this->storeProveedor();
            $this->storeIngreso();
            $this->storeDetalle();
            $this->resetInput();
            $this->emit('alert', 'Añadio un nuevo Ingreso de Productos');
            return redirect()->to('/admin/ingresos');
        } else {
            session()->flash('message', 'Agregue Productos.');
        }
    }
    public function storeIngreso()
    {
        $this->estado = 'aceptado';
        if ($this->proveedor_id) {
            if ($this->listen_proveedor == 'activar') {
                $this->proveedor_id = $this->proveedor->id;
            } else {
                $this->proveedor_id = Proveedor::latest('id')->select('id')->first()->id;
            }
        } else {
            $this->proveedor_id = Proveedor::latest('id')->select('id')->first()->id;
        }
        Ingreso::create([
            'tipo_comprobante' =>  $this->tipo_comprobante,
            'comprobante' => $this->comprobante,
            'fecha' =>  $this->fecha,
            'total_compra' =>  $this->total_compra,
            'impuesto' =>  $this->impuesto,
            'proveedor_id' =>  $this->proveedor_id,
            'user_id' =>  $this->user_id,
            'estado' =>  $this->estado,
        ]);
    }
    public function storeDetalle()
    {
        $this->ingreso_id = Ingreso::latest('id')->select('id')->first()->id;
        foreach ($this->Items as $values) {
            foreach ($this->products_stock as $product_stock) {
                if ($product_stock->id ==  $values->producto_id) {
                    $product_stock->stock = $product_stock->stock + $values->cantidad;
                    $product_stock->precio_compra = $values->precio_compra;
                    $product_stock->precio_venta = $values->precio_venta;
                    $product_stock->condicion = 'activado';
                    $product_stock->save();
                }
            }
            kardex::create([
                'fecha' => $this->fecha,
                'detalle' => 'Compra con:' . ' ' . $this->tipo_comprobante . ' ' . 'N°' . ' ' . $this->comprobante,
                'costo_unitario' =>  $values->precio_compra - ($values->precio_compra * ($this->impuesto / 100)),
                'cantidad_entrada' => $values->cantidad,
                'cantidad_salida' => null,
                'precio_entrada' =>  $values->subtotal - ($values->subtotal * ($this->impuesto / 100)),
                'precio_salida' => null,
                'cantidad_total' => null,
                'precio_total' => null,
                'cantidad' => null,
                'producto_id' => $values->producto_id,
                'ingreso_id' => $this->ingreso_id,
                'cantidad' => $values->cantidad,
                'estado' => 'ingreso',
                'cantidad_detalle' => $values->cantidad,
            ]);
            $values->ingreso_id = $this->ingreso_id;
            $values->save();
        }
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'crear',
            'detalle' => 'crear nueva compra' . ' ' . $this->tipo_comprobante . ' ' . $this->comprobante,
            'detalle_id' => $this->ingreso_id,
            'user_id' => $this->user_id,
        ]);
    }
    public function storeProveedor()
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
        if ($this->listen_proveedor == 'anular') {
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
                'detalle' => 'crear nuevo proveedor' . ' ' . $this->nombre,
                'detalle_id' => $this->registro_id,
                'user_id' => $this->user_id,
            ]);
        }
    }

    public function render()
    {
        $this->Items = DetalleIngreso::where('ingreso_id', null)
            ->where('user_id', $this->user_id)
            ->orderBy('producto_id', 'desc')
            ->get();

        $this->producto_seleccionado = $this->Items->pluck("producto_id")->toArray();

        $this->total_compra = $this->Items->sum('subtotal');

        $this->products_stock = Producto::orderBy('id', 'desc')
            ->whereIn('id', $this->producto_seleccionado)
            ->get();

        $proveedors = Proveedor::where('nombre', 'like', '%' . $this->buscar . '%')
            ->orwhere('documento', 'like', '%' . $this->buscar . '%')
            ->get();

        $productos = Producto::where(function ($query) {
            $query->where('nombre', 'LIKE', '%' . $this->search . '%')
                ->orWhere('marca', 'LIKE', '%' . $this->search . '%')
                ->orWhere('stock', 'LIKE', '%' . $this->search . '%');
        })
            ->whereNotIn('id', $this->producto_seleccionado)
            ->orderBy('id', 'desc')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = 'products');

        $detalleIngresos = DetalleIngreso::where('ingreso_id', null)
            ->where('user_id', $this->user_id)->get();

        return view('livewire.admin.ingresos.create-ingresos', compact('proveedors', 'productos', 'detalleIngresos'));
    }
    public function cancelar()
    {
        return redirect()->to('/admin/ingresos');
    }
    public function updatingSearch()
    {
        $this->resetPage($pageName = 'products');
    }
    private function resetInput()
    {
        $this->nombre = null;
        $this->tipo_documento = null;
        $this->documento = null;
        $this->direccion = null;
        $this->telefono = null;
        $this->email = null;
        $this->tipo_comprobante = null;
        $this->comprobante = null;
    }
}
