<?php

namespace Tests\Feature\Api\Admin;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_products()
    {
        $user = $this->signIn();

        $product = Product::factory()->create([
            'user_id' => $user->id
        ]);

        $this->getJson('/api/admin/products')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $product->id
                    ]
                ]
            ]);
    }
    
    public function test_store_a_product()
    {
        Storage::fake('public');

        $user = $this->signIn();

        $data = Product::factory()->make();

        $parameters = [
            'title'       => $data->title,
            'description' => $data->description,
            'stock'       => $data->stock,
            'min_price'   => $data->min_price,
            'category_id' => $data->category_id,
            'file'        => UploadedFile::fake()->image('test.png'),
        ];

        $this->postJson('/api/admin/products', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title' => $data->title
                ]
            ]);

        $this->assertDatabaseHas('products', [
            'title' => $data->title,
            'description' => $data->description,
            'stock'       => $data->stock,
            'min_price'   => $data->min_price,
            'user_id'     => $user->id,
            'category_id' => $data->category_id,
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => Product::max('id'),
            'fileable_type' => Product::class,
            'name'          => 'test.png',
            'filename'      => 'test.png',
        ]);
    }
    
    public function test_validate_store_a_product()
    {
        $this->signIn();

        $parameters = [];

        $this->postJson('/api/admin/products', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'title'       => ['El campo título es obligatorio.'],
                    'description' => ['El campo descripción es obligatorio.'],
                    'min_price'   => ['El campo precio mínimo es obligatorio.'],
                    'stock'       => ['El campo stock es obligatorio.'],
                    'file'        => ['El campo imagen es obligatorio.'],
                    'category_id' => ['El campo categoría es obligatorio.'],
                ]
            ]);
    }
    
    public function test_update_a_product()
    {
        $user = $this->signIn();

        $product = Product::factory()->create([
            'user_id' => $user->id
        ]);

        $data     = Product::factory()->make();

        $parameters = [
            'title'       => $data->title,
            'description' => $data->description,
            'category_id' => $data->category_id,
            'stock'       => $data->stock,
            'min_price'   => $data->min_price,
            'file'        => UploadedFile::fake()->image('test.png'),
        ];

        $this->putJson('/api/admin/products/'.$product->id, $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'title' => $data->title
                ]
            ]);

        $this->assertDatabaseHas('products', [
            'id'          => $product->id,
            'title'       => $data->title,
            'description' => $data->description,
            'stock'       => $data->stock,
            'min_price'   => $data->min_price,
            'category_id' => $data->category_id,
            'user_id'     => $user->id,
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => $product->id,
            'fileable_type' => Product::class,
            'name'          => 'test.png',
            'filename'      => 'test.png',
        ]);
    }
    
    public function test_validate_update_products()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $parameters = [];

        $this->putJson('/api/admin/products/'.$product->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'title'       => ['El campo título es obligatorio.'],
                    'description' => ['El campo descripción es obligatorio.'],
                    'min_price'   => ['El campo precio mínimo es obligatorio.'],
                    'stock'       => ['El campo stock es obligatorio.'],
                    'file'        => ['El campo imagen es obligatorio.'],
                    'category_id' => ['El campo categoría es obligatorio.'],
                ]
            ]);
    }
    
    public function test_destroy_product()
    {
        $this->signIn();

        $product = Product::factory()->create();

        $this->deleteJson('/api/admin/products/'.$product->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('products', [
            'id' => $product->id
        ]);
    }
}
