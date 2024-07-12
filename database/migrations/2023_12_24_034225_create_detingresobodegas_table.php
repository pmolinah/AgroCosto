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
        Schema::create('detingresobodegas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('ingresobodega_id')->unsigned();
            $table->foreign('ingresobodega_id')->references('id')->on('ingresobodegas');
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items');
            $table->integer('cantidad')->unsigned();
            $table->integer('contenido')->unsigned();
            $table->string('presentacion');
            $table->bigInteger('precioUnitario')->unsigned();
            $table->date('vencimiento');
            $table->bigInteger('bodega_id')->unsigned();
            $table->foreign('bodega_id')->references('id')->on('bodegas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detingresobodegas');
    }
};
