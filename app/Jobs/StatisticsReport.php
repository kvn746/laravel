<?php

namespace App\Jobs;

use App\Events\ReportCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StatisticsReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $reports;
    private $user;

    public function __construct($user, $reports)
    {
        $this->reports = $reports;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::to($this->user)->send(
            new \App\Mail\StatisticsReport($this->reports)
        );

        $report ='';
        foreach ($this->reports as $item) {
            $report .=  $item['title'] . $item['value'] . PHP_EOL;
        }

        event(new ReportCreated($report));
    }

    public function fail(\Exception $exception = null)
    {

    }
}
