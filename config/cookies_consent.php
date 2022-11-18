<?php

return [
    /**
     * This prefix will be applied when setting and getting all cookies.
     * If not set, the cookies will not be prefixed.
     * When using this plugin for multiple apps, it is a good strategy to set a prefix that is relevant to the app
     * (for example "my_app_", in order for the cookies not to be mingled when running locally.
     */
    'cookie_prefix' => '',
    /*
    |--------------------------------------------------------------------------
    | Editor
    |--------------------------------------------------------------------------
    |
    | Choose your preferred cookies to be shown. You can add more cookies as desired.
    | If, for example you add another cookie with the name "marketing", then you should also
    | publish the translation files and add a "cookie_marketing" key in the translation file,
    | since the plugin will try to display the cookie name by this convention.
    |
    | Built-in: "strictly_necessary", "performance", "targeting", "functionality"
    |
    */
    'cookies' => [
        'strictly_necessary',
        'targeting',
        'performance',
        'functionality',
    ],
    'enabled' => [
        'strictly_necessary',
        'targeting',
        'performance',
        'functionality',
    ],
    'required' => ['strictly_necessary'],
    /*
     * Set the cookie duration in days.  Default is 365 * 10.
     */
    'cookie_lifetime' => 365 * 10,
];
