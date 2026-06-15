<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'cantidad',
        'precio_compra',
        'precio_venta',
        'ingreso_id',
        'producto_id', 
        'user_id',
        'subtotal',
    ]; 

    //relacion uno a muchos inversa detalleingresos-ingreso
    public function ingreso()
    {
        return $this->belongsTo(Ingreso::class);
    }

    //relacion uno a muchos inversa detalleingresos-producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
