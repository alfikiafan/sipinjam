<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usage;
use App\Models\Booking;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usage>
 */
class UsageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('id_ID');
        $bookingIds = Booking::pluck('id')->toArray();
        return [
            'booking_id' => $faker->randomElement($bookingIds),
            'note_text' => $this->faker->text(500),
        ];
    }
}
