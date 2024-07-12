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
        Schema::create('cuartels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->BigInteger('campo_id')->unsigned();
            $table->foreign('campo_id')->references('id')->on('campos');
            $table->BigInteger('capataz_id')->unsigned();
            $table->foreign('capataz_id')->references('id')->on('users');
            $table->float('superficie',8,2);
            $table->integer('certificado')->nullable();
            $table->string('observaciones');
            $table->string('codigoSag',10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuartels');
    }
};
