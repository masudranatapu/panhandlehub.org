@extends('frontend.layouts.app')

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



<div class="desktop_view d-none d-md-block">



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
                <img src="{{ asset('frontend/images/ads/ads.png') }}" class="w-100" alt="logo">
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
                <div class="col-sm-6 col-md-4 col-lg-3 mb-3 d-sm-flex justify-content-strach">
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
                                    {{ $row->city }}
                                    {{ isset($row->countries->name) ? ', ' .
                                    ucfirst(strtolower($row->countries->name)) : ''
                                    }}
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



    {{-- ads --}}
    <div class="ads mt-5 mb-5">
        <div class="container">
            <a href="#" target="_blank">
                <img src="{{ asset('frontend/images/ads/ads.png') }}" class="w-100" alt="logo">
            </a>
        </div>
    </div>
    {{-- ads --}}


</div>


{{-- mobile version --}}
<div class="mobile-view d-block d-md-none">
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
