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
        Schema::create('cosechas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fechaCosecha');
            $table->BigInteger('contratista_id')->unsigned();
            $table->foreign('contratista_id')->references('id')->on('empresas');
            $table->BigInteger('plantacion_id')->unsigned();
            $table->foreign('plantacion_id')->references('id')->on('plantacions');
            $table->integer('tipoCosecha')->unsigned();
            $table->float('cantidadCosecha')->unsigned();
            $table->float('kilos',3)->unsigned();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cosechas');
    }
};
