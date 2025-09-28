<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'        => fake()->sentence(),
            'body'         => fake()->paragraphs(3, true),
            'user_id'      => 1, // или rand(1, 10), если есть несколько пользователей
            'published_at' => fake()->date(),
            'preview_image'=> 'placeholder_preview.png',
            'full_image'   => 'placeholder_full.png',
        ];
    }
}
