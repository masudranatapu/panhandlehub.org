@extends('frontend.layouts.app', ['nav' => 'yes'])

@push('style')
<link rel="stylesheet" href="{{ asset('frontend/css/slick.min.css') }}" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lightgallery-bundle.min.css" />
@endpush
@section('title')
{{ __('Seller Shop') }}
@endsection
@section('breadcrumb')
<div class="breadcrumb_section">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item pe-2"><a href="{{ route('frontend.index') }}">Home</a></li>
                >
                <li class="breadcrumb-item active">Seller Shop</li>
            </ol>
        </nav>
    </div>
</div>
@endsection



@section('content')
<div class="main_template mt-5">
    <div class="container">
        <div class="row g-4">
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

                    <div class="text-center">
                        <a href="#" target="_blank">
                            <img src="{{ asset('frontend/images/ads/ads-3.png') }}" class="img-fluid" alt="">
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-lg-8">
                <div class="seller_shop">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
                        {{-- item --}}
                        <div class="col mb-3">
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
                                            boston
                                            , United states
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
                                                <input class="form-check-input" name="wishlist" type="checkbox"
                                                    id="wishlist_112" onchange="AddWishlist2(112, )">
                                                <label class="form-check-label" for="wishlist_112"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- item --}}
                        <div class="col mb-3">
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
                                            boston
                                            , United states
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
                                                <input class="form-check-input" name="wishlist" type="checkbox"
                                                    id="wishlist_112" onchange="AddWishlist2(112, )">
                                                <label class="form-check-label" for="wishlist_112"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- item --}}
                        <div class="col mb-3">
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
                                            boston
                                            , United states
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
                                                <input class="form-check-input" name="wishlist" type="checkbox"
                                                    id="wishlist_112" onchange="AddWishlist2(112, )">
                                                <label class="form-check-label" for="wishlist_112"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- item --}}
                        <div class="col mb-3">
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
                                            boston
                                            , United states
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
                                                <input class="form-check-input" name="wishlist" type="checkbox"
                                                    id="wishlist_112" onchange="AddWishlist2(112, )">
                                                <label class="form-check-label" for="wishlist_112"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- item --}}
                        <div class="col mb-3">
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
                                            boston
                                            , United states
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
                                                <input class="form-check-input" name="wishlist" type="checkbox"
                                                    id="wishlist_112" onchange="AddWishlist2(112, )">
                                                <label class="form-check-label" for="wishlist_112"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- item --}}
                        <div class="col mb-3">
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
                                            boston
                                            , United states
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
                                                <input class="form-check-input" name="wishlist" type="checkbox"
                                                    id="wishlist_112" onchange="AddWishlist2(112, )">
                                                <label class="form-check-label" for="wishlist_112"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- item --}}
                        <div class="col mb-3">
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
                                            boston
                                            , United states
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
                                                <input class="form-check-input" name="wishlist" type="checkbox"
                                                    id="wishlist_112" onchange="AddWishlist2(112, )">
                                                <label class="form-check-label" for="wishlist_112"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- item --}}
                        <div class="col mb-3">
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
                                            boston
                                            , United states
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
                                                <input class="form-check-input" name="wishlist" type="checkbox"
                                                    id="wishlist_112" onchange="AddWishlist2(112, )">
                                                <label class="form-check-label" for="wishlist_112"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- item --}}
                        <div class="col mb-3">
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
                                            boston
                                            , United states
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
                                                <input class="form-check-input" name="wishlist" type="checkbox"
                                                    id="wishlist_112" onchange="AddWishlist2(112, )">
                                                <label class="form-check-label" for="wishlist_112"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- pagination --}}
                    <div class="shop_pagination mt-4 d-flex justify-content-center">
                        <nav>
                            <ul class="pagination">
                                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                    <span class="page-link" aria-hidden="true">‹</span>
                                </li>
                                <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                <li class="page-item"><a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" rel="next" aria-label="Next »">›</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>



        {{-- ads --}}
        <div class="text-center mt-5">
            <a href="#" target="_blank">
                <img src="{{ asset('frontend/images/ads/ads-4.png') }}" class="img-fluid" alt="">
            </a>
        </div>

    </div>
</div>

@endsection


@push('script')
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend/js/lg-thumbnail.umd.js') }}"></script>
<script src="{{ asset('frontend/js/lightgallery.min.js') }}"></script>
<script>
    // show seller number
    $(document).ready(function(){
         $('.showNumber').on('click', function(){
            $('.showNumber').hide();
            $('.sellerNumber').show();
         });
    });
</script>
@endpush
