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
        Schema::create('envases', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('envase',200);
            $table->float('capacidad')->unsigned();
            $table->float('tara')->unsigned();
            $table->string('observacion',100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envases');
    }
};
