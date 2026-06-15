<?php

namespace App\Exports;

use App\Models\Ingreso;
use App\Models\Producto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EstadosExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('admin.excel.estado-resultados', [
            'productos' => Producto::all(),
            'kardex' => Producto::sum('kardex'),
            'compras' => Producto::sum('compras'),
            'ventas' => Producto::sum('ventas'),
            'descuentos' => Producto::sum('descuentos'),
        ]);
    }
}
