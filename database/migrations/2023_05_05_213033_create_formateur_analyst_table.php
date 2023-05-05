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
        Schema::disableForeignKeyConstraints();

        Schema::create('analysts', function (Blueprint $table) {
            $table->string('FormateurCIN')->nullable();
            $table->string('AnalystCIN')->nullable();
            $table->foreign('AnalystCIN')->references('CIN')->on('users');
            $table->foreign('FormateurCIN')->references('CIN')->on('formateurs');
            $table->primary(['FormateurCIN','AnalystCIN']);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analysts');
    }
};
