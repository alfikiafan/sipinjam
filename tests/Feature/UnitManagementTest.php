<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitManagementTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCanManageUnits()
    {
        $admin = User::factory()->create(['role' => 'administrator']);
        $unit = Unit::factory()->create();

        $response = $this->actingAs($admin)->get('/units');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->get('/units/create');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->post('/units', [
            'name' => 'New Unit',
            'location' => 'Unit Location',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('units', ['name' => 'New Unit']);

        $response = $this->actingAs($admin)->get('/units/' . $unit->id . '/edit');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->put('/units/' . $unit->id, [
            'name' => 'Updated Unit',
            'location' => 'Updated Location',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('units', ['name' => 'Updated Unit']);

        $response = $this->actingAs($admin)->delete('/units/' . $unit->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('units', ['name' => 'Updated Unit']);
    }
}
