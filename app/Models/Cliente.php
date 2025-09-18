<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'tipo_documento',
        'numero_documento',
        'direccion',
        'ciudad',
        'telefono',
        'es_mostrador' // Asegúrate de que este campo también esté si lo usas
    ];
}