<?php

namespace App\Http\Controllers\pdf;

use App\Http\Controllers\Controller;
use App\Models\Cotizacion;
use App\Models\Ingreso;
use App\Models\kardex;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function factura($id)
    {
        $venta = Venta::find($id);
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.pdf.factura', ['venta' => $venta]);
        return $pdf->stream();
    }
    public function boleta($id)
    {
        $venta = Venta::find($id);
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.pdf.boleta', ['venta' => $venta]);
        return $pdf->stream();
    }
    public function proforma($id)
    {
        $cotizacion = Cotizacion::find($id);
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.pdf.proforma', ['cotizacion' => $cotizacion]);
        return $pdf->stream();
    }
    public function proformapagina($id)
    {
        $cotizacion = Cotizacion::find($id);
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.pdf.proforma', ['cotizacion' => $cotizacion]);
        return $pdf->download();
    }
    public function kardex($producto_id, $anio, $mes)
    {
        $kardexs = kardex::where('producto_id', $producto_id)
            ->whereYear('fecha', $anio)
            ->whereMonth('fecha', $mes)
            ->orderBy('fecha', 'asc')
            ->get();
        $producto = Producto::find($producto_id);
        $fecha = $anio . '/' . $mes;
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.pdf.kardex', ['kardexs' => $kardexs, 'producto' => $producto, 'fecha' => $fecha]);
        return $pdf->stream();
    }
    public function estados()
    {
        $productos = Producto::all();
        $kardex = Producto::sum('kardex');
        $compras = Producto::sum('compras');
        $ventas = Producto::sum('ventas');
        $descuentos = Producto::sum('descuentos');
        $comp = Ingreso::where('estado', 'aceptado')->sum('total_compra');
        $vent = Venta::where('estado', 'aceptado')->sum('total');
        $fecha = Carbon::now()->format('Y-m-d');;
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.pdf.estado-resultados', ['productos' => $productos, 'kardex' => $kardex, 'compras' => $compras, 'ventas' => $ventas, 'descuentos' => $descuentos, 'comp' => $comp, 'vent' => $vent, 'fecha' => $fecha]);
        return $pdf->stream();
    }
}

