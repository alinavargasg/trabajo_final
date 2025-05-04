<?php

namespace App\Providers;
//use App\Models\Order;
//use App\Observers\OrderObserver;
use App\Services\LoggerSingleton;
use Illuminate\Support\ServiceProvider;
use App\Models\Prestamo;
use App\Observers\PrestamoObserver;


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
        $this->app->singleton(LoggerSingleton::class, function ($app) {
            return new LoggerSingleton();
        });

        $this->app->singleton('NotificadorFacade', function ($app) {
            return new \App\Services\NotificadorService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Prestamo::observe(PrestamoObserver::class);
    }
}
