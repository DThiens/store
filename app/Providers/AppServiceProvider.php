<?php

namespace App\Providers;

use App\View\Components\Alert;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\View\Components\Input\button;
use App\View\Components\forms\button as formButton;
use Illuminate\Pagination\Paginator;

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
        Blade::component('alert', Alert::class);
        Blade::component('button', button::class);
        Blade::component('form-button', formButton::class);
        Paginator::useBootstrap();
    }
}
