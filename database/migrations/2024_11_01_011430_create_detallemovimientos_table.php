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
        Schema::create('detallemovimientos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('movimiento_id')->unsigned();
            $table->foreign('movimiento_id')->references('id')->on('movimientos');
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items');
            $table->double('cantidad')->nullable();
            $table->double('contenido')->nullable();
            $table->double('precio')->nullable();
            $table->string('presentacion',100)->nullable();
            $table->date('vencimiento')->nullable();
            $table->bigInteger('lineaInventario_id')->nullable();
            $table->bigInteger('lineaDerIngresoBodega_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallemovimientos');
    }
};
