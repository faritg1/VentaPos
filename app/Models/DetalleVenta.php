<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// App\Models\DetalleVenta.php
class DetalleVenta extends Model {
    protected $table = 'detalle_venta';

    public function producto() {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}

