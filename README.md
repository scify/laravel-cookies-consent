# Laravel Cookies Consent Plugin

[![Latest Version on Packagist](https://img.shields.io/packagist/v/scify/laravel-cookies-consent.svg?style=flat-square)](https://packagist.org/packages/scify/laravel-cookies-consent)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/scify/laravel-cookies-consent/run-tests?label=tests)](https://github.com/scify/laravel-cookies-consent/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/scify/laravel-cookies-consent/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/scify/laravel-cookies-consent/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/scify/laravel-cookies-consent.svg?style=flat-square)](https://packagist.org/packages/scify/laravel-cookies-consent)

## About the plugin

According to the [GDPR law](https://gdpr-info.eu/), every platform is required to allow the users to decide which cookie
categories they will allow,
and, if a cookie category is not allowed, the application should not use the functionality tied to that cookie.

This plugin provides a simple cookie consent window through which the user can specify the cookies they would like to
allow.

After the user submission, the page reloads and the relevant cookies are set on the browser, and can then be used in the front-end.

## Installation

You can install the package via composer:

```bash
composer require scify/laravel-cookies-consent
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="SciFY\LaravelCookiesConsent\LaravelCookiesConsentServiceProvider" --tag="cookies-consent-config"
```

In the config file, you can change the cookie categories of your application, set the required and pre-selected
categories, as well as add new categories.

This is the contents of the published config file:

```php
return [
    'cookies' => [
        'strictly_necessary', 
        'targeting', 
        'performance', 
        'functionality'
    ],
    'enabled' => [
        'strictly_necessary', 
        'targeting', 
        'performance', 
        'functionality'
    ],
    'required' => ['strictly_necessary']
];
```

You can add as many cookie categories as you like, simply by adding values to the `cookies` array.

If you want to remove a cookie category, simply remove it from the array.

You can use the `enabled` array to set the cookie categories that will be pre-selected,
and the `required` array to set the cookies that the user won't be able to deselect.

## Usage

When the plugin is installed, a `laravel-cookies-consent`
custom [Laravel View Component](https://laravel.com/docs/9.x/blade#components) is automatically registered.

This will render the following cookies consent that, will look very much like this one.

![dialog](https://github.com/scify/laravel-cookies-consent/blob/9c0ddafe15ad8118ab07979b72094799417f93db/images/dialog.png)

The styling of the component will also be published automatically, in
the `public/vendor/scify/laravel-cookies-consent/css/style.css` file.

**Notice:** Make sure to include this file to `.gitignore`.

You can then use this component in order to display the cookies consent window, wherever you'd like.

Typically, a good strategy is to put the component just before the closing `<body>` tag:

```html

<body>
...
...
...
<x-laravel-cookies-consent></x-laravel-cookies-consent>
</body>
```

After that, you can use the `$_COOKIE` global object, in order to check for the appropriate cookie.

For example, An application that want to load the Google Analytics script only if the user has given their consent to
the `targeting` cookie category,
might do the following:

```php
<!-- Google Analytics -->
@if(isset($_COOKIE['cookies_consent_targeting']) && config('app.google_analytics_id'))
    <script defer async>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        window.ga('create', '{{ config('app.google_analytics_id') }}', 'auto');
        window.ga('set', 'anonymizeIp', true);
        window.ga('send', 'pageview');
    </script>
@endif
```

In this example, we checked whether the `$_COOKIE['cookies_consent_targeting']` key exists or not.


## Customising the component texts

If you want to modify the texts shown in the cookies dialog, you can publish the language resource files with this
command:

```bash
php artisan vendor:publish --provider="SciFY\LaravelCookiesConsent\LaravelCookiesConsentServiceProvider" --tag="cookies-consent-translations"
```

This will publish this file to `resources/lang/vendor/cookies_consent/{{lang}}/messages.php`.

The plugin comes with 5 built-in languages. You can change the translations for a given language, or add additional
languages yourself.

### Customising the "Read more" link

In the cookies dialog, there is also an optional "Read more" link. This link is specified in the language translation
files, since it is common to have a different link for each language.

Example (file `lang/vendor/cookies_consent/en/messages.php`):

```php
return [
    ...
    'read_more_link' => '',
    ...
];
```

If the link is left empty (default state), it won't be shown.

### Customising the component contents

If you need full control over the contents of the cookies dialog, you can publish the views of the package:

```bash
php artisan vendor:publish --provider="SciFY\LaravelCookiesConsent\LaravelCookiesConsentServiceProvider" --tag="cookies-consent-components"
```

This will copy the `resources/views/components/laravel-cookies-consent` view file over
to `resources/views/components/vendor/cookies_consent` directory.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [SciFY Dev Team](https://github.com/scify)

## License

The Apache Licence. Please see the [Licence File](LICENCE.md) for more information.
