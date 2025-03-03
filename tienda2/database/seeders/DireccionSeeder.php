<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Direccion; // 👈 Importar el modelo

class DireccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Direccion::create([
            'pais' => 'España',
            'provincia' => 'Madrid',
            'calle' => 'Calle Gran Vía, 1',
            'codigo_postal' => '28013',
        ]);

        Direccion::create([
            'pais' => 'México',
            'provincia' => 'CDMX',
            'calle' => 'Avenida Reforma, 250',
            'codigo_postal' => '01000',
        ]);

        Direccion::create([
            'pais' => 'Argentina',
            'provincia' => 'Buenos Aires',
            'calle' => 'Avenida 9 de Julio, 5000',
            'codigo_postal' => 'C1073',
        ]);

        Direccion::create([
            'pais' => 'Colombia',
            'provincia' => 'Bogotá',
            'calle' => 'Carrera 7, 200',
            'codigo_postal' => '110011',
        ]);
    }
}