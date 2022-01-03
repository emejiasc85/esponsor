<?php

namespace Tests\Feature\Api\Guest;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_categories()
    {

        $category = Category::factory()->create();

        $this->getJson('/api/categories')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $category->id
                    ]
                ]
            ]);
    }

}
