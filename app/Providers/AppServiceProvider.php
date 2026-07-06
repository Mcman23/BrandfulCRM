<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS URL generation in production so all generated
        // links, redirects and asset URLs use https:// even though
        // Render's internal proxy forwards plain HTTP to the container.
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
