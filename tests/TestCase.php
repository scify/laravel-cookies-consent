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

    public function assertTranslationExists(string $key) {
        $this->assertTrue(trans($key) != $key, "Failed to assert that a translation exists for key `{$key}`");
    }
}
