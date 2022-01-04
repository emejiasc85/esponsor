<?php

namespace Tests\Feature\Api\Admin;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_carts()
    {
        $user = $this->signIn();

        $cart = Cart::factory()->create([
            'user_id' => $user->id
        ]);

        $this->getJson('/api/admin/carts')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $cart->id
                    ]
                ]
            ]);
    }
    
    public function test_store_a_cart()
    {
        $user = $this->signIn();

        $product = Product::factory()->create([
            'stock' => 2
        ]);

        $parameters = [
            'products' => [
                ['product_id' => $product->id,
                'quantity'   => 1,
                'real_price' => $product->min_price,
                'price'      => $product->min_price,
                'total'      => $product->min_price,]
            ]
        ];

        $this->postJson('/api/admin/carts', $parameters)
            ->assertStatus(201);

        $this->assertDatabaseHas('products', [
            'id'    => $product->id,
            'stock' => 1
        ]);
        
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'total'   => $product->min_price
        ]);

        $this->assertDatabaseHas('cart_products', [
            'cart_id'    => Cart::max('id'),
            'quantity'   => 1,
            'real_price' => $product->min_price,
            'price'      => $product->min_price,
            'total'      => $product->min_price,
        ]);

    }

}
