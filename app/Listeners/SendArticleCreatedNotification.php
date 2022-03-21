<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use App\Services;

class SendArticleCreatedNotification
{
    public function handle(ArticleCreated $event)
    {
        \Mail::to(Services::getAllAdministratorsEmail())->send(
            new \App\Mail\ArticleCreated($event->article)
        );
        push_all('Добавлена новая статья', $event->article->title);
        flash('Статья "' . $event->article->title . '" успешно создана!');
    }
}
