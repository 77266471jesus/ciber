<?php

namespace App\Exports;

use App\Models\Venta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VentasExport implements FromView
{
    public function view(): View
    {
        return view('admin.excel.ventas-excel', [
            'ventas' => Venta::all()
        ]);
    } 
}
