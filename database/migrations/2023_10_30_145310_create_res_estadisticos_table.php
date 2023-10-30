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
        Schema::create('res_estadisticos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_nota');
            $table->json('resultados');
            $table->string('nota_cuestionario');
            $table->bigInteger('usuario')->unsigned();
            $table->foreign('usuario')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('res_estadisticos');
    }
};
