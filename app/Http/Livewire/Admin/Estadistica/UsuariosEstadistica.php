<?php

namespace App\Http\Livewire\Admin\Estadistica;

use App\Models\Ingreso;
use App\Models\Venta;
use Carbon\Carbon;
use Livewire\Component;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class UsuariosEstadistica extends Component
{
    public $date, $fecha;
    public $detalleVentas, $datalleCompras;
    public $dia, $mes, $anio;
    public $consulta = 'dia';

    public function mount()
    {
        $this->date = Carbon::now();
        $this->fecha = $this->date->format('Y-m-d');
        $this->dia = $this->date->format('Y-m-d');

        $this->detalleVentas = Venta::selectRaw('users.name as nombre, SUM(ventas.total_venta) as cantidad')
            ->join('users', 'ventas.user_id', '=', 'users.id')
            ->where('ventas.estado', 'aceptado')
            ->where('ventas.fecha', 'like', '%' . $this->fecha . '%')
            ->groupBy('nombre')
            ->orderBy('cantidad', 'desc')
            ->get();

        $this->datalleCompras = Ingreso::selectRaw('users.name as nombre, SUM(ingresos.total_compra) as cantidad')
            ->join('users', 'ingresos.user_id', '=', 'users.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('ingresos.fecha', 'like', '%' . $this->fecha . '%')
            ->groupBy('nombre')
            ->orderBy('cantidad', 'desc')
            ->get();
    }
    public function UpdatedDia()
    {
        $this->detalleVentas = Venta::selectRaw('users.name as nombre, SUM(ventas.total_venta) as cantidad')
            ->join('users', 'ventas.user_id', '=', 'users.id')
            ->where('ventas.estado', 'aceptado')
            ->where('ventas.fecha', 'like', '%' . $this->dia . '%')
            ->groupBy('nombre')
            ->orderBy('cantidad', 'desc')
            ->get();

        $this->datalleCompras = Ingreso::selectRaw('users.name as nombre, SUM(ingresos.total_compra) as cantidad')
            ->join('users', 'ingresos.user_id', '=', 'users.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('ingresos.fecha', 'like', '%' . $this->dia . '%')
            ->groupBy('nombre')
            ->orderBy('cantidad', 'desc')
            ->get();
    }
    public function UpdatedMes()
    {
        $this->detalleVentas = Venta::selectRaw('users.name as nombre, SUM(ventas.total_venta) as cantidad')
            ->join('users', 'ventas.user_id', '=', 'users.id')
            ->where('ventas.estado', 'aceptado')
            ->where('ventas.fecha', 'like', '%' . $this->mes . '%')
            ->groupBy('nombre')
            ->orderBy('cantidad', 'desc')
            ->get();

        $this->datalleCompras = Ingreso::selectRaw('users.name as nombre, SUM(ingresos.total_compra) as cantidad')
            ->join('users', 'ingresos.user_id', '=', 'users.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('ingresos.fecha', 'like', '%' . $this->mes . '%')
            ->groupBy('nombre')
            ->orderBy('cantidad', 'desc')
            ->get();
    }
    public function UpdatedAnio()
    {
        $this->detalleVentas = Venta::selectRaw('users.name as nombre, SUM(ventas.total_venta) as cantidad')
            ->join('users', 'ventas.user_id', '=', 'users.id')
            ->where('ventas.estado', 'aceptado')
            ->where('ventas.fecha', 'like', '%' . $this->anio . '%')
            ->groupBy('nombre')
            ->orderBy('cantidad', 'desc')
            ->get();

        $this->datalleCompras = Ingreso::selectRaw('users.name as nombre, SUM(ingresos.total_compra) as cantidad')
            ->join('users', 'ingresos.user_id', '=', 'users.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('ingresos.fecha', 'like', '%' . $this->anio . '%')
            ->groupBy('nombre')
            ->orderBy('cantidad', 'desc')
            ->get();
    }


    public function render()
    {
        $ventas = $this->detalleVentas;
        $compras = $this->datalleCompras;
        if ($ventas->count()) {
            $columnChartModelVentas = $ventas
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
            $columnChartModelVentas = null;
        }
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
                        ->setTitle('Registro de Compra de Productos')
                        ->withOnColumnClickEventName('onColumnClick')
                        ->withoutLegend()
                );
        } else {
            $columnChartModelCompras = null;
        }

        $years = Venta::selectRaw('YEAR(fecha) as year')
            ->where('estado', 'aceptado')
            ->groupBy('year')
            ->get();

        return view('livewire.admin.estadistica.usuarios-estadistica', compact('years'))
        ->with([
            'columnChartModelVentas' => $columnChartModelVentas,
            'columnChartModelCompras' => $columnChartModelCompras,
        ]);
    }
}
