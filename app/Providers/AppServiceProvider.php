<?php

namespace App\Providers;

use Illuminate\Support\Facades\Session;
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
        // Compartilha as variáveis com TODAS as views
        View::composer('*', function ($view) {
            $view->with('auth', Session::has('auth'));
            $view->with('user', Session::get('user'));
        });
    }
}