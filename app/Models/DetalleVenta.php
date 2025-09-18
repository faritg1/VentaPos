<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model {
    protected $table = 'detalle_venta';

    /**
     * Indica al modelo que no use las columnas created_at y updated_at.
     */
    public $timestamps = false;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal' // Añadido para el siguiente paso
    ];

    public function producto() {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}