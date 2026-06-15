<?php

namespace App\Http\Livewire\Admin\Ventas;

use App\Models\DetalleIngreso;
use App\Models\DetalleVenta;
use App\Models\Historial;
use App\Models\kardex;
use App\Models\Producto;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Ventas extends Component
{
    use WithPagination;

    protected $listeners = ['render'];

    public $search;
    public $show_venta, $venta, $estado;
    public $sort = 'id';
    public $direction = 'desc';
    public $open_show = false;
    public $open_estado = false;
    public $egreso, $compra, $cantidad, $producto_seleccionados, $products_stock;
    public $productos, $fecha;
    //registro
    public $user_id, $registro_id;

    public function mount()
    {
        $this->fecha = Carbon::now();
        $this->show_venta = new Venta();
        $this->venta = new Venta();
        $this->user_id = Auth::user()->id;
    }
    public function show(Venta $venta)
    {
        $this->show_venta = $venta;        
        $this->open_show = true;
    }
    public function estado(Venta $venta)
    {
        $this->venta = $venta;
        $this->open_estado = true;
        $this->productos = DetalleVenta::where('venta_id', $this->venta->id )->get();
        $this->producto_seleccionados = $this->productos->pluck("producto_id")->toArray();
        $this->products_stock = Producto::whereIn('id', $this->producto_seleccionados)->get();
    }
    public function AnularAceptar()
    {
        if ($this->venta->estado == 'aceptado') {
            $this->estado = 'anulado';
        } else {
            $this->estado = 'aceptado';
        }
        $this->venta->estado = $this->estado;
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'anular',
            'detalle' => 'anulo venta' . ' ' . $this->venta->tipo_comprobante . ' ' . $this->venta->comprobante,
            'detalle_id' => $this->venta->id,
            'user_id' => $this->user_id,
        ]); 
        $this->venta->save();
        foreach ($this->products_stock as $values) {

            $this->compra = DetalleIngreso::join('productos', 'productos.id', '=', 'detalle_ingresos.producto_id')
            ->join('ingresos', 'ingresos.id', '=', 'detalle_ingresos.ingreso_id')
            ->where('ingresos.estado', 'aceptado')
            ->where('productos.id', $values->id)
            ->sum('detalle_ingresos.cantidad');
            
            $this->egreso = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_ventas.producto_id')
            ->join('ventas', 'ventas.id', '=', 'detalle_ventas.venta_id')
            ->where('ventas.estado', 'aceptado')
            ->where('productos.id', $values->id)
            ->sum('detalle_ventas.cantidad'); 

            $this->cantidad = $values->stock_inicial + $this->compra - $this->egreso;
            $values->stock = $this->cantidad;
            if($values->stock == 0){
                $values->condicion = 'desactivado';
            }else{
                $values->condicion = 'activado';
            }
            $values->save();
        }
        $this->open_estado = false;
        if ($this->estado == 'aceptado') {
            $this->emit('alert', 'Aceptado con Exito');
        } else {
            $this->emit('alert', 'Anulado con Exito');
        }
        $this->kardexs = kardex::where('venta_id', $this->venta->id)->get();
        foreach ($this->kardexs as $kardex) {
            $kardex->delete();
        }
        $this->estado = null;
    }
    public function cancel()
    {
        $this->open_estado = false;
        $this->emit('cancelar', 'Cancelado');
    }

    public function render()
    {
        $ventas = Venta::selectRaw('ventas.id as id, ventas.tipo_comprobante as tipo_comprobante, ventas.comprobante as comprobante, ventas.estado as estado,
        ventas.fecha as fecha, ventas.impuesto as impuesto, ventas.total_venta as total_venta, users.name as usuario, clientes.nombre as cliente')
            ->join('users', 'ventas.user_id', '=', 'users.id')
            ->join('clientes', 'ventas.cliente_id', '=', 'clientes.id')
            ->where('tipo_comprobante', 'like', '%' . $this->search . '%')
            ->orwhere('comprobante', 'like', '%' . $this->search . '%')
            ->orwhere('fecha', 'like', '%' . $this->search . '%')
            ->orwhere('users.name', 'like', '%' . $this->search . '%')
            ->orwhere('clientes.nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.admin.ventas.ventas', compact('ventas'));
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
