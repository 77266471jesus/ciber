<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCotizacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad',
        'descuento',
        'precio_venta',
        'cotizacion_id',
        'producto_id', 
        'user_id',
        'subtotal',
    ]; 

    //relacion uno a muchos inversa detalleCotizacions-cotizacion
    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }

    //relacion uno a muchos inversa detalleCotizacions-producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
