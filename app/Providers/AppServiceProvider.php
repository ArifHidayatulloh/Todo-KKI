<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Todo;
use App\Models\Departemen;
use App\Models\Karyawan;
use App\Models\DepartmenUser;

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
            if (session('level') == 1) {
                $departemenIds = DepartmenUser::where('nik', session('nik'))->pluck('dep_code');
                if ($departemenIds->isNotEmpty()) {
                    $requestDone = Todo::whereIn('dep_code', $departemenIds)->where('req_status','request')->count();
                } else {
                    $requestDone = Todo::where('req_status', 'request')->count();
                }
            }else{
                $requestDone = Todo::where('req_status', 'request')->count();
            }
            $view->with([
                'notifications' => $notifications,
                'unread' => $unread,
                'requestDone' => $requestDone
            ]);
        });
    }
}
