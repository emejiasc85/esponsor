<?php

namespace Tests\Feature\Api\Admin;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_categories()
    {
        $this->signIn();

        $category = Category::factory()->create();

        $this->getJson('/api/admin/categories')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $category->id
                    ]
                ]
            ]);
    }
    
    public function test_store_a_category()
    {
        $this->signIn();

        $data = Category::factory()->make();

        $parameters = [
            'name' => $data->name
        ];

        $this->postJson('/api/admin/categories', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('categories', [
            'name' => $data->name
        ]);
    }
    
    public function test_validate_store_a_category()
    {
        $this->signIn();

        $parameters = [];

        $this->postJson('/api/admin/categories', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }
    
    public function test_update_a_category()
    {
        $this->signIn();

        $category = Category::factory()->create();
        $data     = Category::factory()->make();

        $parameters = [
            'name' => $data->name
        ];

        $this->putJson('/api/admin/categories/'.$category->id, $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('categories', [
            'id'   => $category->id,
            'name' => $data->name
        ]);
    }
    
    public function test_validate_store_categories()
    {
        $this->signIn();

        $category = Category::factory()->create();

        $parameters = [];

        $this->putJson('/api/admin/categories/'.$category->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }
    
    public function test_destroy_category()
    {
        $this->signIn();

        $category = Category::factory()->create();

        $this->deleteJson('/api/admin/categories/'.$category->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('categories', [
            'id' => $category->id
        ]);
    }
}
