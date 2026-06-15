<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'slug',
        'medida',
        'marca',
        'stock',
        'stock_inicial',
        'descripcion',
        'condicion',   
        'image',
        'subcategoria_id',
        'precio_compra',
        'precio_venta',
        'precio_unitario',
        'kardex',
        'compras',
        'ventas',
        'descuentos'
    ];

    //relacion uno a muchos inversa subcategoria-producto
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    //relacion uno a muchos detalleIngresos-producto
    public function detalleIngresos()
    {
        return $this->hasMany(DetalleIngreso::class);
    }

    //relacion uno a muchos detalleVentas-producto
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class);
    }

    //relacion uno a muchos detalleCotizacions-producto
    public function detalleCotizacions()
    {
        return $this->hasMany(DetalleCotizacion::class);
    }

    //relacion uno a muchos kardexs-producto
    public function kardexes()
    {
        return $this->hasMany(kardex::class);
    }
}
