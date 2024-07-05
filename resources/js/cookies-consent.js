import '../scss/cookies-consent.scss';

document.addEventListener('DOMContentLoaded', function () {
    const acceptAllButton = document.getElementById('accept-all-cookies');
    const acceptSelectedButton = document.getElementById('accept-selected-cookies');
    const rejectOptionalButton = document.getElementById('reject-optional-cookies');
    const cookieBanner = document.getElementById('cookies-consent-banner');
    const cookieButton = document.getElementById('cookieButton');
    const showFloatingButton = cookieBanner.dataset.showFloatingButton === 'true';
    const useSeparatePage = cookieBanner.dataset.useSeparatePage === 'true';

    // Check if preferences are stored
    if (getCookie('cookieConsent') && !window.location.href.includes('/cookie-policy')) {
        cookieBanner.style.display = 'none';
        if (showFloatingButton) {
            cookieButton.style.display = 'block';
        }
    } else {
        cookieBanner.style.display = 'block';
        if (showFloatingButton) {
            cookieButton.style.display = 'none';
        }
    }

    acceptAllButton.addEventListener('click', function () {
        handleCookieConsent({
            necessary: true,
            analytics: true,
        });
    });

    acceptSelectedButton.addEventListener('click', function () {
        handleCookieConsent({
            necessary: true,
            analytics: document.getElementById('statistics') ? document.getElementById('statistics').checked : false,
        });
    });

    rejectOptionalButton.addEventListener('click', function () {
        handleCookieConsent({
            necessary: true,
            analytics: false,
        });
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
                    cookieBanner.style.display = 'none';
                    if (showFloatingButton) {
                        cookieButton.style.display = 'block';
                    }
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

    if (!useSeparatePage || window.location.href.includes('/cookie-policy')) {
        document.querySelectorAll('.accordion-button').forEach(button => {
            button.addEventListener('click', () => {
                const target = document.querySelector(button.dataset.target);
                target.classList.toggle('show');
            });
        });
    }

    // Clear cookieConsent when navigating to the cookie policy page
    const cookiePolicyLink = document.getElementById('cookie-policy-link');
    if (cookiePolicyLink) {
        cookiePolicyLink.addEventListener('click', function() {
            eraseCookie('cookieConsent');
        });
    }

    // Helper functions to manage cookies
    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }

    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for(let i=0;i < ca.length;i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    function eraseCookie(name) {
        document.cookie = name + '=; Max-Age=-99999999;';
    }
});
