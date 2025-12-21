<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Friendship;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
        if (auth()->check()) {
            $pendingCount = Friendship::where('friend_id', auth()->id())
                ->where('status', 'pending')
                ->count();

            $view->with('pendingFriendRequests', $pendingCount);
        }
    });
    }
}
