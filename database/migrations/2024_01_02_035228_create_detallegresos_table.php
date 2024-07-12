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
        Schema::create('detallegresos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('egresobodega_id')->unsigned();
            $table->foreign('egresobodega_id')->references('id')->on('egresobodegas');
            $table->bigInteger('bodega_id')->unsigned();
            $table->foreign('bodega_id')->references('id')->on('bodegas');
            $table->bigInteger('inventario_id')->unsigned();
            $table->foreign('inventario_id')->references('id')->on('inventarios');
            $table->bigInteger('tarea_id')->nullable();
            // $table->float('contenido');
            // $table->float('contenidoTotal');
            // $table->float('stock');
            $table->float('detalleEntrega');
            $table->float('costo');
            $table->integer('entregada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallegresos');
    }
};
