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
        Schema::create('planificacioncosechas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fechai');
            $table->date('fechaf');
            $table->float('kilos')->unsigned();
        
            $table->bigInteger('cuartel_id')->unsigned();
            $table->foreign('cuartel_id')->references('id')->on('cuartels');
            $table->string('observacion',250)->nullable();
            $table->bigInteger('envase_id')->unsigned();
            $table->foreign('envase_id')->references('id')->on('envases');
            $table->bigInteger('plantacion_id')->unsigned();
            $table->foreign('plantacion_id')->references('id')->on('plantacions');
            $table->integer('finalizada')->unsigned()->nullable();
            $table->float('kilosRealesCosechados')->unsigned()->nullable();
                       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planificacioncosechas');
    }
};
