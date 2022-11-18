@if(!isset($_COOKIE[config('cookies_consent.cookie_prefix') . 'cookies_consent_selection']))
    <link rel="stylesheet" href="{{asset('vendor/cookies_consent/css/style.css')}}">
    <div class="laravel-cookies-consent" id="laravel-cookies-consent">
        <div class="outer-wrapper">
            <a href="#" class="cookies-close" tabindex="0" role="button"
               onclick="document.getElementById('laravel-cookies-consent').classList.add('slide_down')">close</a>
            <div class="inner-wrapper">
                <p class="cookies-title">{!! trans('cookies_consent::messages.title') !!}</p>
                <small class="cookies-text">{!! __('cookies_consent::messages.body') !!}
                    @if(__('cookies_consent::messages.read_more_link'))
                        <a href="{{ __('cookies_consent::messages.read_more_link') }}"
                           target="_blank">{{ __('cookies_consent::messages.read_more_text') }}</a>
                    @endif
                </small>
                <div class="consent-form-container">
                    <form name="cookies-consent-form" id="add-blog-post-form" method="post"
                          action="{{ route('cookies_consent.accept_selection') }}">
                        @csrf
                        <div class="consent-checkboxes">
                            @foreach(config('cookies_consent.cookies') as $cookie_key)
                                <div class="form-group">
                                    <input type="checkbox" id="cookies_consent_{{$cookie_key}}"
                                           name="cookies_consent_{{$cookie_key}}"
                                           onchange="document.getElementById('cookies-consent-accept-all').classList.add('hidden');
                                       document.getElementById('cookies-consent-accept-selection').classList.remove('hidden');"
                                        {{ in_array($cookie_key, config('cookies_consent.enabled')) ? 'checked' : '' }}
                                        {{ in_array($cookie_key, config('cookies_consent.required')) ? 'disabled' : '' }}>
                                    <label
                                        for="cookies_consent_{{$cookie_key}}"> {{ __('cookies_consent::messages.cookie_' . $cookie_key) }}</label><br>
                                </div>
                            @endforeach
                        </div>
                        <div class="consent-buttons">
                            <button type="submit"
                                    id="cookies-consent-accept-selection"
                                    class="consent-submit consent-accept {{ !(count(config('cookies_consent.enabled')) > 1) ? 'hidden' : '' }}">{{ __('cookies_consent::messages.accept_selection_btn') }}
                            </button>
                            <a href="{{ route('cookies_consent.accept_all') }}"
                               id="cookies-consent-accept-all"
                               class="consent-submit consent-accept {{ count(config('cookies_consent.enabled')) > 1 ? 'hidden' : '' }}">{{ __('cookies_consent::messages.accept_all_btn') }}
                            </a>
                            <a href="{{ route('cookies_consent.decline_all') }}"
                               class="consent-submit consent-decline-all">{{ __('cookies_consent::messages.decline_all_btn') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
