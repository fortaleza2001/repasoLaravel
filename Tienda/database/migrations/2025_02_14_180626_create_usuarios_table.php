<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('usuario')->unique();
            $table->string('email')->unique(); // Campo de correo electrónico único
            $table->string('password'); // Laravel usa "password", no "contraseña"
            $table->string('rol')->default('usuario'); // Definir un rol por defecto
            $table->unsignedBigInteger('direccion_id')->nullable();
            $table->string('imagen_usuario')->nullable();
            $table->rememberToken(); // Para "Recuérdame"
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
