import '../scss/cookies-consent.scss';

document.addEventListener('DOMContentLoaded', function () {

    // Add event listeners to all accordion buttons to toggle the accordion content
    document.querySelectorAll('.accordion-button').forEach(button => {
        button.addEventListener('click', function () {
            const target = document.querySelector(button.dataset.target);
            if (target) {
                target.classList.toggle('show');
                button.classList.toggle('collapsed');
            }
        });
    });

    const acceptAllButton = document.getElementById('accept-all-cookies');
    const acceptSelectedButton = document.getElementById('accept-selected-cookies');
    const rejectOptionalButton = document.getElementById('reject-optional-cookies');
    const cookieBanner = document.getElementById('cookies-consent-banner');
    const cookieButton = document.getElementById('scify-cookie-consent-floating-button');
    const showFloatingButton = cookieBanner.dataset.showFloatingButton === 'true' || cookieBanner.dataset.showFloatingButton === '1';
    let cookieConsent = getCookie('cookieConsent');
    initialiseBanner();
    setSliders();

    function onCookiesPage() {
        return window.location.href.includes('/cookie-policy');
    }

    function initialiseBanner() {
        if (onCookiesPage()) {
            cookieBanner.style.display = 'block';
            if (showFloatingButton && cookieButton)
                cookieButton.style.display = 'none';
        } else {
            if (cookieConsent) {
                cookieBanner.style.display = 'none';
                if (showFloatingButton && cookieButton) {
                    cookieButton.style.display = 'block';
                }
            } else {
                cookieBanner.style.display = 'block';
            }
        }
    }

    function setSliders() {
        // Retrieve and set sliders based on cookieConsent cookie
        if (cookieConsent) {
            const consentSettings = JSON.parse(cookieConsent);
            for (const category in consentSettings) {
                const categoryCheckbox = document.getElementById(category);
                if (categoryCheckbox) {
                    categoryCheckbox.checked = consentSettings[category];
                }
            }
        }
    }

    acceptAllButton.addEventListener('click', function () {
        const consent = {};
        document.querySelectorAll('.cookie-category').forEach(checkbox => {
            consent[checkbox.id] = true;
        });
        handleCookieConsent(consent);
    });

    if (acceptSelectedButton) {
        acceptSelectedButton.addEventListener('click', function () {
            const consent = {};
            document.querySelectorAll('.cookie-category').forEach(checkbox => {
                consent[checkbox.id] = checkbox.checked;
            });
            handleCookieConsent(consent);
        });
    }

    rejectOptionalButton.addEventListener('click', function () {
        const consent = {};
        document.querySelectorAll('.cookie-category').forEach(checkbox => {
            consent[checkbox.id] = checkbox.id === 'strictly_necessary';
        });
        handleCookieConsent(consent);
    });

    function handleCookieConsent(consent) {
        fetch(cookieBanner.dataset.ajaxUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(consent)
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    setCookie('cookieConsent', JSON.stringify(consent), 30);
                    setSliders();
                    if (!onCookiesPage()) {
                        cookieBanner.style.display = 'none';
                        if (showFloatingButton) {
                            cookieButton.style.display = 'block';
                        }
                    }
                    // create and show a success floating message
                    const message = document.createElement('div');
                    message.classList.add('cookie-success-message');
                    message.innerText = data.message;
                    // show the message with an animation, and after 4 seconds hide it, with another animation
                    document.body.appendChild(message);
                    setTimeout(() => {
                        message.classList.add('show');
                    }, 100);
                    setTimeout(() => {
                        message.classList.remove('show');
                        setTimeout(() => {
                            message.remove();
                        }, 1000);
                    }, 4000);
                    // we also need to set the sliders to the new values
                    cookieConsent = JSON.stringify(consent);
                    setSliders();
                }
            });
    }

    window.toggleCookieBanner = function () {
        if (cookieBanner.style.display === 'none' || cookieBanner.style.display === '') {
            cookieBanner.style.display = 'block';
            if (showFloatingButton) {
                cookieButton.style.display = 'none';
            }
        } else {
            cookieBanner.style.display = 'none';
            if (showFloatingButton) {
                cookieButton.style.display = 'block';
            }
        }
    };

    // Clear cookieConsent when navigating to the cookie policy page
    const cookiePolicyLink = document.getElementById('cookie-policy-link');
    if (cookiePolicyLink) {
        cookiePolicyLink.addEventListener('click', function () {
            eraseCookie('cookieConsent');
        });
    }

    // Helper functions to manage cookies
    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function eraseCookie(name) {
        document.cookie = name + '=; Max-Age=-99999999;';
    }
});
