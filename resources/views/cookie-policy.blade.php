<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Policy</title>
    <link href="{{ asset('vendor/cookies_consent/css/cookies-consent.css') }}" rel="stylesheet">
</head>
<body class="cookies-policy-body">
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Cookie Policy</h1>
            <p>This is the cookie policy page. Here you can explain in detail what cookies are used and for what purposes.</p>
            <section class="cookies-consent-banner" id="cookies-consent-banner" role="dialog" aria-labelledby="cookie-consent-title"
                     aria-describedby="cookie-consent-description"
                     data-ajax-url="{{ url('/cookie-consent') }}"
                     data-show-floating-button="false"
                     data-use-separate-page="true">
                @include('cookies_consent::components._cookie-categories')
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
        </div>
    </div>
</div>
<script type="module" src="{{ asset('vendor/cookies_consent/js/cookies-consent.js') }}"></script>
</body>
</html>
