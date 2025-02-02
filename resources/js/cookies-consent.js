import '../scss/cookies-consent.scss';

document.addEventListener('DOMContentLoaded', function () {
    initializeAccordionButtons();
    initializeCookieBanner();
    initializeCookiePolicyLink();
});

function initializeAccordionButtons() {
    document.querySelectorAll('.accordion-button').forEach(button => {
        button.addEventListener('click', function () {
            toggleAccordion(button);
        });
    });
}

function toggleAccordion(button) {
    const target = document.querySelector(button.dataset.target);

    // Close all accordion items
    document.querySelectorAll('.accordion-collapse').forEach(collapse => {
        collapse.classList.remove('show');
    });
    document.querySelectorAll('.accordion-button').forEach(btn => {
        btn.classList.add('collapsed');
    });

    // Open the clicked accordion item
    if (target) {
        target.classList.toggle('show');
        button.classList.toggle('collapsed');
    }
}

function initializeCookieBanner() {
    const cookieBanner = document.getElementById('cookies-consent-banner');
    const cookieButton = document.getElementById('scify-cookie-consent-floating-button');
    const showFloatingButton = cookieBanner.dataset.showFloatingButton === 'true' || cookieBanner.dataset.showFloatingButton === '1';
    const hideFloatingButtonOnMobile = cookieBanner.dataset.hideFloatingButtonOnMobile === 'true' || cookieBanner.dataset.hideFloatingButtonOnMobile === '1';
    const cookiePrefix = cookieBanner.dataset.cookiePrefix;
    let cookieConsent = getCookie(cookiePrefix + 'cookies_consent');

    initialiseBanner(cookieBanner, cookieButton, showFloatingButton, hideFloatingButtonOnMobile, cookieConsent);
    setSliders(cookieConsent);

    addEventListeners({
        'accept-all-cookies': handleAcceptAllCookies,
        'accept-selected-cookies': handleAcceptSelectedCookies,
        'reject-optional-cookies': handleRejectOptionalCookies
    });
}

function addEventListeners(buttonHandlers) {
    for (const [buttonId, handler] of Object.entries(buttonHandlers)) {
        const button = document.getElementById(buttonId);
        if (button) {
            button.addEventListener('click', handler);
        }
    }
}

function initialiseBanner(cookieBanner, cookieButton, showFloatingButton, hideFloatingButtonOnMobile, cookieConsent) {
    if (onCookiesPage()) {
        cookieBanner.style.display = 'block';
    } else {
        toggleBannerDisplay(cookieBanner, cookieButton, showFloatingButton, hideFloatingButtonOnMobile, cookieConsent);
    }
}

function toggleBannerDisplay(cookieBanner, cookieButton, showFloatingButton, hideFloatingButtonOnMobile, cookieConsent) {
    if (cookieConsent) {
        cookieBanner.style.display = 'none';
        if (showFloatingButton && cookieButton) {
            cookieButton.style.display = hideFloatingButtonOnMobile && window.innerWidth < 768 ? 'none' : 'block';
        }
    } else {
        cookieBanner.style.display = 'block';
    }
}

function setSliders(cookieConsent) {
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

function handleAcceptAllCookies() {
    handleCookieConsent(getConsentSettings(true));
}

function handleAcceptSelectedCookies() {
    handleCookieConsent(getConsentSettings());
}

function handleRejectOptionalCookies() {
    handleCookieConsent(getConsentSettings(false, 'strictly_necessary'));
}

function getConsentSettings(acceptAll = false, requiredCategory = null) {
    const consent = {};
    document.querySelectorAll('.cookie-category').forEach(checkbox => {
        consent[checkbox.id] = acceptAll || checkbox.id === requiredCategory || checkbox.checked;
    });
    return consent;
}

function handleCookieConsent(consent) {
    const cookieBanner = document.getElementById('cookies-consent-banner');
    const cookieButton = document.getElementById('scify-cookie-consent-floating-button');
    const showFloatingButton = cookieBanner.dataset.showFloatingButton === 'true' || cookieBanner.dataset.showFloatingButton === '1';
    const cookiePrefix = cookieBanner.dataset.cookiePrefix;

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
                setCookie(cookiePrefix + 'cookies_consent', JSON.stringify(consent), 30);
                setSliders(JSON.stringify(consent));
                if (!onCookiesPage()) {
                    cookieBanner.style.display = 'none';
                    if (showFloatingButton) {
                        cookieButton.style.display = 'block';
                    }
                }
                showSuccessMessage(data.message);
            }
        });
}

function showSuccessMessage(messageText) {
    const message = document.createElement('div');
    message.classList.add('cookie-success-message');
    message.innerText = messageText;
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
}

function initializeCookiePolicyLink() {
    const cookiePolicyLink = document.getElementById('cookie-policy-link');
    if (cookiePolicyLink) {
        cookiePolicyLink.addEventListener('click', function () {
            eraseCookie('cookieConsent');
        });
    }
}

function onCookiesPage() {
    return window.location.href.includes('/cookie-policy');
}

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
        let c = ca[i].trim();
        if (c.startsWith(nameEQ)) {
            return c.substring(nameEQ.length, c.length);
        }
    }
    return null;
}

function eraseCookie(name) {
    document.cookie = name + '=; Max-Age=-99999999;';
}

window.toggleCookieBanner = function () {
    const cookieBanner = document.getElementById('cookies-consent-banner');
    const cookieButton = document.getElementById('scify-cookie-consent-floating-button');
    const showFloatingButton = cookieBanner.dataset.showFloatingButton === 'true' || cookieBanner.dataset.showFloatingButton === '1';

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