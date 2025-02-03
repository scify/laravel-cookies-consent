<dialog class="cookies-consent-banner banner cookies-policy-body" id="cookies-consent-banner"
        aria-labelledby="cookie-consent-title"
        aria-describedby="cookie-consent-description"
        data-ajax-url="{{ url('/cookie-consent/save') }}"
        data-show-floating-button="{{ config('cookies_consent.display_floating_button') }}"
        data-hide-floating-button-on-mobile="{{ config('cookies_consent.hide_floating_button_on_mobile') }}"
        data-cookie-prefix="{{ config('cookies_consent.cookie_prefix') }}"
        style="display: none;">
    <div class="cookies-container">
        <h5 id="cookie-consent-title" class="h5 m-0 pt-0 pb-2">{{ __('cookies_consent::messages.title') }}</h5>
        <p id="cookie-consent-description" class="small">{{ __('cookies_consent::messages.description') }}</p>
        @if(config('cookies_consent.use_separate_page'))
            <p class="small">{{ __('cookies_consent::messages.please_visit_1') }} <a
                        href="{{ url('/cookie-policy') }}"
                        target="_blank"><b>{{ __('cookies_consent::messages.cookie_policy_page') }}</b></a>.</p>
        @else
            @include('cookies_consent::components._cookie-categories')
        @endif

        <div class="cookie-actions">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    @if(config('cookies_consent.use_separate_page'))
                        <div class="col-lg-6 col-sm-12">
                            <button type="button" class="btn btn-light w-100" id="accept-all-cookies"
                                    aria-label="Accept All Cookies">
                                {{ __('cookies_consent::messages.accept_additional_cookies_btn') }}
                            </button>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <button type="button" class="btn btn-light w-100" id="reject-optional-cookies"
                                    aria-label="Reject Optional Cookies">
                                {{ __('cookies_consent::messages.reject_additional_cookies_btn') }}
                            </button>
                        </div>
                    @else
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</dialog>

@if(config('cookies_consent.display_floating_button'))
    <button id="scify-cookie-consent-floating-button" class="cookie-button" style="display: none;"
         onclick="toggleCookieBanner()" onkeyup="if (event.key === 'Enter') toggleCookieBanner()"
         tabindex="0">
        <img src="{{ asset('vendor/scify/laravel-cookies-consent/cookie.png') }}" alt="Cookie">
    </button>
@endif
<link rel="stylesheet" href="{{ asset('vendor/scify/laravel-cookies-consent/cookies-consent.css') }}">
<script src="{{ asset('vendor/scify/laravel-cookies-consent/cookies-consent.js') }}"></script>
