<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\Item;
use App\Models\User;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {        
        $faker = Faker::create('id_ID');
        $itemIds = Item::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();
        $startDateTime = $faker->dateTimeBetween('2023-07-01', '2023-11-30');
        $endDateTime = clone $startDateTime;
        $endDateTime->modify('+1 month');
        
        return [
            'item_id' => $faker->randomElement($itemIds),
            'user_id' => $faker->randomElement($userIds),
            'start_date' => $startDateTime->format('Y-m-d'),
            'end_date' => $endDateTime->format('Y-m-d'),
            'status' => $faker->randomElement(['pending', 'cancelled', 'approved', 'rejected'])
        ];        
    }
}
