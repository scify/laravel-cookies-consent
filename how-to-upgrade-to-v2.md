# How To Upgrade to v2

The v2 of the Laravel Cookies Consent plugin has been released! 🎉🥳😍

## Why Upgrade?

According to the EU General Data Protection Regulation (GDPR), websites must obtain user consent before storing cookies
on a user's device. The Laravel Cookies Consent plugin helps you comply with this regulation by providing a customizable
cookies consent dialog that allows users to choose which cookies they want to accept.

The intuition behind the v2 release was to provide a more analytical, user-friendly and intuitive UI for the cookies
consent dialog,
as well as to make the configuration file more structured and easier to use.

Additionally, we wanted to provide the users with a more detailed list of each cookie category and the cookies that are
being used, and allow the users to change their cookies preferences at any time.

## Changes - New Features

This version includes some important changes and improvements, such as:

- A new configuration file format. Now you can declare the cookies each cookie category uses in a
  more structured way.
- A new, clean, and intuitive UI for the cookies consent modal.
- An option to present the cookies consent dialog in a separate page instead of a modal.
- A stick cookies button that allows users to change their cookies preferences at any time. This button is optional and
  it's existence can be tweaked in the configuration file.
- A separate page for the cookies preferences, where users can read more about each cookie category and change their
  preferences.

This guide will help you upgrade your existing v1 plugin to v2.

## How to transition from v1 to v2

### Step 0: Backup Your Current Configuration File

The configuration file has been updated in v2. The new configuration file has some important changes and generally is
not 100% backward compatible with the v1 configuration file.

So, in order to update to the new configuration file, you should save your current configuration file (e.g.
`config/cookies-consent.php`) to a safe place.

### Step 1: Update the Plugin

First, update the plugin to the latest version. You can do this by running the following command:

```bash
composer update scify/laravel-cookies-consent
```

### Step 2: Update the Configuration file

1. Publish the new configuration file by running the following command:

```bash
php artisan vendor:publish --tag=cookies-consent-config
```

2. Compare the new configuration file (`config/cookies-consent.php`) with your old configuration file. You should copy
   the values from your old configuration file to the new one. Most importantly, you should migrate the `cookies` array
   from the old configuration file to the new one, which contains the cookies that your website uses.

3. Make sure that the new configuration file is correct and that it contains all the necessary information about the
   cookies and the cookie categories that your website uses.

4. Make sure that the `cookies` array in the new configuration file is structured correctly. The `cookies` array should
   contain the cookies that your website uses, grouped by category.

5. Make sure that the `cookies` array in the new configuration file contains the necessary information about each cookie
   (e.g. name, description, duration, etc.).