<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    use HasFactory;

    protected $table = 'pedido_producto';

    protected $fillable = ['pedido_id', 'producto_id', 'cantidad'];

    // Relación con el modelo Pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    // Relación con el modelo Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
