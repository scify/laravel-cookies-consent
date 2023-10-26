# Changelog

All notable changes to `laravel-cookies-consent` will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## v1.1.3 - UI Improvements for compliance with GDPR - 2023-10-26

- Changed the background color of the "Allow all cookies" button, in order to be compliant with the GDPR rules
- Fixed the padding of the button texts

## v.1.1.2 - Portoguese Language v2

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
