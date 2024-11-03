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
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('banco_id')->unsigned();
            $table->foreign('banco_id')->references('id')->on('bancos');
            $table->string('cuenta',50);
            $table->integer('saldo_inicial');
            $table->integer('saldo_real');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas');
    }
};
