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
        Schema::table('guiarecepciondetalles', function (Blueprint $table) {
            $table->bigInteger('observacion_id')->unsigned();
            $table->foreign('observacion_id')->references('id')->on('observacions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guiarecepciondetalles', function (Blueprint $table) {
            $table->dropForeign(['observacion_id']);
            $table->dropColumn('observacion_id');
        });
    }
};
