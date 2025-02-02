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

    protected function getEnvironmentSetUp($app) {
        // This method is intentionally left empty because the default environment setup is sufficient for these tests.
    }

    public function assertTranslationExists(string $key) {
        $this->assertTrue(trans($key) != $key, "Failed to assert that a translation exists for key `{$key}`");
    }
}
