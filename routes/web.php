<?php

use App\Http\Controllers\bot\BotmanController;
use App\Http\Controllers\ContactanosController;
use App\Http\Livewire\Pagina\HistorialCotizacion;
use App\Http\Livewire\Pagina\MostrarProducto;
use App\Http\Livewire\Pagina\VistaCarrito;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Pagina\VistaProductos;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/productos', VistaProductos::class)->name('pagina.productos');
Route::get('/producto/{producto}', MostrarProducto::class)->name('pagina.producto_slug');

Route::get('/servicios', function () {
    return view('servicios');
})->name('servicios');

Route::get('/telecomunicaciones', function () {
    return view('telecomunicaciones');
})->name('telecomunicaciones');

Route::get('/centro-procesamiento-datos', function () {
    return view('centro-procesamiento-datos');
})->name('centro.procesamiento.datos');

Route::get('/sistemas-electricos', function () {
    return view('sistemas-electricos');
})->name('sistemas.electricos');

Route::get('/alarmas-cctv-y-acceso', function () {
    return view('alarmas');
})->name('alarmas');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/contactos', [ContactanosController::class,'index'])->name("contactos");
Route::post('contactanos',[ContactanosController::class, 'store'])->name("contactanos.store");

// botman 
Route::match(['get', 'post'], '/botman', [BotmanController::class, 'handle']);
// Route::match('botman', [BotmanController@handle]);

Route::middleware(['auth:sanctum', 'verified', 'can:pagina.cotizacion'])->get('/carrito-cotizacion',VistaCarrito::class)->name('carrito.cotizacion');
Route::middleware(['auth:sanctum', 'verified', 'can:pagina.cotizacion'])->get('/historial-cotizacion',HistorialCotizacion::class)->name('historial.cotizacion');
Route::middleware(['auth:sanctum', 'verified', 'can:pagina.cotizacion'])->get('/proforma/{id}', [App\Http\Controllers\pdf\PdfController::class, 'proformapagina'])->name('pagina.proforma');
Route::get('/linkstorage', function (){
    Artisan::call('storage:link');
 });