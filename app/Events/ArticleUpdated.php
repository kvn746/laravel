<?php

namespace App\Events;

use App\Article;
use App\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleUpdated
{
    use Dispatchable, SerializesModels;

    public $article;
    public $administrators;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->administrators = (new User())->getAllAdministratorsEmail();
    }
}
