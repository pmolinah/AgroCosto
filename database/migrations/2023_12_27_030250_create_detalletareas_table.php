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
        Schema::create('detalletareas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('tarea_id')->unsigned();
            $table->foreign('tarea_id')->references('id')->on('tareas');
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items');
            $table->bigInteger('cuartel_id')->unsigned();
            $table->foreign('cuartel_id')->references('id')->on('cuartels');
            $table->integer('estado')->unsigned()->nullable();
            $table->string('objetivo',150)->nullable();
            $table->float('dosis')->unsigned()->nullable();
            $table->date('fechai')->nullable();
            $table->date('fechaf')->nullable();
            $table->integer('diasentreAplicacion')->unsigned()->nullable();
            $table->string('fechasAplicacion',100)->nullable();
            $table->string('reingreso',50)->nullable();
            $table->bigInteger('mojamiento')->unsigned()->nullable();
            $table->bigInteger('equipo_id')->unsigned();
            $table->foreign('equipo_id')->references('id')->on('items');
            $table->string('carencia',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalletareas');
    }
};
