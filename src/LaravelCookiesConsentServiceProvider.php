<?php

namespace SciFY\LaravelCookiesConsent;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\TranslationServiceProvider;

class LaravelCookiesConsentServiceProvider extends ServiceProvider {
    public function boot() {
        $publishedPathResources = resource_path('lang/vendor/scify/laravel-cookies-consent');
        $publishedPathLang = base_path('lang/vendor/scify/laravel-cookies-consent');
        $packagePath = __DIR__ . '/../lang';

        if (is_dir($publishedPathResources)) {
            $this->loadTranslationsFrom($publishedPathResources, 'cookies_consent');
        } elseif (is_dir($publishedPathLang)) {
            $this->loadTranslationsFrom($publishedPathLang, 'cookies_consent');
        } else {
            $this->loadTranslationsFrom($packagePath, 'cookies_consent');
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cookies_consent');

        $this->publishes([
            __DIR__ . '/../resources/views/components/' => resource_path('views/vendor/scify/laravel-cookies-consent/components'),
        ], 'cookies-consent-components');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/scify/laravel-cookies-consent'),
        ], 'cookies-consent-public');

        $this->publishes([
            __DIR__ . '/../config/cookies_consent.php' => config_path('cookies_consent.php'),
        ], 'cookies-consent-config');

        $this->publishes([
            __DIR__ . '/../lang' => app()->langPath() . '/vendor/scify/laravel-cookies-consent',
        ], 'cookies-consent-translations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        Blade::component('laravel-cookies-consent', \SciFY\LaravelCookiesConsent\View\Components\LaravelCookiesConsent::class);
    }

    public function register() {
        // Ensure the translation service is registered
        $this->app->register(TranslationServiceProvider::class);
        $this->mergeConfigFrom(
            __DIR__ . '/../config/cookies_consent.php', 'cookies_consent'
        );
    }
}
