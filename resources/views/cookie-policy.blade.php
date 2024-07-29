<!-- resources/views/cookie-policy.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Policy</title>
    <link href="{{ asset('vendor/cookies_consent/css/cookies-consent.css') }}" rel="stylesheet">
</head>
<body class="cookies-policy-body cookies-consent-banner">
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>Cookie Policy</h1>
            <p>This is the cookie policy page. Here you can read about the Cookies that are used in the application and
                select which cookies to allow.</p>

            <h2>What Are Cookies?</h2>

            <p>
                A cookie is a small text file that a website or app sends to a user's device. This text file collects
                information about user actions on your site.

                Cookies store helpful information to enhance users' experiences with your site, and possibly to improve
                your ability to reconnect with them later.

                Information collected by cookies can include the user's preferred language, device settings, browsing
                activities and other useful information.

                Websites like Google use cookies to make ads more relevant to their users. They also track analytics
                such as counting the number of visitors to a page, locations of visitors, search preferences and so on.

                Cookies are not harmful to your device. They are not viruses or malware. They are just text files that
                can be deleted at any time.
            </p>

            <h2>Use of Cookies</h2>
            <p>Cookies generally are used to perform one or all of the following:</p>

            <ul>
                <li><b>Authentication:</b> Cookies help websites determine if a user is logged in, and then deliver the
                    right
                    experience and features to that unique user.
                </li>
                <li><b>Security:</b> Cookies help impose security measures on a website. They also help detect unusual
                    and
                    suspicious activities.
                </li>
                <li><b>Advertising:</b> Cookies deliver a better advertising experience for both users and advertisers.
                    Cookies
                    help connect advertisers to users who are most interested in their products based on the user's
                    browsing history.
                </li>
                <li><b>Performance:</b> Cookies help your website learn how services work for different people and how
                    to route
                    traffic between servers.
                </li>
                <li><b>Analytics and Research:</b> Websites and apps use cookies to learn which of their services are
                    most
                    used. This helps determine what to improve, what to remove and what to leave the same.
                </li>
                Some cookies can gather data across several websites in order to create user behavior profiles. These
                profiles are then used to send targeted content and advertisement to users.
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <h2>Cookies used in this application</h2>
            <p>
                The following cookies are used in this application. Please select which cookies you would like to allow.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <section class="cookies-consent-banner" id="cookies-consent-banner" role="dialog"
                     aria-labelledby="cookie-consent-title"
                     aria-describedby="cookie-consent-description"
                     data-ajax-url="{{ url('/cookie-consent') }}"
                     data-show-floating-button="false"
                     data-use-separate-page="true">
                @include('cookies_consent::components._cookie-categories', ['alwaysOpen' => true])
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