@extends('frontend.layouts.app', ['nav' => 'yes'])

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.min.css') }}"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lightgallery-bundle.min.css"/>
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
                                        <img src="{{ asset($seller->image) }}" width="80" height="80"
                                             class="profile rounded-circle" alt="{{ $seller->username }}">
                                    </a>
                                    <h3><a href="javascript:void(0);">{{ $seller->name ?? $seller->username }}</a></h3>
                                    {{--                                <div class="star">--}}
                                    {{--                                    <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">--}}
                                    {{--                                    <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">--}}
                                    {{--                                    <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">--}}
                                    {{--                                    <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">--}}
                                    {{--                                    <img src="{{ asset('frontend/images/icon/star-outline.svg') }}" alt="star">--}}
                                    {{--                                    <span> <strong>(547)</strong> Reviews</span>--}}
                                    {{--                                </div>--}}
                                    <p>Registered for <strong>{{ $seller->created_at->diffForHumans() }}</strong></p>
                                    <p>Last online <strong>{{ $seller->last_seen->diffForHumans() }}</strong></p>
                                    <p>Total Listed Ads <strong>{{ $seller->available_ads->count() }}</strong></p>
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

                                        @if(isset($seller->phone))
                                            <div class="input-group mb-3 me-0 me-sm-2 me-lg-0">
                                                <button class="btn btn-primary w-100 text-start showNumber">Show Number
                                                </button>
                                                <a href="tel:123-456-789"
                                                   class="btn btn-primary w-100 text-start sellerNumber"
                                                   style="display:none;">
                                                    {{ $seller->phone }}
                                                </a>
                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                            </div>
                                        @endif
                                        <div class="input-group mb-2 ms-0 ms-sm-2 ms-lg-0">
                                            <a href="{{ route('user.message', $seller->username) }}"
                                               class="btn btn-secondary w-100 text-start">Send Message</a>
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
                            @foreach($ads as $row)
                                <div class="col mb-3">
                                    @include('frontend.single_ad', $row)
                                </div>
                            @endforeach
                        </div>

                        {{-- pagination --}}
                        <div class="shop_pagination mt-4 d-flex justify-content-center">
                            <nav>
                                <ul class="pagination">
                                    {{ $ads->links() }}
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
        $(document).ready(function () {
            $('.showNumber').on('click', function () {
                $('.showNumber').hide();
                $('.sellerNumber').show();
            });
        });
    </script>
@endpush
