<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente'; // 👈 nombre correcto de la tabla

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'numero_documento',
        'correo',
        'telefono',
        'direccion',
        'ciudad',
    ];
}
