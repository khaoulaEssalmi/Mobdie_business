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

        Schema::create('AnalystManager', function (Blueprint $table) {
            $table->string('ManagerCIN')->nullable();
            $table->string('AnalystCIN')->nullable();
            $table->string('AdminCIN')->nullable();
            $table->foreign('AnalystCIN')->references('CIN')->on('users');
            $table->foreign('AdminCIN')->references('CIN')->on('users');
            $table->foreign('ManagerCIN')->references('CIN')->on('formateurs');
            $table->primary(['ManagerCIN','AnalystCIN']);
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
