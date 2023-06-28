<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\Item;
use App\Models\User;
use Faker\Factory as Faker;
use Carbon\Carbon;
use DateInterval;

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
        
        $startDateTime = $faker->dateTimeBetween('-11 months', '-1 month');
        $endDateTime = clone $startDateTime;
        $endDateTime->modify('+1 month');
        
        $itemId = $faker->randomElement($itemIds);
        $item = Item::find($itemId);
        $maxQuantity = $item->quantity;

        $quantity = $faker->numberBetween(1, $maxQuantity);

        if ($item && $quantity <= $maxQuantity) {
            $item->quantity -= $quantity;
            $item->save();
        } else {
            $quantity = 1;
        }

        $createdAt = Carbon::instance($faker->dateTimeBetween(
            $startDateTime->sub(new DateInterval('P7D')),
            $startDateTime
        ));        

        return [
            'item_id' => $itemId,
            'user_id' => $faker->randomElement($userIds),
            'quantity' => $quantity,
            'start_date' => $startDateTime->format('Y-m-d'),
            'end_date' => $endDateTime->format('Y-m-d'),
            'created_at' => $createdAt,
            'status' => $faker->randomElement(['pending', 'cancelled', 'approved', 'rejected'])
        ];
    }
}
