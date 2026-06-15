<?php

namespace App\Http\Livewire\Admin\Estadistica;

use App\Models\Ingreso;
use Carbon\Carbon;
use Livewire\Component;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class ProveedorEstadistica extends Component
{
    public $date, $fecha;
    public $datalleCompras;
    public $dia, $mes, $anio;
    public $rango = 10;
    public $consulta = 'dia';

    public function mount()
    {
        $this->date = Carbon::now();
        $this->fecha = $this->date->format('Y-m-d');
        $this->dia = $this->date->format('Y-m-d');

        $this->datalleCompras = Ingreso::selectRaw('proveedors.nombre as nombre, SUM(ingresos.total_compra) as cantidad')
            ->join('proveedors', 'ingresos.proveedor_id', '=', 'proveedors.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('ingresos.fecha', 'like', '%' . $this->fecha . '%')
            ->groupBy('nombre')
            ->orderBy('cantidad', 'desc')
            ->take($this->rango)
            ->get();
    }
    public function UpdatedDia()
    {
        $this->datalleCompras = Ingreso::selectRaw('proveedors.nombre as nombre, SUM(ingresos.total_compra) as cantidad')
            ->join('proveedors', 'ingresos.proveedor_id', '=', 'proveedors.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('ingresos.fecha', 'like', '%' . $this->dia . '%')
            ->groupBy('nombre')
            ->orderBy('cantidad', 'desc')
            ->take($this->rango)
            ->get();
    }
    public function UpdatedMes()
    {
        $this->datalleCompras = Ingreso::selectRaw('proveedors.nombre as nombre, SUM(ingresos.total_compra) as cantidad')
            ->join('proveedors', 'ingresos.proveedor_id', '=', 'proveedors.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('ingresos.fecha', 'like', '%' . $this->mes . '%')
            ->groupBy('nombre')
            ->orderBy('cantidad', 'desc')
            ->take($this->rango)
            ->get();
    }
    public function UpdatedAnio()
    {
        $this->datalleCompras = Ingreso::selectRaw('proveedors.nombre as nombre, SUM(ingresos.total_compra) as cantidad')
            ->join('proveedors', 'ingresos.proveedor_id', '=', 'proveedors.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('ingresos.fecha', 'like', '%' . $this->anio . '%')
            ->groupBy('nombre')
            ->orderBy('cantidad', 'desc')
            ->take($this->rango)
            ->get();
    }

    public function render()
    {
        $compras = $this->datalleCompras;
        if ($compras->count()) {
            $columnChartModelCompras = $compras
                ->reduce(
                    function (ColumnChartModel $columnChartModel, $data) {
                        $type = $data->nombre;
                        $value = $data->cantidad;
                        $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                        return $columnChartModel->addColumn($type, $value, $color);
                    },
                    (new ColumnChartModel())
                        ->setTitle('Registro de Venta de Productos')
                        ->withOnColumnClickEventName('onColumnClick')
                        ->withoutLegend()
                );
        } else {
            $columnChartModelCompras = null;
        }

        $years = Ingreso::selectRaw('YEAR(fecha) as year')
            ->where('estado', 'aceptado')
            ->groupBy('year')
            ->get();

        return view('livewire.admin.estadistica.proveedor-estadistica', compact('years'))
        ->with([
            'columnChartModelCompras' => $columnChartModelCompras,
        ]);
    }
}
