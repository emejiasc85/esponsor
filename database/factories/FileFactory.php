<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'path'     => $this->faker->url,
            'filename' => $this->faker->word,
            'name'     => $this->faker->word,
        ];
    }
}
