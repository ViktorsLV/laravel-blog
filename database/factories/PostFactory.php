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
        /* php artisan tinker - to enter the shell and seed db with fake data */
        /* App\Models\Post::factory()->times(10)->create(['user_id' => 1]);  -- assigns the userId to each post - USER HAS TO BE CREATED FIRST*/ 
        /* (https://fakerphp.github.io/formatters/text-and-paragraphs/) */
        return [
            'body' => $this->faker->paragraph(15), 
            'title' => $this->faker->realText($maxNbChars = 128, $indexSize = 2), /* creating fake text with real words, (not lorem ipsum). Taken from Faker docs */
        ];
    }
}
