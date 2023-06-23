<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Unit;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('id_ID');
        static $unitIdCounter = 0;
        return [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => $faker->randomElement(['administrator', 'unitadmin', 'borrower']),
            'phone' => $faker->phoneNumber(),
            'photo' => 'storage/img/avatar/default.png',
            'unit_id' => function (array $attributes) use (&$unitIdCounter) {
                if ($attributes['role'] === 'unitadmin') {
                    $unitIdCounter++;
                    return $unitIdCounter;
                }
                return null;
            },
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
