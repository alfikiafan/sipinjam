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
        static $serialNumberCount = 0;
    
        $faker = Faker::create('id_ID');
        $categoryIds = Category::pluck('id')->toArray();
        $unitIds = Unit::pluck('id')->toArray();

        $hasSerialNumber = ($serialNumberCount <= 10) ? false : true;
        $serialNumberCount++;

        $serialNumber = $hasSerialNumber ? null : $faker->unique()->randomNumber();
        $quantity = $hasSerialNumber ? $faker->numberBetween(0, 100) : 1;
        $status = ($quantity === 0) ? 'empty' : $faker->randomElement(['available', 'not available']);
    
        return [
            'category_id' => $faker->randomElement($categoryIds),
            'unit_id' => $faker->randomElement($unitIds),
            'name' => $faker->word,
            'brand' => $faker->word,
            'serial_number' => $serialNumber,
            'photo' => 'storage/img/items/default.jpg',
            'quantity' => $quantity,
            'status' => $status,
        ];
    }
}
