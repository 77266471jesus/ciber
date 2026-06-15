<?php

namespace App\Exports;

use App\Models\Ingreso;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class IngresosExport implements FromView
{
    public function view(): View
    {
        return view('admin.excel.ingresos-excel', [
            'ingresos' => Ingreso::all()
        ]);
    } 
}
