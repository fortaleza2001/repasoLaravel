<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'proveedores';

    protected $fillable = ['nombre_completo', 'direccion', 'descripcion', 'telefono'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'proveedor_id');
    }

    protected static function booted()
    {
        static::deleting(function ($proveedor) {
            if (!$proveedor->isForceDeleting()) {
                // Si es un SoftDelete, ponemos proveedor_id en NULL en los productos
                $proveedor->productos()->update(['proveedor_id' => null]);
            }
        });
    }
}
