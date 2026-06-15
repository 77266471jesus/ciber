<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'accion',
        'detalle',
        'detalle_id',
        'user_id',
    ];

    //relacion uno a muchos inversa historial-user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
