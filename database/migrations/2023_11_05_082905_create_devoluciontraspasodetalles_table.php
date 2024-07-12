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
        Schema::create('devoluciontraspasodetalles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('devoluciontraspaso_id')->unsigned();
            $table->foreign('devoluciontraspaso_id')->references('id')->on('devoluciontraspasos');
            $table->bigInteger('envase_id')->unsigned();
            $table->foreign('envase_id')->references('id')->on('envases');
            $table->bigInteger('color_id')->unsigned();
            $table->foreign('color_id')->references('id')->on('colors');
            $table->integer('cantidadEnvases')->unsigned();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devoluciontraspasodetalles');
    }
};
