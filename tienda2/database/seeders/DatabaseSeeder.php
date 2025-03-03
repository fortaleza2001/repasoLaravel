<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

       

        // Llamamos a todos los seeders
            $this->call(
     [
                    ProveedorSeeder::class,
                    UsuarioSeeder::class,
                    DireccionSeeder::class,
                    DescuentosSeeder::class,
                    ProductosSeeder::class,
                    PedidosSeeder::class,
                    Pedidos_ProductosSeeder::class
            ]);
            $this->command->info('¡Migración y Seeders completados con éxito!');
    }
}
