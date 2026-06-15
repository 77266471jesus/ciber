<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kardex extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'detalle',
        'costo_unitario',
        'cantidad_entrada',
        'cantidad_salida',
        'precio_entrada',
        'precio_salida',
        'cantidad_total',
        'precio_total',
        'cantidad',
        'producto_id',
        'ingreso_id',
        'venta_id',
        'estado',
        'inicio',
        'egreso_detalle',
        'cantidad_detalle'
    ];

    //relacion uno a muchos inversa kardexes-producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
