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
        Schema::create('desgloseenvasecampos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('envaseempresa_id')->unsigned();
            $table->foreign('envaseempresa_id')->references('id')->on('envaseempresas');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->integer('stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desgloseenvasecampos');
    }
};
