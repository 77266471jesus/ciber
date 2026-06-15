<?php

namespace App\Exports;

use App\Models\kardex;
use App\Models\Producto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class KardexesExport implements FromView
{
    use Exportable;

    public function Producto(int $producto)
    {
        $this->producto = $producto;
        return $this;
    }

    public function Year(int $year)
    {
        $this->year = $year;
        return $this;
    }

    public function Month(int $month)
    {
        $this->month = $month;
        return $this;
    }    
    public function view(): View
    {
        return view('admin.excel.kardex', [
            'kardexs' => kardex::where('producto_id', $this->producto)
            ->whereYear('fecha', $this->year)
            ->whereMonth('fecha', $this->month)
            ->orderBy('fecha', 'asc')
            ->get(),
            'anio' => $this->year,
            'mes' => $this->month,
            'producto' => Producto::find($this->producto),
        ]);
    }
}
