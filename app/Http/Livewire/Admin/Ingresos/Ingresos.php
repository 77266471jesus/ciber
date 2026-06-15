<?php

namespace App\Http\Livewire\Admin\Ingresos;

use App\Models\DetalleIngreso;
use App\Models\DetalleVenta;
use App\Models\Historial;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ingreso;
use App\Models\kardex;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Ingresos extends Component
{
    use WithPagination;

    protected $listeners = ['render'];

    public $search;
    public $show_ingreso, $ingreso, $estado;
    public $sort = 'id';
    public $direction = 'desc';
    public $open_show = false;
    public $open_estado = false;
    public $venta, $compra, $cantidad, $producto_seleccionados, $products_stock;
    public $productos;
    //registro
    public $user_id, $registro_id, $fecha;

    public function mount()
    {
        $this->show_ingreso = new Ingreso();
        $this->ingreso = new Ingreso();
        $this->fecha = Carbon::now();
        $this->user_id = Auth::user()->id;
    }
    public function show(Ingreso $ingreso)
    {
        $this->show_ingreso = $ingreso;        
        $this->open_show = true;
    }
    public function estado(Ingreso $ingreso)
    {        
        $this->ingreso = $ingreso;
        $this->open_estado = true;
        $this->productos = DetalleIngreso::where('ingreso_id', $this->ingreso->id )->get();
        $this->producto_seleccionados = $this->productos->pluck("producto_id")->toArray();
        $this->products_stock = Producto::whereIn('id', $this->producto_seleccionados)->get();
    }
    public function AnularAceptar()
    {        
        if ($this->ingreso->estado == 'aceptado') {
            $this->estado = 'anulado';
        } else {
            $this->estado = 'aceptado';
        }
        $this->ingreso->estado = $this->estado;
        Historial::create([
            'fecha' => $this->fecha,
            'accion' => 'anular',
            'detalle' => 'anulo compra' . ' ' . $this->ingreso->tipo_comprobante . ' ' . $this->ingreso->comprobante,
            'detalle_id' => $this->ingreso->id,
            'user_id' => $this->user_id,
        ]); 
        $this->ingreso->save();
        foreach ($this->products_stock as $values) {

            $this->compra = DetalleIngreso::join('productos', 'productos.id', '=', 'detalle_ingresos.producto_id')
            ->join('ingresos', 'ingresos.id', '=', 'detalle_ingresos.ingreso_id')
            ->where('ingresos.estado', 'aceptado')
            ->where('productos.id', $values->id)
            ->sum('detalle_ingresos.cantidad');
            
            $this->venta = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_ventas.producto_id')
            ->join('ventas', 'ventas.id', '=', 'detalle_ventas.venta_id')
            ->where('ventas.estado', 'aceptado')
            ->where('productos.id', $values->id)
            ->sum('detalle_ventas.cantidad'); 

            $this->cantidad = $values->stock_inicial + $this->compra - $this->venta;
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
        $this->estado = null;
        $this->kardexs = kardex::where('ingreso_id', $this->ingreso->id)->get();
        foreach ($this->kardexs as $kardex) {
            $kardex->delete();
        }
    }
    public function cancel()
    {
        $this->open_estado = false;
        $this->emit('cancelar', 'Cancelado');
    }

    public function render()
    {
        $ingresos = Ingreso::selectRaw('ingresos.id as id, ingresos.tipo_comprobante as tipo_comprobante, ingresos.comprobante as comprobante, ingresos.estado as estado,
        ingresos.fecha as fecha, ingresos.impuesto as impuesto, ingresos.total_compra as total_compra, users.name as usuario, proveedors.nombre as proveedor')
            ->join('users', 'ingresos.user_id', '=', 'users.id')
            ->join('proveedors', 'ingresos.proveedor_id', '=', 'proveedors.id')
            ->where('tipo_comprobante', 'like', '%' . $this->search . '%')
            ->orwhere('comprobante', 'like', '%' . $this->search . '%')
            ->orwhere('fecha', 'like', '%' . $this->search . '%')
            ->orwhere('users.name', 'like', '%' . $this->search . '%')
            ->orwhere('proveedors.nombre', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.admin.ingresos.ingresos', compact('ingresos'));
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
