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
        Schema::create('candidats', function (Blueprint $table) {
            $table->id('CandidatID');
            $table->integer('Age')->nullable();
            $table->integer('ID')->nullable();
            $table->string('Cin')->nullable();
            $table->string('Commune')->nullable();
            $table->string('Email')->nullable();
            $table->string('Nom')->nullable();
            $table->string('Prenom')->nullable();
            $table->string('Province')->nullable();
            $table->string('Telephone')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidats');
    }
};
