<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;

    protected $table = 'descuento';

    protected $fillable = ['nombre', 'porcentaje', 'fecha_finalizacion', 'descripcion'];
}
