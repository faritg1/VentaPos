<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// App\Models\Venta.php
class Venta extends Model {
    protected $table = 'venta';
    public $timestamps = false;
    protected $fillable = ['tipo','cliente_id','metodo_pago_id','total','numero_factura','fecha'];

    public function detalles() {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }
    public function cliente() {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}


