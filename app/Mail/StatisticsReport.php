<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatisticsReport extends Mailable
{
    use Queueable, SerializesModels;

    public $reports;

    public function __construct($reports)
    {
        $this->reports = $reports;
    }

    public function build()
    {
        return $this->markdown('mail.statistic-report');
    }
}
