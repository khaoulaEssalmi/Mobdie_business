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

        Schema::create('analyst_managers', function (Blueprint $table) {
            $table->id();
            $table->string('ManagerCIN')->nullable();
            $table->string('AnalystCIN')->nullable();
            $table->foreign('AnalystCIN')->references('CIN')->on('users');
            $table->foreign('ManagerCIN')->references('CIN')->on('users');
            $table->timestamps();
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
