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
        Schema::create('tratoxcosechas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('cosecha_id')->unsigned();
            $table->foreign('cosecha_id')->references('id')->on('cosechas');
            $table->bigInteger('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->integer('precioxkilo')->unsigned();
            $table->string('observacion',200);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tratoxcosechas');
    }
};
