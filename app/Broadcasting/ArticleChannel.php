<?php

namespace App\Broadcasting;

use App\User;

class ArticleChannel
{
    public function join(User $user)
    {
        if ($user->isAdmin() || $user->isModerator()) {
            return ['id' => $user->id, 'name' => $user->name];
        }

        return false;
    }
}
