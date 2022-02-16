<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => Post::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'content' => $this->faker->realText(200),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
