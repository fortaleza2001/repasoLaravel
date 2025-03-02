<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public function contact() {
        return $this->hasOne('App\Models\Contact'); // Relación con cardinalidad 1:1 entre las entidades "suppliers" y "contacts".
    }

    public function products() {
        return $this->hasMany('App\Models\Product'); // Relación con cardinalidad 1:N entre las entidades "suppliers" y "products".
    }
}
