<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Models\Comment;
use App\Policies\ArticlePolicy;
use App\Policies\CommentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Сопоставление моделей и их политик
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Зарегистрировать службы авторизации
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Шлюз: админ/модератор может всё
        Gate::before(function ($user, $ability) {
            if ($user->isModerator()) {
                return true;
            }
        });
    }
}
