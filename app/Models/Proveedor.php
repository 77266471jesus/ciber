<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
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

    //relacion uno a muchos proveedor-ingresos
    public function ingreso()
    {
        return $this->hasMany(Ingreso::class);
    }
}
