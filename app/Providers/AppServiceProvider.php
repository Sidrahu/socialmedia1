<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Like;

class AppServiceProvider extends ServiceProvider
{
    // Blade::component('sidebar-link', \App\View\Components\SidebarLink::class);

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
        if (Auth::check()) {
        // Update last_seen_at field every request
        DB::table('users')
            ->where('id', Auth::id())
            ->update(['last_seen_at' => now()]);

       View::composer('*', function ($view) {
        if (auth()->check()) {
            $likesCount = Like::whereHas('post', function ($query) {
                $query->where('user_id', auth()->id());
            })->where('is_seen', false)->count();

            $view->with('likesCount', $likesCount);
        }
    });
    }
    }
}
