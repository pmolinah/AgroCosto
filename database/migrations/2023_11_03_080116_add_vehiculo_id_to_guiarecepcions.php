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
        Schema::table('guiarecepcions', function (Blueprint $table) {
            $table->bigInteger('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guiarecepcions', function (Blueprint $table) {
            $table->dropForeign(['vehiculo_id']);
            $table->dropColumn('vehiculo_id');
        });
    }
};
