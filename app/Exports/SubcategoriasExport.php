<?php

namespace App\Exports;

use App\Models\Subcategoria;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SubcategoriasExport implements FromView
{
    public function view(): View
    {
        return view('admin.excel.subcategorias-excel', [
            'subcategorias' => Subcategoria::all()
        ]);
    }
}
