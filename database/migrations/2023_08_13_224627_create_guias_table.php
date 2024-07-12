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
        Schema::create('guias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->bigInteger('numero')->unsigned()->nullable();
            $table->integer('tipo')->unsigned();
            $table->integer('cantidadKilos')->unsigned();
            $table->integer('cantidadEnvases')->unsigned();
            $table->datetime('fecha');
            $table->string('observacion',100)->nullable();
            $table->bigInteger('envase_id')->unsigned();
            $table->foreign('envase_id')->references('id')->on('envases');
            $table->bigInteger('conductor_id')->unsigned();
            $table->foreign('conductor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guias');
    }
};
