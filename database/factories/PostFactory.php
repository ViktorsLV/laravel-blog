<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->sentence(20), /* App\Models\Post::factory()->times(10)->create(['user_id' => 2]);  -- assigns the userId to each post */
        ];
    }
}
