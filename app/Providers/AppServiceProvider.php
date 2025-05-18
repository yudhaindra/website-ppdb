<?php

namespace App\Providers;

use App\Models\Registration;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
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
        if ($this->app->environment('staging')) {
            URL::forceScheme('https');
        }

        Paginator::useBootstrapFive();
        // Ambil data pendaftaran untuk ditampilkan di navbar
        view()->composer('layouts.app', function ($view) {
            $registrations = Registration::open()->get();;
            $view->with('registrations', $registrations);
        });
    }
}
