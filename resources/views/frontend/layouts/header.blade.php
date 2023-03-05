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
                        @if (auth()->guard('user')->check() && userWishlist() > 0)
                            <li class="nav-item">
                                <a href="{{ route('user.favourite') }}" class="nav-link">
                                    <i class="fa fa-star"></i> {{ userWishlist() }}
                                    {{ userWishlist() > 1 ? 'favourites' : 'favourite' }}
                                </a>
                            </li>
                        @endif
                        @if (auth('user')->check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.profile') }}">
                                    <i class="fas fa-user"></i>
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
                            <a class="nav-link adpost_btn" href="{{ route('frontend.post.create') }}">
                                <i class="fas fa-plus-square"></i>
                                Place an ad
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>