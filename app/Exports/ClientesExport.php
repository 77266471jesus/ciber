<?php

namespace App\Exports;

use App\Models\Cliente;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClientesExport implements FromView
{
    public function view(): View
    {
        return view('admin.excel.clientes-excel', [
            'clientes' => Cliente::all()
        ]);
    } 
}
