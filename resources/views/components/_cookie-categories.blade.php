@php
    $alwaysOpen = $alwaysOpen ?? false;
    $cookieCategories = config('cookies_consent.cookies');
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="accordion" id="cookieAccordion">
    @foreach ($cookieCategories as $category => $cookies)
        <div class="form-check form-switch">
            <input class="form-check-input cookie-category" type="checkbox" id="{{ $category }}"
                {{ in_array($category, config('cookies_consent.required')) ? 'checked disabled' : '' }}>
            <label class="form-check-label" for="{{ $category }}">
                {{ __('cookies_consent::messages.' . $category) }}
            </label>
        </div>
        <div class="accordion-item cookies-consent-category-item">
            <h5 class="accordion-header h5" id="heading-{{ $category }}">
                <button
                    class="accordion-button {{ $alwaysOpen || $category === 'strictly_necessary' ? '' : 'collapsed' }}"
                    type="button" data-toggle="collapse" data-target="#collapse-{{ $category }}"
                    aria-expanded="{{ $alwaysOpen ? 'true' : 'false' }}" aria-controls="collapse-{{ $category }}">
                    @if ($category === 'strictly_necessary')
                        {{ __('cookies_consent::messages.read_less') }}
                    @else
                        {{ __('cookies_consent::messages.read_more') }}
                    @endif
                </button>
            </h5>
            <div id="collapse-{{ $category }}"
                class="accordion-collapse {{ $alwaysOpen || $category === 'strictly_necessary' ? 'show' : '' }}"
                aria-labelledby="heading-{{ $category }}" data-parent="#cookieAccordion">
                <div class="accordion-body">
                    <ul class="list-group mt-3">
                        @foreach ($cookies as $cookie)
                            <li class="list-group-item cookie-content-text small">
                                <dl>
                                    <dt>
                                        <strong>Cookie: </strong>
                                        <code>{{ $cookie['name'] }}</code>
                                    </dt>
                                    <dd>
                                        <strong>{{ __('cookies_consent::messages.description_label') }}: </strong>
                                        {{ __($cookie['description']) }}
                                    </dd>
                                    <dd>
                                        <strong>{{ __('cookies_consent::messages.duration_label') }}: </strong>
                                        {{ trans_choice($cookie['duration'], $cookie['duration_count'] ?? 1) }}
                                    </dd>
                                    @if ($cookie['policy_external_link'])
                                        <dd>
                                            <a class="policy-link" href="{{ $cookie['policy_external_link'] }}"
                                                target="_blank">{{ __('cookies_consent::messages.policy_label') }}
                                                &#x1F517;</a>
                                        </dd>
                                    @endif
                                </dl>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
