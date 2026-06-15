<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'user_name',
        'email',
        'password',
        'tipo_documento',
        'ci',
        'cargo',
        'telefono',
        'direccion',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    //relacion uno a muchos polimorfica
    public function images()
    {
        return $this->morphMany(Image::class, "imageable");
    }

    //relacion uno a muchos users users-ingreso
    public function ingreso()
    {
        return $this->hasMany(Ingreso::class);
    }

    //relacion uno a muchos user-ventas
    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    //relacion uno a muchos user-cotizacions
    public function cotizacions()
    {
        return $this->hasMany(Cotizacion::class);
    }

    //relacion uno a muchos user-ventas
    public function historial()
    {
        return $this->hasMany(Historial::class);
    }
}
