<!-- resources/views/cookie-policy.blade.php -->
<!DOCTYPE html>
<html lang="{{ \Illuminate\Support\Facades\App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('cookies_consent::messages.cookie_policy_title') }}</title>
    <link href="{{ asset('vendor/cookies_consent/css/cookies-consent.css') }}" rel="stylesheet">
</head>
<body class="cookies-policy-body cookies-consent-banner">
<div class="container">
    <div class="row">
        <div class="col-6 col-sm-12">
            <h1>{{ __('cookies_consent::messages.cookie_policy_title') }}</h1>
            <p>{{ __('cookies_consent::messages.cookie_policy_text_1') }}</p>

            <h2>{{ __('cookies_consent::messages.what_are_cookies_title') }}</h2>

            <p>
                {{ __('cookies_consent::messages.what_are_cookies_text_1') }}

                {{ __('cookies_consent::messages.what_are_cookies_text_2') }}

                {{ __('cookies_consent::messages.what_are_cookies_text_3') }}

                {{ __('cookies_consent::messages.what_are_cookies_text_4') }}

                {{ __('cookies_consent::messages.what_are_cookies_text_5') }}
            </p>

            <h2>{{ __('cookies_consent::messages.use_of_cookies_title') }}</h2>
            <p>{{ __('cookies_consent::messages.use_of_cookies_text_1') }}</p>

            <ul>
                <li>{!! __('cookies_consent::messages.use_of_cookies_text_2') !!}</li>
                <li>{!! __('cookies_consent::messages.use_of_cookies_text_3') !!}</li>
                <li>{!! __('cookies_consent::messages.use_of_cookies_text_4') !!}</li>
                <li>{!! __('cookies_consent::messages.use_of_cookies_text_5') !!}</li>
                <li>{!! __('cookies_consent::messages.use_of_cookies_text_6') !!}</li>
                <li>{!! __('cookies_consent::messages.use_of_cookies_text_7') !!}</li>
                <li>{!! __('cookies_consent::messages.use_of_cookies_text_8') !!}</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-sm-12">
            <h2>{{ __('cookies_consent::messages.cookies_used_title') }}</h2>
            <p>
                {{ __('cookies_consent::messages.cookies_used_text_1') }}
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <section class="cookies-consent-banner" id="cookies-consent-banner" role="dialog"
                     aria-labelledby="cookie-consent-title"
                     aria-describedby="cookie-consent-description"
                     data-ajax-url="{{ url('/cookie-consent/save') }}"
                     data-cookie-prefix="{{ config('cookies_consent.cookie_prefix') }}"
                     data-show-floating-button="false"
                     data-hide-floating-button-on-mobile="{{ config('cookies_consent.hide_floating_button_on_mobile') }}">
                @include('cookies_consent::components._cookie-categories', ['alwaysOpen' => true])
                <div class="cookie-actions">
                    <div class="container-fluid p-0">
                        <div class="row g-0">
                            <div class="col-lg-4 col-sm-12">
                                <button type="button" class="btn btn-light w-100" id="accept-all-cookies"
                                        aria-label="Accept All Cookies">
                                    {{ __('cookies_consent::messages.accept_all_btn') }}
                                </button>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <button type="button" class="btn btn-light w-100" id="accept-selected-cookies"
                                        aria-label="Accept Selected Cookies">
                                    {{ __('cookies_consent::messages.accept_selection_btn') }}
                                </button>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <button type="button" class="btn btn-light w-100" id="reject-optional-cookies"
                                        aria-label="Reject Optional Cookies">
                                    {{ __('cookies_consent::messages.reject_optional_btn') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script type="module" src="{{ asset('vendor/cookies_consent/js/cookies-consent.js') }}"></script>
</body>
</html>