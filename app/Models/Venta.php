<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

   protected $table = 'venta'; // Nombre exacto de tu tabla

    // Desactivamos los timestamps porque tu tabla no tiene created_at ni updated_at
    public $timestamps = false;

    protected $fillable = [
        'tipo',
        'cliente_id',
        'metodo_pago_id',
        'total',
        'numero_factura',
        'fecha',
    ];

    // Relaciones
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'metodo_pago_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }
}
