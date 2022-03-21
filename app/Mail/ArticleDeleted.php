<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArticleDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function build()
    {
        return $this->markdown('mail.article-deleted');
    }
}
