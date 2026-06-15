<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'impuesto',
        'total_cotizacion',
        'comprobante',
        'total',
        'cliente_id', 
        'user_id',             
    ];  

    //relacion uno a muchos cotizacion cotizacion-detalleCotizacions
    public function detalleCotizacions()
    {
        return $this->hasMany(DetalleCotizacion::class);
    }
    
    //relacion uno a muchos inversa Cotizacions-cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    //relacion uno a muchos inversa Cotizacions-user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
