<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- URL Facade import kiya hai

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
        // Cloudflare Tunnel aur HTTPS requests ke liye links force karein:
        if (request()->server->has('HTTP_X_FORWARDED_PROTO') || config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
