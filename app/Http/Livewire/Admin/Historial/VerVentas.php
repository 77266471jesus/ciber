<?php

namespace App\Http\Livewire\Admin\Historial;

use App\Models\DetalleVenta;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class VerVentas extends Component
{
    use WithPagination;

    public $producto_id, $producto;
    public $fecha, $date;
    public $search;
    public $sort = 'ventas.fecha';
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
        $detalleVentas = DetalleVenta::selectRaw('ventas.fecha as fecha, detalle_ventas.cantidad as cantidad,
        detalle_ventas.precio_venta as precio_venta, detalle_ventas.descuento as descuento,
        detalle_ventas.subtotal as subtotal, users.name as nombre, ventas.tipo_comprobante as tipo_comprobante, 
        ventas.comprobante as comprobante')
        ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
        ->join('users', 'detalle_ventas.user_id', '=', 'users.id')
        ->where('detalle_ventas.created_at', 'LIKE', '%' . $this->fecha . '%')
        ->where('detalle_ventas.producto_id', $this->producto_id)
        ->where('ventas.estado', 'aceptado')
        ->where(function ($query) {
            $query->where('detalle_ventas.cantidad', 'LIKE', '%' . $this->search . '%')
                ->orWhere('detalle_ventas.descuento', 'LIKE', '%' . $this->search . '%')
                ->orWhere('detalle_ventas.precio_venta', 'LIKE', '%' . $this->search . '%')
                ->orWhere('detalle_ventas.subtotal', 'LIKE', '%' . $this->search . '%')
                ->orWhere('users.name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('ventas.tipo_comprobante', 'LIKE', '%' . $this->search . '%');
        })
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);

        return view('livewire.admin.historial.ver-ventas', compact('detalleVentas'));
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
