<?php

namespace App\Http\Controllers\admin\excel;

use App\Http\Controllers\Controller;
use App\Models\kardex;
use App\Models\Producto;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KardexesExport;
use App\Exports\UsersExport;
use App\Exports\CategoriasExport;
use App\Exports\ClientesExport;
use App\Exports\CotizacionsExport;
use App\Exports\DetalleComprasExport;
use App\Exports\DetalleVentasExport;
use App\Exports\EstadosExport;
use App\Exports\HistorialsExport;
use App\Exports\IngresosExport;
use App\Exports\ProductosExport;
use App\Exports\ProveedorsExport;
use App\Exports\SubcategoriasExport;
use App\Exports\VentasExport;

class ExcelController extends Controller
{
    public function kardex($producto_id, $anio, $mes)
    {
        return (new KardexesExport)->Producto($producto_id)->Year($anio)->Month($mes)->download('kardex.xlsx');        
    }
    public function users()
    {
        return Excel::download(new UsersExport, 'usuarios.xlsx');
    }
    public function categorias()
    {
        return Excel::download(new CategoriasExport, 'categorias.xlsx');
    }
    public function subcategorias()
    {
        return Excel::download(new SubcategoriasExport, 'subcategorias.xlsx');
    }
    public function productos()
    {
        return Excel::download(new ProductosExport, 'productos.xlsx');
    }
    public function proveedors()
    {
        return Excel::download(new ProveedorsExport, 'proveedors.xlsx');
    }
    public function ingresos()
    {
        return Excel::download(new IngresosExport, 'ingresos.xlsx');
    }
    public function clientes()
    {
        return Excel::download(new ClientesExport, 'clientes.xlsx');
    }
    public function ventas()
    {
        return Excel::download(new VentasExport, 'ventas.xlsx');
    }
    public function cotizacions()
    {
        return Excel::download(new CotizacionsExport, 'cotizacions.xlsx');
    }
    public function registros($user_id, $fecha)
    {
        return (new HistorialsExport)->User($user_id)->Fecha($fecha)->download('registros.xlsx');        
    }
    public function historialcompra($producto_id, $fecha)
    {
        return (new DetalleComprasExport)->Producto($producto_id)->Fecha($fecha)->download('detalleIngreso.xlsx');        
    }
    public function historialventa($producto_id, $fecha)
    {
        return (new DetalleVentasExport)->Producto($producto_id)->Fecha($fecha)->download('detalleVenta.xlsx');        
    }
    public function estados()
    {
        return Excel::download(new EstadosExport, 'estado_resultados.xlsx');
    }
}

