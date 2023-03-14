@extends('frontend.layouts.app', ['nav' => 'yes'])

@push('style')
    <link rel="stylesheet" href="{{ asset('frontend/css/rateyo.min.css') }}">
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
     {{-- seller shop  --}}
    <section class="seller_shop_section">
        <div class="container">
            <div class="seller_dashboard mb-4">
                <div class="d-flex position-relative align-items-center">
                    <img src="{{ asset('frontend/images/user2.jpg') }}" width="50" class="profile me-3 rounded-circle"
                         alt="image">
                    <div class="info_seller">
                        <h3>{{ $seller->name ?? $seller->username }}</h3>
                        <div class="star">
                            @for($i=0; $i < 5; $i++)
                                @if($i < $reviews->avg('stars'))
                                    <img src="{{ asset('frontend/images/icon/star.svg') }}"
                                         alt="star">
                                @else
                                    <img src="{{ asset('frontend/images/icon/star-outline.svg') }}"
                                         alt="star">
                                @endif

                            @endfor
                            <span> <strong>({{ $reviews->count() }})</strong> Reviews</span>
                        </div>
                        <p>
                            Joined <strong>{{ date('d F Y', strtotime($seller->created_at)) }}</strong> |
                            Total Listed Ads <strong>({{ $seller->ads->count() }})</strong>
                        </p>
                    </div>
                </div>
                <div class="chat_seller_btn">
                    <a href="{{ route('user.message', $seller->username) }}" class="btn btn-primary">
                        <i class="fa fa-comments"></i>
                        Chat with seller
                    </a>
                </div>
            </div>

            <div class="seller_dashboard_shop">
                <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist" style="justify-content: center">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="shop_id" data-bs-toggle="pill" data-bs-target="#shop_tab"
                                type="button" role="tab" aria-controls="shop_tab" aria-selected="true">Shop
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seller_review_id" data-bs-toggle="pill"
                                data-bs-target="#seller_review"
                                type="button" role="tab" aria-controls="seller_review" aria-selected="false">Seller
                            Review
                        </button>
                    </li>
                    @if(Auth::check() && $seller->id != Auth::user()->id || !Auth::check())
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="write_review_id" data-bs-toggle="pill"
                                    data-bs-target="#write_review_tab" type="button" role="tab"
                                    aria-controls="write_review_tab" aria-selected="false">Write Review
                            </button>
                        </li>
                    @endif
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <!-- shop -->
                    <div class="tab-pane fade show active" id="shop_tab" role="tabpanel" aria-labelledby="shop_id"
                         tabindex="0">
                        <div class="shop_wrapper">
                            <div class="shop_header mb-4 text-center text-sm-start">
                                <div class="row g-3 align-items-center">
                                    <div class="col-sm-6">
                                        <div class="listing_ad">
                                            <h3>{{ $ads_count }} items Available Listings</h3>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="filter_form float-sm-end">
                                            {{-- <form action="{{ route('seller.profile', $seller->username) }}" method="get" --}}
                                                  id="sortForm">
                                                <div class="input-group">
                                                    <span class="input-group-text">Sort By:</span>
                                                    <select name="sort" id="sort" class="form-control"
                                                            onchange="document.getElementById('sortForm').submit()">
                                                        <option
                                                            value="recent" {{ request()->sort == 'recent' ? 'selected' : '' }} >
                                                            Recent ads
                                                        </option>
                                                        <option
                                                            value="high_to_low" {{ request()->sort == 'high_to_low' ? 'selected' : '' }} >
                                                            Price high to low
                                                        </option>
                                                        <option
                                                            value="low_to_high" {{ request()->sort == 'low_to_high' ? 'selected' : '' }} >
                                                            Price low to high
                                                        </option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                                <!-- ads item -->
                                @foreach($ads as $item)
                                    @include('frontend.single_ad', $item)
                                @endforeach
                            </div>
                            <div class="shop_pagination mt-4">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        {!! $ads->links() !!}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <!-- seller review -->
                    <div class="tab-pane fade" id="seller_review" role="tabpanel" aria-labelledby="seller_review_id"
                         tabindex="0">
                        <div class="feedback_wrapper">
                            <div class="row g-2">
                                @foreach($reviews as $review)
                                    <div class="col-lg-6">
                                        <!-- feedback list -->
                                        <div class="feedback_list">
                                            <div class="d-md-flex position-relative">
                                                <div class="feedback_img text-center mb-3">
                                                    <a href="{{ route('seller.profile', $review->user->username) }}">
                                                        <img src="{{ asset($review->user->image) }}" width="80"
                                                             class="rounded-circle me-3" alt="user">
                                                    </a>
                                                </div>
                                                <div class="feedback_content">
                                                    <h3>
                                                        <a href="{{ route('seller.profile', $review->user->username) }}">{{ $review->user->name ?? $review->user->username }}</a>
                                                    </h3>

                                                    <h6>{{ date('F d, Y', strtotime($review->created_at)) }}</h6>
                                                    <div class="star">
                                                        @for($i=0; $i < 5; $i++)
                                                            @if($i < $review->stars)
                                                                <img src="{{ asset('frontend/images/icon/star.svg') }}"
                                                                     alt="star">
                                                            @else
                                                                <img
                                                                    src="{{ asset('frontend/images/icon/star-outline.svg') }}"
                                                                    alt="star">
                                                            @endif

                                                        @endfor
                                                    </div>
                                                    <p>
                                                        {{ $review->comment }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @if(Auth::check() && $seller->id != Auth::user()->id || !Auth::check())
                        <!-- write review -->
                        <div class="tab-pane fade" id="write_review_tab" role="tabpanel"
                             aria-labelledby="write_review_id"
                             tabindex="0">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8 col-xl-6">
                                    <div class="review_form">
                                        @if(Auth::check())
                                            <form action="{{ route('seller.review.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="seller_id" id="seller_id"
                                                       value="{{ $seller->id }}">
                                                <input type="hidden" name="star" id="rating" value="3">
                                                <div class="mb-3">
                                                    <div id="rateYo"></div>
                                                </div>
                                                <div class="mb-3">
                                            <textarea name="comment" id="comment" cols="30" rows="7"
                                                      class="form-control"
                                                      placeholder="Write your review" required></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary">Send Review</button>
                                                </div>
                                            </form>
                                        @else
                                            <h4 class="text-center">You must sign in to write a review</h4>
                                            <div class="mb-3 mt-2 text-center">
                                                <a href="{{ route('signin') }}" class="btn btn-primary">Please Sign
                                                    In</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </section>
@endsection


@push('script')
    <script src="{{ asset('frontend/js/rateyo.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#rateYo").rateYo({
                starWidth: '30px',
                fullStar: true,
                rating: 3,
                mormalFill: 'yellow',
                ratedFill: 'orange',
                onSet: function (rating, rateYoInstance) {
                    $('#rating').val(rating);
                }
            });
        });
    </script>
@endpush
