<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Administrator;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Item;
use App\Models\UnitAdmin;
use App\Models\Unit;
use App\Models\Usage;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory()->count(5)->create();

        Unit::factory()->count(5)->create();

        Category::factory()->count(10)->create();

        Item::factory()->count(20)->create();

        Administrator::factory()->count(5)->create();

        UnitAdmin::factory()->count(5)->create();

        Booking::factory()->count(20)->create();

        Usage::factory()->count(50)->create();
    }
}
