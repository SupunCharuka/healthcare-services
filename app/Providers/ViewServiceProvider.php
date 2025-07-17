<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('backend.layouts.master','frontend.layouts.master', function ($view) {
            $roles = Auth::user()->getRoleNames()->toArray();
            if (in_array('customer', $roles, true)) {
                $folder = 'customer';
            } elseif (in_array('member', $roles, true)) {
                $folder = 'member';
            } elseif (in_array('super-admin', $roles, true)) {
                $folder = 'super-admin';
            } else {
                $folder = 'admin';
            }
            $view->with('folder', $folder);
        });
    }
}
