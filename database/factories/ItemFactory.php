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

    protected $model = Item::class;

    public function definition()
    {
        $faker = Faker::create('id_ID');
        $categoryIds = Category::pluck('id')->toArray();
        $unitIds = Unit::pluck('id')->toArray();

        $hasSerialNumber = $faker->boolean(40);

        $quantity = $faker->numberBetween(1, 500);

        $status = $faker->boolean(90) ? 'available' : 'not available';

        if ($hasSerialNumber) {
            $quantity = 1;
        }

        $serialNumber = $hasSerialNumber ? $faker->unique()->randomNumber() : null;

        return [
            'category_id' => $faker->randomElement($categoryIds),
            'unit_id' => $faker->randomElement($unitIds),
            'name' => $faker->word,
            'brand' => $faker->word,
            'serial_number' => $serialNumber,
            'photo' => 'storage/img/items/default.jpg',
            'quantity' => $quantity,
            'status' => $status,
            'description' => $faker->sentence(),
        ];
    }
}