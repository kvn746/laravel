<?php

namespace App\Listeners;

use App\Events\ArticleDeleted;
use App\Services;

class SendArticleDeletedNotification
{
    public function handle(ArticleDeleted $event)
    {
        \Mail::to(Services::getAllAdministratorsEmail())->send(
            new \App\Mail\ArticleDeleted($event->title)
        );
        flash('Статья "' . $event->title . '" успешно удалена!', 'warning');
    }
}
