<?php

namespace App\Exports;

use App\Models\DetalleVenta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class DetalleVentasExport implements FromView
{
    use Exportable;

    public function Producto(int $producto)
    {
        $this->producto = $producto;
        return $this;
    }

    public function Fecha(string $fecha)
    {
        $this->fecha = $fecha;
        return $this;
    }

    public function view(): View
    {
        return view('admin.excel.detalleVentas-excel', [
            'detalleVentas' => DetalleVenta::selectRaw('ventas.fecha as fecha, detalle_ventas.cantidad as cantidad,
            detalle_ventas.precio_venta as precio_venta, detalle_ventas.descuento as descuento,
            detalle_ventas.subtotal as subtotal, users.name as nombre, ventas.tipo_comprobante as tipo_comprobante, 
            ventas.comprobante as comprobante')
                ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
                ->join('users', 'detalle_ventas.user_id', '=', 'users.id')
                ->where('detalle_ventas.created_at', 'LIKE', '%' . $this->fecha . '%')
                ->where('detalle_ventas.producto_id', $this->producto)
                ->where('ventas.estado', 'aceptado')
                ->orderBy('ventas.fecha', 'asc')
                ->get()
        ]);
    }
}
