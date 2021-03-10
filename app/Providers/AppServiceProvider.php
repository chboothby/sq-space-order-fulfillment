<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\URL;

// if ($this->app->environment() == 'production') {
//     URL::forceScheme('https');
// }


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
        Blade::directive('icon', function ($expression) {
            return "<i class=\"fas fa-fw fa-{{ $expression }}\"></i>";
        });

        if(config(‘app.env’) === ‘production’) {
            \URL::forceScheme(‘https’);
    }

   
}
