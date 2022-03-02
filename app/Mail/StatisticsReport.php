<?php

namespace App\Mail;

use App\Http\Requests\StatisticsReportRequest;
use App\Services\AdminReportsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatisticsReport extends Mailable
{
    use Queueable, SerializesModels;

    public $reports;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reports)
    {
        $this->reports = $reports;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.statistic-report');
    }
}
