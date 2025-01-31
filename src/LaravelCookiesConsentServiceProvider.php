<?php

namespace SciFY\LaravelCookiesConsent;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelCookiesConsentServiceProvider extends ServiceProvider {
    public function boot() {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cookies-consent');

        $this->publishes([
            __DIR__ . '/../resources/views/components/' => resource_path('views/vendor/cookies_consent/components'),
        ], 'cookies-consent-components');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/scify/laravel-cookies-consent'),
        ], 'cookies-consent-public');

        $this->publishes([
            __DIR__ . '/../config/cookies_consent.php' => config_path('cookies_consent.php'),
        ], 'cookies-consent-config');

        $this->publishes([
            __DIR__ . '/../lang' => app()->langPath() . '/vendor/cookies_consent',
        ], 'cookies-consent-translations');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cookies_consent');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'cookies_consent');

        Blade::component('laravel-cookies-consent', \SciFY\LaravelCookiesConsent\View\Components\LaravelCookiesConsent::class);
    }

    public function register() {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/cookies_consent.php', 'cookies_consent'
        );
    }
}
