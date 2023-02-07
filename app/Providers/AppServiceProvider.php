<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Inquiry;
use App\Models\Package;
use App\Models\Place;
use App\Models\User;
use App\Models\Vehicle;
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
        Paginator::useBootstrapFive();

        View::composer('admin.dashboard',function ($view){
            $view->with([
                'users' => User::all(),
                'inquiries' => Inquiry::all()
            ]);
        });
        View::composer([
            'package.show'
        ],function ($view){
            $view->with([
                'places' => Place::latest('id')->get(),
                'vehicles' => Vehicle::latest('id')->get()
            ]);
        });
    }
}
