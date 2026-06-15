<?php

namespace App\Http\Livewire\Admin\Kardex;

use App\Models\DetalleIngreso;
use App\Models\DetalleVenta;
use App\Models\kardex;
use Livewire\WithPagination;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

class Kardexs extends Component
{
    use WithPagination;

    public $search, $fecha, $anio;
    public $sort = 'id';
    public $direction = 'desc';
    public $resultados;
    public $consulta = 'anio';
    public $kardex, $ventas, $prueba;
    // por kardex 
    public $producto_id;
    public $kardexs;
    public $cantidad;
    public $ingreso, $precio_total, $kardex_fecha;
    public $mesKardexs, $productoss;

    /// variable de exportar
    public $estados = 1;

    public function mount()
    {
        $this->date = Carbon::now();
        $this->fecha = $this->date->format('Y');
        $this->prueba = kardex::where('producto_id', 1)
            ->orderBy('fecha', 'desc')
            ->first();
        $this->estados = 1;
    }

    public function resultado()
    {
        $this->resultados = Producto::all();
        foreach ($this->resultados as $resultado) {
            $resultado->compras = DetalleIngreso::join('ingresos', 'detalle_ingresos.ingreso_id', '=', 'ingresos.id')
                ->where('detalle_ingresos.producto_id', $resultado->id)
                ->where('ingresos.estado', 'aceptado')
                ->sum('detalle_ingresos.subtotal');

            $this->ventas = DetalleVenta::join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
                ->where('detalle_ventas.producto_id', $resultado->id)
                ->where('ventas.estado', 'aceptado')
                ->sum('detalle_ventas.subtotal');

            $resultado->ventas = $this->ventas + ($this->ventas * 0.13);

            $this->kardex = kardex::where('producto_id', $resultado->id)
                ->orderBy('fecha', 'desc')
                ->first();

            $resultado->kardex = $this->kardex->precio_total;

            $resultado->descuentos = DetalleVenta::join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
                ->where('detalle_ventas.producto_id', $resultado->id)
                ->where('ventas.estado', 'aceptado')
                ->sum('detalle_ventas.descuento');

            $resultado->save();
        }

        $this->estados = 2;
    }

    public function kardex()
    {
        $this->productoss = Producto::select('id')->get();
        foreach ($this->productoss as $producto) {
            $this->producto_id = $producto->id;
            $this->kardexs = kardex::where('producto_id', $this->producto_id)
                ->orderBy('fecha', 'asc')
                ->get();
            foreach ($this->kardexs as $kardex) {
                if ($kardex->estado == 'ingreso') {
                    if ($kardex->inicio == 'inicio') {
                        $this->kardex_fecha = $kardex->fecha;
                        $kardex->cantidad = $kardex->cantidad_total;
                        $kardex->cantidad_detalle = $kardex->cantidad_total;
                        $kardex->save();
                    } else {
                        $this->ingreso = kardex::where('producto_id', $this->producto_id)
                            ->where('fecha',  $this->kardex_fecha)
                            ->first();
                        $kardex->cantidad_total = $kardex->cantidad_entrada + $this->ingreso->cantidad_total;
                        $kardex->precio_total = $kardex->precio_entrada + $this->ingreso->precio_total;
                        $kardex->cantidad = $kardex->cantidad_entrada;
                        $this->kardex_fecha = $kardex->fecha;
                        $kardex->save();
                    }
                }
                if ($kardex->estado == 'egreso') {
                    $kardex->cantidad_salida = $kardex->cantidad_detalle;
                    $kardex->save();
                    $this->egreso = kardex::where('producto_id', $this->producto_id)
                        ->where('fecha',  $this->kardex_fecha)
                        ->first();
                    $this->cantidad = kardex::where('producto_id', $this->producto_id)
                        ->where('cantidad', '>', 0)
                        ->where('estado', 'ingreso')
                        ->orderBy('fecha', 'asc')
                        ->first();
                    if ($kardex->cantidad_salida > $this->cantidad->cantidad) {

                        $kardex->cantidad = $kardex->cantidad_salida - $this->cantidad->cantidad;
                        $kardex->costo_unitario = $this->cantidad->costo_unitario;
                        $kardex->cantidad_salida = $this->cantidad->cantidad;
                        $kardex->precio_salida = $this->cantidad->costo_unitario * $this->cantidad->cantidad;
                        $kardex->cantidad_total = $this->egreso->cantidad_total - $this->cantidad->cantidad;
                        $kardex->precio_total = $this->egreso->precio_total -  ($this->cantidad->costo_unitario * $this->cantidad->cantidad);
                        $kardex->egreso_detalle = 'salida ' . $this->cantidad->cantidad . ' de ' . $this->cantidad->detalle . ' fecha ' . $this->cantidad->fecha;
                        $this->cantidad->cantidad = $this->cantidad->cantidad - $this->cantidad->cantidad;
                        $this->cantidad->save();
                        $kardex->save();
                        $this->cantidad = kardex::where('producto_id', $this->producto_id)
                            ->where('cantidad', '>', 0)
                            ->where('estado', 'ingreso')
                            ->orderBy('fecha', 'asc')
                            ->first();
                        if ($kardex->cantidad > $this->cantidad->cantidad) {
                            while ($kardex->cantidad > $this->cantidad->cantidad) {

                                $kardex->cantidad = $kardex->cantidad - $this->cantidad->cantidad;
                                $kardex->cantidad_salida = $kardex->cantidad_salida + $this->cantidad->cantidad;
                                $kardex->precio_salida = $kardex->precio_salida + ($this->cantidad->costo_unitario * $this->cantidad->cantidad);
                                $kardex->costo_unitario = $kardex->precio_salida / $kardex->cantidad_salida;
                                $kardex->cantidad_total = $this->egreso->cantidad_total - $kardex->cantidad_salida;
                                $kardex->precio_total = $this->egreso->precio_total - $kardex->precio_salida;
                                $kardex->egreso_detalle = $kardex->egreso_detalle . '; ' . 'salida ' . $this->cantidad->cantidad . ' de ' . $this->cantidad->detalle . ' fecha ' . $this->cantidad->fecha;
                                $this->cantidad->cantidad = $this->cantidad->cantidad - $this->cantidad->cantidad;
                                $this->cantidad->cantidad = $this->cantidad->cantidad - $this->cantidad->cantidad;
                                $this->cantidad->save();
                                $kardex->save();
                                $this->cantidad = kardex::where('producto_id', $this->producto_id)
                                    ->where('cantidad', '>', 0)
                                    ->where('estado', 'ingreso')
                                    ->orderBy('fecha', 'asc')
                                    ->first();
                            }
                            $this->cantidad->cantidad = $this->cantidad->cantidad - $kardex->cantidad;
                            $kardex->cantidad_salida = $kardex->cantidad_salida + $kardex->cantidad;
                            $kardex->precio_salida = $kardex->precio_salida + ($this->cantidad->costo_unitario * $kardex->cantidad);
                            $kardex->costo_unitario = $kardex->precio_salida / $kardex->cantidad_salida;
                            $kardex->cantidad_total = $this->egreso->cantidad_total - $kardex->cantidad_salida;
                            $kardex->precio_total = $this->egreso->precio_total - $kardex->precio_salida;
                            $kardex->egreso_detalle = $kardex->egreso_detalle . '; ' . 'salida ' . $kardex->cantidad . ' de ' . $this->cantidad->detalle . ' fecha ' . $this->cantidad->fecha;
                            $kardex->cantidad = $kardex->cantidad - $kardex->cantidad;
                            $this->cantidad->save();
                            $kardex->save();
                        } else {
                            $this->cantidad->cantidad = $this->cantidad->cantidad - $kardex->cantidad;
                            $kardex->cantidad_salida = $kardex->cantidad_salida + $kardex->cantidad;
                            $kardex->precio_salida = $kardex->precio_salida + ($this->cantidad->costo_unitario * $kardex->cantidad);
                            $kardex->costo_unitario = $kardex->precio_salida / $kardex->cantidad_salida;
                            $kardex->cantidad_total = $this->egreso->cantidad_total - $kardex->cantidad_salida;
                            $kardex->precio_total = $this->egreso->precio_total - $kardex->precio_salida;
                            $kardex->egreso_detalle = $kardex->egreso_detalle . '; ' . 'salida ' . $kardex->cantidad . ' de ' . $this->cantidad->detalle . ' fecha ' . $this->cantidad->fecha;
                            $kardex->cantidad = $kardex->cantidad - $kardex->cantidad;
                            $this->cantidad->save();
                            $kardex->save();
                        }
                    } else {
                        $kardex->costo_unitario = $this->cantidad->costo_unitario;
                        $kardex->precio_salida = $this->cantidad->costo_unitario * $kardex->cantidad_salida;
                        $kardex->cantidad_total = $this->egreso->cantidad_total - $kardex->cantidad_salida;
                        $kardex->precio_total = $this->egreso->precio_total -  $kardex->precio_salida;
                        $kardex->egreso_detalle = 'salida ' . $kardex->cantidad_salida . ' de ' . $this->cantidad->detalle . ' fecha ' . $this->cantidad->fecha;
                        $kardex->cantidad = $kardex->cantidad - $kardex->cantidad;
                        $this->cantidad->cantidad = $this->cantidad->cantidad - $kardex->cantidad_salida;
                        $this->cantidad->save();
                        $kardex->save();
                    }
                    $this->acumulador = 2;
                    $this->kardex_fecha = $kardex->fecha;
                }
            }
        }
    }

    public function render()
    {
        $productos = kardex::selectRaw('productos.id as id, productos.nombre as nombre, 
        productos.marca as marca, productos.condicion as condicion')
            ->join('productos', 'kardexes.producto_id', '=', 'productos.id')
            ->where('nombre', 'like', '%' . $this->search . '%')
            ->orwhere('marca', 'like', '%' . $this->search . '%')
            ->groupBy('id', 'nombre', 'marca', 'condicion')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        $anios = Kardex::selectRaw('YEAR(fecha) as fecha')
            ->groupBy('fecha')
            ->get();

        $button = kardex::orderBy('fecha', 'desc')
            ->first();

        return view('livewire.admin.kardex.kardexs', compact('productos', 'anios', 'button'));
    }

    public function order($sort)
    {
        if ($this->sort == $sort) {

            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
