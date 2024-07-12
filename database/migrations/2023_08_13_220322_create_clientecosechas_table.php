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
        Schema::create('clientecosechas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->float('kilos');
            $table->float('precio');
            $table->bigInteger('cosecha_id')->unsigned();
            $table->foreign('cosecha_id')->references('id')->on('cosechas');
            $table->string('observacion',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientecosechas');
    }
};
