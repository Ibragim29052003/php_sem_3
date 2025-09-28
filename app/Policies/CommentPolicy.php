<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Comment $comment): Response
    {
        return ($user->id === $comment->user_id || $user->isModerator())
            ? Response::allow()
            : Response::deny('Вы не можете удалить этот комментарий.');
    }

    public function update(User $user, Comment $comment): Response
    {
        return ($user->id === $comment->user_id || $user->isModerator())
            ? Response::allow()
            : Response::deny('Вы не можете редактировать этот комментарий.');
    }
}
