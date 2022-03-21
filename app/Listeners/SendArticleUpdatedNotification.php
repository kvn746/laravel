<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;
use App\Services;

class SendArticleUpdatedNotification
{
    public function handle(ArticleUpdated $event)
    {
        \Mail::to(Services::getAllAdministratorsEmail())->send(
            new \App\Mail\ArticleUpdated($event->article)
        );
        flash('Статья "' . $event->article->title . '" успешно изменена!');
    }
}
