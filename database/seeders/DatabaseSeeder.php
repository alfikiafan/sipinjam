<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Item;
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
        $this->call([
            UnitSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            ItemSeeder::class,
            BookingSeeder::class,
            UsageSeeder::class,
        ]);
    }
}
