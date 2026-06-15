<?php

namespace App\Http\Livewire\Admin\Ventas;

use Livewire\Component;
use App\Models\DetalleVenta;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Historial;
use App\Models\kardex;
use Carbon\Carbon;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CreateVenta extends Component
{
    use WithPagination;

    public $date, $search, $buscar;
    // detalle venta 
    public $cantidad, $precio_venta, $descuento, $producto_id, $venta_id;
    //venta
    public $comprobante, $fecha, $total_venta, $total, $cliente_id, $user_id, $estado;
    public $tipo_comprobante = 'factura';
    public $boleta, $factura;
    public $impuesto = 13;
    // cliente
    public $nombre, $tipo_documento, $documento, $telefono, $email, $direccion;
    public $cliente;
    public $listen_cliente = 'activar';
    public $open_cliente = true;
    public $open_productos;
    public $producto, $detalleVenta, $Items, $producto_seleccionado, $precio;
    public $products_stock, $ingreso, $venta, $prueba3, $prueba4, $prueba5;
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
        // 'impuesto' => ['required', 'numeric', 'min:0', 'max:999999999'],
        // 'tipo_comprobante' => ['required', 'string', 'max:255'],
    ];

    public function mount()
    {
        $this->fecha = Carbon::now();
        $this->cliente = new Cliente();
        $this->producto = new Producto();
        $this->detalleVenta = new DetalleVenta();
        $this->user_id = Auth::user()->id;
    }
    public function updatedBuscar()
    {
        $this->open_cliente = true;
    }
    public function cliente(Cliente $cliente)
    {
        $this->cliente = $cliente;
        $this->cliente_id = $this->cliente->id;
        $this->nombre = $this->cliente->nombre;
        $this->tipo_documento = $this->cliente->tipo_documento;
        $this->documento = $this->cliente->documento;
        $this->telefono = $this->cliente->telefono;
        $this->email = $this->cliente->email;
        $this->direccion = $this->cliente->direccion;
        $this->open_cliente = false;
        $this->listen_cliente = 'activar';
    }
    public function cerrar()
    {
        $this->open_cliente = false;
    }
    public function anular()
    {
        $this->open_cliente = false;
        $this->listen_cliente = 'anular';
        $this->resetInput();
    }
    public function activar()
    {
        $this->open_cliente = true;
        $this->listen_cliente = 'activar';
    }
    public function productos(Producto $producto)
    {
        $this->producto = $producto;
        $this->precio = $this->producto->precio_venta;
        DetalleVenta::create([
            'cantidad' =>  1,
            'precio_venta' => $this->precio,
            'descuento' =>  0,
            'subtotal' =>  $this->precio,
            'producto_id' =>  $this->producto->id,
            'user_id' =>  $this->user_id,
        ]);
        $this->precio = null;
    }
    public function store()
    {
        if ($this->producto_seleccionado) {
            $this->storeCliente();
            $this->storeVenta();
            $this->storeDetalle();
            $this->resetInput();
            $this->emit('alert', 'Añadio una nueva Venta de Productos');
            return redirect()->to('/admin/ventas');
        } else {
            session()->flash('message', 'Agregue Productos.');
        }
    }
    public function storeVenta()
    {
        $this->estado = 'aceptado';
        if ($this->cliente_id) {
            if ($this->listen_cliente == 'activar') {
                $this->cliente_id = $this->cliente->id;
            } else {
                $this->cliente_id = Cliente::latest('id')->select('id')->first()->id;
            }
        } else {
            $this->cliente_id = Cliente::latest('id')->select('id')->first()->id;
        }

        $this->factura();
        // if ($this->tipo_comprobante == 'boleta') {
        //     $this->boleta();
        // }
        Venta::create([
            'tipo_comprobante' =>  $this->tipo_comprobante,
            'comprobante' => $this->comprobante,
            'fecha' =>  $this->fecha,
            'total_venta' =>  $this->total_venta,
            'total' =>  $this->total,
            'impuesto' =>  $this->impuesto,
            'cliente_id' =>  $this->cliente_id,
            'user_id' =>  $this->user_id,
            'estado' =>  $this->estado,
        ]);
    }
    public function storeDetalle()
    {
        $this->venta_id = Venta::latest('id')->select('id')->first()->id;
        foreach ($this->Items as $values) {
            foreach ($this->products_stock as $product_stock) {
                if ($product_stock->id ==  $values->producto_id) {
                    $product_stock->stock = $product_stock->stock - $values->cantidad;
                    if ($product_stock->stock == 0) {
                        $product_stock->condicion = 'desactivado';
                    }
                    $product_stock->save();
                }
            }
            kardex::create([
                'fecha' => $this->fecha,
                'detalle' => 'Venta con:' . ' ' . $this->tipo_comprobante . ' ' . 'N°' . ' ' . $this->comprobante,
                'costo_unitario' =>  null,
                'cantidad_entrada' => null,
                'cantidad_salida' => $values->cantidad,
                'precio_entrada' =>  null,
                'precio_salida' => null,
                'cantidad_total' => null,
                'precio_total' => null,
                'cantidad' => null,
                'producto_id' => $values->producto_id,
                'venta_id' => $this->venta_id,
                'cantidad' => $values->cantidad,
                'estado' => 'egreso',
                'cantidad_detalle' => $values->cantidad,
            ]);
            $values->venta_id = $this->venta_id;
            $values->save();
        }
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'crear',
            'detalle' => 'crear nueva venta' . ' ' . $this->tipo_comprobante . ' ' . $this->comprobante,
            'detalle_id' => $this->venta_id,
            'user_id' => $this->user_id,
        ]);
    }
    public function storeCliente()
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
        if ($this->listen_cliente == 'anular') {
            Cliente::create([
                'nombre' => $this->nombre,
                'tipo_documento' => $this->tipo_documento,
                'documento' => $this->documento,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'email' => $this->email,
            ]);
            $this->registro_id = Cliente::latest('id')->select('id')->first()->id;
            Historial::create([
                'fecha' => $this->fecha,
                'accion' => 'crear',
                'detalle' => 'crear nuevo cliente' . ' ' . $this->nombre,
                'detalle_id' => $this->registro_id,
                'user_id' => $this->user_id,
            ]);
        }
    }
    public function factura()
    {
        $this->auxiliar = Venta::select('comprobante')
            ->where('tipo_comprobante', 'factura')
            ->where('estado', 'aceptado')
            ->orderBy('id', 'desc')
            ->first();
        if ($this->auxiliar == null) {
            $this->factura = 1;
        } else {
            $this->factura = $this->auxiliar->comprobante + 1;
        }
        $this->comprobante = $this->factura;
    }
    // public function boleta()
    // {
    //     $this->auxiliar = Venta::select('comprobante')
    //         ->where('tipo_comprobante', 'boleta')
    //         ->where('estado', 'aceptado')
    //         ->orderBy('id', 'desc')
    //         ->first();
    //     if ($this->auxiliar == null) {
    //         $this->boleta = 1;
    //     } else {
    //         $this->boleta = $this->auxiliar->comprobante + 1;
    //     }
    //     $this->comprobante = $this->boleta;
    // }

    public function render()
    {
        $this->Items = DetalleVenta::where('venta_id', null)
            ->where('user_id', $this->user_id)
            ->orderBy('producto_id', 'desc')
            ->get();

        $this->producto_seleccionado = $this->Items->pluck("producto_id")->toArray();

        $this->total_venta = $this->Items->sum('subtotal');
        if ($this->impuesto) {
            $this->total = $this->total_venta + (($this->impuesto / 100) * $this->total_venta);
        } else {
            $this->total = $this->total_venta;
        }

        $this->products_stock = Producto::where('condicion', 'activado')
            ->orderBy('id', 'desc')
            ->whereIn('id', $this->producto_seleccionado)
            ->get();

        $clientes = Cliente::where('nombre', 'like', '%' . $this->buscar . '%')
            ->orwhere('documento', 'like', '%' . $this->buscar . '%')
            ->get();

        $productos = Producto::where('condicion', 'activado')
            ->where('stock', '>', 0)
            ->where(function ($query) {
                $query->where('nombre', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('marca', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('stock', 'LIKE', '%' . $this->search . '%');
            })
            ->whereNotIn('id', $this->producto_seleccionado)
            ->orderBy('id', 'desc')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = 'products');

        $detalleVentas = DetalleVenta::where('venta_id', null)
            ->where('user_id', $this->user_id)->get();

        return view('livewire.admin.ventas.create-venta', compact('clientes', 'productos', 'detalleVentas'));
    }

    public function cancelar()
    {
        return redirect()->to('/admin/ventas');
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
        // $this->tipo_comprobante = null;
        // $this->comprobante = null;
    }
}
