<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('articles', \App\Broadcasting\ArticleChannel::class);

Broadcast::channel('reports', \App\Broadcasting\ReportChannel::class);

Broadcast::channel('chat', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});
