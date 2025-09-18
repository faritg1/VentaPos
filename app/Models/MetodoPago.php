<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
        // 👇 Aquí obligamos a Laravel a usar la tabla "producto"
    protected $table = 'metodo_pago';
    protected $fillable = ['nombre'];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}

