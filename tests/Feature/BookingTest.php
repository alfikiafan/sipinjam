<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanMakeBooking()
    {
        $user = User::factory()->create([
            'role' => 'peminjam',
            'phone' => '081234567890'
        ]);

        $item = Item::factory()->create([
            'status' => 'available',
            'categories_id' => 1,
            'unit_id' => 1,
            'name' => 'Fulan',
            'brand' => 'brand',
        ]);

        $response = $this->actingAs($user)->post('/bookings', [
            'item_id' => $item->id,
            'start_date' => '2023-06-01',
            'end_date' => '2023-06-05',
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('bookings', [
            'item_id' => $item->id,
            'user_id' => $user->id,
            'status' => 'pending',
        ]);
        
        $booking = Booking::latest()->first();
        
        $response = $this->actingAs($user)->get('/bookings/' . $booking->id . '/approval');
        $response->assertStatus(200);
    }
}
