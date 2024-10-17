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
        Schema::create('actividads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('ejecutor_id')->unsigned();
            $table->foreign('ejecutor_id')->references('id')->on('empresas');
            $table->string('observacion');
            $table->bigInteger('lugar_id')->unsigned();
            $table->foreign('lugar_id')->references('id')->on('cuartels');
            $table->date('fechai');
            $table->date('fechat');
            $table->integer('dias');
            $table->bigInteger('responsable_id')->unsigned();
            $table->foreign('responsable_id')->references('id')->on('users');
            $table->string('avances',250)->nullable();
                // $table->bigInteger('tipocosto_id')->unsigned();
                // $table->foreign('tipocosto_id')->references('id')->on('tipocostos');
            $table->integer('costo')->nullable();
            $table->integer('estado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividads');
    }
};
