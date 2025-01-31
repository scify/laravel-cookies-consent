# Changelog

All notable changes to `laravel-cookies-consent` will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## v3.0.6 - Assets files are no longer published in the public directory - 2025-01-31

In order to simplify the installation process and avoid potential conflicts with existing assets, the front-end assets
are no longer published in the public directory. The assets are now included directly in the package and loaded from the
vendor directory.

This means that the `public/vendor/cookies_consent` directory now should contain only the `cookie.png` image file.

In order to update to the new version, you need to remove the `public/vendor/cookies_consent` directory and run the
asset publishing command:

```bash
rm -rf public/vendor/cookies_consent
```

And then:

```bash
php artisan vendor:publish \
--provider="SciFY\LaravelCookiesConsent\LaravelCookiesConsentServiceProvider" \
--tag="cookies-consent-assets"
```

## v3.0.2 - Major Release - JSON Cookie Storage & Configuration Changes - 2025-01-30

### Breaking Changes

* JSON Cookie Storage: Cookies are now stored in a JSON object under a single key with the prefix specified in the
  configuration file. This change improves the structure and management of cookies.

* Configuration File Changes: The configuration file format has been updated to reflect the new JSON cookie storage
  method. The `cookie_prefix` is now used to store cookies in a JSON object.

## New Features

* JSON Cookie Storage: Cookies are now stored in a JSON object under a single key with the prefix specified in the
  configuration file. This change improves the structure and management of cookies.
* `hide_floating_button_on_mobile` option: A new configuration option has been added to hide the floating cookies button
  on mobile devices. This option allows you to control the visibility of the floating button based on the device type.
* UI/UX Improvements: The cookies consent modal has been updated with improved styling and layout for a better user
  experience.

### Migration Guide

1. Update the configuration file to reflect the new JSON cookie storage method:

* Ensure the `cookie_prefix` is set in the `config/cookies_consent.php` file.
* Update the `name` field of each cookie in the `cookies` array to reflect the new JSON storage format.

Example:

```php
'cookie_prefix' => 'my_app_',
'cookies' => [
    'strictly_necessary' => [
        [
            'name' => 'my_app_cookies_consent',
            'description' => 'This cookie is set by the GDPR Cookie Consent plugin and is used to store whether or not user has consented to the use of cookies. It does not store any personal data.',
            'duration' => '2 years',
            'policy_external_link' => null,
        ],
        // other cookies...
    ],
    'targeting' => [
        // cookies...
    ],
],
```

2. Update Blade Files

* Update the Blade files to reflect the new JSON cookie storage method. The `cookie` helper function is used to set and
  retrieve cookies from the JSON object.

Example:

```php
@if(isset($_COOKIE[config('cookies_consent.cookie_prefix') . 'cookies_consent']))
    @php
        $cookiesConsent = json_decode($_COOKIE[config('cookies_consent.cookie_prefix') . 'cookies_consent'], true);
    @endphp
    @if(isset($cookiesConsent['targeting']) && $cookiesConsent['targeting'] && config('app.google_analytics_id'))
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
@endif
```

3. Publish the front-end assets

* Run the following command to publish the updated assets:
  `php artisan vendor:publish --provider="SciFY\LaravelCookiesConsent\LaravelCookiesConsentServiceProvider" --tag="cookies-consent-assets" --force`

4. Test your application

* Ensure that the cookies consent functionality works as expected with the new JSON storage format.
* Verify that the cookies are correctly set and retrieved in the browser.

## v2.0.7 - UI Improvements for smaller screens - 2024-01-27

- Improved the UI design for smaller screens (phones & tablets)
- Fixed the width of the cookies container

## v2.0.0 - Major Release - GDPR & UI Improvements - 2024-10-10

The v2 of the Laravel Cookies Consent plugin has been released! 🎉🥳😍

This version includes some important changes and improvements, such as:

- A new configuration file format. Now you can declare the cookies each cookie category uses in a
  more structured way.
- A new, clean, and intuitive UI for the cookies consent modal.
- An option to present the cookies consent dialog in a separate page instead of a modal.
- A stick cookies button that allows users to change their cookies preferences at any time. This button is optional and
  it's existence can be tweaked in the configuration file.
- A separate page for the cookies preferences, where users can read more about each cookie category and change their
  preferences.

## v1.1.3 - UI Improvements for compliance with GDPR - 2023-10-26

- Changed the background color of the "Allow all cookies" button, in order to be compliant with the GDPR rules
- Fixed the padding of the button texts

## v.1.1.2 - Portuguese Language v2

Added Portuguese Language corrections, thanks to
this [PR](https://github.com/scify/laravel-cookies-consent/commit/a0ce037cd3bc82ca95c52ff30d2bf07236bd8306)
by [ViNiSeNnAtt](https://github.com/scify/laravel-cookies-consent/commits?author=ViNiSeNnAtt)

## v1.1.1 - Portuguese Language

Added Portuguese Language, thanks
to [this commit](https://github.com/scify/laravel-cookies-consent/commit/c5e015f93df4ad9a40450cea37231592613e77b8)
by [ViNiSeNnAtt](https://github.com/scify/laravel-cookies-consent/commits?author=ViNiSeNnAtt)

## v1.1.0 - Improvements regarding the styles file, Composer lib updates

Improvements regarding the styles file, Composer lib updates

**List of Updates:**

- Fixed z-index issue (as reported in https://github.com/scify/laravel-cookies-consent/issues/10)
- Now the front-end assets (styles) file is not automatically published, to avoid causing overriding (reported   
  in https://github.com/scify/laravel-cookies-consent/issues/11)
- Composer libraries update
- Improved Development guidelines in Readme file

**Notable Changes:**

Now, in order to publish the styles file to `public/vendor/cookies_consent/css/style.css` it is **required** to manually
run the publishing command:

```bash
php artisan vendor:publish \
--provider="SciFY\LaravelCookiesConsent\LaravelCookiesConsentServiceProvider" \
--tag="cookies-consent-assets"

```

## v1.0.1 - Fixed bug on setting "all" cookies button - 2023-03-16

This release addresses [this issue](https://github.com/scify/laravel-cookies-consent/issues/4), regarding the cookie
prefix when accepting "all" cookies.

## v1.0.0 - First Stable Release - 2022-12-19

This is the first stable release of the plugin!
Feel free to download, try and customize it. If you find any issues, please report them to
the [issue page](https://github.com/scify/laravel-cookies-consent/issues).
Check out the [CONTRIBUTING.md](https://github.com/scify/laravel-cookies-consent/blob/main/CONTRIBUTING.md) guide to
contribute to this open-source project!

## Use of app()->langPath() Laravel method, in order to publish the translation resources - 2022-12-09

The plugin now uses Laravel's `app()->langPath()` method, in order to publish the translation files.

## v0.9.3 - Plugin is now compatible with all 7.x and 8.x versions - 2022-11-21

Set the required PHP version to either `7.x` or `8.x`, in order to accommodate older Laravel installations.

## v0.9.2 - Fixed bugs on cookie prefix, improved documentation - 2022-11-21

- Now the cookie prefix is set entirely from the configuration file. The trailing character should be set there.

## v0.9.0 - Tested and improved UI in smaller screens - 2022-11-21

- Improved UI design in smaller (phone & tablet) screens.
- The plugin is now ready to be tested and used in 3rd party Laravel apps.

## v0.0.3 - Improvements in Design & Layout - 2022-11-21

Improved the overall design and fixed the width of the cookies container

## v0.0.2 - Added translations, cookie lifetime duration - 2022-11-18

- Added the ability to set cookie duration
- Fixed container width on larger screens
- Added remaining languages
- Improved README.md instructions

## v0.0.1 First Testing Version - 2022-11-18

This is the initial release of the plugin.
SciFY Team will start testing the plugin in our own projects and proceed to the release of version 1.0.0, when deem
applicable.
