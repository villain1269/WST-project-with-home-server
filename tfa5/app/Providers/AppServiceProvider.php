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
     * PREFIX DEPLOYMENT:
     * This app is served behind Caddy at https://<host>/tfa5, and Caddy
     * strips the prefix before proxying, so the router only ever sees
     * clean paths (/about, /customers). The URL generators (url(), asset(),
     * route()) would normally build URLs from the request root, which lacks
     * the /tfa5 prefix. Forcing the root URL from APP_URL makes every
     * generated link include the prefix, both through the proxy and when
     * running locally (where APP_URL points at 127.0.0.1:8001).
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
