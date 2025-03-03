<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Pedidos_ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('pedido_producto')->insert([
            ['pedido_id' => 1, 'producto_id' => 1, 'cantidad' => 2],
            ['pedido_id' => 1, 'producto_id' => 2, 'cantidad' => 1],
            ['pedido_id' => 2, 'producto_id' => 1, 'cantidad' => 1],
            ['pedido_id' => 2, 'producto_id' => 3, 'cantidad' => 3],
            
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
