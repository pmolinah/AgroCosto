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
        Schema::create('certificacionasignadas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('certificacion_id')->unsigned();
            $table->foreign('certificacion_id')->references('id')->on('certificacions');
            $table->date('fechaInicio');
            $table->date('fechaTermino');
            $table->date('fechaExtension')->nullable();
            $table->date('fechaProrroga')->nullable();
            $table->string('observacion',100)->nullable();
            $table->string('rutaDocumento');
            $table->string('documento',100);
            $table->bigInteger('campo_id')->unsigned();
            $table->foreign('campo_id')->references('id')->on('campos');
         
            $table->string('casaCertificadora',30);
            $table->integer('alertaTempranaCaducidad');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificacionasignadas');
    }
};
