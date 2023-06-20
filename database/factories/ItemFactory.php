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
        $faker = Faker::create('id_ID');
        $categoryIds = Category::pluck('id')->toArray();
        $unitIds = Unit::pluck('id')->toArray();
        $quantity = $faker->numberBetween(0, 100);
        $status = ($quantity === 0) ? 'empty' : $faker->randomElement(['available', 'not available']);
        return [
            'categories_id' => $faker->randomElement($categoryIds),
            'unit_id' => $faker->randomElement($unitIds),
            'name' => $this->faker->word,
            'brand' => $this->faker->word,
            'serial_number' => $this->faker->unique()->randomNumber(),
            'photo' => 'storage/img/default.jpg',
            'quantity' => $quantity,
            'status' => $status,
        ];
    }
}
