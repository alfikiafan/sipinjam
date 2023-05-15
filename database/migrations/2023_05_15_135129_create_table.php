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
        Schema::create('unit_admins', function (Blueprint $table) {
            $table->id('unit_admin_id')->primary();
            $table->foreign('unit_id')->references('unit_id')->on('units');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->timestamps();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->id('unit_id')->primary();
            $table->string('name', 50);
            $table->string('location', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table');
    }
};
