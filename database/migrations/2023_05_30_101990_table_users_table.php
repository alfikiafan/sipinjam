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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('role')->default('borrower');
            $table->string('photo')->nullable()->default('storage/img/avatar/default.png');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('about_me', 500)->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
