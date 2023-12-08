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
        Schema::create('purchaorders', function (Blueprint $table) {
            $table->increments('id');

            $table->float('pricetotal')->nullable();
            $table->string('status')->nullable();
            $table->integer('units')->nullable();
            $table->string('img_pago')->nullable();
            $table->string('img_delivery')->nullable();
            $table->string('address')->nullable();
            $table->integer('id_cliente')->unsigned()->nullable();;
            $table->foreign('id_cliente')->references('id')->on('usuarios');
            $table->integer('id_repartidor')->unsigned()->nullable();;
            $table->foreign('id_repartidor')->references('id')->on('usuarios');
            $table->integer('id_usuario')->unsigned()->nullable();;
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->integer('id_trolley')->unsigned()->nullable();;
            $table->foreign('id_trolley')->references('id')->on('trolleys');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchaorders');
    }
};
