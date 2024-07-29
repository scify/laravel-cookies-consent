@php
    $alwaysOpen = $alwaysOpen ?? false;
    $cookieCategories = config('cookies_consent.cookies');
@endphp

<div class="accordion" id="cookieAccordion">
    @foreach($cookieCategories as $category => $cookies)
        <div class="accordion-item cookies-consent-category-item">
            <h5 class="accordion-header h5" id="heading-{{ $category }}">
                <button class="accordion-button" type="button" data-toggle="collapse"
                        data-target="#collapse-{{ $category }}" aria-expanded="{{ $alwaysOpen ? 'true' : 'false' }}"
                        aria-controls="collapse-{{ $category }}">
                    {{ ucfirst(str_replace('_', ' ', $category)) }}
                </button>
            </h5>
            <div id="collapse-{{ $category }}" class="accordion-collapse collapse {{ $alwaysOpen ? 'show' : '' }}"
                 aria-labelledby="heading-{{ $category }}"
                 data-parent="#cookieAccordion">
                <div class="accordion-body">
                    <div class="form-check form-switch">
                        <input class="form-check-input cookie-category" type="checkbox"
                               id="{{ $category }}" {{ in_array($category, config('cookies_consent.required')) ? 'checked disabled' : '' }}>
                        <label class="form-check-label" for="{{ $category }}">
                            {{ ucfirst(str_replace('_', ' ', $category)) }}
                        </label>
                    </div>
                    <ul class="list-group mt-3">
                        @foreach($cookies as $cookie)
                            <li class="list-group-item cookie-content-text small">
                                <dl>
                                    <dt>
                                        <strong>Cookie: </strong>
                                        <code>{{ $cookie['name'] }}</code>
                                    </dt>
                                    <dd>
                                        <strong>Description: </strong>
                                        {{ $cookie['description'] }}
                                    </dd>
                                    <dd>
                                        <strong>Duration: </strong>
                                        {{ $cookie['duration'] }}
                                    </dd>
                                    @if($cookie['policy_external_link'])
                                        <dd>
                                            <strong>Policy link: </strong>
                                            <a href="{{ $cookie['policy_external_link'] }}"
                                               target="_blank">{{ $cookie['policy_external_link'] }}</a>
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