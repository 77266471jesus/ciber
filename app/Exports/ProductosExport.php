<?php

namespace App\Exports;

use App\Models\Producto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductosExport implements FromView
{
    public function view(): View
    {
        return view('admin.excel.productos-excel', [
            'productos' => Producto::all()
        ]);
    }
}
