<?php

namespace App\Events;

use App\Article;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleCreated implements ShouldBroadcast
{
    use Dispatchable, SerializesModels, InteractsWithSockets;

    public $article;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function broadcastOn()
    {
        return new Channel('articles');
    }

    public function broadcastAs()
    {
        return 'article-created';
    }

    public function broadcastWith()
    {
        return [
            'article' => $this->article,
            'route' => route('admin.articles.show', $this->article),
            'message' => 'Создана статья: ',
        ];
    }
}
