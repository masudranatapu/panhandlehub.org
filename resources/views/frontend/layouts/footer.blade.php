<footer class="text-center footer_menu">
    <div class="container">
        <div class="p-3">
            <ul>
                <li class="list-item text-white"> © {{ date('Y') }} ffuts |</li>
                <li><a href="{{ route('frontend.faq') }}">{{ __('faq') }} |</a></li>
                <li><a href="{{ route('frontend.search') }}">{{ __('Ads') }} |</a></li>
                <li><a href="{{ route('frontend.privacy.policy') }}">{{ __('privacy') }} |</a></li>
                <li><a href="{{ route('frontend.terms.condition') }}">{{ __('terms_conditions') }} |</a>
                </li>
                <li><a href="{{ route('frontend.about') }}">{{ __('about') }} |</a></li>
                <li><a href="{{ route('frontend.contact') }}">{{ __('contact') }} </a></li>
            </ul>
        </div>
    </div>
</footer>
