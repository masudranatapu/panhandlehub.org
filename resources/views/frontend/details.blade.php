@extends('frontend.layouts.app', ['nav' => 'yes'])

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
<link rel="stylesheet" href="{{ asset('frontend/css/slick.min.css') }}" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lightgallery-bundle.min.css" />
@endpush
@section('title')
{{ __('Details') }}
@endsection
@section('breadcrumb')
<div class="breadcrumb_section">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item pe-2"><a href="{{ route('frontend.index') }}">Home</a></li>
                >
                <li class="breadcrumb-item active">{{ $ad_details->ad_type->slug }}</li>
                >
                <li class="breadcrumb-item active" aria-current="page">{{ $ad_details->category->slug }}</li>
            </ol>
        </nav>
    </div>
</div>
@endsection



@section('content')
<div class="main_template mt-5">
    <div class="container">
        {{-- <div class="single_product mt-5 mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9">
                    <div class="single_pro_content mb-2">
                        <div class="product_info mb-4">
                            <div class="form-check">
                                <input class="form-check-input" name="wishlist" type="checkbox"
                                    id="wishlist_{{ $ad_details->id }}" {{ isWishlisted($ad_details->id) ? 'checked' :
                                '' }}
                                onchange="AddWishlist2({{ $ad_details->id }}, {{ Auth::user()->id ?? '' }})">
                                <label class="form-check-label" for="wishlist_{{ $ad_details->id }}">favorite</label>
                            </div>
                            <span class="float-end">Posted {{ $ad_details->created_at->diffForHumans() }}</span>
                        </div>
                        <h3>{{ $ad_details->title }}</h3>
                    </div>
                    <!-- gallery -->
                    <div class="product-item__gallery mb-4">
                        <div class="swiper mySwiper2">
                            <div class="swiper-wrapper single_item" id="lightgallery">
                                @foreach ($ad_galleies as $key => $value)
                                <a href="{{ asset($value->image) }}" class="swiper-slide">
                                    <img src="{{ asset($value->image) }} " alt="{{ $value->name }}" />
                                </a>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>

                    <div thumbsSlider="" class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($ad_galleies as $key => $value)
                            <div class="swiper-slide">
                                <img src="{{ asset($value->image) }}" alt="{{ $value->name }}" />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- details -->
                <div class="details p-5">
                    <!-- Job Offerd -->
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="mb-4">
                                @if ($ad_details->ad_type->slug == 'job-offered')
                                @if ($ad_details->employment_type)
                                <li>Kind of Employment:
                                    <strong>{{ $ad_details->employment_type }}</strong>
                                </li>
                                @endif
                                @isset($ad_details->services)
                                <li>
                                    Services:
                                    @foreach ($ad_details->services as $value)
                                    <span class="badge rounded-pill bg-success">{{ $value }}</span>
                                    @endforeach
                                </li>
                                @endisset
                                @if ($ad_details->job_title)
                                <li>Job Title: <strong>{{ $ad_details->job_title }}</strong></li>
                                @endif
                                @if ($ad_details->price)
                                <li>Salary: <strong>${{ $ad_details->price }}</strong></li>
                                @endif
                                @if ($ad_details->company_name)
                                <li>Company Name: <strong>{{ $ad_details->company_name }}</strong></li>
                                @endif
                                @endif
                                @if ($ad_details->ad_type->slug == 'job-wanted')
                                @isset($ad_details->availability)
                                <li>Availability:
                                    @foreach ($ad_details->availability as $value)
                                    <span class="badge rounded-pill bg-primary">{{ $value }}</span>
                                    @endforeach
                                </li>
                                @endisset
                                @if ($ad_details->education)
                                <li>Education: <strong>{{ $ad_details->education }}</strong></li>
                                @endif
                                @if ($ad_details->direct_contact)
                                <li>Direct Contact: <strong>{{ $ad_details->direct_contact }}</strong>
                                </li>
                                @endif
                                @if ($ad_details->is_license)
                                <li>Is license: <strong>{{ $ad_details->is_license }}</strong></li>
                                @endif
                                @if ($ad_details->license_info)
                                <li>licensure information:
                                    <strong>{{ $ad_details->license_info }}</strong>
                                    @endif
                                </li>
                                @endif
                                @if ($ad_details->ad_type->slug == 'housing-offered')
                                @if ($ad_details->sqft)
                                <li>SQFT: <strong>{{ $ad_details->sqft }}</strong></li>
                                @endif
                                @if ($ad_details->houssing_type)
                                <li>Houssing Type: <strong>{{ $ad_details->houssing_type }}</strong>
                                </li>
                                @endif
                                @if ($ad_details->laundry)
                                <li>Laundry: <strong>{{ $ad_details->laundry }}</strong></li>
                                @endif
                                @if ($ad_details->parking)
                                <li>Parking: <strong>{{ $ad_details->parking }}</strong></li>
                                @endif
                                @if ($ad_details->bedrooms)
                                <li>Bedrooms: <strong>{{ $ad_details->bedrooms }}</strong></li>
                                @endif
                                @if ($ad_details->bathrooms)
                                <li>Bathrooms: <strong>{{ $ad_details->bathrooms }}</strong></li>
                                @endif
                                @isset($ad_details->services)
                                <li>
                                    Services:
                                    @foreach ($ad_details->services as $value)
                                    <span class="badge rounded-pill bg-success">{{ $value }}</span>
                                    @endforeach
                                </li>
                                @endisset
                                @if ($ad_details->available_on)
                                <li>Available On: <strong>{{ $ad_details->available_on }}</strong></li>
                                @endif
                                @endif
                                @if ($ad_details->ad_type->slug == 'housing-wanted')
                                @isset($ad_details->services)
                                <li>
                                    Services:
                                    @foreach ($ad_details->services as $value)
                                    <span class="badge rounded-pill bg-success">{{ $value }}</span>
                                    @endforeach
                                </li>
                                @endisset
                                @if ($ad_details->broker_fee)
                                <li>Broker Fee: <strong>{{ $ad_details->broker_fee }}</strong></li>
                                @endif
                                @if ($ad_details->broker_fee_detailed)
                                <li>Please: <strong>{{ $ad_details->broker_fee_detailed }}</strong>
                                </li>
                                @endif
                                @if ($ad_details->application_fee_detailed)
                                <li>Application Fee:
                                    <strong>{{ $ad_details->application_fee_detailed }}</strong>
                                </li>
                                @endif
                                @endif
                                @if ($ad_details->ad_type->slug == 'for-sale-by-owner')
                                @if ($ad_details->manufacturer)
                                <li>make / manufacturer: <strong>{{ $ad_details->manufacturer }}</strong></li>
                                @endif
                                @if ($ad_details->model_name)
                                <li>model name / number: <strong>{{ $ad_details->model_name }}</strong></li>
                                @endif
                                @if ($ad_details->dimension)
                                <li>size / dimensions: <strong>{{ $ad_details->dimension }}</strong></li>
                                @endif
                                @if ($ad_details->conditions)
                                <li>condition: <strong>{{ $ad_details->conditions }}</strong></li>
                                @endif
                                @if ($ad_details->language)
                                <li>language of posting: <strong>{{ $ad_details->language }}</strong></li>
                                @endif

                                @isset($ad_details->services)
                                <li>
                                    Services:
                                    @foreach ($ad_details->services as $value)
                                    <span class="badge rounded-pill bg-success">{{ $value }}</span>
                                    @endforeach
                                </li>
                                @endisset

                                @endif
                                @if ($ad_details->ad_type->slug == 'for-sale-by-dealer')
                                @if ($ad_details->manufacturer)
                                <li>make / manufacturer: <strong>{{ $ad_details->manufacturer }}</strong></li>
                                @endif
                                @if ($ad_details->model_name)
                                <li>model name / number: <strong>{{ $ad_details->model_name }}</strong></li>
                                @endif
                                @if ($ad_details->dimension)
                                <li>size / dimensions: <strong>{{ $ad_details->dimension }}</strong></li>
                                @endif
                                @if ($ad_details->conditions)
                                <li>condition: <strong>{{ $ad_details->conditions }}</strong></li>
                                @endif
                                @if ($ad_details->language)
                                <li>language of posting: <strong>{{ $ad_details->language }}</strong></li>
                                @endif

                                @isset($ad_details->services)
                                <li>
                                    Services:
                                    @foreach ($ad_details->services as $value)
                                    <span class="badge rounded-pill bg-success">{{ $value }}</span>
                                    @endforeach
                                </li>
                                @endisset

                                @endif
                                @if ($ad_details->ad_type->slug == 'wanted-by-owner')

                                @if ($ad_details->dimension)
                                <li>size / dimensions: <strong>{{ $ad_details->dimension }}</strong></li>
                                @endif
                                @if ($ad_details->conditions)
                                <li>condition: <strong>{{ $ad_details->conditions }}</strong></li>
                                @endif
                                @if ($ad_details->language)
                                <li>language of posting: <strong>{{ $ad_details->language }}</strong></li>
                                @endif

                                @isset($ad_details->services)
                                <li>
                                    Services:
                                    @foreach ($ad_details->services as $value)
                                    <span class="badge rounded-pill bg-success">{{ $value }}</span>
                                    @endforeach
                                </li>
                                @endisset

                                @endif
                                @if ($ad_details->ad_type->slug == 'wanted-by-dealer')

                                @if ($ad_details->dimension)
                                <li>size / dimensions: <strong>{{ $ad_details->dimension }}</strong></li>
                                @endif
                                @if ($ad_details->conditions)
                                <li>condition: <strong>{{ $ad_details->conditions }}</strong></li>
                                @endif
                                @if ($ad_details->language)
                                <li>language of posting: <strong>{{ $ad_details->language }}</strong></li>
                                @endif

                                @isset($ad_details->services)
                                <li>
                                    Services:
                                    @foreach ($ad_details->services as $value)
                                    <span class="badge rounded-pill bg-success">{{ $value }}</span>
                                    @endforeach
                                </li>
                                @endisset

                                @endif
                                @if ($ad_details->ad_type->slug == 'service-offered')

                                @if ($ad_details->dimension)
                                <li>size / dimensions: <strong>{{ $ad_details->dimension }}</strong></li>
                                @endif
                                @if ($ad_details->conditions)
                                <li>condition: <strong>{{ $ad_details->conditions }}</strong></li>
                                @endif
                                @if ($ad_details->language)
                                <li>language of posting: <strong>{{ $ad_details->language }}</strong></li>
                                @endif

                                @isset($ad_details->services)
                                <li>
                                    Services:
                                    @foreach ($ad_details->services as $value)
                                    <span class="badge rounded-pill bg-success">{{ $value }}</span>
                                    @endforeach
                                </li>
                                @endisset

                                @endif
                                @if ($ad_details->ad_type->slug == 'event-class')
                                @isset($ad_details->services)
                                <li>
                                    Services:
                                    @foreach ($ad_details->services as $value)
                                    <span class="badge rounded-pill bg-success">{{ $value }}</span>
                                    @endforeach
                                </li>
                                @endisset
                                @if ($ad_details->venue)
                                <li>Venue: <strong>{{ $ad_details->venue }}</strong></li>
                                @endif
                                @if ($ad_details->event_start_date)
                                <li>Start Date:
                                    <strong>{{ date('d M, Y', strtotime($ad_details->event_start_date)) }}</strong>
                                </li>
                                @endif
                                @if ($ad_details->event_end_date)
                                <li>End Date:
                                    <strong>{{ date('d M, Y', strtotime($ad_details->event_end_date)) }}</strong>
                                </li>
                                @endif
                                @if ($ad_details->event_duration)
                                <li>Event Duration: <strong>{{ $ad_details->event_duration }}</strong>
                                </li>
                                @endif
                                @endif
                                @if ($ad_details->price)
                                <li>Price: <strong>${{ $ad_details->price }}</strong></li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="mb-4">
                                @if ($ad_details->email)
                                <li>Email: <strong>{{ $ad_details->customer->email }}</strong></li>
                                @endif
                                @if ($ad_details->email_privacy)
                                <li>Email Privacy: <strong>{{ $ad_details->email_privacy }}</strong></li>
                                @endif
                                @if ($ad_details->phone_call)
                                <li>Phone Call:
                                    <strong>{{ $ad_details->phone_call == 1 ? 'Yes' : 'No' }}</strong>
                                </li>
                                @endif
                                @if ($ad_details->phone_text)
                                <li>Phone Text:
                                    <strong>{{ $ad_details->phone_text == 1 ? 'Yes' : 'No' }}</strong>
                                </li>
                                @endif
                                @if ($ad_details->phone)
                                <li>Phone Number: <strong>{{ $ad_details->phone }}</strong></li>
                                @endif
                                @if ($ad_details->phone_2)
                                <li>Local number: <strong>{{ $ad_details->phone_2 }}</strong></li>
                                @endif
                                @if ($ad_details->contact_name)
                                <li>Contact Name: <strong>{{ $ad_details->contact_name }}</strong></li>
                                @endif
                                @if ($ad_details->city)
                                <li>City: <strong>{{ $ad_details->city }}</strong></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    @if ($ad_details->description)
                    <p>{{ $ad_details->description }}</p>
                    @endif
                </div>
            </div>
        </div> --}}
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="single_pro_content mb-2">
                    <div class="d-flex justify-content-between">
                        <div class="title">
                            <h3>{{ $ad_details->title }}</h3>
                        </div>
                        <div class="favourite">
                            <div class="form-check">
                                <input class="form-check-input" name="wishlist" type="checkbox"
                                    id="wishlist_{{ $ad_details->id }}" {{ isWishlisted($ad_details->id) ? 'checked' :
                                '' }}
                                onchange="AddWishlist2({{ $ad_details->id }}, {{ Auth::user()->id ?? '' }})">
                                <label class="form-check-label" for="wishlist_{{ $ad_details->id }}"></label>
                            </div>
                        </div>
                    </div>
                    <span>Posted {{ $ad_details->created_at->diffForHumans() }}</span>
                </div>
                <!-- gallery -->
                <div class="single_product mb-5">
                    <div class="product-item__gallery">
                        <div class="swiper mySwiper2">
                            <div class="swiper-wrapper single_item" id="lightgallery">
                                @foreach ($ad_galleies as $key => $value)
                                <a href="{{ asset($value->image) }}" class="swiper-slide">
                                    <img src="{{ asset($value->image) }} " alt="{{ $value->name }}" />
                                </a>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                    <div thumbsSlider="" class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($ad_galleies as $key => $value)
                            <div class="swiper-slide">
                                <img src="{{ asset($value->image) }}" alt="{{ $value->name }}" />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="seller_wrapper">
                    <div class="ad_wrap mb-3">
                        <div class="heading mb-2">
                            <h3>Seller Infomation</h3>
                        </div>
                        <div class="seller_sort_info">
                            <div class="seller_profile text-center">
                                <a href="#" target="_blank">
                                    <img src="{{ asset('frontend/images/user.jpg') }}" width="80" height="80"
                                        class="profile rounded-circle" alt=" jhon doe">
                                </a>
                                <h3><a href="#" target="_blank">John Doe</a></h3>
                                <div class="star">
                                    <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                    <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                    <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                    <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                    <img src="{{ asset('frontend/images/icon/star-outline.svg') }}" alt="star">
                                    <span> <strong>(547)</strong> Reviews</span>
                                </div>
                                <p>Registered for <strong>9+ months</strong></p>
                                <p>Last online <strong>5 days ago</strong></p>
                                <p>Total Listed Ads <strong>891</strong></p>
                                <a href="{{ route('frontend.seller.shop') }}" class="btn btn-primary btn-sm mt-3"
                                    target="_blank">
                                    Seller profile
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="ad_wrap mb-3">
                        <div class="heading mb-2">
                            <h3>Contact Seller</h3>
                        </div>
                        <div class="seller_sort_info">
                            <div class="seller_profile">
                                <div class="d-block d-sm-flex d-lg-block">
                                    <div class="input-group mb-3 me-0 me-sm-2 me-lg-0">
                                        <button class="btn btn-primary w-100 text-start showNumber">123-456-xxx</button>
                                        <a href="tel:123-456-789" class="btn btn-primary w-100 text-start sellerNumber"
                                            style="display:none;">
                                            123-456-789
                                        </a>
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <div class="input-group mb-2 ms-0 ms-sm-2 ms-lg-0">
                                        <a href="#" class="btn btn-secondary w-100 text-start">Send Message</a>
                                        <span class="input-group-text"><i class="fa fa-comments"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="details">
                    <h3 class="mb-4">Description</h3>
                    <P>
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of
                        classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a
                        Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin
                        words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in
                        classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32
                        and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero,
                        written in 45 BC. This book is a treatise on the theory of ethics, very popular during the
                        Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in
                        section 1.10.32.
                    </P>
                    <p>
                        There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                        alteration in some form, by injected humour, or randomised words which don't look even slightly
                        believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                        anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the
                        Internet tend to repeat predefined chunks as necessary, making this the first true generator on
                        the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model
                        sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum
                        is therefore always free from repetition, injected humour, or non-characteristic words etc.
                    </p>
                </div>

                <div class="text-center mt-5">
                    <a href="#" target="_blank">
                        <img src="{{ asset('frontend/images/ads/ads-4.png') }}" class="img-fluid" alt="">
                    </a>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="ad_wrap">
                    <div class="text-center">
                        <a href="#" target="_blank">
                            <img src="{{ asset('frontend/images/ads/ads-3.png') }}" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="related_product mt-5">
        <div class="container">
            <div class="section_heading mb-4">
                <h3>Related items</h3>
                <div class="slider-btn">
                    <button class="slider-btn--prev slick-arrow">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    <button class="slider-btn--next slick-arrow">
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div class="related_post_slider">
                {{-- item --}}
                <div class="card product_wrapper">
                    <div class="product_img">
                        <a href="#">
                            <img src="{{ asset('frontend/images/no-img.png') }}" class="w-100" alt="image">
                        </a>
                    </div>
                    <div class="card-body product_content d-flex flex-column">
                        <h3>
                            <a href="#">
                                I want to sell my phone
                            </a>
                        </h3>
                        <div class="mb-4 mt-auto">
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                (boston
                                , United states)
                            </p>
                            <p class="time">
                                <i class="fa fa-clock"></i>
                                27 2023
                            </p>
                        </div>
                        <div class="d-flex mt-auto">
                            <div class="price">
                                <h4>$500</h4>
                            </div>
                            <div class="features">
                                <div class="form-check">
                                    <input class="form-check-input" name="wishlist" type="checkbox" id="wishlist_112"
                                        onchange="AddWishlist2(112, )">
                                    <label class="form-check-label" for="wishlist_112"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- item --}}
                <div class="card product_wrapper">
                    <div class="product_img">
                        <a href="#">
                            <img src="{{ asset('frontend/images/no-img.png') }}" class="w-100" alt="image">
                        </a>
                    </div>
                    <div class="card-body product_content d-flex flex-column">
                        <h3>
                            <a href="#">
                                I want to sell my phone
                            </a>
                        </h3>
                        <div class="mb-4 mt-auto">
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                (boston
                                , United states)
                            </p>
                            <p class="time">
                                <i class="fa fa-clock"></i>
                                27 2023
                            </p>
                        </div>
                        <div class="d-flex mt-auto">
                            <div class="price">
                                <h4>$500</h4>
                            </div>
                            <div class="features">
                                <div class="form-check">
                                    <input class="form-check-input" name="wishlist" type="checkbox" id="wishlist_112"
                                        onchange="AddWishlist2(112, )">
                                    <label class="form-check-label" for="wishlist_112"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- item --}}
                <div class="card product_wrapper">
                    <div class="product_img">
                        <a href="#">
                            <img src="{{ asset('frontend/images/no-img.png') }}" class="w-100" alt="image">
                        </a>
                    </div>
                    <div class="card-body product_content d-flex flex-column">
                        <h3>
                            <a href="#">
                                I want to sell my phone
                            </a>
                        </h3>
                        <div class="mb-4 mt-auto">
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                (boston
                                , United states)
                            </p>
                            <p class="time">
                                <i class="fa fa-clock"></i>
                                27 2023
                            </p>
                        </div>
                        <div class="d-flex mt-auto">
                            <div class="price">
                                <h4>$500</h4>
                            </div>
                            <div class="features">
                                <div class="form-check">
                                    <input class="form-check-input" name="wishlist" type="checkbox" id="wishlist_112"
                                        onchange="AddWishlist2(112, )">
                                    <label class="form-check-label" for="wishlist_112"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- item --}}
                <div class="card product_wrapper">
                    <div class="product_img">
                        <a href="#">
                            <img src="{{ asset('frontend/images/no-img.png') }}" class="w-100" alt="image">
                        </a>
                    </div>
                    <div class="card-body product_content d-flex flex-column">
                        <h3>
                            <a href="#">
                                I want to sell my phone
                            </a>
                        </h3>
                        <div class="mb-4 mt-auto">
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                (boston
                                , United states)
                            </p>
                            <p class="time">
                                <i class="fa fa-clock"></i>
                                27 2023
                            </p>
                        </div>
                        <div class="d-flex mt-auto">
                            <div class="price">
                                <h4>$500</h4>
                            </div>
                            <div class="features">
                                <div class="form-check">
                                    <input class="form-check-input" name="wishlist" type="checkbox" id="wishlist_112"
                                        onchange="AddWishlist2(112, )">
                                    <label class="form-check-label" for="wishlist_112"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- item --}}
                <div class="card product_wrapper">
                    <div class="product_img">
                        <a href="#">
                            <img src="{{ asset('frontend/images/no-img.png') }}" class="w-100" alt="image">
                        </a>
                    </div>
                    <div class="card-body product_content d-flex flex-column">
                        <h3>
                            <a href="#">
                                I want to sell my phone
                            </a>
                        </h3>
                        <div class="mb-4 mt-auto">
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                (boston
                                , United states)
                            </p>
                            <p class="time">
                                <i class="fa fa-clock"></i>
                                27 2023
                            </p>
                        </div>
                        <div class="d-flex mt-auto">
                            <div class="price">
                                <h4>$500</h4>
                            </div>
                            <div class="features">
                                <div class="form-check">
                                    <input class="form-check-input" name="wishlist" type="checkbox" id="wishlist_112"
                                        onchange="AddWishlist2(112, )">
                                    <label class="form-check-label" for="wishlist_112"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- item --}}
                <div class="card product_wrapper">
                    <div class="product_img">
                        <a href="#">
                            <img src="{{ asset('frontend/images/no-img.png') }}" class="w-100" alt="image">
                        </a>
                    </div>
                    <div class="card-body product_content d-flex flex-column">
                        <h3>
                            <a href="#">
                                I want to sell my phone
                            </a>
                        </h3>
                        <div class="mb-4 mt-auto">
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                (boston
                                , United states)
                            </p>
                            <p class="time">
                                <i class="fa fa-clock"></i>
                                27 2023
                            </p>
                        </div>
                        <div class="d-flex mt-auto">
                            <div class="price">
                                <h4>$500</h4>
                            </div>
                            <div class="features">
                                <div class="form-check">
                                    <input class="form-check-input" name="wishlist" type="checkbox" id="wishlist_112"
                                        onchange="AddWishlist2(112, )">
                                    <label class="form-check-label" for="wishlist_112"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- item --}}
                <div class="card product_wrapper">
                    <div class="product_img">
                        <a href="#">
                            <img src="{{ asset('frontend/images/no-img.png') }}" class="w-100" alt="image">
                        </a>
                    </div>
                    <div class="card-body product_content d-flex flex-column">
                        <h3>
                            <a href="#">
                                I want to sell my phone
                            </a>
                        </h3>
                        <div class="mb-4 mt-auto">
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                (boston
                                , United states)
                            </p>
                            <p class="time">
                                <i class="fa fa-clock"></i>
                                27 2023
                            </p>
                        </div>
                        <div class="d-flex mt-auto">
                            <div class="price">
                                <h4>$500</h4>
                            </div>
                            <div class="features">
                                <div class="form-check">
                                    <input class="form-check-input" name="wishlist" type="checkbox" id="wishlist_112"
                                        onchange="AddWishlist2(112, )">
                                    <label class="form-check-label" for="wishlist_112"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







</div>

@endsection



@push('script')
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend/js/lg-thumbnail.umd.js') }}"></script>
<script src="{{ asset('frontend/js/lightgallery.min.js') }}"></script>
<script>
    $(document).ready(function() {
            lightGallery(document.getElementById('lightgallery'), {
                thumbnail: true,
                download: true,
                speed: 500,
            });
        });

    // show seller number
    $(document).ready(function(){
         $('.showNumber').on('click', function(){
            $('.showNumber').hide();
            $('.sellerNumber').show();
         });
    });

    // related ads
    $(".related_post_slider").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        loop: false,
        autoplay: true,
        autoplaySpeed: 1500,
        adaptiveHeight: true,
        prevArrow: ".slider-btn--prev",
        nextArrow: ".slider-btn--next",
        responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 4,
            },
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 500,
            settings: {
                slidesToShow: 1,
            },
        },
        ],
    });


    // gallery
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 12,
            freeMode: true,
            watchSlidesProgress: true,
            breakpoints: {

                1024: {
                    slidesPerView: 6,
                },
                1: {
                    slidesPerView: 3,
                },
            },
        });

        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
</script>
@endpush
