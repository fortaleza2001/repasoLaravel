<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = ['fecha_compra', 'fecha_aproximada_entrega', 'usuario_id'];

    protected $casts = [
        'fecha_aproximada_entrega' => 'datetime',
        'fecha_compra' => 'datetime',
    ];
    // Relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    // Relación con el modelo PedidoProducto
    public function productos()
    {
        return $this->hasMany(PedidoProducto::class);
    }

    
}
