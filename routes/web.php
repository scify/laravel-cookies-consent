<?php

use Illuminate\Support\Facades\Route;
use SciFY\LaravelCookiesConsent\Http\Controllers\CookiesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where the routes of the package are defined
|
*/

Route::get('/cookie-policy', function () {
    return view('cookies-consent::cookie-policy');
});

Route::post('/cookie-consent/save', [CookiesController::class, 'save_cookies_consent_selection']);

