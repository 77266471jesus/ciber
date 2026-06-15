<?php

namespace App\Http\Livewire\Pagina;

use App\Models\DetalleVenta;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

class ProductosNoVendidos extends Component
{
    public $date, $fecha;
    public $detalleVenta;

    public function mount()
    {
        $this->date = Carbon::now();
        $this->fecha = $this->date->format('Y');
        $this->detalleVenta = DetalleVenta::select('producto_id')
        ->whereYear('created_at', '<', $this->fecha)
        ->get();
    }

    public function render()
    {
        $productos = Producto::whereIn('id', $this->detalleVenta)
        ->orderBy('stock', 'asc')
        ->get();

        return view('livewire.pagina.productos-no-vendidos', compact('productos'));
    }
}
