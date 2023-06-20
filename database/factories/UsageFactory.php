<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usage;
use App\Models\Booking;
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
        $returnDate = Carbon::parse($endDate)->addDays(7);
        
        return [
            'booking_id' => $selectedBookingId,
            'status' => $faker->randomElement(['awaiting use', 'used', 'returned']),
            'note_text' => $faker->text(500),
            'due_date' => $returnDate,
        ];
    }
}
