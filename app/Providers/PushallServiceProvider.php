<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PushallServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Services\Pushall::class, function () {
            return new \App\Services\Pushall(config('services.pushall.key'), config('services.pushall.id'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
