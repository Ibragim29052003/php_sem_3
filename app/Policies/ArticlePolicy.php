<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function create(User $user): Response
    {
        return $user->isModerator()
            ? Response::allow()
            : Response::deny('Только модератор может создавать новости.');
    }

    public function update(User $user, Article $article): Response
    {
        return $user->isModerator()
            ? Response::allow()
            : Response::deny('Только модератор может редактировать новости.');
    }

    public function delete(User $user, Article $article): Response
    {
        return $user->isModerator()
            ? Response::allow()
            : Response::deny('Только модератор может удалять новости.');
    }
}
