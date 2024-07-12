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
        Schema::table('guias', function (Blueprint $table) {
            $table->bigInteger('planificacioncosecha_id')->unsigned();
            $table->foreign('planificacioncosecha_id')->references('id')->on('planificacioncosechas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guias', function (Blueprint $table) {
            $table->dropForeign(['planificacioncosecha_id']);
            $table->dropColumn('planificacioncosecha_id');
        });
    }
};
