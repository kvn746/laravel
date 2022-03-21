<?php

namespace App\Console\Commands;

use App\Article;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\User;

class NewArticlesNotification extends Command
{
    protected $signature = 'command:new-articles
        {users?* : Users for notification}
        {--period-start=0 : Start date for notification, if "0" a day ago period-end}
        {--period-end=0 : End date for notification, if "0" then current time}';

    protected $description = 'Notification of new articles for the period';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = $this->argument('users') ?
            User::findOrFail($this->argument('users')) :
            User::all();

        $periodEnd = $this->option('period-end') ? $this->option('period-end') : Carbon::now()->toDateTimeString();
        $periodStart = $this->option('period-start') ? $this->option('period-start') : Carbon::createFromDate($periodEnd)->subDay()->toDateTimeString();

        $period = 'с ' . $periodStart . ' по ' . $periodEnd;

        $articles = Article::whereBetween('created_at', [$periodStart, $periodEnd])->get();

        $users->map->notify(new \App\Notifications\NewArticlesNotification($period, $articles));
    }
}
