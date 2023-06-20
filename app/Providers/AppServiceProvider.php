<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
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
        Gate::define('administrator', function ($user) {
            return $user->role === 'administrator';
        });

        Gate::define('unitadmin', function ($user) {
            return $user->role === 'unitadmin';
        });

        Gate::define('borrower', function ($user) {
            return $user->role === 'borrower';
        });
    }
}
