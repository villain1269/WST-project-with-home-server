<?php

namespace App\Providers;

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
     *
     * PREFIX DEPLOYMENT: this app is served behind Caddy at
     * https://<host>/tfa6 (prefix stripped before proxying), so the router
     * sees clean paths while URL generation re-attaches the prefix from
     * APP_URL. See TFA5's identical provider for the full explanation.
     */
    public function boot(): void
    {
        $appUrl = config('app.url');

        if ($appUrl) {
            URL::forceRootUrl($appUrl);

            if (str_starts_with($appUrl, 'https://')) {
                URL::forceScheme('https');
            }
        }
    }
}
