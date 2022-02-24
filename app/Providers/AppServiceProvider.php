<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'App\Services\ArticleServiceContract',
            'App\Services\ArticleService'
        );

        $this->app->singleton(
            'App\Services\CommentServiceContract',
            'App\Services\CommentService'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout.sidebar', function ($view) {
            $view->with('tagsCloud', \App\Tag::tagsCloud());
        });

        view()->composer('admin.sidebar', function ($view) {
            $view->with('tagsCloud', \App\Tag::tagsCloud());
        });

        Blade::if('admin', function() {
            return auth()->check() && auth()->user()->isAdmin();
        });

        Blade::if('moderator', function() {
            return auth()->check() && auth()->user()->isModerator();
        });

        Blade::if('editor', function() {
            return auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isModerator());
        });
    }
}
