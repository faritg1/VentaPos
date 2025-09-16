<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'precio', 'cantidad', 'descripcion'];

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}
