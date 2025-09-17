<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // 👇 Laravel automáticamente buscará la tabla "productos"
    // pero como tu tabla se llama "producto", lo forzamos aquí:
    protected $table = 'producto';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'precio',
    ];

    // 👇 Si tu tabla usa "id" como clave primaria, no hace falta,
    // pero lo pongo explícito para mayor claridad:
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';


        public $timestamps = false;
}
