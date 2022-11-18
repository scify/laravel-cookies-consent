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

Route::get('/cookies-consent/accept-all', [CookiesController::class, 'accept_all_cookies'])->name('cookies_consent.accept_all');
Route::get('/cookies-consent/decline-all', [CookiesController::class, 'decline_all_cookies'])->name('cookies_consent.decline_all');
Route::post('/cookies-consent/accept-selection', [CookiesController::class, 'accept_selection_cookies'])->name('cookies_consent.accept_selection');
