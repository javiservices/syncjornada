<?php

namespace App\Providers;

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
        // Register observers
        \App\Models\TimeEntry::observe(\App\Observers\TimeEntryObserver::class);

        // Trust all proxies for HTTPS detection (sin incluir puerto)
        $this->app['request']->setTrustedProxies(
            ['*'],
            \Symfony\Component\HttpFoundation\Request::HEADER_X_FORWARDED_FOR |
            \Symfony\Component\HttpFoundation\Request::HEADER_X_FORWARDED_PROTO
        );

        // Force HTTPS in production
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
