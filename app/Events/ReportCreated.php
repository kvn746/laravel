<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReportCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $report;

    public function __construct($report)
    {
        $this->report = $report;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('reports');
    }

    public function broadcastAs()
    {
        return 'report-created';
    }

    public function broadcastWith()
    {
        return [
            'report' => $this->report,
            'message' => 'Создан отчет: ',
        ];
    }
}
