<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_comprobante',
        'comprobante',
        'fecha',
        'impuesto',
        'total_venta',
        'total',
        'estado', 
        'cliente_id', 
        'user_id',             
    ];  

    //relacion uno a muchos venta-DetalleVentas
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class);
    }
    
    //relacion uno a muchos inversa ventas-cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    //relacion uno a muchos inversa ventas-user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
