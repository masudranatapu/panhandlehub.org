@extends('frontend.layouts.app', ['nav' => 'no'])

@section('meta')
<meta property="title" content="{{ $meta_title }}" />
<meta property="description" content="{{ $meta_description }}" />
<meta property="keywords" content="{{ $meta_keywords }}" />
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
<meta property="og:keywords" content="{{ $meta_keywords }}" />
<meta property="og:image" content="{{ asset($meta_image) }}" />
@endsection

@push('style')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('title')
{{ config('app.name') }}
@endsection
@php
$country = getCountryCode();
// dd($country);
@endphp

@section('content')

{{-- <div class="template_wrap mt-1 d-none d-md-block">
    <div class="container">
        <div class="row g-0">
            <div class="col-md-3">
                <div class="sidebar_left overflow-hidden">
                    <div class="heading1 text-center p-3">
                        <h5><a href="{{ route('frontend.index') }}"><img src="{{ asset('frontend/images/logo.png') }}"
                                    width="124" alt="logo"></a>
                        </h5>
                        <ul class="list-group pt-3">
                            <li class="custom-list-style mb-2">
                                <a href="{{ route('frontend.post.create') }}">Post Your Ad</a>
                            </li>
                            @if (auth('user')->check())
                            <li class="mt-1 mb-3">
                                <a href="{{ route('user.profile') }}">My Account</a>
                            </li>
                            @else
                            <li class="mt-1 mb-3">
                                <a href="{{ route('signin') }}">My Account</a>
                            </li>
                            @endif
                        </ul>
                        <div class="search-style mb-4">
                            <form action="{{ route('frontend.search') }}" method="get">
                                <div class="input-group">
                                    <input type="text" name="search" id="search" class="form-control"
                                        placeholder="Search..." required>
                                    <button type="submit" class="text-input-group"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="custom-calender mb-3">
                            <h5><a href="javascript:;">Event Calendar</a></h5>
                        </div>
                        <div class="calender-style mb-4">
                            <div id="datepicker"></div>
                        </div>
                        <div class="list-style1 mb-4">
                            <h5 class="mb-3"><a href="javascript:;"
                                    style="font-size: 14px;text-align: center;margin-top: 5px;color: #0000EE;font-weight: 600;">Latest
                                    Post</a></h5>
                            <ul class="list-group">
                                @foreach ($ads as $key => $value)
                                <li class="list-item custom-list-style1">
                                    <a href="{{ route('frontend.details', $value->slug) }}">{{ $value->title }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="heading2 text-center py-3">
                    <h5><a href="{{ route('frontend.index') }}">{{ config('app.name') }}</a></h5>
                </div>
                <div class="main_body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                @foreach ($categories as $key => $item)
                                @if (!in_array($item->id, ['10', '14', '15']))
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="category_heading text-center">
                                        <h5>
                                            <a
                                                href="{{ route('frontend.search', ['country' => $country, 'category' => $item->slug]) }}">
                                                {{ __($item->slug) }}</a>
                                        </h5>
                                    </div>
                                    <div class="row g-1">
                                        @foreach ($item->subcategories as $scat)
                                        <div
                                            class="@if ($item->id == 8) col-md-6 @elseif($item->id == 9) col-md-12  @elseif($item->id == 11) col-md-6  @elseif($item->id == 12) col-md-6  @elseif($item->id == 13) col-md-4 @else col-md-12 @endif  ">
                                            <div class="mt-1">
                                                <ul class="list-group category_list">
                                                    <li><a
                                                            href="{{ route('frontend.search', ['country' => $country, 'category' => $item->slug, 'subcategory' => $scat->slug]) }}">{{
                                                            __($scat->name) }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="row">
                                @foreach ($categories as $key => $item)
                                @if (in_array($item->id, ['10', '14', '15']))
                                <div class="col-md-12 mb-2">
                                    <div class="category_heading text-center">
                                        <h5>
                                            <a
                                                href="{{ route('frontend.search', ['country' => $country, 'category' => $item->slug]) }}">
                                                {{ __($item->slug) }}</a>
                                        </h5>
                                    </div>
                                    <div class="row g-1">
                                        @foreach ($item->subcategories as $scat)
                                        <div class="col-md-12">
                                            <div class="mt-2">
                                                <ul class="list-group category_list">
                                                    <li><a
                                                            href="{{ route('frontend.search', ['country' => $country, 'category' => $item->slug, 'subcategory' => $scat->slug]) }}">{{
                                                            __($scat->name) }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="sidebar_right">
                    <div class="heading3 text-center">
                        <form action="{{ route('frontend.localization') }}" method="post">
                            @csrf
                            <select name="language" id="language"
                                class="form-control form-select language_dropdown mb-3" onchange="this.form.submit()">
                                @foreach($languages as $key => $value)
                                <option value="{{ $value->code }}" @if (Session::get('locale')==$value->code) selected
                                    @endif>{{ $value->name }}</option>
                                @endforeach

                            </select>
                        </form>

                        <hr>
                        <form action="{{ route('frontend.setCountry') }}" method="post">
                            @csrf
                            <select name="country" id="country"
                                class="form-control form-select language_dropdown mb-3 select2"
                                onchange="this.form.submit()">
                                @if (isset($countries) && count($countries) > 0)
                                @foreach ($countries as $key => $row)
                                @php $iso = strtolower($row->iso) @endphp
                                <option value="{{ $iso }}" {{ $country==$iso ? 'selected' : '' }}>
                                    {{ $row->name }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </form>

                        @if (isset($cities) && count($cities) > 0)
                        <div class="mt-2 list-syle-hover">
                            <ul class="list-group ">
                                @foreach ($cities as $key => $city)
                                <li><a
                                        href="{{ route('frontend.search', ['country' => $country]) }}?city={{ $city->slug }}">
                                        {{ $city->name }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        @include('frontend.layouts.footer')
    </div>
</div> --}}
{{-- Header --}}


<div class="desktop_view d-none d-md-block">

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
    {{-- Header --}}

    {{-- search banner --}}
    <div class="search_banner">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="banner_content">
                        <div class="content mb-4">
                            <h2>Find Your Perfect Match</h2>
                        </div>
                        <form action="{{ route('frontend.search') }}" method="get">
                            <div class="input-group">
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Enter keywords..." required autocomplete="off">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- search banner --}}

    {{-- top category --}}
    <div class="category_section mt-5">
        <div class="container">
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-3">
                @foreach ($top_categoreis as $key => $item)
                <div class="col">
                    <div class="category_name text-center">
                        <a href="{{ route('frontend.search', ['country' => $country, 'category' => $item->slug]) }}">
                            <i class="icon {{ $item->icon }}"></i>
                            <h6>{{ $item->name }}</h6>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- top category --}}

    {{-- ads --}}
    <div class="ads mt-5 mb-5">
        <div class="container">
            <a href="#" target="_blank">
                <img src="{{ asset('frontend/images/ads.png') }}" class="w-100" alt="logo">
            </a>
        </div>
    </div>
    {{-- ads --}}


    {{-- category --}}
    <div class="category_section mb-5">
        <div class="container">
            @foreach ($categories as $key => $item)
            <div class="heading mb-2">
                <h3>
                    <a href="{{ route('frontend.search', ['country' => $country, 'category' => $item->slug]) }}">
                        {{ __($item->slug) }}</a>
                </h3>
            </div>
            <div class="category_item mb-4">
                <ul>
                    @foreach ($item->subcategories as $scat)
                    <li>
                        <a
                            href="{{ route('frontend.search', ['country' => $country, 'category' => $item->slug, 'subcategory' => $scat->slug]) }}">{{
                            __($scat->name) }} |
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
    {{-- category --}}


    {{-- featured product --}}
    <div class="featured_product">
        <div class="container">
            <div class="section_heading mb-4">
                <h3>Recently viewed classifieds</h3>
            </div>
            <div class="row">
                {{-- product --}}
                @foreach ($ads as $key => $row)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-3 d-flex justify-content-strach">
                    <div class="card product_wrapper">
                        <div class="product_img">
                            <a href="{{ route('frontend.details', $row->slug) }}">
                                <img src="{{ asset($row->thumbnail ?? 'frontend/images/no-img.png') }}" class="w-100"
                                    alt="image">
                            </a>
                        </div>
                        <div class="card-body product_content d-flex flex-column">
                            <h3>
                                <a href="{{ route('frontend.details', $row->slug) }}">
                                    {{ Str::limit($row->title, '32',
                                    '...') }}
                                </a>
                            </h3>
                            <div class="mb-4 mt-auto">
                                <p class="location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    ({{ $row->city }}
                                    {{ isset($row->countries->name) ? ', ' .
                                    ucfirst(strtolower($row->countries->name)) : ''
                                    }})
                                </p>
                                <p class="time">
                                    <i class="fa fa-clock"></i>
                                    {{ date('d Y', strtotime($row->created_at)) }}
                                </p>
                            </div>
                            <div class="d-flex mt-auto">
                                <div class="price">
                                    @if($row->price)<h4>${{ $row->price }}</h4>@endif
                                </div>
                                <div class="features">
                                    <div class="form-check">
                                        <input class="form-check-input" name="wishlist" type="checkbox"
                                            id="wishlist_{{ $row->id }}" {{ isWishlisted($row->id) ? 'checked' : ''
                                        }}
                                        onchange="AddWishlist2({{ $row->id }}, {{ Auth::user()->id ?? '' }})">
                                        <label class="form-check-label" for="wishlist_{{ $row->id }}"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- product --}}
            </div>
        </div>
    </div>
    {{-- featured product --}}

    {{-- footer --}}
    <footer class="footer_section mt-5 pt-5 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="footer_wrapper">
                        <div class="footer_widget mb-4">
                            <h3>PanHandleHub</h3>
                        </div>
                        <div class="infomation">
                            <ul>
                                <li>
                                    <a href="mailto:info@gmail.com">
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
                                <li><a href="">Facebook</a></li>
                                <li><a href="">Twitter</a></li>
                                <li><a href="">Linkedin</a></li>
                                <li><a href="">Whatsapp</a></li>
                                <li><a href="">Pinterest</a></li>
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
</div>





{{-- mobile version --}}
<div class="mobile-view d-block d-md-none">
    <div class="mobile_header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-5">
                    <div class="mobile_heade_left">
                        <div class="site_logo">
                            <a class="navbar-brand" href="{{ route('frontend.index') }}">
                                <img src="{{ asset('frontend/images/logo.png') }}" width="124" alt="logo">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="mobile_heade_right float-end">
                        <ul id="wishlist_count">
                            @if (auth()->guard('user')->check() && userWishlist() > 0)
                            <li><a href="{{ route('user.favourite') }}" class="badge text-bg-warning">
                                    <i class="las la-star"></i> {{ userWishlist() }}
                                    {{ userWishlist() > 1 ? 'favourites' : 'favourite' }}</a>
                            </li>
                            @endif
                            <li><a href="{{ route('frontend.post.create') }}">Post an Ad</a></li>
                            @if (auth('user')->check())
                            <li><a href="{{ route('user.profile') }}">My Account</a></li>
                            @else
                            <li><a href="{{ route('signin') }}">My Account</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="mobile_body">
            <form action="{{ route('frontend.search') }}" method="get" class="mb-3 mt-3 p-2">
                <div class="input-group">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search..." required>
                    <button type="submit" class="text-input-group"><i class="fa fa-search"></i></button>
                </div>
            </form>
            <div class="accordion_item mb-4">
                <div class="accordion" id="accordionExample">
                    @foreach ($categories as $key => $item)
                    @if (!in_array($item->id, ['10', '14', '15']))
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading_{{ $item->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_{{ $item->id }}" aria-expanded="false"
                                aria-controls="collapse_{{ $item->id }}">
                                {{ __($item->slug) }}
                            </button>
                        </h2>
                        <div id="collapse_{{ $item->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading_{{ $item->id }}" data-bs-parent="#accordionExample">
                            <div class="accordion_body">
                                <ul>
                                    @foreach ($item->subcategories as $scat)
                                    <li>
                                        <a
                                            href="{{ route('frontend.search', ['country' => $country, 'category' => $item->slug, 'subcategory' => $scat->slug]) }}">{{
                                            __($scat->name) }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @foreach ($categories as $key => $item)
                    @if (in_array($item->id, ['10', '14', '15']))
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading_{{ $item->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_{{ $item->id }}" aria-expanded="false"
                                aria-controls="collapse_{{ $item->id }}">
                                {{ __($item->slug) }}
                            </button>
                        </h2>
                        <div id="collapse_{{ $item->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading_{{ $item->id }}" data-bs-parent="#accordionExample">
                            <div class="accordion_body">
                                <ul>
                                    @foreach ($item->subcategories as $scat)
                                    <li>
                                        <a
                                            href="{{ route('frontend.search', ['country' => $country, 'category' => $item->slug, 'subcategory' => $scat->slug]) }}">{{
                                            __($scat->name) }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach


                </div>
            </div>
        </div>
    </div>
    @include('frontend.layouts.footer')
</div>

@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function() {
            $("#datepicker").datepicker({
                dateFormat: 'dd-mm-yy',
                onSelect: function(date, datepicker) {
                    if (date != "") {
                        var base_url = $('#base_url').val();
                        var country = $('#country').val();
                        var full_url = base_url + '/ads/' + country + '/events/?date=' + date
                        window.location.replace(full_url);
                    }
                }
            });
        });
</script>
@endpush