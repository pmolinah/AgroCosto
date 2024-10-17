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
        Schema::create('stockbodegas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('planificacioncosecha_id')->unsigned();
            $table->foreign('planificacioncosecha_id')->references('id')->on('planificacioncosechas');
            $table->bigInteger('bodega_id')->unsigned();
            $table->foreign('bodega_id')->references('id')->on('bodegas');
            $table->float('kilosSolicitados')->unsigned();
            $table->float('KilosRecolectados')->nullable()->unsigned();
            $table->string('observacion',250)->nullable();
            // $table->bigInteger('cuentaenvase_id')->unsigned();
            // $table->foreign('cuentaenvase_id')->references('id')->on('cuentaenvases');
            // $table->integer('envasesUtilizadosReales')->unsigned()->nullable();
            // $table->integer('guiaDespacho')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stockbodegas');
    }
};
