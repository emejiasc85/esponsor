<?php

namespace Tests\Feature\Api\Guest;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_categories()
    {

        $product = Product::factory()->create();

        $this->getJson('/api/products')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $product->id
                    ]
                ]
            ]);
    }

}
