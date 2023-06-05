<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanMakeBooking()
    {
        $user = User::factory()->create([
            'role' => 'peminjam',
            'no_telp' => '081234567890'
        ]);
        $item = Item::factory()->create([
            'status' => 'available',
            'categories_id' => 1,
            'unit_id' => 1,
            'name' => 'Fulan',
            'brand' => 'brand',
        ]);

        $response = $this->actingAs($user)->get('/bookings/create');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->post('/bookings', [
            'item_id' => $item->id,
            'start_date' => '2023-06-01',
            'end_date' => '2023-06-05',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('bookings', ['item_id' => $item->id]);

        $response = $this->actingAs($user)->get('/bookings/' . $item->id . '/approval');
        $response->assertStatus(200);
    }
}
