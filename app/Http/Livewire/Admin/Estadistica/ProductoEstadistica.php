<?php

namespace App\Http\Livewire\Admin\Estadistica;

use App\Models\DetalleIngreso;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Carbon\Carbon;
use Livewire\Component;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class ProductoEstadistica extends Component
{
    public $date, $fecha;
    public $detalleVentas, $datalleCompras;
    public $dia, $mes, $anio;
    public $rango = 5;
    public $consulta = 'dia';

    public $firstRun = true;

    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }
    public function handleOnColumnClick($column)
    {
        dd($column);
    }

    public function mount()
    {
        $this->date = Carbon::now();
        $this->fecha = $this->date->format('Y-m-d');
        $this->dia = $this->date->format('Y-m-d');

        $this->detalleVentas = DetalleVenta::selectRaw('productos.nombre as producto, SUM(cantidad) as cantidad')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->join('productos', 'detalle_ventas.producto_id', '=', 'productos.id')
            ->where('ventas.estado', 'aceptado')
            ->where('ventas.fecha', 'like', '%' . $this->dia . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->take($this->rango)
            ->get();

        $this->datalleCompras = DetalleIngreso::selectRaw('productos.nombre as producto, SUM(cantidad) as cantidad')
            ->join('ingresos', 'detalle_ingresos.ingreso_id', '=', 'ingresos.id')
            ->join('productos', 'detalle_ingresos.producto_id', '=', 'productos.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('ingresos.fecha', 'like', '%' . $this->dia . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->take($this->rango)
            ->get();
    }
    public function UpdatedDia()
    {
        $this->fecha = $this->dia;
        $this->detalleVentas = DetalleVenta::selectRaw('productos.nombre as producto, SUM(cantidad) as cantidad')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->join('productos', 'detalle_ventas.producto_id', '=', 'productos.id')
            ->where('ventas.estado', 'aceptado')
            ->where('ventas.fecha', 'like', '%' . $this->fecha . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->take($this->rango)
            ->get();

        $this->datalleCompras = DetalleIngreso::selectRaw('productos.nombre as producto, SUM(cantidad) as cantidad')
            ->join('ingresos', 'detalle_ingresos.ingreso_id', '=', 'ingresos.id')
            ->join('productos', 'detalle_ingresos.producto_id', '=', 'productos.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('ingresos.fecha', 'like', '%' . $this->fecha . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->take($this->rango)
            ->get();
    }
    public function UpdatedMes()
    {
        $this->detalleVentas = DetalleVenta::selectRaw('productos.nombre as producto, SUM(cantidad) as cantidad')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->join('productos', 'detalle_ventas.producto_id', '=', 'productos.id')
            ->where('ventas.estado', 'aceptado')
            ->where('ventas.fecha', 'like', '%' . $this->mes . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->take($this->rango)
            ->get();

        $this->datalleCompras = DetalleIngreso::selectRaw('productos.nombre as producto, SUM(cantidad) as cantidad')
            ->join('ingresos', 'detalle_ingresos.ingreso_id', '=', 'ingresos.id')
            ->join('productos', 'detalle_ingresos.producto_id', '=', 'productos.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('ingresos.fecha', 'like', '%' . $this->mes . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->take($this->rango)
            ->get();
    }
    public function UpdatedAnio()
    {
        $this->detalleVentas = DetalleVenta::selectRaw('productos.nombre as producto, SUM(cantidad) as cantidad')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->join('productos', 'detalle_ventas.producto_id', '=', 'productos.id')
            ->where('ventas.estado', 'aceptado')
            ->where('ventas.fecha', 'like', '%' . $this->anio . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->take($this->rango)
            ->get();

        $this->datalleCompras = DetalleIngreso::selectRaw('productos.nombre as producto, SUM(cantidad) as cantidad')
            ->join('ingresos', 'detalle_ingresos.ingreso_id', '=', 'ingresos.id')
            ->join('productos', 'detalle_ingresos.producto_id', '=', 'productos.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('ingresos.fecha', 'like', '%' . $this->anio . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->take($this->rango)
            ->get();
    }

    public function render()
    {
        $productos = $this->detalleVentas;
        $compras = $this->datalleCompras;
        if ($productos->count()) {
            $columnChartModelVentas = $productos
                ->reduce(
                    function (ColumnChartModel $columnChartModel, $data) {
                        $type = $data->producto;
                        $value = $data->cantidad;
                        $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                        return $columnChartModel->addColumn($type, $value, $color);
                    },
                    (new ColumnChartModel())
                        ->setTitle('Registro de Venta de Productos')
                        ->setAnimated($this->firstRun)
                        // ->withoutDataLabels()
                        ->withoutLegend()
                        ->withOnColumnClickEventName('onColumnClick')
                );
        } else {
            $columnChartModelVentas = null;
        }
        if ($compras->count()) {
            $columnChartModelCompras = $compras
                ->reduce(
                    function (ColumnChartModel $columnChartModel, $data) {
                        // $type = substr($data->producto, 0, 5) . "...";
                        $type = $data->producto;
                        $value = $data->cantidad;
                        $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                        return $columnChartModel->addColumn($type, $value, $color);
                    },
                    (new ColumnChartModel())
                        ->setTitle('Registro de Compra de Productos')
                        ->setAnimated($this->firstRun)
                        // ->withoutDataLabels()
                        ->withoutLegend()
                        ->withOnColumnClickEventName('onColumnClick')
                );
        } else {
            $columnChartModelCompras = null;
        }

        $years = Venta::selectRaw('YEAR(fecha) as year')
            ->where('estado', 'aceptado')
            ->groupBy('year')
            ->get();

        return view('livewire.admin.estadistica.producto-estadistica', compact('productos', 'years', 'compras'))
            ->with([
                'columnChartModelVentas' => $columnChartModelVentas,
                'columnChartModelCompras' => $columnChartModelCompras,
            ]);
    }
}
