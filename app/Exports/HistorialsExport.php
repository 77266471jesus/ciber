<?php

namespace App\Exports;

use App\Models\Historial;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class HistorialsExport implements FromView
{
    use Exportable;

    public function User(int $user)
    {
        $this->user = $user;
        return $this;
    }

    public function Fecha(string $fecha)
    {
        $this->fecha = $fecha;
        return $this;
    }

    public function view(): View
    {
        return view('admin.excel.registros-excel', [
            'historials' => Historial::where('fecha', 'LIKE', '%' . $this->fecha . '%')
            ->where('user_id', $this->user)
            ->orderBy('fecha', 'asc')
            ->get()
        ]);
    }
}
