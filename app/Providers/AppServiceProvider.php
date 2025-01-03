<?php

namespace App\Providers;

use App\Events\EmployeeCreated;
use App\Events\EmployeeUpdated;
use App\Listeners\CreateTrackTikEmployee;
use App\Listeners\UpdateTrackTikEmployee;
use Illuminate\Support\Facades\Event;
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
        Event::listen(
            EmployeeCreated::class,
            CreateTrackTikEmployee::class,
        );

        Event::listen(
            EmployeeUpdated::class,
            UpdateTrackTikEmployee::class,
        );
    }
}
