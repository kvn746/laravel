<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewArticlesNotification extends Notification
{
    use Queueable;

    public $period;
    public $articles;

    public function __construct($period, $articles)
    {
        $this->period = $period;
        $this->articles = $articles;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail()
    {
        return (new MailMessage)
            ->subject('Новые статьи за период: ' . $this->period)
            ->markdown('mail.new-articles-notification', ['articles' => $this->articles, 'period' => $this->period])
//            ->line('Новые статьи за период: ' . $this->period . ":")
//            ->action('Перейти к статьям', '/articles/')
            ;
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
