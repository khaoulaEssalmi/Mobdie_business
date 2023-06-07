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
        Schema::create('appels', function (Blueprint $table) {
                $table->id('AppelID');
                $table->text('Appreciation')->nullable();
                $table->text('Elements_discutes')->nullable();
                $table->text('Elements_convenus')->nullable();

            $table->date('Date_appel')->nullable();
            $table->date('Prochain_appel')->nullable();

            $table->integer('ProjetID')->nullable();
//            $table->foreign('ProjetID')->references('ProjetID')->on('projets');

            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appels');
    }
};
