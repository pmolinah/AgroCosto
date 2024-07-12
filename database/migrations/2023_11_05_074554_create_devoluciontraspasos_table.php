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
        Schema::create('devoluciontraspasos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('campo_id')->unsigned();
            $table->foreign('campo_id')->references('id')->on('campos');
            $table->bigInteger('destino_id')->unsigned();
            $table->string('destino_type');
            $table->date('fecha');
            $table->bigInteger('conductor_id')->unsigned();
            $table->foreign('conductor_id')->references('id')->on('users');
            $table->bigInteger('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->integer('tipo')->unsigned();
            $table->string('observacion',100)->nullable();
            $table->integer('numero')->unsigned()->nullable();
            $table->integer('emitida')->unsigned()->nullable();
            $table->string('NombreDestino',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devoluciontraspasos');
    }
};
