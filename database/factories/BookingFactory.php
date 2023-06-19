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
        static $id = 1;
        $faker = Faker::create('id_ID');
        return [
            'id' => $id++,
            'item_id' => function () {
                return Item::factory()->create()->id;
            },
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'status' => $faker->randomElement(['pending', 'waiting', 'approved', 'rejected', 'cancelled'])
        ];
    }
}
