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
        Schema::create('campos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('rut',10);
            $table->BigInteger('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->string('campo',250);
            $table->string('direccion',250);
            $table->BigInteger('adm_id')->unsigned();
            $table->foreign('adm_id')->references('id')->on('users');
            $table->float('superficie');
            $table->string('codigoSag',10);
            // $table->BigInteger('capataz_id')->unsigned();
            // $table->foreign('capataz_id')->references('id')->on('users');
           });
    }   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campos');
    }
};
