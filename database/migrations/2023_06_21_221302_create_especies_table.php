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
        Schema::create('especies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('especie',250);
            $table->BigInteger('variedad_id')->unsigned();
            $table->foreign('variedad_id')->references('id')->on('variedads');
            $table->float('metros2')->unsigned();
            $table->date('fechaCosecha');
            $table->float('distanciaPlanta')->unsigned();
            $table->string('observacion',250);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especies');
    }
};
