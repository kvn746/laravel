<?php

namespace App\Broadcasting;

use App\User;

class ArticleChannel
{

    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User  $user
     * @return array|bool
     */
    public function join(User $user)
    {
        if ($user->isAdmin() || $user->isModerator()) {
            return ['id' => $user->id, 'name' => $user->name];
        }

        return false;
    }
}
