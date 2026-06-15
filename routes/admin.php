<?php

use App\Http\Controllers\admin\roles\RoleController;
use App\Http\Controllers\upload;
use App\Http\Controllers\UploadController;
use App\Http\Livewire\Admin\Backup\Backups;
use App\Http\Livewire\Admin\Bienvenida\Bienvenida;
use App\Http\Livewire\Admin\Categorias\Categorias;
use App\Http\Livewire\Admin\Chatbot\Chatbots;
use App\Http\Livewire\Admin\Clientes\Clientes;
use App\Http\Livewire\Admin\Cotizacion\Cotizacions;
use App\Http\Livewire\Admin\Cotizacion\CreateCotizacions;
use App\Http\Livewire\Admin\Escritorio\Escritorio;
use App\Http\Livewire\Admin\Estadistica\ClienteEstadistica;
use App\Http\Livewire\Admin\Estadistica\ComprasEstaditica;
use App\Http\Livewire\Admin\Estadistica\ProductoEstadistica;
use App\Http\Livewire\Admin\Estadistica\ProductoEstadisticaHistorial;
use App\Http\Livewire\Admin\Estadistica\ProductoVenta;
use App\Http\Livewire\Admin\Estadistica\ProveedorEstadistica;
use App\Http\Livewire\Admin\Estadistica\UsuariosEstadistica;
use App\Http\Livewire\Admin\Estadistica\VentasEstaditica;
use App\Http\Livewire\Admin\Historial\ComprasHistorial;
use App\Http\Livewire\Admin\Historial\CotizacionHistorial;
use App\Http\Livewire\Admin\Historial\VentasHistorial;
use App\Http\Livewire\Admin\Historial\VerCompras;
use App\Http\Livewire\Admin\Historial\VerVentas;
use App\Http\Livewire\Admin\Ingresos\CreateIngresos;
use App\Http\Livewire\Admin\Ingresos\Ingresos;
use App\Http\Livewire\Admin\Kardex\GenerarKardex;
use App\Http\Livewire\Admin\Kardex\Kardexs;
use App\Http\Livewire\Admin\Personal\Personals;
use App\Http\Livewire\Admin\Productos\Productos;
use App\Http\Livewire\Admin\Proveedors\Proveedors;
use App\Http\Livewire\Admin\Registro\Registros;
use App\Http\Livewire\Admin\Registro\VerRegistros;
use App\Http\Livewire\Admin\Roles\Roles;
use App\Http\Livewire\Admin\Subcategorias\Subcategorias;
use App\Http\Livewire\Admin\Usuarios\ClienteUsuario;
use App\Http\Livewire\Admin\Usuarios\Users;
use App\Http\Livewire\Admin\Ventas\CreateVenta;
use App\Http\Livewire\Admin\Ventas\Ventas;
use Illuminate\Support\Facades\Route;

Route::post('/upload', [UploadController::class, 'store'])->name('upload');
//escritorio
Route::middleware(['auth:sanctum', 'verified', 'can:admin.escritorio'])->get('/',Escritorio::class)->name('admin.escritorio');
//roles
Route::middleware(['auth:sanctum', 'verified', 'can:admin.roles'])->resource('/roles', RoleController::class)->names('admin.roles');
//usuarios
Route::middleware(['auth:sanctum', 'verified', 'can:admin.usuarios'])->get('/usuarios',Users::class)->name('admin.usuarios');
//usuario CLiente
Route::middleware(['auth:sanctum', 'verified', 'can:admin.usuarios'])->get('/usuarios-cliente',ClienteUsuario::class)->name('admin.usuarios.clientes');
//categorias
Route::middleware(['auth:sanctum', 'verified', 'can:admin.categorias'])->get('/categorias',Categorias::class)->name('admin.categorias');
//subcategorias
Route::middleware(['auth:sanctum', 'verified', 'can:admin.subcategorias'])->get('/subcategorias',Subcategorias::class)->name('admin.subcategorias');
//productos
Route::middleware(['auth:sanctum', 'verified', 'can:admin.productos'])->get('/productos',Productos::class)->name('admin.productos');
// compras 
Route::middleware(['auth:sanctum', 'verified', 'can:admin.proveedors'])->get('/proveedors',Proveedors::class)->name('admin.proveedors');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.ingresos'])->get('/ingresos',Ingresos::class)->name('admin.ingresos');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.create-ingreso'])->get('/crear-ingresos',CreateIngresos::class)->name('admin.create-ingreso');
// ventas 
Route::middleware(['auth:sanctum', 'verified', 'can:admin.clientes'])->get('/clientes',Clientes::class)->name('admin.clientes');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.ventas'])->get('/ventas',Ventas::class)->name('admin.ventas');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.create.venta'])->get('/crear-ventas',CreateVenta::class)->name('admin.create.venta');
// Cotizacions 
Route::middleware(['auth:sanctum', 'verified', 'can:admin.cotizacion'])->get('/cotizacion',Cotizacions::class)->name('admin.cotizacion');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.create.cotizacion'])->get('/crear-cotizacion',CreateCotizacions::class)->name('admin.create.cotizacion');
// Estadisticas
Route::middleware(['auth:sanctum', 'verified', 'can:admin.estadistica.producto'])->get('/estadistica-productos-cantidad',ProductoEstadistica::class)->name('admin.estadistica.productos.cantidad');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.estadistica.producto'])->get('/estadistica-productos-precio',ProductoVenta::class)->name('admin.estadistica.productos.suma');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.estadistica.producto'])->get('/estadistica-productos-historial',ProductoEstadisticaHistorial::class)->name('admin.estadistica.productos.historial');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.estadistica.usuario'])->get('/estadistica-usuarios',UsuariosEstadistica::class)->name('admin.estadistica.usuarios');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.estadistica.cliente'])->get('/estadistica-cliente',ClienteEstadistica::class)->name('admin.estadistica.cliente');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.estadistica.proveedor'])->get('/estadistica-proveedor',ProveedorEstadistica::class)->name('admin.estadistica.proveedor');
// generador de pdf 
Route::middleware(['auth:sanctum', 'verified', 'can:admin.factura'])->get('/factura/{id}', [App\Http\Controllers\pdf\PdfController::class, 'factura'])->name('admin.factura');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.boleta'])->get('/boleta/{id}', [App\Http\Controllers\pdf\PdfController::class, 'boleta'])->name('admin.boleta');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.proforma'])->get('/proforma/{id}', [App\Http\Controllers\pdf\PdfController::class, 'proforma'])->name('admin.proforma');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.kardex.pdf'])->get('/kardex-pdf/{producto_id}/{anio}/{mes}', [App\Http\Controllers\pdf\PdfController::class, 'kardex'])->name('admin.kardex.pdf');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.kardex.pdf'])->get('/resultados-pdf', [App\Http\Controllers\pdf\PdfController::class, 'estados'])->name('admin.estados.pdf');
//Excel
Route::middleware(['auth:sanctum', 'verified', 'can:admin.kardex.excel'])->get('/kardex-resultados', [App\Http\Controllers\admin\excel\ExcelController::class, 'estados'])->name('admin.estados.excel');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.kardex.excel'])->get('/kardex-excel/{producto_id}/{anio}/{mes}', [App\Http\Controllers\admin\excel\ExcelController::class, 'kardex'])->name('admin.kardex.excel');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.usuarios.excel'])->get('/users-excel', [App\Http\Controllers\admin\excel\ExcelController::class, 'users'])->name('admin.users.excel');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.categorias.excel'])->get('/categorias-excel', [App\Http\Controllers\admin\excel\ExcelController::class, 'categorias'])->name('admin.categorias.excel');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.subcategorias.excel'])->get('/subcategorias-excel', [App\Http\Controllers\admin\excel\ExcelController::class, 'subcategorias'])->name('admin.subcategorias.excel');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.productos.excel'])->get('/productos-excel', [App\Http\Controllers\admin\excel\ExcelController::class, 'productos'])->name('admin.productos.excel');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.proveedors.excel'])->get('/proveedors-excel', [App\Http\Controllers\admin\excel\ExcelController::class, 'proveedors'])->name('admin.proveedors.excel');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.ingresos.excel'])->get('/ingresos-excel', [App\Http\Controllers\admin\excel\ExcelController::class, 'ingresos'])->name('admin.ingresos.excel');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.clientes.excel'])->get('/clientes-excel', [App\Http\Controllers\admin\excel\ExcelController::class, 'clientes'])->name('admin.clientes.excel');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.ventas.excel'])->get('/ventas-excel', [App\Http\Controllers\admin\excel\ExcelController::class, 'ventas'])->name('admin.ventas.excel');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.cotizacion.excel'])->get('/cotizacions-excel', [App\Http\Controllers\admin\excel\ExcelController::class, 'cotizacions'])->name('admin.cotizacions.excel');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.registro.usuarios.excel'])->get('/registros-excel/{user_id}/{fecha}', [App\Http\Controllers\admin\excel\ExcelController::class, 'registros'])->name('admin.registros.excel');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.historial.compras.excel'])->get('/historialcompra-excel/{producto_id}/{fecha}', [App\Http\Controllers\admin\excel\ExcelController::class, 'historialcompra'])->name('admin.historialcompra.excel');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.historial.ventas.excel'])->get('/historialventa-excel/{producto_id}/{fecha}', [App\Http\Controllers\admin\excel\ExcelController::class, 'historialventa'])->name('admin.historialventa.excel');
// Historial
Route::middleware(['auth:sanctum', 'verified', 'can:admin.historial.ventas'])->get('/historial-ventas',VentasHistorial::class)->name('admin.historial.ventas');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.historial.ventas'])->get('/ver-historial-ventas/{producto_id}',VerVentas::class)->name('admin.ver.ventas.historial');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.historial.compras'])->get('/historial-compras',ComprasHistorial::class)->name('admin.historial.compras');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.historial.compras'])->get('/ver-historial-compras/{producto_id}',VerCompras::class)->name('admin.ver.compras.historial');
// Kardex 
Route::middleware(['auth:sanctum', 'verified', 'can:admin.kardex'])->get('/kardex',Kardexs::class)->name('admin.kardex');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.kardex'])->get('/generar-kardex/{producto_id}',GenerarKardex::class)->name('admin.generar-kardex');
//Registro de Actividad
Route::middleware(['auth:sanctum', 'verified', 'can:admin.registro.usuarios'])->get('/registros',Registros::class)->name('admin.registros');
Route::middleware(['auth:sanctum', 'verified', 'can:admin.registro.usuarios'])->get('/ver-registros/{user_id}',VerRegistros::class)->name('admin.ver.registros');

//Backups de sistema
Route::middleware(['auth:sanctum', 'verified', 'can:admin.backup'])->get('/respaldo', Backups::class)->name('admin.backup');

