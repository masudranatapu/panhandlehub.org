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
<div class="template_wrap mt-1 d-none d-md-block">
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
                                    <button type="submit" class="text-input-group"><i class="la la-search"></i></button>
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
                                    <option value="{{ $value->code }}" @if (Session::get('locale')== $value->code) selected @endif>{{ $value->name }}</option>
                                @endforeach
                                {{-- <option value="en" @if (Session::get('locale')=='en' ) selected @endif>English
                                </option>
                                <option value="hi" @if (Session::get('locale')=='hi' ) selected @endif>Hindi</option> --}}
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
</div>


{{-- mobile version --}}
<div class="mobile-view d-block d-md-none">
    <div class="mobile_header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-5">
                    <div class="mobile_heade_left">
                        <div class="site_logo">
                            <a class="header_logo" name="logoLink" href="{{ route('frontend.index') }}">ffutS</a>
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
                            {{-- <li>
                                <a href="javascript:;" class="badge text-bg-danger">
                                    <i class="las la-times-circle"></i> 2
                                    hidden
                                </a>
                            </li> --}}
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
                    <button type="submit" class="text-input-group"><i class="la la-search"></i></button>
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

{{-- <div class="d-none">
    <form action="{{ route('frontend.search') }}" method="get" id="eventForm">
        <input type="hidden" name="category" value="event-class">
        <input type="hidden" name="date" id="date_select">
    </form>
</div> --}}

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
                        // alert("Selected Date: " + date);
                        // $('#date_select').val(date);
                        // $('#eventForm').submit();
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