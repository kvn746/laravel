<?php

namespace App\Jobs;

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
    public function handle(AdminReportsService $report)
    {
        $articles = $report->getAllArticlesCount();
        $news = $report->getAllNewsCount();
        $comments = $report->getAllCommentsCount();
        $tags = $report->getAllTagsCount();
        $users = $report->getAllUsersCount();

        echo "Articles: " . $articles . PHP_EOL;
        echo "News: " . $news . PHP_EOL;
        echo "Comments: " . $comments . PHP_EOL;
        echo "Tags: " . $tags . PHP_EOL;
        echo "Users: " . $users . PHP_EOL;
    }

    public function fail(\Exception $exception = null)
    {

    }
}
