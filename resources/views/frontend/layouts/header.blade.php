<header class="header_section sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg p-0">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('frontend.index') }}">
                    <img src="{{ asset('frontend/images/logo.png') }}" width="124" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @php
                            if (Auth::check()) {
                              $unread_message = \App\Models\Messenger::where('to_id', auth()->id())->where('read', 0)->count();
                            }
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.message') }}">
                                <i class="	far fa-comment"></i>
                                Chat {{ isset($unread_message) ? "(" .$unread_message . ")"  : '' }}
                            </a>
                        </li>
                        <li class="nav-item" id="wishlist_count">
                            <a href="{{ route('user.favourite') }}" class="nav-link">
                                <i class="fa fa-star"></i> {{ userWishlist() > 0 ? userWishlist() : '0' }}
                                {{ __('Saves') }}
                            </a>
                        </li>
                        @if (auth('user')->check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.setting') }}" style="margin-top: -10px">
                                    @if(Auth::user()->image)
                                    <img src="{{ asset(Auth::user()->image) }}" alt="" class="rounded-circle" style="border: 1px solid #ddd;
                                    border-radius: 4px;
                                    padding: 1px;width: 50px; height:54px; margin-top:-8px">
                                    @else
                                    <img src="{{ asset('default-user.png') }}" alt="" class="rounded-circle" style="border: 1px solid #ddd;
                                    border-radius: 4px;
                                    padding: 1px;width: 50px; height:54px;margin-top:-8px">
                                    @endif
                                    My Account
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('signin') }}">
                                    <i class="fa fa-user"></i>
                                    Sign in / Register
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link adpost_btn"
                                href="
                            @if (auth('user')->check()) {{ route('frontend.post.create') }}
                            @else
                                {{ route('signin') }} @endif">
                                <i class="fas fa-plus-square"></i>
                                Place an Ad
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
