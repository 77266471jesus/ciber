<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'condicion',
        'image',   
        'categoria_id',    
    ];

    //relacion uno a muchos inversa categoria-subcategoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    //relacion uno a muchos subcategoria subcategoria-productos
    public function prodcutos() {
        return $this->hasMany(Producto::class);
    }
}
