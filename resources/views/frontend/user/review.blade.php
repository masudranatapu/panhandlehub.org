@extends('frontend.layouts.app', ['nav' => 'yes'])

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
@endpush
@section('breadcrumb')
<div class="breadcrumb_section">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">User Profile</li>
                >
                <li class="breadcrumb-item active">Review</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="main_template mt-5">
    <div class="container">
        <div class="user_dashboard mb-4">
            @include('frontend.user.dashboard_nav')
        </div>
        <div class="user_dashboard_wrap">
            <div class="row g-4">
                <div class="col-lg-8 order-lg-2">
                    <div class="user_review_wrap">
                        <div class="row g-3">
                            {{-- review --}}
                            <div class="col-md-6">
                                <div class="review_list">
                                    <div class="d-flex position-relative align-items-center">
                                        <div class="user_avatar me-2">
                                            <img src="{{ asset('frontend/images/user.jpg') }}" alt="">
                                        </div>
                                        <div class="review_star mb-4">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star-outline.svg') }}" width="15"
                                                alt="">
                                            <div class="name">
                                                <h3>John Doe</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti
                                            consectetur veniam, pariatur dolor quos est officiis exercitationem labore
                                            maxime illum optio omnis? Tempora, nobis? Aspernatur in excepturi temporibus
                                            possimus officia?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- review --}}
                            <div class="col-md-6">
                                <div class="review_list">
                                    <div class="d-flex position-relative align-items-center">
                                        <div class="user_avatar me-2">
                                            <img src="{{ asset('frontend/images/user.jpg') }}" alt="">
                                        </div>
                                        <div class="review_star mb-4">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star-outline.svg') }}" width="15"
                                                alt="">
                                            <div class="name">
                                                <h3>John Doe</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti
                                            consectetur veniam, pariatur dolor quos est officiis exercitationem labore
                                            maxime illum optio omnis? Tempora, nobis? Aspernatur in excepturi temporibus
                                            possimus officia?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- review --}}
                            <div class="col-md-6">
                                <div class="review_list">
                                    <div class="d-flex position-relative align-items-center">
                                        <div class="user_avatar me-2">
                                            <img src="{{ asset('frontend/images/user.jpg') }}" alt="">
                                        </div>
                                        <div class="review_star mb-4">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star-outline.svg') }}" width="15"
                                                alt="">
                                            <div class="name">
                                                <h3>John Doe</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti
                                            consectetur veniam, pariatur dolor quos est officiis exercitationem labore
                                            maxime illum optio omnis? Tempora, nobis? Aspernatur in excepturi temporibus
                                            possimus officia?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- review --}}
                            <div class="col-md-6">
                                <div class="review_list">
                                    <div class="d-flex position-relative align-items-center">
                                        <div class="user_avatar me-2">
                                            <img src="{{ asset('frontend/images/user.jpg') }}" alt="">
                                        </div>
                                        <div class="review_star mb-4">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star-outline.svg') }}" width="15"
                                                alt="">
                                            <div class="name">
                                                <h3>John Doe</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti
                                            consectetur veniam, pariatur dolor quos est officiis exercitationem labore
                                            maxime illum optio omnis? Tempora, nobis? Aspernatur in excepturi temporibus
                                            possimus officia?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- review --}}
                            <div class="col-md-6">
                                <div class="review_list">
                                    <div class="d-flex position-relative align-items-center">
                                        <div class="user_avatar me-2">
                                            <img src="{{ asset('frontend/images/user.jpg') }}" alt="">
                                        </div>
                                        <div class="review_star mb-4">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star-outline.svg') }}" width="15"
                                                alt="">
                                            <div class="name">
                                                <h3>John Doe</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti
                                            consectetur veniam, pariatur dolor quos est officiis exercitationem labore
                                            maxime illum optio omnis? Tempora, nobis? Aspernatur in excepturi temporibus
                                            possimus officia?
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- review --}}
                            <div class="col-md-6">
                                <div class="review_list">
                                    <div class="d-flex position-relative align-items-center">
                                        <div class="user_avatar me-2">
                                            <img src="{{ asset('frontend/images/user.jpg') }}" alt="">
                                        </div>
                                        <div class="review_star mb-4">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star.svg') }}" alt="star">
                                            <img src="{{ asset('frontend/images/icon/star-outline.svg') }}" width="15"
                                                alt="">
                                            <div class="name">
                                                <h3>John Doe</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti
                                            consectetur veniam, pariatur dolor quos est officiis exercitationem labore
                                            maxime illum optio omnis? Tempora, nobis? Aspernatur in excepturi temporibus
                                            possimus officia?
                                        </p>
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
                                    <li class="page-item active" aria-current="page"><span class="page-link">1</span>
                                    </li>
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
                <div class="col-lg-4 order-lg-1">
                    <div class="review_form">
                        <form action="#" method="post">
                            <div class="title mb-4">
                                <h4>Write your review</h4>
                            </div>
                            <div class="mb-4">
                                <div id="rateYo"></div>
                            </div>
                            <div class="mb-4">
                                <label for="message" class="form-label">Write your review</label>
                                <textarea name="message" id="message" cols="30" rows="5" class="form-control" required
                                    placeholder="Write your review" style="height:120px;"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>
    $(document).ready(function () {
        $("#rateYo").rateYo({
            starWidth: '30px',
            fullStar: true,
            mormalFill: 'yellow',
            ratedFill: 'orange',
            onSet: function (rating, rateYoInstance) {
                $('#rating').val(rating);
            }
        });
    });
</script>
@endpush
