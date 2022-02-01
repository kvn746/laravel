<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services;

class SendArticleCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        \Mail::to(Services::getAllAdministratorsEmail())->send(
            new \App\Mail\ArticleCreated($event->article)
        );
        push_all('Добавлена новая статья', $event->article->title);
        flash('Статья "' . $event->article->title . '" успешно создана!');
    }
}
