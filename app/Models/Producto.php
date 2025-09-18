<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';

    /**
     * Indica al modelo que no use las columnas created_at y updated_at.
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'precio',
    ];
}