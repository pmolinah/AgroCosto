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
        Schema::table('tipoactividads', function (Blueprint $table) {
            $table->bigInteger('tipocosto_id')->unsigned();
            $table->foreign('tipocosto_id')->references('id')->on('tipocostos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipoactividads', function (Blueprint $table) {
            $table->dropForeign(['tipocosto_id']);
            $table->dropColumn('tipocosto_id');
        });
    }
};
