<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanCompleteProfile()
    {
        $user = User::factory()->create(['role' => 'peminjam']);

        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->put('/profile', [
            'name' => 'John Doe',
            'phone' => '123456789',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'John Doe']);
    }
}
