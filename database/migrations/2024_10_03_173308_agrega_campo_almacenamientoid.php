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
        Schema::table('detalleguias', function (Blueprint $table) {
            $table->bigInteger('almacenamiento_id')->unsigned();
            $table->foreign('almacenamiento_id')->references('id')->on('almacenamientos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalleguias', function (Blueprint $table) {
            $table->dropForeign(['almacenamiento_id']);
            $table->dropColumn('almacenamiento_id');
        });
    }
};
