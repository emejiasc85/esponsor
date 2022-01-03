<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'       => $this->faker->word(),
            'description' => $this->faker->word(),
            'stock'       => $this->faker->randomDigitNotNull(),
            'min_price'   => $this->faker->randomDigitNotNull(),
            'user_id'     => User::factory()->create(),
            'category_id' => Category::factory()->create()
        ];
    }
}
