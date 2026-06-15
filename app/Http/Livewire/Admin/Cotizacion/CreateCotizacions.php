<?php

namespace App\Http\Livewire\Admin\Cotizacion;

use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\DetalleCotizacion;
use App\Models\Historial;
use App\Models\Producto;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CreateCotizacions extends Component
{
    use WithPagination;

    public $date, $search, $buscar;
    // detalle cotizacion 
    public $cantidad, $precio_venta, $descuento, $producto_id, $cotizacion_id;
    //cotizacion
    public $comprobante, $fecha, $total_venta, $total, $cliente_id, $user_id;
    public $profomra, $auxiliar;
    public $impuesto = 13;
    // cliente
    public $nombre, $tipo_documento, $documento, $telefono, $email, $direccion;
    public $cliente;
    public $listen_cliente = 'activar';
    public $open_cliente = true;
    public $open_productos;
    public $producto, $detalleCotizacion, $Items, $producto_seleccionado, $precio;
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
        'impuesto' => ['required', 'numeric', 'min:0', 'max:999999999'],
    ];

    public function mount()
    {
        $this->fecha = Carbon::now();
        $this->cliente = new Cliente();
        $this->producto = new Producto();
        $this->detalleCotizacion = new DetalleCotizacion();
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
        DetalleCotizacion::create([
            'cantidad' =>  1,
            'precio_venta' => $this->precio,
            'descuento' =>  0,
            'subtotal' =>  $this->precio,
            'producto_id' =>  $this->producto->id,
            'user_id' =>  $this->user_id,
        ]);
    }
    public function store()
    {
        if ($this->producto_seleccionado) {
            $this->storeCliente();
            $this->storeCotizacion();
            $this->storeDetalle();
            $this->resetInput();
            $this->emit('alert', 'Añadio una nueva Cotización');
            return redirect()->to('/admin/cotizacion');
        } else {
            session()->flash('message', 'Agregue Productos.');
        }
    }
    public function storeCotizacion()
    {
        if ($this->cliente_id) {
            if ($this->listen_cliente == 'activar') {
                $this->cliente_id = $this->cliente->id;
            } else {
                $this->cliente_id = Cliente::latest('id')->select('id')->first()->id;
            }
        } else {
            $this->cliente_id = Cliente::latest('id')->select('id')->first()->id;
        }
        $this->proforma();
        Cotizacion::create([
            'comprobante' => $this->comprobante,
            'fecha' =>  $this->fecha,
            'total_cotizacion' =>  $this->total_cotizacion,
            'total' =>  $this->total,
            'impuesto' =>  $this->impuesto,
            'cliente_id' =>  $this->cliente_id,
            'user_id' =>  $this->user_id,
        ]);
    }
    public function storeDetalle()
    {
        $this->cotizacion_id = Cotizacion::latest('id')->select('id')->first()->id;
        foreach ($this->Items as $values) {
            $values->cotizacion_id = $this->cotizacion_id;
            $values->save();
        }
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'crear',
            'detalle' => 'crear una nueva cotizacion' . ' ' . $this->comprobante,
            'detalle_id' => $this->cotizacion_id,
            'user_id' => $this->user_id,
        ]);
    }
    public function storeCliente()
    {
        $rules = $this->rules;
        if ($this->documento) {
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
    public function proforma()
    {
        $this->auxiliar = Cotizacion::select('comprobante')
            ->orderBy('id', 'desc')
            ->first();
        if ($this->auxiliar == null) {
            $this->proforma = 1;
        } else {
            $this->proforma = $this->auxiliar->comprobante + 1;
        }
        $this->comprobante = $this->proforma;
    }

    public function render()
    {
        $this->Items = DetalleCotizacion::where('cotizacion_id', null)
            ->where('user_id', $this->user_id)
            ->orderBy('producto_id', 'desc')
            ->get();

        $this->producto_seleccionado = $this->Items->pluck("producto_id")->toArray();

        $this->total_cotizacion = $this->Items->sum('subtotal');

        if ($this->impuesto) {
            $this->total = $this->total_cotizacion + (($this->impuesto / 100) * $this->total_cotizacion);
        } else {
            $this->total = $this->total_cotizacion;
        }

        $this->products_stock = Producto::where('condicion', 'activado')
            ->orderBy('id', 'desc')
            ->whereIn('id', $this->producto_seleccionado)
            ->get();

        $clientes = Cliente::where('nombre', 'like', '%' . $this->buscar . '%')
            ->orwhere('documento', 'like', '%' . $this->buscar . '%')
            ->get();

        $productos = Producto::where('condicion', 'activado')
            ->where(function ($query) {
                $query->where('nombre', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('marca', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('stock', 'LIKE', '%' . $this->search . '%');
            })
            ->whereNotIn('id', $this->producto_seleccionado)
            ->orderBy('id', 'desc')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = 'products');

        $detalleCotizacions = DetalleCotizacion::where('cotizacion_id', null)
            ->where('user_id', $this->user_id)->get();

        return view('livewire.admin.cotizacion.create-cotizacions', compact('detalleCotizacions', 'productos', 'clientes'));
    }

    public function cancelar()
    {
        return redirect()->to('/admin/cotizacion');
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
    }
}
