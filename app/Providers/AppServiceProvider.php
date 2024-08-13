<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // if(config('app.env') === 'local'){
        //     URL::forceScheme('https');
        // }

        View::composer('*', function ($view) {
            $userId = session('nik');
            $notifications = Notification::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            $unread = Notification::where('user_id', $userId)
                ->where('is_read', false)
                ->count();
            $view->with([
                'notifications' => $notifications,
                'unread' => $unread
            ]);
        });
    }
}
