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
            $table->increments('id');

            $table->string('nombre_apellido');
            $table->string('correo')->unique();
            $table->string('clave');
            $table->string('usuario');
            $table->string('roles');
            $table->string('dni')->unique()->nullable();
            $table->string('phones')->nullable();
            $table->string('address')->nullable();
            $table->string('imgprofile')->nullable();
            $table->string('account')->nullable();
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
