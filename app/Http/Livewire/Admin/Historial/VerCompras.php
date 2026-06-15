<?php

namespace App\Http\Livewire\Admin\Historial;

use App\Models\DetalleIngreso;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class VerCompras extends Component
{
    use WithPagination;

    public $producto_id, $producto;
    public $fecha, $date;
    public $search;
    public $sort = 'ingresos.fecha';
    public $direction = 'desc';
    public $consulta = 'mes';

    public function mount($producto_id)
    {
        $this->date = Carbon::now();
        $this->fecha = $this->date->format('Y-m');
        $this->producto_id = $producto_id;
        $this->producto = Producto::find($this->producto_id);
    }

    public function render()
    {
        $detalleIngresos = DetalleIngreso::selectRaw('ingresos.fecha as fecha, detalle_ingresos.cantidad as cantidad,
        detalle_ingresos.precio_compra as precio_compra, detalle_ingresos.precio_venta as precio_venta,
        detalle_ingresos.subtotal as subtotal, users.name as nombre, ingresos.tipo_comprobante as tipo_comprobante, 
        ingresos.comprobante as comprobante')
        ->join('ingresos', 'detalle_ingresos.ingreso_id', '=', 'ingresos.id')
        ->join('users', 'detalle_ingresos.user_id', '=', 'users.id')
        ->where('ingresos.fecha', 'LIKE', '%' . $this->fecha . '%')
        ->where('detalle_ingresos.producto_id', $this->producto_id)
        ->where('ingresos.estado', 'aceptado')
        ->where(function ($query) {
            $query->where('detalle_ingresos.cantidad', 'LIKE', '%' . $this->search . '%')
                ->orWhere('detalle_ingresos.precio_compra', 'LIKE', '%' . $this->search . '%')
                ->orWhere('detalle_ingresos.precio_venta', 'LIKE', '%' . $this->search . '%')
                ->orWhere('detalle_ingresos.subtotal', 'LIKE', '%' . $this->search . '%')
                ->orWhere('users.name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('ingresos.tipo_comprobante', 'LIKE', '%' . $this->search . '%');
        })
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);

        return view('livewire.admin.historial.ver-compras', compact('detalleIngresos'));
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
