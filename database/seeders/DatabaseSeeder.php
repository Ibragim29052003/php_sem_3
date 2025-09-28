<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Создаём администратора/модератора
        \App\Models\User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Администратор',
            'password' => bcrypt('password'),
        ]);

        // Импортируем статьи из JSON
        $this->call([
            RoleSeeder::class,
            ArticleSeeder::class,
        ]);

        $admin = \App\Models\User::where('email', 'admin@example.com')->first();
        if ($admin) {
            $admin->role_id = \App\Models\Role::where('name', 'moderator')->first()->id;
            $admin->save();
        }

        $articles = Article::all();

        // Создаём 30 комментариев и случайно распределяем их по существующим статьям
        Comment::factory(30)->make()->each(function($comment) use ($articles) {
            $comment->article_id = $articles->random()->id;
            $comment->save();
        });
    }
}
