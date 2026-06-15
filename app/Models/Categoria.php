<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'condicion',
        'image',     
    ];

    use HasFactory;

    //relacion uno a muchos categoria categoria-subcategoria
    public function subcategorias() {
        return $this->hasMany(Subcategoria::class);
    }
}
