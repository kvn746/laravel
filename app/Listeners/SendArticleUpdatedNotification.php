<?php

namespace App\Listeners;

use App\Events\ArticleUpdated;
use App\Services;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendArticleUpdatedNotification
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
     * @param  ArticleUpdated  $event
     * @return void
     */
    public function handle(ArticleUpdated $event)
    {
        \Mail::to(Services::getAllAdministratorsEmail())->send(
            new \App\Mail\ArticleUpdated($event->article)
        );
        flash('Статья "' . $event->article->title . '" успешно изменена!');
    }
}
