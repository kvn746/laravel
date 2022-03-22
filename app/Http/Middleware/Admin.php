<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user && ! $user->isAdmin() && ! $user->isModerator()) {
            return redirect()->route('main');
        }

        return $next($request);
    }
}
