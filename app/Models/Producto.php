<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // 👇 Aquí obligamos a Laravel a usar la tabla "producto"
    protected $table = 'producto';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'cantidad',
        'precio',
    ];

    protected $primaryKey = 'codigo'; // si tu llave primaria no es 'id'
    public $incrementing = true;
    protected $keyType = 'int';
}
