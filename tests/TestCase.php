<?php

namespace SciFY\LaravelCookiesConsent\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use SciFY\LaravelCookiesConsent\LaravelCookiesConsentServiceProvider;

class TestCase extends Orchestra {
    protected function setUp(): void {
        parent::setUp();
    }

    protected function getPackageProviders($app) {
        return [
            LaravelCookiesConsentServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app) {
    }
}
