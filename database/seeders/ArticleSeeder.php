<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\File;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $json = File::get(database_path('articles.json'));
        $articles = json_decode($json, true);

        // // Проверяем, есть ли пользователь с ID = 1
        $user = \App\Models\User::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Администратор',
                'email' => 'admin@example.com',
                'password' => bcrypt('password')
            ]
        );

    
        foreach ($articles as $item) {
            Article::create([
                'title'        => $item['name'],
                'body'         => $item['desc'],
                'user_id'       => $user->id,
                'published_at' => $item['date'],
                // 'preview_image'=> $item['preview_image'] ?? null,
                // 'full_image'   => $item['full_image'] ?? null,
                'preview_image'=> $item['preview_image'] ? basename($item['preview_image']) : 'placeholder_preview.png',
                'full_image'   => $item['full_image'] ? basename($item['full_image']) : 'placeholder_full.png',

            ]);
        }
    }
}
