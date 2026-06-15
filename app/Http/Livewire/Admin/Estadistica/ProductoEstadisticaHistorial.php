<?php

namespace App\Http\Livewire\Admin\Estadistica;

use App\Models\DetalleIngreso;
use App\Models\DetalleVenta;
use App\Models\kardex;
use App\Models\Producto;
use Livewire\Component;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Carbon\Carbon;

class ProductoEstadisticaHistorial extends Component
{
    public $date, $fecha;
    public $dia, $mes, $anio;
    public $consulta = 'dia';
    public $producto, $open_producto;
    public $nombre, $seleccion;
    public $detalleVentas, $datalleCompras;

    protected $rules = [
        'seleccion' =>  ['required'],
    ];
    public function mount()
    {
        $this->producto = new Producto();
        $this->date = Carbon::now();
        $this->fecha = $this->date->format('Y-m-d');
    }
    public function updatedNombre($value)
    {
        $this->open_producto = true;
    }
    public function producto(Producto $producto)
    {
        $this->producto = $producto;
        $this->detalleVentas = DetalleVenta::selectRaw('TIME(ventas.fecha) as producto, SUM(cantidad) as cantidad')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->where('ventas.estado', 'aceptado')
            ->where('detalle_ventas.producto_id', $this->producto->id)
            ->where('ventas.fecha', 'like', '%' . $this->fecha . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->get();

        $this->datalleCompras = DetalleIngreso::selectRaw('TIME(ingresos.fecha) as producto, SUM(cantidad) as cantidad')
            ->join('ingresos', 'detalle_ingresos.ingreso_id', '=', 'ingresos.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('detalle_ingresos.producto_id', $this->producto->id)
            ->where('ingresos.fecha', 'like', '%' . $this->fecha . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->get();
        $this->seleccion = $this->producto->nombre;
        $this->open_producto = false;
    }
    public function UpdatedDia()
    {
        $this->validate();
        $this->detalleVentas = DetalleVenta::selectRaw('TIME(ventas.fecha) as producto, SUM(cantidad) as cantidad')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->where('ventas.estado', 'aceptado')
            ->where('detalle_ventas.producto_id', $this->producto->id)
            ->where('ventas.fecha', 'like', '%' . $this->dia . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->get();

        $this->datalleCompras = DetalleIngreso::selectRaw('TIME(ingresos.fecha) as producto, SUM(cantidad) as cantidad')
            ->join('ingresos', 'detalle_ingresos.ingreso_id', '=', 'ingresos.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('detalle_ingresos.producto_id', $this->producto->id)
            ->where('ingresos.fecha', 'like', '%' . $this->dia . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->get();
        $this->resetValidation();
    }
    public function UpdatedMes()
    {
        $this->validate();
        $this->detalleVentas = DetalleVenta::selectRaw('DAY(ventas.fecha) as producto, SUM(cantidad) as cantidad')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->where('ventas.estado', 'aceptado')
            ->where('detalle_ventas.producto_id', $this->producto->id)
            ->where('ventas.fecha', 'like', '%' . $this->mes . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->get();

        $this->datalleCompras = DetalleIngreso::selectRaw('DAY(ingresos.fecha) as producto, SUM(cantidad) as cantidad')
            ->join('ingresos', 'detalle_ingresos.ingreso_id', '=', 'ingresos.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('detalle_ingresos.producto_id', $this->producto->id)
            ->where('ingresos.fecha', 'like', '%' . $this->mes . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->get();
        $this->resetValidation();
    }
    public function UpdatedAnio()
    {
        $this->validate();
        $this->detalleVentas = DetalleVenta::selectRaw('MONTH(ventas.fecha) as producto, SUM(cantidad) as cantidad')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->where('ventas.estado', 'aceptado')
            ->where('detalle_ventas.producto_id', $this->producto->id)
            ->where('ventas.fecha', 'like', '%' . $this->anio . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->get();

        $this->datalleCompras = DetalleIngreso::selectRaw('MONTH(ingresos.fecha) as producto, SUM(cantidad) as cantidad')
            ->join('ingresos', 'detalle_ingresos.ingreso_id', '=', 'ingresos.id')
            ->where('ingresos.estado', 'aceptado')
            ->where('detalle_ingresos.producto_id', $this->producto->id)
            ->where('ingresos.fecha', 'like', '%' . $this->anio . '%')
            ->groupBy('producto')
            ->orderBy('cantidad', 'desc')
            ->get();
        $this->resetValidation();
    }

    public function render()
    {
        $ventas = $this->detalleVentas;
        $compras = $this->datalleCompras;
        if ($this->seleccion) {
            if ($ventas->count()) {
                $columnChartModelVentas = $ventas
                    ->reduce(
                        function (ColumnChartModel $columnChartModel, $data) {
                            $type = $data->producto;
                            $value = $data->cantidad;
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
            if ($compras->count()) {
                $columnChartModelCompras = $compras
                    ->reduce(
                        function (ColumnChartModel $columnChartModel, $data) {
                            $type = $data->producto;
                            $value = $data->cantidad;
                            $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                            return $columnChartModel->addColumn($type, $value, $color);
                        },
                        (new ColumnChartModel())
                            ->setTitle('Registro de Compra de Productos')
                            ->withOnColumnClickEventName('onColumnClick')
                    );
            } else {
                $columnChartModelCompras = null;
            }
        } else {
            $columnChartModelVentas = null;
            $columnChartModelCompras = null;
        }

        $productos = Producto::where('nombre', 'like', '%' . $this->nombre . '%')
            ->get();
        $years = kardex::selectRaw('YEAR(fecha) as year')
            ->groupBy('year')
            ->get();

        return view('livewire.admin.estadistica.producto-estadistica-historial', compact('productos', 'years', 'ventas', 'compras'))
            ->with([
                'columnChartModelVentas' => $columnChartModelVentas,
                'columnChartModelCompras' => $columnChartModelCompras,
            ]);
    }
}
