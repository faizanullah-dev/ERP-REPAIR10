<?php

namespace App\Providers;

use File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $menus = [];
        if (File::exists(base_path('resources/laravel-admin/menus.json'))) {
            $menus = json_decode(File::get(base_path('resources/laravel-admin/menus.json')));
            view()->share('laravelAdminMenus', $menus);
        }

//        View::composer('*', function ($view) {
//
//            // 1. Fetch the list of notifications
//            $notificationList = Notification::orderBy('id', 'desc')
//                ->where('status', 'unseen')
//                ->where('model', 'Message Received')
//                ->get();
//
//            // 2. Get the count
//            $unseenNotificationsCount = Notification::where('status', 'unseen')
//                ->where('model', 'Message Received')
//                ->count();
//
//            // 3. Share the variables with the view
//            $view->with('notificationList', $notificationList);
//            $view->with('unseenNotificationsCount', $unseenNotificationsCount);
//        });

    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
