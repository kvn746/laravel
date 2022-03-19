<?php

use App\Article;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

//Broadcast::channel('articles.{articleId}', function ($user, Article $article) {
//    return $article->owner_id == $user->id || $user->isAdmin() || $user->isModerator();
//});

Broadcast::channel('articles', \App\Broadcasting\ArticleChannel::class);

Broadcast::channel('reports', \App\Broadcasting\ReportChannel::class);

Broadcast::channel('chat', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});
