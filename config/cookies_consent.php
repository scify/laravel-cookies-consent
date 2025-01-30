<?php

return [
    /**
     * This prefix will be applied when setting and getting all cookies.
     * If not set, the cookies will not be prefixed.
     * If set, a good strategy is to also add a trailing underscore "_", that will be added between the field value, and each cookie.
     * For example, if `cookie_prefix` is set to `my_app_`, then the cookies will be stored in a JSON object with the key `my_app_cookies_consent_selection`.
     * Example:
     *
     * {
     *    "my_app_cookies_consent_selection": {
     *       "strictly_necessary": true,
     *      "performance": false,
     *     "targeting": false
     *   }
     * }
     */
    'cookie_prefix' => 'my_app_',
    'display_floating_button' => true, // Set to false to display the footer link instead
    'use_separate_page' => false, // Set to true to use a separate page for cookies explanation
    /*
    |--------------------------------------------------------------------------
    | Editor
    |--------------------------------------------------------------------------
    |
    | Choose your preferred cookies to be shown. You can add more cookies as desired.
    |
    | Built-in: "strictly_necessary"
    |
    */
    'cookies' => [
        'strictly_necessary' => [
            [
                // you need to change this in order to reflect the cookie_prefix from above
                'name' => 'my_app_cookies_consent',
                'description' => 'This cookie is set by the GDPR Cookie Consent plugin and is used to store whether or not user has consented to the use of cookies. It does not store any personal data.',
                'duration' => '2 years',
                'policy_external_link' => null,
            ],
            [
                'name' => 'XSRF-TOKEN',
                'description' => 'This cookie is set by Laravel to prevent Cross-Site Request Forgery (CSRF) attacks.',
                'duration' => '2 hours',
                'policy_external_link' => null,
            ],
            [
                'name' => 'laravel_session',
                'description' => 'This cookie is set by Laravel to identify a session instance for the user.',
                'duration' => '2 hours',
                'policy_external_link' => null,
            ],
        ],
    ],
    'enabled' => [
        'strictly_necessary',
    ],
    'required' => ['strictly_necessary'],
    /*
     * Set the cookie duration in days.  Default is 365 days.
     */
    'cookie_lifetime' => 365,
];
