<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usage;
use App\Models\Booking;
use App\Models\User;
use Faker\Factory as Faker;
use Carbon\Carbon;

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
        
        $selectedBookingId = $faker->randomElement($bookingIds);
        $selectedBooking = Booking::find($selectedBookingId);
        $endDate = $selectedBooking->end_date;
        $dueDate = Carbon::parse($endDate)->addDays(7);
        $userId = User::whereHas('unit', function ($query) use ($selectedBooking) {
            $query->where('unit_id', $selectedBooking->item->unit_id);
        })->pluck('id')->toArray();
        
        return [
            'booking_id' => $selectedBookingId,
            'user_id' => $faker->randomElement($userId),
            'status' => $faker->randomElement(['awaiting use', 'used', 'returned']),
            'note' => $faker->text(300),
            'due_date' => $dueDate,
        ];
    }
}
