<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Inquiry;
use App\Models\Package;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFour();

        View::composer('admin.dashboard',function ($view){
            $view->with([
                'users' => User::all(),
                'inquiries' => Inquiry::all()
            ]);
        });
    }
}
