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
        Schema::create('aplicaciontareas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('detalletarea_id')->unsigned();
            $table->foreign('detalletarea_id')->references('id')->on('detalletareas');
            $table->bigInteger('dosificador_id')->unsigned();
            $table->foreign('dosificador_id')->references('id')->on('users');
            $table->bigInteger('aplicador_id')->unsigned();
            $table->foreign('aplicador_id')->references('id')->on('users');
            $table->date('fecha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplicaciontareas');
    }
};
