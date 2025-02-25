<div id="scify-cookies-consent">
    <dialog
        class="cookies-consent-banner banner cookies-policy-wrapper {{ config('cookies_consent.use_separate_page') ? 'separate-page-mode' : '' }}"
        id="cookies-consent-banner"
        aria-labelledby="cookie-consent-title" aria-describedby="cookie-consent-description"
        data-ajax-url="{{ url('/cookie-consent/save') }}"
        data-show-floating-button="{{ config('cookies_consent.display_floating_button') }}"
        data-hide-floating-button-on-mobile="{{ config('cookies_consent.hide_floating_button_on_mobile') }}"
        data-cookie-prefix="{{ config('cookies_consent.cookie_prefix') }}" data-locale="{{ app()->getLocale() }}"
        style="display: none;">
        <div class="cookies-container">
            <h5 id="cookie-consent-title" class="h5 m-0 pt-0 pb-2">{{ __('cookies_consent::messages.title') }}</h5>
            <p id="cookie-consent-description" class="small">{{ __('cookies_consent::messages.description') }}</p>
            @if (config('cookies_consent.use_separate_page'))
                <p class="small">{{ __('cookies_consent::messages.please_visit_1') }} <a
                        href="{{ config('cookies_consent.cookie_policy_page_custom_url') ?? url('/cookie-policy', ['locale' => app()->getLocale()]) }}"
                        target="_blank"><b>{{ __('cookies_consent::messages.cookie_policy_page') }}</b></a>.</p>
            @else
                @include('cookies_consent::components._cookie-categories')
            @endif

            <div class="cookie-actions">
                <div class="container-fluid p-0">
                    <div class="row g-0">
                        @if (config('cookies_consent.use_separate_page'))
                            <div class="col-6 col-sm-12 pl-0">
                                <button type="button" class="btn btn-light w-100" id="accept-all-cookies"
                                        aria-label="Accept All Cookies">
                                    {{ __('cookies_consent::messages.accept_all_btn') }}
                                </button>
                            </div>
                            <div class="col-6 col-sm-12 pr-0">
                                <button type="button" class="btn btn-light w-100" id="reject-optional-cookies"
                                        aria-label="Reject Optional Cookies">
                                    {{ __('cookies_consent::messages.reject_optional_btn') }}
                                </button>
                            </div>
                        @else
                            <div class="col-lg-4 col-sm-12 pl-0">
                                <button type="button" class="btn btn-light w-100" id="accept-all-cookies"
                                        aria-label="Accept All Cookies">
                                    {{ __('cookies_consent::messages.accept_all_btn') }}
                                </button>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <button type="button" class="btn btn-light w-100" id="reject-optional-cookies"
                                        aria-label="Reject Optional Cookies">
                                    {{ __('cookies_consent::messages.reject_optional_btn') }}
                                </button>
                            </div>
                            <div class="col-lg-4 col-sm-12 pr-0">
                                <button type="button" class="btn btn-light w-100" id="accept-selected-cookies"
                                        aria-label="Accept Selected Cookies">
                                    {{ __('cookies_consent::messages.accept_selection_btn') }}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </dialog>
</div>
@if (config('cookies_consent.display_floating_button'))
    <button id="scify-cookie-consent-floating-button" class="cookie-button" style="display: none;"
            onclick="toggleCookieBanner()" onkeyup="if (event.key === 'Enter') toggleCookieBanner()" tabindex="0">
        @include('cookies_consent::components.cookie-icon')

    </button>
@endif
