<?php

namespace App\Broadcasting;

use App\User;

class ReportChannel
{
    public function join(User $user)
    {
        return $user->id == auth()->user()->id;
    }
}
