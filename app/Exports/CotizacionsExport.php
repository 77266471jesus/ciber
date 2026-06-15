<?php

namespace App\Exports;

use App\Models\Cotizacion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CotizacionsExport implements FromView
{
    public function view(): View
    {
        return view('admin.excel.cotizacions-excel', [
            'cotizacions' => Cotizacion::all()
        ]);
    } 
}
