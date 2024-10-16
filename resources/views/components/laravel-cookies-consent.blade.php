<section class="cookies-consent-banner banner cookies-policy-body" id="cookies-consent-banner" role="dialog"
         aria-labelledby="cookie-consent-title"
         aria-describedby="cookie-consent-description"
         data-ajax-url="{{ url('/cookie-consent/save') }}"
         data-show-floating-button="{{ config('cookies_consent.display_floating_button') }}"
         style="display: none;">
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
</section>

@if(config('cookies_consent.display_floating_button'))
    <div id="scify-cookie-consent-floating-button" class="cookie-button" style="display: none;"
         onclick="toggleCookieBanner()">
        <img src="{{ asset('/vendor/cookies_consent/images/cookie.png') }}" alt="Cookie">
    </div>
@endif
{{--<a href="javascript:void(0);" onclick="toggleCookieBanner()">Manage Cookies</a>--}}
<link href="{{ asset('vendor/cookies_consent/css/cookies-consent.css') }}" rel="stylesheet">
<script type="module" src="{{ asset('vendor/cookies_consent/js/cookies-consent.js') }}"></script>
