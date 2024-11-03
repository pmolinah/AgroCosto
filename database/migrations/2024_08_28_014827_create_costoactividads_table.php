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
        Schema::create('costoactividads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('actividad_id')->unsigned();
            $table->foreign('actividad_id')->references('id')->on('actividads');
            $table->integer('costo');
            $table->bigInteger('tipoactividad_id')->unsigned();
            $table->foreign('tipoactividad_id')->references('id')->on('tipoactividads');
            $table->double('cantidad');
            $table->double('costoUnidad');
            $table->double('avance');
            $table->bigInteger('tipocosto_id')->unsigned();
            $table->foreign('tipocosto_id')->references('id')->on('tipocostos');
            $table->bigInteger('pivote')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costoactividads');
    }
};