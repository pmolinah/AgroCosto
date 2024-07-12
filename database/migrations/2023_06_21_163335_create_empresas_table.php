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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre',100);
            $table->string('rut',10)->unique();
            $table->string('razon_social',250);
            $table->string('direccion',100);
           
            $table->string('email',50)->nullable();
            $table->string('telefono',30)->nullable();
            $table->string('nombreContacto',100)->nullable();
            $table->string('telefonoContacto',30)->nullable();
            $table->string('emailContacto',50)->nullable();
            $table->string('codigoproexp',10)->nullable();
            $table->string('giro',100)->nullable();

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
