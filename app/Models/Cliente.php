<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nombre',
        'direccion',
        'ciudad',
        'telefono',
        'es_mostrador'
    ];

    public $timestamps = false; // si tu tabla no tiene created_at y updated_at


    public function ventas()
    {
        return $this->hasMany(Venta::class, 'cliente_id'); 
    }
}
