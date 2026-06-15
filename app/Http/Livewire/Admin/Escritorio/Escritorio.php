<?php

namespace App\Http\Livewire\Admin\Escritorio;

use App\Models\kardex;
use App\Models\Venta;
use App\Models\Ingreso;
use Livewire\Component;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Carbon\Carbon;

class Escritorio extends Component
{
    public $date, $fecha;
    public $ingresos, $ingresosTotal;
    public $ventas, $ventasTotal;
    public $dia, $mes, $anio, $inicio, $fin;
    public $consulta = 'dia';

    public function mount()
    {
        $this->date = Carbon::now();
        $this->fecha = $this->date->format('Y-m-d');
        $this->dia = $this->date->format('Y-m-d');
        $this->fin = $this->fecha;
        $this->inicio = $this->fecha;
        $this->ventas = Venta::selectRaw('total_venta, TIME(fecha) as fechas')
            ->where('fecha', 'like', '%' . $this->fecha . '%')
            ->where('estado', 'aceptado')
            ->get();
        $this->ventasTotal = Venta::where('fecha', 'like', '%' . $this->fecha . '%')
            ->where('estado', 'aceptado')
            ->sum('total_venta');
        $this->ingresos = Ingreso::selectRaw('total_compra, TIME(fecha) as fechas')
            ->where('fecha', 'like', '%' . $this->fecha . '%')
            ->where('estado', 'aceptado')
            ->get();
        $this->ingresosTotal = Ingreso::where('fecha', 'like', '%' . $this->fecha . '%')
            ->where('estado', 'aceptado')
            ->sum('total_compra');
    }
    public function UpdatedConsulta()
    {
        $this->dia = null;
        $this->mes = null;
        $this->anio = null;
        $this->ventasTotal = null;
        $this->ingresosTotal = null;
    }
    public function UpdatedDia()
    {
        $this->fecha = $this->dia;
        $this->ventas = Venta::selectRaw('total_venta, TIME(fecha) as fechas')
            ->where('fecha', 'like', '%' . $this->fecha . '%')
            ->where('estado', 'aceptado')
            ->get();
        $this->ventasTotal = Venta::where('fecha', 'like', '%' . $this->fecha . '%')
            ->where('estado', 'aceptado')
            ->sum('total_venta');
        $this->ingresos = Ingreso::selectRaw('total_compra, TIME(fecha) as fechas')
            ->where('fecha', 'like', '%' . $this->fecha . '%')
            ->where('estado', 'aceptado')
            ->get();
        $this->ingresosTotal = Ingreso::where('fecha', 'like', '%' . $this->fecha . '%')
            ->where('estado', 'aceptado')
            ->sum('total_compra');
    }
    public function UpdatedMes()
    {
        $this->ventas = Venta::selectRaw('SUM(total_venta) as total_venta, DAY(fecha) as fechas')
            ->where('fecha', 'like', '%' . $this->mes . '%')
            ->where('estado', 'aceptado')
            ->groupBy('fechas')
            ->get();
        $this->ventasTotal = Venta::where('fecha', 'like', '%' . $this->mes . '%')
            ->where('estado', 'aceptado')
            ->sum('total_venta');
        $this->ingresos = Ingreso::selectRaw('SUM(total_compra) as total_compra, DAY(fecha) as fechas')
            ->where('fecha', 'like', '%' . $this->mes . '%')
            ->where('estado', 'aceptado')
            ->groupBy('fechas')
            ->get();
        $this->ingresosTotal = Ingreso::where('fecha', 'like', '%' . $this->mes . '%')
            ->where('estado', 'aceptado')
            ->sum('total_compra');
    }
    public function UpdatedAnio()
    {
        $this->ventas = Venta::selectRaw('SUM(total_venta) as total_venta, MONTH(fecha) as fechas')
            ->where('fecha', 'like', '%' . $this->anio . '%')
            ->where('estado', 'aceptado')
            ->groupBy('fechas')
            ->get();
        $this->ventasTotal = Venta::where('fecha', 'like', '%' . $this->anio . '%')
            ->where('estado', 'aceptado')
            ->sum('total_venta');
        $this->ingresos = Ingreso::selectRaw('SUM(total_compra) as total_compra, MONTH(fecha) as fechas')
            ->where('fecha', 'like', '%' . $this->anio . '%')
            ->where('estado', 'aceptado')
            ->groupBy('fechas')
            ->get();
        $this->ingresosTotal = Ingreso::where('fecha', 'like', '%' . $this->anio . '%')
            ->where('estado', 'aceptado')
            ->sum('total_compra');
    }
    public function UpdatedInicio()
    {
        $this->ventas = Venta::selectRaw('SUM(total_venta) as total_venta, DAY(fecha) as fechas')
            ->whereDate("fecha", ">=",  $this->inicio)
            ->whereDate("fecha", "<=",  $this->fin)
            ->where('estado', 'aceptado')
            ->groupBy('fechas')
            ->get();
        $this->ventasTotal = Venta::whereDate("fecha", ">=",  $this->inicio)
            ->whereDate("fecha", "<=",  $this->fin)
            ->where('estado', 'aceptado')
            ->sum('total_venta');
        $this->ingresos = Ingreso::selectRaw('SUM(total_compra) as total_compra, DAY(fecha) as fechas')
            ->whereDate("fecha", ">=",  $this->inicio)
            ->whereDate("fecha", "<=",  $this->fin)
            ->where('estado', 'aceptado')
            ->groupBy('fechas')
            ->get();
        $this->ingresosTotal = Ingreso::whereDate("fecha", ">=",  $this->inicio)
            ->whereDate("fecha", "<=",  $this->fin)
            ->where('estado', 'aceptado')
            ->sum('total_compra');
    }
    public function UpdatedFin()
    {
        $this->ventas = Venta::selectRaw('SUM(total_venta) as total_venta, DAY(fecha) as fechas')
            ->whereDate("fecha", ">=",  $this->inicio)
            ->whereDate("fecha", "<=",  $this->fin)
            ->where('estado', 'aceptado')
            ->groupBy('fechas')
            ->get();
        $this->ventasTotal = Venta::whereDate("fecha", ">=",  $this->inicio)
            ->whereDate("fecha", "<=",  $this->fin)
            ->where('estado', 'aceptado')
            ->sum('total_venta');
        $this->ingresos = Ingreso::selectRaw('SUM(total_compra) as total_compra, DAY(fecha) as fechas')
            ->whereDate("fecha", ">=",  $this->inicio)
            ->whereDate("fecha", "<=",  $this->fin)
            ->where('estado', 'aceptado')
            ->groupBy('fechas')
            ->get();
        $this->ingresosTotal = Ingreso::whereDate("fecha", ">=",  $this->inicio)
            ->whereDate("fecha", "<=",  $this->fin)
            ->where('estado', 'aceptado')
            ->sum('total_compra');
    }

    public function render()
    {
        $ventas = $this->ventas;
        $ingresos = $this->ingresos;
        $ingresosTotal = $this->ingresosTotal;
        if ($ingresos->count()) {
            $columnChartModelCompras = $ingresos
                ->reduce(
                    function (ColumnChartModel $columnChartModel, $data) {
                        $type = $data->fechas;
                        $value = $data->total_compra;
                        $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                        return $columnChartModel->addColumn($type, $value, $color);
                    },
                    (new ColumnChartModel())
                        ->setTitle('Registro de Ingresos de Productos')
                        ->withOnColumnClickEventName('onColumnClick')
                );
        } else {
            $columnChartModelCompras = null;
        }
        $ventasTotal = $this->ventasTotal;
        if ($ventas->count()) {
            $columnChartModelVentas = $ventas
                ->reduce(
                    function (ColumnChartModel $columnChartModel, $data) {
                        $type = $data->fechas;
                        $value = $data->total_venta;
                        $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                        return $columnChartModel->addColumn($type, $value, $color);
                    },
                    (new ColumnChartModel())
                        ->setTitle('Registro de Venta de Productos')
                        ->withOnColumnClickEventName('onColumnClick')
                );
        } else {
            $columnChartModelVentas = null;
        }

        $years = kardex::selectRaw('YEAR(fecha) as year')
            ->groupBy('year')
            ->get();

        return view('livewire.admin.escritorio.escritorio', compact('ventasTotal', 'ventas', 'years'))
            ->with([
                'columnChartModelVentas' => $columnChartModelVentas,
                'columnChartModelCompras' => $columnChartModelCompras,
            ]);
    }
}
