<?php

namespace App\Events;

use App\Article;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleDeleted implements ShouldBroadcast
{
    use Dispatchable, SerializesModels, InteractsWithSockets;

    public $title;

    public function __construct(Article $article)
    {
        $this->title = $article->title;
    }

    public function broadcastOn()
    {
        return new PresenceChannel('articles');
    }

    public function broadcastAs()
    {
        return 'article-deleted';
    }

    public function broadcastWith()
    {
        return [
            'title' => $this->title,
            'message' => 'Удалена статья: ',
        ];
    }
}
