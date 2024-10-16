<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\PostLikeObserver;
use App\Models\PostLike;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // PostLike::observe(PostLikeObserver::class);
    }
}
