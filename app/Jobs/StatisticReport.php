<?php

namespace App\Jobs;

use App\Http\Requests\StatisticsReportRequest;
use App\Services\AdminReportsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StatisticReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(StatisticsReportRequest $request, AdminReportsService $report)
    {
        $reports = $report->getStatisticReport($request);
    }

    public function fail(\Exception $exception = null)
    {

    }
}
