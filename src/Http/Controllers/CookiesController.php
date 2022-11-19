<?php

namespace SciFY\LaravelCookiesConsent\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;

/**
 * Manages the cookies consent submission
 */
class CookiesController extends Controller {
    private static $MINUTES_IN_A_DAY = 1440;

    /**
     * Called when the user clicks on "ACCEPT ALL"
     *
     * @return RedirectResponse redirects to the previous page
     */
    public function accept_all_cookies(): RedirectResponse {
        $this->set_cookies_consent_basic_cookie();
        foreach (config('cookies_consent.cookies') as $cookie_key) {
            $this->set_cookie('cookies_consent_cookie_' . $cookie_key);
        }

        return redirect()->back()->withCookies(Cookie::getQueuedCookies());
    }

    /**
     * Called when the user clicks on "DECLINE ALL"
     *
     * @return RedirectResponse redirects to the previous page
     */
    public function decline_all_cookies(): RedirectResponse {
        $this->set_cookies_consent_basic_cookie();
        foreach (config('cookies_consent.cookies') as $cookie_key) {
            $this->delete_cookie('cookies_consent_cookie_' . $cookie_key);
        }

        return redirect()->back()->withCookies(Cookie::getQueuedCookies());
    }

    /**
     * Called when the user clicks on "ACCEPT SELECTION"
     * This method goes over all the input fields (checkboxes)
     * submitted by the cookies consent form, and stores
     * all the relevant cookies.
     *
     * @return RedirectResponse redirects to the previous page
     */
    public function accept_selection_cookies(Request $request): RedirectResponse {
        $this->set_cookies_consent_basic_cookie();
        $data = $request->all();
        foreach ($data as $key => $value) {
            if (strpos($key, 'cookies_consent_') !== false) {
                $this->set_cookie($key);
            }
        }

        return redirect()->back()->withCookies(Cookie::getQueuedCookies());
    }

    /**
     * Sets the basic cookie, identifying that the user has
     * already submitted a certain cookie selection.
     *
     * @return void
     */
    public function set_cookies_consent_basic_cookie() {
        $this->set_cookie('cookies_consent_selection');
    }

    /**
     * Sets a cookie
     *
     * @param $cookie_name string the cookie name
     * @return void
     */
    public function set_cookie(string $cookie_name) {
        $cookie_prefix = config('cookies_consent.cookie_prefix');
        Cookie::queue($cookie_prefix . $cookie_name, true, (self::$MINUTES_IN_A_DAY * config('cookies_consent.cookie_lifetime')));
    }

    /**
     * Deletes a cookie
     *
     * @param $cookie_name string the cookie name
     * @return void
     */
    public function delete_cookie(string $cookie_name) {
        $cookie_prefix = config('cookies_consent.cookie_prefix');
        Cookie::queue(Cookie::forget($cookie_prefix . $cookie_name));
    }
}
