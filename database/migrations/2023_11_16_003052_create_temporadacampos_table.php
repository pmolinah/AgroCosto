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
        Schema::create('temporadacampos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('envaseempresa_id')->unsigned();
            $table->foreign('envaseempresa_id')->references('id')->on('envaseempresas');
            $table->bigInteger('campo_id')->unsigned();
            $table->foreign('campo_id')->references('id')->on('campos');
            $table->bigInteger('envase_id')->unsigned();
            $table->foreign('envase_id')->references('id')->on('envases');
            $table->integer('stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporadacampos');
    }
};
