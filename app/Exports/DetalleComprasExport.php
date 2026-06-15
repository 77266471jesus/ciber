<?php

namespace App\Exports;

use App\Models\DetalleIngreso;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class DetalleComprasExport implements FromView
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
        return view('admin.excel.detalleInreso-excel', [
            'detalleIngresos' => DetalleIngreso::selectRaw('ingresos.fecha as fecha, detalle_ingresos.cantidad as cantidad,
        detalle_ingresos.precio_compra as precio_compra, detalle_ingresos.precio_venta as precio_venta,
        detalle_ingresos.subtotal as subtotal, users.name as nombre, ingresos.tipo_comprobante as tipo_comprobante, 
        ingresos.comprobante as comprobante')
                ->join('ingresos', 'detalle_ingresos.ingreso_id', '=', 'ingresos.id')
                ->join('users', 'detalle_ingresos.user_id', '=', 'users.id')
                ->where('ingresos.fecha', 'LIKE', '%' . $this->fecha . '%')
                ->where('detalle_ingresos.producto_id', $this->producto)
                ->where('ingresos.estado', 'aceptado')
                ->orderBy('ingresos.fecha', 'asc')
                ->get()
        ]);
    }
}
