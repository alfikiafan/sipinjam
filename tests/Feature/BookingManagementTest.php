<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingManagementTest extends TestCase
{
    use RefreshDatabase;

    public function testUnitAdminCanApproveBooking()
    {
        $unitAdmin = User::factory()->create(['role' => 'unit_admin', 'no_telp' => '081234567890']);
        $booking = Booking::factory()->create(['status' => 'pending']);

        $response = $this->actingAs($unitAdmin)->put('/bookings/' . $booking->id . '/approval');
        $response->assertStatus(302);
        $this->assertDatabaseHas('bookings', ['id' => $booking->id, 'status' => 'approved']);
    }
}
