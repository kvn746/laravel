<?php

namespace App\Events;

use App\Article;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleUpdated implements ShouldBroadcast
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
        return new PresenceChannel('articles');
    }

    public function broadcastAs()
    {
        return 'article-updated';
    }

    public function broadcastWith()
    {
        $history = '';

        foreach ($this->article->history as $item) {
            $history .= $item->pivot->created_at->diffForHumans() . ': ';
            $history .= 'Before: ' .
                implode(', ', array_map(
                        function ($value, $key) {
                            return sprintf("%s: %s", $key, $value);
                        },
                        $item->pivot->old_value,
                        array_keys($item->pivot->old_value)
                    )
                )
                . ' | ';
            $history .= 'After: ' .
                implode(', ', array_map(
                        function ($value, $key) {
                            return sprintf("%s: %s", $key, $value);
                        },
                        $item->pivot->new_value,
                        array_keys($item->pivot->new_value)
                    )
                )
                . PHP_EOL;
        }

        return [
            'article' => $this->article,
            'history' => $history,
            'route' => route('articles.show', $this->article),
            'message' => 'Обновлена статья: ',
        ];
    }
}
