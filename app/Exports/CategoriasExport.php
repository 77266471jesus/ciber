<?php

namespace App\Exports;

use App\Models\Categoria;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CategoriasExport implements FromView
{
    public function view(): View
    {
        return view('admin.excel.categorias-excel', [
            'categorias' => Categoria::all()
        ]);
    } 
}
