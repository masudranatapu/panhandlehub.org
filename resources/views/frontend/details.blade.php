@extends('frontend.layouts.app', ['nav' => 'yes'])

@section('meta')
    <meta property="title" content="{{ $meta_title }}"/>
    <meta property="description" content="{{ $meta_description }}"/>
    <meta property="keywords" content="{{ $meta_keywords }}"/>
    <meta property="og:title" content="{{ $meta_title }}"/>
    <meta property="og:description" content="{{ $meta_description }}"/>
    <meta property="og:keywords" content="{{ $meta_keywords }}"/>
    <meta property="og:image" content="{{ asset($meta_image) }}"/>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.min.css') }}"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lightgallery-bundle.min.css"/>
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
                                            <img src="{{ asset($value->image) }} " alt="{{ $value->name }}"/>
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
                                        <img src="{{ asset($value->image) }}" alt="{{ $value->name }}"/>
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
                                        <img src="{{ asset($ad_details->customer->image) }}" width="80" height="80"
                                             class="profile rounded-circle" alt="{{ $ad_details->customer->username }}">
                                    </a>
                                    <h3><a href="{{ route('frontend.seller.shop', $ad_details->customer->username) }}"
                                           target="_blank">{{ $ad_details->customer->name ??
                                    $ad_details->customer->username }} </a></h3>
                                    <p>Registered for
                                        <strong>{{ $ad_details->customer->created_at->diffForHumans() }}</strong></p>
                                    <p>Last online
                                        <strong>{{ $ad_details->customer->last_seen->diffForHumans() }}</strong></p>
                                    <p>Total Listed Ads
                                        <strong>{{ $ad_details->customer->available_ads->count() }}</strong></p>
                                    <a href="{{ route('frontend.seller.shop', $ad_details->customer->username) }}"
                                       class="btn btn-primary btn-sm mt-3"
                                       target="_blank">
                                        Seller Profile
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
                                        @if(isset($ad_details->phone) || isset($ad_details->customer->phone))
                                            <div class="input-group mb-3 me-0 me-sm-2 me-lg-0">
                                                <button class="btn btn-primary w-100 text-start showNumber">Show Number
                                                </button>
                                                <a href="tel:123-456-789"
                                                   class="btn btn-primary w-100 text-start sellerNumber"
                                                   style="display:none;">
                                                    {{ $ad_details->phone ?? $ad_details->customer->phone }}
                                                </a>
                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                            </div>
                                        @endif
                                        <div class="input-group mb-2 ms-0 ms-sm-2 ms-lg-0">
                                            <a href="{{ route('user.message', $ad_details->customer->username) }}"
                                               class="btn btn-secondary w-100 text-start">Send Message</a>
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
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="mb-4">
                                    @if ($ad_details->ad_type->slug == 'job-offered')
                                        @if(isset($ad_details->employment_type))
                                            <li>Kind of Employment: <strong>{{ $ad_details->employment_type }}</strong>
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
                                        @if(isset($ad_details->job_title))
                                            <li>Job Title: <strong>{{ $ad_details->job_title }}</strong></li>
                                        @endif
                                        @if(isset($ad_details->price))
                                            <li>Salary: <strong>${{ $ad_details->price }}</strong></li>
                                        @endif
                                        @if(isset($ad_details->company_name))
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
                                        @if(isset($ad_details->education))
                                            <li>Education: <strong>{{ $ad_details->education }}</strong></li>
                                        @endif
                                        @if(isset($ad_details->direct_contact))
                                            <li>Direct Contact: <strong>{{ $ad_details->direct_contact }}</strong></li>
                                        @endif
                                        @if(isset($ad_details->is_license))
                                            <li>Is license: <strong>{{ $ad_details->is_license }}</strong></li>
                                        @endif
                                        @if(isset($ad_details->license_info))
                                            <li>licensure information: <strong>{{ $ad_details->license_info }}</strong>
                                            </li>
                                        @endif
                                    @endif
                                    @if ($ad_details->ad_type->slug == 'housing-offered')
                                        @if(isset($ad_details->sqft))
                                            <li>SQFT: <strong>{{ $ad_details->sqft }}</strong></li>
                                        @endif

                                        @if(isset($ad_details->houssing_type))
                                            <li>Houssing Type: <strong>{{ $ad_details->houssing_type }}</strong></li>
                                        @endif

                                        @if(isset($ad_details->laundry))
                                            <li>Laundry: <strong>{{ $ad_details->laundry }}</strong></li>
                                        @endif

                                        @if(isset($ad_details->parking))
                                            <li>Parking: <strong>{{ $ad_details->parking }}</strong></li>
                                        @endif

                                        @if(isset($ad_details->bedrooms))
                                            <li>Bedrooms: <strong>{{ $ad_details->bedrooms }}</strong></li>
                                        @endif

                                        @if(isset($ad_details->bathrooms))
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
                                        @if(isset($ad_details->available_on))
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
                                        @if(isset($ad_details->broker_fee))
                                            <li>Broker Fee: <strong>{{ $ad_details->broker_fee }}</strong></li>
                                        @endif
                                        @if(isset($ad_details->fee_detailed))
                                            <li>Please: <strong>{{ $ad_details->fee_detailed }}</strong></li>
                                        @endif
                                        @if(isset($ad_details->application_fee))
                                            <li>Application Fee: <strong>{{ $ad_details->application_fee }}</strong>
                                            </li>
                                        @endif
                                        @if(isset($ad_details->fee_detailed))
                                            <li>detailed fee description please:
                                                <strong>{{ $ad_details->fee_detailed }}</strong>
                                            </li>
                                        @endif
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
                                        @if(isset($ad_details->venue))
                                            <li>Venue: <strong>{{ $ad_details->venue }}</strong></li>
                                        @endif
                                        @if(isset($ad_details->price))
                                            <li>Price: <strong>{{ $ad_details->price }}</strong></li>
                                        @endif
                                        @if(isset($ad_details->event_start_date))
                                            <li>Start Date:
                                                <strong>{{ date('d M, Y', strtotime($ad_details->event_start_date)) }}</strong>
                                            </li>
                                        @endif
                                        @if(isset($ad_details->event_end_date))
                                            <li>End Date:
                                                <strong>{{ date('d M, Y', strtotime($ad_details->event_end_date)) }}</strong>
                                            </li>
                                        @endif
                                        @if(isset($ad_details->event_duration))
                                            <li>Event Duration: <strong>{{ $ad_details->event_duration }}</strong></li>
                                        @endif
                                    @endif
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <ul class="mb-4">
                                    @if(isset($ad_details->customer->email))
                                        <li>Email: <strong>{{ $ad_details->customer->email }}</strong></li>
                                    @endif
                                    @if(isset($ad_details->email_privacy))
                                        <li>Email Privacy: <strong>{{ $ad_details->email_privacy }}</strong></li>
                                    @endif
                                    <li>Phone Call: <strong>{{ $ad_details->phone_call == 1 ? 'Yes' : 'No' }}</strong>
                                    </li>
                                    <li>Phone Text: <strong>{{ $ad_details->phone_text == 1 ? 'Yes' : 'No' }}</strong>
                                    </li>
                                    @if(isset($ad_details->phone))
                                        <li>Phone Number: <strong>{{ $ad_details->phone }}</strong></li>
                                    @endif
                                    @if(isset($ad_details->phone_2))
                                        <li>Local number: <strong>{{ $ad_details->phone_2 }}</strong></li>
                                    @endif
                                    @if(isset($ad_details->contact_name))
                                        <li>Contact Name: <strong>{{ $ad_details->contact_name }}</strong></li>
                                    @endif
                                    @if(isset($ad_details->city))
                                        <li>City: <strong>{{ $ad_details->city }}</strong></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <h3 class="mb-4">Description</h3>
                        {!! $ad_details->description !!}
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
                    <h3>Related Items</h3>
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
                    @if(isset($relative_ads) && $relative_ads->count() > 0)
                        @foreach($relative_ads as $item)

                            <div class="card product_wrapper">
                                <div class="product_img">
                                    <a href="{{ route('frontend.details', $item->slug) }}">
                                        <img src="{{ asset(isset($item->thumbnail) && File::exists($item->thumbnail) ? $item->thumbnail : 'frontend/images/no-img.png') }}" class="w-100" alt="image">
                                    </a>
                                </div>
                                <div class="card-body product_content d-flex flex-column">
                                    <h3>
                                        <a href="{{ route('frontend.details', $item->slug) }}">
                                            {{ Str::limit($item->title, '32', '...') }}
                                        </a>
                                    </h3>
                                    <div class="mb-4 mt-auto">
                                        <p class="location">
                                            <i class="fas fa-map-marker-alt"></i>
                                                {{ $item->city }}
                                                {{ isset($item->countries->name) ? ', ' .
                                                ucfirst(strtolower($item->countries->name)) : ''}}
                                        </p>
                                        <p class="time">
                                            <i class="fa fa-clock"></i>
                                            {{ date('d Y', strtotime($item->created_at)) }}
                                        </p>
                                    </div>
                                    <div class="d-flex mt-auto">
                                        <div class="price">
                                            @if($item->price)<h4>${{ $item->price }}</h4>@endif
                                        </div>
                                        <div class="features">
                                            <div class="form-check">
                                                <input class="form-check-input" name="wishlist" type="checkbox"
                                                    id="wishlist_{{ $item->id }}" {{ isWishlisted($item->id) ? 'checked' : ''
                                                }}
                                                onchange="AddWishlist2({{ $item->id }}, {{ Auth::user()->id ?? '' }})">
                                                <label class="form-check-label" for="wishlist_{{ $item->id }}"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
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
        $(document).ready(function () {
            lightGallery(document.getElementById('lightgallery'), {
                thumbnail: true,
                download: true,
                speed: 500,
            });
        });

        // show seller number
        $(document).ready(function () {
            $('.showNumber').on('click', function () {
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
