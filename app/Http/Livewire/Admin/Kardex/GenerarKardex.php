<?php

namespace App\Http\Livewire\Admin\Kardex;

use Livewire\Component;
use App\Models\kardex;
use App\Models\Producto;
use Carbon\Carbon;

class GenerarKardex extends Component
{
    public $fecha, $anio, $mes;
    public $producto_id;
    public $kardexs;
    public $cantidad;
    public $open_show = false;
    public $cargando = false;
    public $ingreso, $precio_total, $kardex_fecha;
    public $mesKardexs, $producto;
    // actualizar producto
    public $kardex, $auxiliar;

    public function mount($producto_id)
    {
        $this->fecha = Carbon::now();
        $this->anio = $this->fecha->format('Y');
        $this->producto_id = $producto_id;
    }
    public function show($mes)
    {
        $this->mes = $mes;
        $this->mesKardexs = kardex::where('producto_id', $this->producto_id)
            ->whereYear('fecha', $this->anio)
            ->whereMonth('fecha', $this->mes)
            ->orderBy('fecha', 'asc')
            ->get();
        $this->producto = Producto::find($this->producto_id);
        $this->open_show = true;
    }
    public function generar()
    {        
        $this->kardexs = kardex::where('producto_id', $this->producto_id)
            ->orderBy('fecha', 'asc')
            ->get();
        $this->kardex();     
    }
    public function kardex()
    {
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
        $this->kardex = Producto::find($this->producto_id);
        $this->auxiliar = kardex::where('producto_id', $this->producto_id)
        ->orderBy('fecha', 'desc')
        ->first();
        $this->kardex->kardex = $this->auxiliar->precio_total;
        $this->kardex->save();
    }

    public function render()
    {
        $years = kardex::selectRaw('YEAR(fecha) as year')
            ->where('producto_id', $this->producto_id)
            ->groupBy('year')
            ->get();

        $months = kardex::selectRaw('MONTH(fecha) as month, SUM(cantidad_total) as cantidad')
            ->where('producto_id', $this->producto_id)
            ->whereYear('fecha', $this->anio)
            ->groupBy('month')
            ->get();

        return view('livewire.admin.kardex.generar-kardex', compact('years', 'months'));
    }
}
