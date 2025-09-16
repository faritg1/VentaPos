<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['tipo','cliente_id','metodo_pago_id','total','numero_factura'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
}

