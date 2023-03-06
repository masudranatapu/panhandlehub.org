{{-- footer --}}
<footer class="footer_section mt-5 pt-5 pb-2">
    <div class="container">
        <div class="row g-4">
            <div class="col-sm-6 col-md-4">
                <div class="footer_wrapper">
                    <div class="footer_widget mb-4">
                        <h3>PanHandleHub</h3>
                    </div>
                    <div class="infomation">
                        <ul>
                            <li>
                                <a href="tel:123 - 456 - 789">
                                    <i class="fas fa-phone-volume"></i>
                                    123 - 456 - 789
                                </a>
                            </li>
                            <li>
                                <a href="mailto:info@gmail.com">
                                    <i class="fas fa-envelope"></i>
                                    info@gmail.com
                                </a>
                            </li>
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                1420 West Jalkuri Fatullah,
                                Narayanganj, BD
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="footer_wrapper">
                    <div class="footer_widget mb-4">
                        <h3>Quick Links</h3>
                    </div>
                    <div class="footer_links">
                        <ul>
                            <li><a href="{{ route('frontend.faq') }}">{{ __('faq') }}</a></li>
                            <li><a href="{{ route('frontend.search') }}">{{ __('Ads') }}</a></li>
                            <li><a href="{{ route('frontend.privacy.policy') }}">{{ __('privacy') }}</a></li>
                            <li><a href="{{ route('frontend.terms.condition') }}">{{ __('terms_conditions') }}</a>
                            </li>
                            <li><a href="{{ route('frontend.contact') }}">{{ __('contact') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="footer_wrapper">
                    <div class="footer_widget mb-4">
                        <h3>Social Media</h3>
                    </div>
                    <div class="social_media">
                        <ul>
                            <li><a href="#" target="_blank">Facebook</a></li>
                            <li><a href="#" target="_blank">Twitter</a></li>
                            <li><a href="#" target="_blank">Linkedin</a></li>
                            <li><a href="#" target="_blank">Whatsapp</a></li>
                            <li><a href="#" target="_blank">Pinterest</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="copyright pt-5 text-center">
                <p>Copyright © {{ date('Y') }} panhandlehub All rights reserved.</p>
            </div>

        </div>
    </div>
</footer>
{{-- footer --}}