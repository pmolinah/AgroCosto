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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('patente',6);
            $table->integer('tipovehiculo_id');
            $table->bigInteger('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->bigInteger('conductor_id')->unsigned();
            $table->foreign('conductor_id')->references('id')->on('users');
            $table->string('color',20)->nullable();
            $table->string('observacion',100)->nullable();
            $table->string('marca',50)->nullable();
            $table->integer('anio')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
