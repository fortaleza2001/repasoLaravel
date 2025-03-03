<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido; // 👈 Importar el modelo
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Desactivar restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Insertar pedidos de ejemplo
        Pedido::create([
            'usuario_id' => 1,
            'fecha_compra' => Carbon::now()->subDays(5)->format('Y-m-d'),
            'fecha_aproximada_entrega' => Carbon::now()->subDays(3)->format('Y-m-d'),
        ]);

        Pedido::create([
            'usuario_id' => 2,
            'fecha_compra' => Carbon::now()->subDays(3)->format('Y-m-d'),
            'fecha_aproximada_entrega' => Carbon::now()->addDays(7)->format('Y-m-d'),
        ]);

        Pedido::create([
            'usuario_id' => 3,
            'fecha_compra' => Carbon::now()->subDays(10)->format('Y-m-d'),
            'fecha_aproximada_entrega' => Carbon::now()->addDays(12)->format('Y-m-d'),
        ]);

        Pedido::create([
            'usuario_id' => 1,
            'fecha_compra' => Carbon::now()->subDays(2)->format('Y-m-d'),
            'fecha_aproximada_entrega' => Carbon::now()->addDays(8)->format('Y-m-d'),
        ]);

        // Reactivar restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
