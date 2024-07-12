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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre',100);
            $table->integer('tipo_id');
            $table->string('QrBarra',100)->nullable();
            $table->string('marca',50)->nullable();
            $table->integer('unidadMedida')->nullable();
            $table->string('ingredienteActivo',50)->nullable();
            $table->string('presentacion',50)->nullable();
            $table->float('contenido')->nullable();
            $table->integer('clasificacion_id')->nullable();
            $table->integer('categoria_id');
            $table->float('capacidad')->nullable();
            $table->string('etiqueta',150)->nullable();
            $table->integer('stockMinimo')->nullable();
            $table->string('observacion',150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
