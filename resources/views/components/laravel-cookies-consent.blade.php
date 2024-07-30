<section class="cookies-consent-banner banner cookies-policy-body" id="cookies-consent-banner" role="dialog"
         aria-labelledby="cookie-consent-title"
         aria-describedby="cookie-consent-description"
         data-ajax-url="{{ url('/cookie-consent/save') }}"
         data-show-floating-button="{{ config('cookie-consent.display_floating_button') }}"
         data-use-separate-page="{{ config('cookie-consent.use_separate_page') }}" style="display: none;">
    <h5 id="cookie-consent-title" class="h5 m-0 pt-0 pb-2">
        Cookies Consent </h5>
    <p id="cookie-consent-description" class="small">
        We use cookies to optimize our website and our service. You can choose which categories you consent to.</p>

    @if(config('cookies_consent.use_separate_page'))
        <p class="small">For more detailed information about cookies, please visit our <a
                    href="{{ url('/cookie-policy') }}">cookie policy page</a>.</p>
    @else
        @include('cookies_consent::components._cookie-categories')
    @endif

    <div class="cookie-actions">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-lg-4 col-sm-12">
                    <button type="button" class="btn btn-light w-100" id="accept-all-cookies"
                            aria-label="Accept All Cookies">
                        Accept All
                    </button>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <button type="button" class="btn btn-light w-100" id="accept-selected-cookies"
                            aria-label="Accept Selected Cookies">
                        Accept Selected
                    </button>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <button type="button" class="btn btn-light w-100" id="reject-optional-cookies"
                            aria-label="Reject Optional Cookies">
                        Reject Optional
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

@if(config('cookies_consent.display_floating_button'))
    <div id="cookieButton" class="cookie-button" style="display: none;" onclick="toggleCookieBanner()">
        <img src="{{ asset('/vendor/cookies_consent/images/cookie.png') }}" alt="Cookie">
    </div>
@else
    <footer>
        <a href="javascript:void(0);" onclick="toggleCookieBanner()">Manage Cookies</a>
    </footer>
@endif
<link href="{{ asset('vendor/cookies_consent/css/cookies-consent.css') }}" rel="stylesheet">
<script type="module" src="{{ asset('vendor/cookies_consent/js/cookies-consent.js') }}"></script>
