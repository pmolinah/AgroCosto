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
        Schema::create('ingresobodegas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha');
            $table->integer('tipoDocumento_id');
            $table->bigInteger('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('empresas');
            $table->bigInteger('numero')->unsigned();
            $table->bigInteger('campo_id')->references('id')->on('campos');
            $table->bigInteger('total')->unsigned();
            $table->string('pivote',20);
            $table->integer('emitida')->nullable();
            $table->string('observacion',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresobodegas');
    }
};
