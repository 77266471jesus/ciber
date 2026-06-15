<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_comprobante',
        'comprobante',
        'fecha',
        'impuesto',
        'total_compra',
        'estado', 
        'proveedor_id', 
        'user_id',             
    ];  

    //relacion uno a muchos ingresos ingreso-DetalleIngresos
    public function detalleingreso()
    {
        return $this->hasMany(DetalleIngreso::class);
    }
    
    //relacion uno a muchos inversa ingresos-proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    //relacion uno a muchos inversa ingresos-user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
