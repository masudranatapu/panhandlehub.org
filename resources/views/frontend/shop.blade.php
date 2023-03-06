@extends('frontend.layouts.app', ['nav' => 'yes'])


@push('style')
@endpush
@section('title')
{{ __('Ads') }}
@endsection
@section('breadcrumb')
<div class="breadcrumb_section">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item pe-2"><a href="{{ route('frontend.index') }}">Home</a></li>
                >
                <li class="breadcrumb-item active" aria-current="page">Ads</li>
            </ol>
        </nav>
    </div>
</div>
@endsection


@section('content')
<div class="main_template mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-3 d-none d-lg-block">
                <div class="shop_sidebar">
                    <div class="shop_filter">
                        <span class="mobile_nav navbar_btn d-block d-sm-none" onclick="openNav()">
                            <i class="las la-angle-double-left"></i>
                        </span>
                        <form action="{{ route('frontend.search') }}" method="get" id="searchFrm">
                            <input type="hidden" name="country" value="{{ getCountryCode() }}" id="country">


                            <div class="mb-3">
                                <div class="filter_heading">
                                    <h3>Keyword</h3>
                                </div>
                                <div class="">
                                    <input type="text" name="search" id="search" class="form-control"
                                        placeholder="Keywords">
                                </div>
                            </div>


                            <div class="mb-3">
                                <div class="filter_heading">
                                    <h3>Sort By</h3>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="sort" type="radio" value="latest" id="sort_1"
                                        {{ request()->has('sort') && request()->sort == 'latest' ? 'checked':'' }}
                                    onchange="this.form.submit()">
                                    <label class="form-check-label" for="sort_1">
                                        Latest
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="sort" type="radio" value="oldest" id="sort_2"
                                        {{ request()->has('sort') && request()->sort == 'oldest' ? 'checked':'' }}
                                    onchange="this.form.submit()">
                                    <label class="form-check-label" for="sort_2">
                                        Oldest
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="sort" type="radio" value="asc" id="sort_3" {{
                                        request()->has('sort') && request()->sort == 'asc' ? 'checked':'' }}
                                    onchange="this.form.submit()">
                                    <label class="form-check-label" for="sort_3">
                                        Ascending
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="sort" type="radio" value="desc" id="sort_4" {{
                                        request()->has('sort') && request()->sort == 'desc' ? 'checked':'' }}
                                    onchange="this.form.submit()">
                                    <label class="form-check-label" for="sort_4">
                                        Descending
                                    </label>
                                </div>
                            </div>
                            {{-- @if (request('category'))
                            <input type="hidden" name="category" value="{{ request()->category }}">
                            @endif
                            @if (request('category'))
                            <div class="filter_heading">
                                <h3>Categories</h3>
                            </div>
                            <div class="filter_category mb-3">
                                @foreach ($subcategories as $item)
                                <div class="form-check">
                                    <input class="form-check-input" name="subcategory[]" type="checkbox"
                                        value="{{ $item->slug }}" id="subcategory{{ $item->id }}" {{
                                        request()->has('subcategory') && in_array($item->slug,
                                    request()->subcategory) ? 'checked':'' }} onchange="this.form.submit()" >
                                    <label class="form-check-label" for="subcategory{{ $item->id }}">
                                        {{ $item->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @endif --}}


                            <div class="filter_heading">
                                <h3>Categories</h3>
                            </div>
                            <div class="filter_category mb-3">
                                @foreach ($categories as $item)
                                <div class="form-check">
                                    <input class="form-check-input" name="category[]" type="checkbox"
                                        value="{{ $item->slug }}" id="category{{ $item->id }}">
                                    <label class="form-check-label" for="category{{ $item->id }}">
                                        {{ $item->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            <div class="filter_heading">
                                <h3>Locations</h3>
                            </div>
                            <div class="filter_category mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="location[]" type="checkbox" value=""
                                        id="location_1">
                                    <label class="form-check-label" for="location_1">
                                        Dhaka
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="location[]" type="checkbox" value=""
                                        id="location_2">
                                    <label class="form-check-label" for="location_2">
                                        Chattogram
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="location[]" type="checkbox" value=""
                                        id="location_3">
                                    <label class="form-check-label" for="location_3">
                                        Sylhet
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="location[]" type="checkbox" value=""
                                        id="location_4">
                                    <label class="form-check-label" for="location_4">
                                        Rajshahi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="location[]" type="checkbox" value=""
                                        id="location_5">
                                    <label class="form-check-label" for="location_5">
                                        Khulna
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="location[]" type="checkbox" value=""
                                        id="location_6">
                                    <label class="form-check-label" for="location_6">
                                        Barishal
                                    </label>
                                </div>
                            </div>

                            {{-- <div class="filter_wrap mb-3">
                                <div class="filter_heading">
                                    <h3>Offices and Activities Trade</h3>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="post[]" type="checkbox" value="title"
                                        id="duration_1" {{ request()->has('post') && in_array('title', request()->post)
                                    ? 'checked':'' }}
                                    onchange="this.form.submit()"
                                    >
                                    <label class="form-check-label" for="duration_1">
                                        it has title
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="post[]" type="checkbox" value="image"
                                        id="duration_2" {{ request()->has('post') && in_array('image', request()->post)
                                    ? 'checked':'' }}
                                    onchange="this.form.submit()">
                                    <label class="form-check-label" for="duration_2">
                                        it has pictures
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="post[]" type="checkbox" value="today"
                                        id="duration_3" {{ request()->has('post') && in_array('today', request()->post)
                                    ? 'checked':'' }}
                                    onchange="this.form.submit()">
                                    <label class="form-check-label" for="duration_3">
                                        posted today
                                    </label>
                                </div>
                            </div> --}}
                            <div class="filter_wrap mb-5">
                                <div class="filter_heading">
                                    <h3>Price</h3>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="number" name="min_price" id="min_price" placeholder="Min"
                                        value="{{ request()->min_price }}" class="form-control">
                                    <span class="input-group-text">-</span>
                                    <input type="number" name="max_price" id="max_price" placeholder="Max"
                                        value="{{ request()->max_price }}" class="form-control">
                                </div>
                            </div>
                            <div class="filter_wrap d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary mb-1">Update Search</button>
                                <a href="{{ route('frontend.search') }}" class="reset btn btn-danger">Reset</a>
                            </div>
                    </div>

                    {{-- ads --}}
                    <div class="ads mt-4">
                        <a href="#" target="_blank">
                            <img src="{{ asset('frontend/images/ads/ads-2.png') }}" class="w-100" alt="logo">
                        </a>
                    </div>
                    {{-- ads --}}
                </div>
            </div>
            <div class="col-lg-8 col-xl-9">
                <div class="featured_product">
                    <div class="shop_header mb-4 text-center text-sm-start">
                        <div class="row g-3 align-items-center">
                            <div class="col-sm-6">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="shop_filter_btn d-block d-lg-none me-2 mb-1" data-bs-toggle="offcanvas"
                                        href="#shopFilter" role="button" aria-controls="shopFilter">
                                        <img src="{{ asset('frontend/images/icon/filter.svg') }}" alt="">
                                    </div>
                                    <div class="listing_ad">
                                        <h3>891 items Available Listings</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="filter_form float-sm-end">
                                    <form action="#" method="post">
                                        <div class="input-group">
                                            <span class="input-group-text">Sort By:</span>
                                            <select name="" id="" class="form-control">
                                                <option value="">Recent Listings</option>
                                                <option value="">Old Listings</option>
                                                <option value="">Price low to high</option>
                                                <option value="">Price high to low</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- product --}}
                        @foreach ($ads as $key => $row)
                        <div class="col-sm-6 col-md-6 col-xl-4 mb-3 d-sm-flex justify-content-strach">
                            <div class="card product_wrapper">
                                <div class="product_img">
                                    <a href="{{ route('frontend.details', $row->slug) }}">
                                        <img src="{{ asset($row->thumbnail ?? 'frontend/images/no-img.png') }}"
                                            class="w-100" alt="image">
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
                                                    id="wishlist_{{ $row->id }}" {{ isWishlisted($row->id) ?
                                                'checked' : ''
                                                }}
                                                onchange="AddWishlist2({{ $row->id }}, {{ Auth::user()->id ?? ''
                                                }})">
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

                    {{-- pagination --}}
                    <div class="shop_pagination mt-4 d-flex justify-content-center">
                        {{ $ads->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




{{-- shop filter mobile device --}}
<div class="filter_offcanvas offcanvas offcanvas-start d-block d-lg-none" tabindex="-1" id="shopFilter"
    aria-labelledby="shopFilterLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="shopFilterLabel">Product Filter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="shop_filter">
            <span class="mobile_nav navbar_btn d-block d-sm-none" onclick="openNav()">
                <i class="las la-angle-double-left"></i>
            </span>
            <form action="{{ route('frontend.search') }}" method="get" id="searchFrm">
                <input type="hidden" name="country" value="{{ getCountryCode() }}" id="country">

                <div class="mb-3">
                    <div class="filter_heading">
                        <h3>Keyword</h3>
                    </div>
                    <div class="">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Keywords">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="filter_heading">
                        <h3>Sort By</h3>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="sort" type="radio" value="latest" id="sort_1" {{
                            request()->has('sort') && request()->sort == 'latest' ? 'checked':'' }}
                        onchange="this.form.submit()">
                        <label class="form-check-label" for="sort_1">
                            Latest
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="sort" type="radio" value="oldest" id="sort_2" {{
                            request()->has('sort') && request()->sort == 'oldest' ? 'checked':'' }}
                        onchange="this.form.submit()">
                        <label class="form-check-label" for="sort_2">
                            Oldest
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="sort" type="radio" value="asc" id="sort_3" {{
                            request()->has('sort') && request()->sort == 'asc' ? 'checked':'' }}
                        onchange="this.form.submit()">
                        <label class="form-check-label" for="sort_3">
                            Ascending
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="sort" type="radio" value="desc" id="sort_4" {{
                            request()->has('sort') && request()->sort == 'desc' ? 'checked':'' }}
                        onchange="this.form.submit()">
                        <label class="form-check-label" for="sort_4">
                            Descending
                        </label>
                    </div>
                </div>

                <div class="filter_heading">
                    <h3>Categories</h3>
                </div>
                <div class="filter_category mb-3">
                    @foreach ($categories as $item)
                    <div class="form-check">
                        <input class="form-check-input" name="category[]" type="checkbox" value="{{ $item->slug }}"
                            id="category{{ $item->id }}">
                        <label class="form-check-label" for="category{{ $item->id }}">
                            {{ $item->name }}
                        </label>
                    </div>
                    @endforeach
                </div>

                <div class="filter_heading">
                    <h3>Locations</h3>
                </div>
                <div class="filter_category mb-3">
                    <div class="form-check">
                        <input class="form-check-input" name="location[]" type="checkbox" value="" id="location_1">
                        <label class="form-check-label" for="location_1">
                            Dhaka
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="location[]" type="checkbox" value="" id="location_2">
                        <label class="form-check-label" for="location_2">
                            Chattogram
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="location[]" type="checkbox" value="" id="location_3">
                        <label class="form-check-label" for="location_3">
                            Sylhet
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="location[]" type="checkbox" value="" id="location_4">
                        <label class="form-check-label" for="location_4">
                            Rajshahi
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="location[]" type="checkbox" value="" id="location_5">
                        <label class="form-check-label" for="location_5">
                            Khulna
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="location[]" type="checkbox" value="" id="location_6">
                        <label class="form-check-label" for="location_6">
                            Barishal
                        </label>
                    </div>
                </div>

                <div class="filter_wrap mb-5">
                    <div class="filter_heading">
                        <h3>Price</h3>
                    </div>

                    <div class="input-group mb-3">
                        <input type="number" name="min_price" id="min_price" placeholder="Min"
                            value="{{ request()->min_price }}" class="form-control">
                        <span class="input-group-text">-</span>
                        <input type="number" name="max_price" id="max_price" placeholder="Max"
                            value="{{ request()->max_price }}" class="form-control">
                    </div>
                </div>
                <div class="filter_wrap d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary mb-1">Update Search</button>
                    <a href="{{ route('frontend.search') }}" class="reset btn btn-danger">Reset</a>
                </div>
        </div>
    </div>
</div>






@endsection




@push('script')
@endpush
