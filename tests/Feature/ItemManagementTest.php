<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Unit;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemManagementTest extends TestCase
{
    use RefreshDatabase;

    public function testUnitAdminCanManageItems()
    {
        $unitAdmin = User::factory()->create(['role' => 'unit_admin']);
        $unit = Unit::factory()->create();
        $item = Item::factory()->create(['unit_id' => $unit->id]);

        $response = $this->actingAs($unitAdmin)->get('/units/' . $unit->id . '/items');
        $response->assertStatus(200);

        $response = $this->actingAs($unitAdmin)->get('/units/' . $unit->id . '/items/create');
        $response->assertStatus(200);

        $response = $this->actingAs($unitAdmin)->post('/units/' . $unit->id . '/items', [
            'categories_id' => 1,
            'name' => 'New Item',
            'brand' => 'Item Brand',
            'serial_number' => 'ABC123',
            'photo' => 'item.jpg',
            'description' => 'Item Description',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('items', ['name' => 'New Item']);

        $response = $this->actingAs($unitAdmin)->get('/units/' . $unit->id . '/items/' . $item->id . '/edit');
        $response->assertStatus(200);

        $response = $this->actingAs($unitAdmin)->put('/units/' . $unit->id . '/items/' . $item->id, [
            'categories_id' => 1,
            'name' => 'Updated Item',
            'brand' => 'Updated Brand',
            'serial_number' => 'XYZ789',
            'photo' => 'updated_item.jpg',
            'description' => 'Updated Description',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('items', ['name' => 'Updated Item']);

        $response = $this->actingAs($unitAdmin)->delete('/units/' . $unit->id . '/items/' . $item->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('items', ['name' => 'Updated Item']);
    }
}
