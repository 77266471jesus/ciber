<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad',
        'descuento',
        'precio_venta',
        'venta_id',
        'producto_id', 
        'user_id',
        'subtotal',
    ]; 

    //relacion uno a muchos inversa detalleVentas-venta
    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    //relacion uno a muchos inversa detalleVentas-producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
