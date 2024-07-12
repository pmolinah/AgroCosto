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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items');
            $table->bigInteger('bodega_id')->unsigned();
            $table->foreign('bodega_id')->references('id')->on('bodegas');
            $table->integer('cantidad')->unsigned();
            $table->float('contenido')->unsigned();
            $table->float('contenidoTotal')->unsigned();
            $table->float('utilizado')->unsigned()->nullable();
            $table->string('presentacion',150)->nullable();
            $table->bigInteger('precioUnitario')->unsigned()->nullable();
            $table->integer('stockMinimo')->unsigned()->nullable();
            $table->date('vencimiento')->nullable();
            $table->string('pivote',100);
            $table->bigInteger('ingresobodega_id')->unsigned();
            $table->foreign('ingresobodega_id')->references('id')->on('ingresobodegas');
            $table->bigInteger('CantidadRestante')->nullable();
            $table->bigInteger('lineaFactura_id')->unsigned();
            $table->foreign('lineaFactura_id')->references('id')->on('detingresobodegas');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
