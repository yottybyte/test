<?php

namespace App\Providers;

use App\Http\Services\Logging;
use Illuminate\Support\ServiceProvider;

class LoggingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(Logging::class, function () {
            return new Logging();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
