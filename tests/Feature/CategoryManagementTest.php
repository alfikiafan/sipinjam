<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCanManageCategories()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        $response = $this->actingAs($admin)->get('/categories');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->get('/categories/create');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->post('/categories', [
            'name' => 'New Category',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('categories', ['name' => 'New Category']);

        $response = $this->actingAs($admin)->get('/categories/' . $category->id . '/edit');
        $response->assertStatus(200);

        $response = $this->actingAs($admin)->put('/categories/' . $category->id, [
            'name' => 'Updated Category',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('categories', ['name' => 'Updated Category']);

        $response = $this->actingAs($admin)->delete('/categories/' . $category->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('categories', ['name' => 'Updated Category']);
    }
}
