<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CommentFactory extends Factory
{
    protected $model = \App\Models\Comment::class;

    public function definition(): array
    {
        return [
            'user_id' => User::first()->id, 
            'body'    => $this->faker->paragraph(),
        ];
    }
}
