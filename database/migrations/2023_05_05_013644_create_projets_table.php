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
        Schema::create('projets', function (Blueprint $table) {
            $table->id('ProjetID');
            $table->integer('ID')->nullable();
            $table->string('Nom')->nullable();
            $table->string('Description')->nullable();
            $table->string('Statut')->nullable();
            $table->string('FormateurCIN')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
