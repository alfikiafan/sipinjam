<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
use App\Models\Category;
use App\Models\Unit;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
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
            'categories_id' => Category::factory()->create()->id,
            'unit_id' => Unit::factory()->create()->id,
            'name' => $this->faker->word,
            'brand' => $this->faker->word,
            'serial_number' => $this->faker->unique()->randomNumber(),
            'photo' => 'default.jpg',
            'description' => $this->faker->sentence,
            'status' => $faker->randomElement(['pending', 'available', 'used', 'not on loan', 'cancelled']),
        ];
    }
}
