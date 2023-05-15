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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id')->primary();
            $table->string('name', 100);
            $table->string('email', 50);
            $table->string('role', 50);
            $table->string('no_telp', 15);
            $table->string('password', 20);
            $table->timestamps();
        });

        Schema::create('administrators', function (Blueprint $table) {
            $table->id('administrator_id')->primary();
            $table->string('name', 100);
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('unit_admins', function (Blueprint $table) {
            $table->id('unit_admin_id')->primary();
            $table->foreign('unit_id')->references('unit_id')->on('units')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->id('unit_id')->primary();
            $table->string('name', 100);
            $table->string('location', 100);
            $table->timestamps();
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id')->primary();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending','waiting', 'approved', 'rejected', 'canceled'])->default('pending');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('usage', function (Blueprint $table) {
            $table->id('usage_id')->primary();
            $table->string('note_text', 500);
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id('item_id')->primary();
            $table->string('name', 100);
            $table->string('brand', 50);
            $table->string('serial_number', 50);
            $table->string('photo', 100);
            $table->string('description', 500);
            $table->enum('status', ['pending','waiting', 'approved', 'rejected', 'canceled'])->default('pending');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');;
            $table->foreign('unit_id')->references('id')->on('unit')->onDelete('cascade');;
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id('categories_id')->primary();
            $table->string('name');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('administrators');
        Schema::dropIfExists('unit_admins');
        Schema::dropIfExists('units');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('usage');
        Schema::dropIfExists('items');
        Schema::dropIfExists('categories');
    }
};
