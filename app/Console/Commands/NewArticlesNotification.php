<?php

namespace App\Console\Commands;

use App\Article;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\User;

class NewArticlesNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:new-articles
        {period-start : Start date for notification}
        {period-end : End date for notification, if "0" then current time}
        {users* : Users for notification}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notification of new articles for the period';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::findOrFail($this->argument('users'));

        $periodStart = $this->argument('period-start');
        $periodEnd = $this->argument('period-end') == 0 ? Carbon::now()->toDateTimeString() : $this->argument('period-end');

        $period = 'с ' . $periodStart . ' по ' . $periodEnd;

        $articles = Article::whereBetween('created_at', [$periodStart, $periodEnd])->get();

        $users->map->notify(new \App\Notifications\NewArticlesNotification($period, $articles));
    }
}
