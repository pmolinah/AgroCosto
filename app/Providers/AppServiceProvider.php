<?php

namespace App\Providers;
use Carbon\Carbon;
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
        Carbon::setWeekStartsAt(Carbon::MONDAY);
        // Opcional: Configura el primer día de la semana también para la función de fin de semana
        Carbon::setWeekEndsAt(Carbon::SUNDAY);
    }
}
