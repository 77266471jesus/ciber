<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo_documento',
        'documento',
        'direccion',
        'telefono',
        'email',
    ];

    //relacion uno a muchos cliente-ventas
    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    //relacion uno a muchos cliente-cotizacions
    public function cotizacions()
    {
        return $this->hasMany(Cotizacion::class);
    }
}
