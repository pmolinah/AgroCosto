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
        Schema::create('plantacions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->BigInteger('cuartel_id')->unsigned();
            $table->foreign('cuartel_id')->references('id')->on('cuartels');
            $table->BigInteger('especie_id')->unsigned();
            $table->foreign('especie_id')->references('id')->on('especies');
            $table->integer('cantidadPlantas');
            $table->date('fechaPlantacion');
            $table->BigInteger('contratista_id')->unsigned();
            $table->foreign('contratista_id')->references('id')->on('users');
            $table->integer('cantidadPlantada')->unsigned();
            $table->string('observacion',200);
            $table->bigInteger('pivote')->nullable()->unique()->unsigned();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantacions');
    }
};
