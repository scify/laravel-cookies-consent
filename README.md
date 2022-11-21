# Laravel Cookies Consent Plugin - Make your Laravel app compliant with the EU GDPR cookie law

[![Latest Version on Packagist](https://img.shields.io/packagist/v/scify/laravel-cookies-consent.svg?style=flat-square)](https://packagist.org/packages/scify/laravel-cookies-consent)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/scify/laravel-cookies-consent/run-tests?label=tests)](https://github.com/scify/laravel-cookies-consent/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/scify/laravel-cookies-consent/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/scify/laravel-cookies-consent/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/scify/laravel-cookies-consent.svg?style=flat-square)](https://packagist.org/packages/scify/laravel-cookies-consent)
[![GitHub Issues](https://img.shields.io/github/issues/scify/laravel-cookies-consent)](https://img.shields.io/github/issues/scify/laravel-cookies-consent)
[![GitHub Stars](https://img.shields.io/github/stars/scify/laravel-cookies-consent)](https://img.shields.io/github/stars/scify/laravel-cookies-consent)
[![GitHub forks](https://img.shields.io/github/forks/scify/laravel-cookies-consent)](https://img.shields.io/github/forks/scify/laravel-cookies-consent)
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/dwyl/esta/issues)
[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)](https://GitHub.com/Naereen/StrapDown.js/graphs/commit-activity)
[![Ask Me Anything !](https://img.shields.io/badge/Ask%20me-anything-1abc9c.svg)](https://GitHub.com/scify)

## About the plugin

According to the [GDPR law](https://gdpr-info.eu/), every platform is required to allow the users to decide which cookie
categories they will allow,
and, if a cookie category is not allowed, the application should not use the functionality tied to that cookie.

This plugin provides a simple cookie consent window through which the user can specify the cookies they would like to
allow.

After the user submission, the page reloads and the relevant cookies are set on the browser, and can then be used in the
front-end.

## Features

- Customizable cookie categories
- Customizable pop-up view and style
- Customizable show/hide "Read more" link
- Customizable translations (6 languages already included)

## Installation

You can install the package via composer:

```bash
composer require scify/laravel-cookies-consent
```

If on Laravel 9 or newer, the assets files (style.css) will **automatically** be published

If on Laravel 8 or older, **make sure to manually publish** the styles file, by running:

```bash
php artisan vendor:publish \
--provider="SciFY\LaravelCookiesConsent\LaravelCookiesConsentServiceProvider" \
--tag="laravel-assets"
```

In both cases, the assets files will be copied to `public/vendor/cookies_consent`.

You can then either decide to include the `public/vendor/cookies_consent/style.css` file to git (especially if you want
to edit it first), or add it to `.gitignore`, and make sure to also run this command on the staging/production server.

You can publish the config file with:

```bash
php artisan vendor:publish \
--provider="SciFY\LaravelCookiesConsent\LaravelCookiesConsentServiceProvider" \
--tag="cookies-consent-config"
```

The configuration file will be published to `config/cookies_consent.php`.

In the config file, you can change the cookie categories of your application, set the required and pre-selected
categories, as well as add new categories.

This is the contents of the published config file:

```bash
return [
    'cookie_prefix' => '',
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
    'required' => ['strictly_necessary'],
    'cookie_lifetime' => 365 * 10,
];
```

The `cookie_prefix` is optional and, if set, will be applied to every cookie. A good example of customizing
the `cookie_prefix` variable is setting it with a character divider at the end, for example `"my_app_"`.

You can add as many cookie categories as you like, simply by adding values to the `cookies` array.

If you want to remove a cookie category, simply remove it from the array.

You can use the `enabled` array to set the cookie categories that will be pre-selected,
and the `required` array to set the cookies that the user won't be able to deselect.

If you want to change how long the cookies will be stored, edit the `cookie_lifetime` variable.

## Usage

When the plugin is installed, a `laravel-cookies-consent`
custom [Laravel View Component](https://laravel.com/docs/9.x/blade#components) is automatically registered.

This will render the following cookies consent that, will look very much like this one.

![dialog](https://github.com/scify/laravel-cookies-consent/blob/9c0ddafe15ad8118ab07979b72094799417f93db/images/dialog.png)

You can then use this component in order to display the cookies consent window, wherever you'd like.

Typically, a good strategy is to put the component just before the closing `<body>` tag:

```bash
<body>
    ...
    ...
    ...
    <x-laravel-cookies-consent></x-laravel-cookies-consent>
</body>
```

After that, you can use the `$_COOKIE` global object, in order to check for the appropriate cookie.

Now you can use this object in your Blade files like this:

```bash
$_COOKIE[config('cookies_consent.cookie_prefix') . {{ COOKIE_NAME }}]
```

For example, An application that wants to load the Google Analytics script only if the user has given their consent to
the `targeting` cookie category,
might do the following:

```bash
google-analytics.blade.php

<!-- Check the 'targeting' cookie: -->
@if(isset($_COOKIE[config('cookies_consent.cookie_prefix') 
. 'cookies_consent_targeting']) && config('app.google_analytics_id'))
    
    <!-- Google Analytics -->
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

In this example, we checked whether
the `$_COOKIE[config('cookies_consent.cookie_prefix') . 'cookies_consent_targeting']` key exists or not.

## Customization

### Customizing the component texts

If you want to modify the texts shown in the cookies dialog, you can publish the language resource files with this
command:

```bash
php artisan vendor:publish \
--provider="SciFY\LaravelCookiesConsent\LaravelCookiesConsentServiceProvider" \
--tag="cookies-consent-translations"
```

This will publish this file to `resources/lang/vendor/cookies_consent/{{lang}}/messages.php`.

The plugin comes with 6 built-in languages. You can change the translations for a given language, or add additional
languages yourself.

### Customizing the "Read more" link

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

### Customizing the component contents

If you need full control over the contents of the cookies dialog, you can publish the views of the package:

```bash
php artisan vendor:publish \
--provider="SciFY\LaravelCookiesConsent\LaravelCookiesConsentServiceProvider" \
--tag="cookies-consent-components"
```

This will copy the `resources/views/components/laravel-cookies-consent` view file over
to `resources/views/components/vendor/cookies_consent` directory.

## Testing

This project uses [Pest](https://pestphp.com/) for testing. To execute the test suite, run:

```bash
composer test
```

## FAQ

**Question:** Is this plugin free to use?

**Answer:** Yes. This plugin is totally free and developed as
an [Open-Source project](https://github.com/scify/laravel-cookies-consent).

---

**Question:** How long do the cookies last?

**Answer:** The duration is set in days, in `config/cookies_consent.php` file. In order to publish this file, run

```bash
php artisan vendor:publish \
--provider="SciFY\LaravelCookiesConsent\LaravelCookiesConsentServiceProvider" \
--tag="cookies-consent-config"
```

The configuration file will be published to `config/cookies_consent.php`.

Then, edit the `cookie_lifetime` field (in days).

---

**Question:** Will the cookie consent window show every time?

**Answer:** No. As soon as the user clicks one of the "Accept all", "Accept selection", or "Decline all", the selection
will be stored in another cookie, and the window won't pop up again, until this cookie expires, or is deleted.

---

**Question:** In which languages is the plugin available?

**Answer:** The plugin has 6 built-in languages: English, Greek, Spanish, German, Italian, and Swedish. If you would
like to add a language, publish the translations by running:

```bash
php artisan vendor:publish \
--provider="SciFY\LaravelCookiesConsent\LaravelCookiesConsentServiceProvider" \
--tag="cookies-consent-translations"
```

And add/change your own translations. If you add a new language, consider also opening
a [pull request](https://github.com/scify/laravel-cookies-consent/pulls), in order for this language to be included in
the plugin.

---

**Question:** Does this plugin work with all Laravel versions?

**Answer:** We have tested the plugin with Laravel 7, 8, and 9. The plugin's simplicity allows it to work with any
Laravel version, but if you try it with a version other that the tested ones and it does not work, please open an issue
on [GitHub](https://github.com/scify/laravel-cookies-consent/issues).

---

**Question:** If I install later a new cookie category, how can I force the plugin to "reset" and show again?

**Answer:** The easiest way is to publish the configuration file, and change the `cookie_prefix` field. This will force
the plugin to show again.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [SciFY Dev Team](https://github.com/scify)

## License

The Apache Licence. Please see the [Licence File](LICENCE.md) for more information.
