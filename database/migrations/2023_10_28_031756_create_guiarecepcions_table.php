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
        Schema::create('guiarecepcions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('campo_id')->unsigned();
            $table->foreign('campo_id')->references('id')->on('campos');
            $table->bigInteger('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->integer('numero')->unsigned();
            $table->date('fecha');
            $table->string('observacion',100)->nullable();
            $table->integer('emitida')->unsigned()->nullable();
            $table->bigInteger('conductor_id')->unsigned();
            $table->foreign('conductor_id')->references('id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guiarecepcions');
    }
};
