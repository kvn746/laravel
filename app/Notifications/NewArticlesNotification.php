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

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($period, $articles)
    {
        $this->period = $period;
        $this->articles = $articles;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
        return (new MailMessage)
            ->subject('Новые статьи за период: ' . $this->period)
            ->markdown('mail.new-articles-notification', ['articles' => $this->articles, 'period' => $this->period])
//            ->line('Новые статьи за период: ' . $this->period . ":")
//            ->action('Перейти к статьям', '/articles/')
            ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
