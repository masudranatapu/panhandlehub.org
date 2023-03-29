@extends('frontend.layouts.app', ['nav' => 'yes'])
@section('meta')
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('image_uploader/dist/image-uploader.min.css') }}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<style>
    .select2-selection--single {
        height: 35px !important;
    }

    .select2-selection__arrow {
        height: 35px !important;
    }
</style>
@endpush
@section('title')
{{ __('Post') }}
@endsection
@section('breadcrumb')
<div class="breadcrumb_section">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{ __($ad_type->name) }} </li>
                >
                <li class="breadcrumb-item active" aria-current="page">{{ __($category->name) }}</li>
                >
                <li class="breadcrumb-item active" aria-current="page">{{ $subCategory->name }}</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="main_template mt-5 mb-5">
    <div class="container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="ad_post_form">
            <form action="{{ route('frontend.post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ad_type" value="{{ $ad_type->slug }}">
                <input type="hidden" name="ad_type_id" value="{{ $ad_type->id }}">
                <input type="hidden" name="category_id" value="{{ $category->id }}">
                <input type="hidden" name="subcategory_id" value="{{ $subCategory->id }}">
                <h4 class="text-center mb-4 mt-4 bg-light">{{ $subCategory->name }}</h4>
                @if ($ad_type->slug == 'service-offered')
                <h5 class="mb-4"><strong>Please be certain your ad is legal, local, and conforms with our Terms of
                        Use</strong><a class="" href="#">[?]</a></h5>
                <h6 class="mb-5">No URLs, links, or web addresses in your text or image please.</h6>
                @endif
                <div class="row">
                    <div class="
                            @if (
                                $ad_type->slug == 'service-offered' ||
                                    $ad_type->slug == 'housing-wanted' ||
                                    $ad_type->slug == 'housing-offered' ||
                                    $ad_type->slug == 'engagement-offered' ||
                                    $ad_type->slug == 'community' ||
                                    $ad_type->slug == 'job-offered' ||
                                    $ad_type->slug == 'job-wanted') col-md-5
                            @else
                               col-md-4 @endif

                        ">
                        <div class="mb-3">
                            <label for="title" class="form-label ">posting title <small
                                    class="text-danger">*</small></label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control"
                                required>
                        </div>
                    </div>
                    @if (
                    $ad_type->slug == 'for-sale-by-owner' ||
                    $ad_type->slug == 'for-sale-by-dealer' ||
                    $ad_type->slug == 'wanted-by-owner' ||
                    $ad_type->slug == 'wanted-by-dealer' ||
                    $ad_type->slug == 'event-class')
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="price" class="form-label ">Price <small class="text-dark">{{
                                    env('APP_CURRENCY_SYMBOL') }}</small> </label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}"
                                class="form-control">
                        </div>
                    </div>
                    @endif
                    <div class="
                                @if ($ad_type->slug == 'service-offered' ||
                                        $ad_type->slug == 'housing-wanted' ||
                                        $ad_type->slug == 'housing-offered' ||
                                        $ad_type->slug == 'engagement-offered' ||
                                        $ad_type->slug == 'job-wanted' ||
                                        $ad_type->slug == 'community' ||
                                        $ad_type->slug == 'job-offered') col-md-5
                                @else
                                    col-md-4 @endif
                            ">
                            <div class="mb-3">
                                <label for="city" class="form-label">city ​​or neighborhood</label>
                                <select name="city" id="city" class="form-control">
                                    @foreach ($country->cities as $value)
                                    <option value="{{ $value->slug }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="postcode" class="form-label">Postal code</label>
                            <input type="number" name="postcode" id="postcode" value="{{ old('postcode') }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <span class="text-dark">Only one description per posting. <small
                                    class="text-danger">*</small></span><br />
                            <label for="description" class="form-label ">description</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                style="height: 150px;" required>{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="input-field mb-3">
                        <label class="active">{{ __('upload_photos') }} </label>
                        <div id="multiple_image_upload" class="input-images-2" style="padding-top: .5rem;"></div>
                    </div>
                </div>

                {{-- For Job --}}
                @if ($ad_type->slug == 'job-offered')
                @include('frontend.post.pages.job-offered')
                @endif
                <!-- gig/engagement offered -->

                @if ($ad_type->slug == 'engagement-offered')
                @include('frontend.post.pages.engagement-offered')
                @endif
                <!-- resume / job wanted -->
                @if ($ad_type->slug == 'job-wanted')
                @include('frontend.post.pages.job-wanted')
                @endif

                <!-- housing offered -->
                @if ($ad_type->slug == 'housing-offered')
                @include('frontend.post.pages.housing-offered')
                @endif

                <!-- housing wanted -->
                @if ($ad_type->slug == 'housing-wanted')
                @include('frontend.post.pages.housing-wanted')
                @endif
                <!-- for-sale-by-owner -->
                @if ($ad_type->slug == 'for-sale-by-owner')
                @include('frontend.post.pages.for-sale-by-owner')
                @endif

                {{-- for-sale-by-dealer --}}

                @if ($ad_type->slug == 'for-sale-by-dealer')
                @include('frontend.post.pages.for-sale-by-dealer')
                @endif
                @if ($ad_type->slug == 'wanted-by-owner')
                @include('frontend.post.pages.wanted-by-owner')
                @endif
                @if ($ad_type->slug == 'wanted-by-dealer')
                @include('frontend.post.pages.wanted-by-dealer')
                @endif
                @if ($ad_type->slug == 'service-offered')
                @include('frontend.post.pages.service-offered')
                @endif
                @if ($ad_type->slug == 'community')
                @include('frontend.post.pages.community')
                @endif
                @if ($ad_type->slug == 'event-class')
                @include('frontend.post.pages.event-class')
                @endif

                <div class="col-12 mb-4">
                    <!-- Contact Form -->
                    <div class="form_wrapper">
                        <div class="title mb-3">
                            <h6>Contact Info</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                                    <input type="text" name="email" id="email" value="{{ Auth::user()->email ?? old('email') }}"
                                        class="form-control" placeholder="Your email address" required>
                                </div>
                                <div class="mb-3">
                                    <span class="text-dark" style="font-weight:600;">email privacy
                                        options</span>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="email_privacy" id="privacy_1"
                                            value="panhandlehub mail relay">
                                        <label class="form-check-label" for="privacy_1">
                                            panhandlehub mail relay (recommended)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="email_privacy" id="privacy_2"
                                            value="show my real email address">
                                        <label class="form-check-label" for="privacy_2">
                                            show my real email address
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="email_privacy" id="privacy_3"
                                            value="no replies to this email">
                                        <label class="form-check-label" for="privacy_3">
                                            no replies to this email
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 inline_checkbox disabled_checked">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="show_phone" value="1" id="show_phone">
                                    <label class="form-check-label" for="show_phone">
                                        show my phone number
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="phone_call" id="calls_ok" disabled value="1">
                                    <label class="form-check-label" for="calls_ok">
                                        phone calls OK
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="phone_text" id="textorsms" disabled value="1">
                                    <label class="form-check-label" for="textorsms">
                                        text/sms OK
                                    </label>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-lg-6">
                                        <div class="mb-1">
                                            <label for="phone" class="form-label">Phone number</label>
                                            <input type="number" name="phone" {{ old('phone') }} id="phone" class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-1">
                                            <label for="phone_2" class="form-label">Local number </label>
                                            <input type="number" name="phone_2" value="{{ old('phone_2') }}" id="phone_2"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-1">
                                            <label for="contact_name" class="form-label">contact name</label>
                                            <input type="text" name="contact_name" value="{{ old('contact_name') }}" id="contact_name"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="term_condition" name="other_contact" checked value="1" required>
                        <label class="form-check-label" for="term_condition" style="font-size: 14px;">
                            ok for others to contact you about other services, products or commercial interests
                        </label>
                    </div>
                </div> --}}

                <div class="mt-5 text-center">
                    <button type="submit" class="btn btn-light">Ad Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('image_uploader/dist/image-uploader.min.js') }}"></script>
<script>
    $('.input-images-2').imageUploader({
            maxSize: 2 * 1024 * 1024,
            maxFiles: 10,
            multiple: true,
        });
</script>

  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
<script>
    function show_phone(id) {
            if ($(id).is(':checked')) {
                $('.disabled_checked input').not(id).removeAttr('disabled');
            } else {
                $('.disabled_checked input').not(id).attr('disabled', true);
            }
        }
        show_phone('#show_phone');

        $('#show_phone').change(function() {
            show_phone(this);
        });

        $('#licensed').change(function() {
            if ($(this).is(':checked')) {
                $('#license_info').removeAttr('disabled');
            }
        });
        $('#unlicensed').change(function() {
            if ($(this).is(':checked')) {
                $('#license_info').attr('disabled', true);
            }
        });
        $('#broker_1').change(function() {
            if ($(this).is(':checked')) {
                console.log(1);
                $('#broker_fee_detailed').removeAttr('disabled');
            } else {
                $('#broker_fee_detailed').attr('disabled', true);

            }
        });
        $('#application_1').change(function() {
            if ($(this).is(':checked')) {
                $('#application_fee_detailed').removeAttr('disabled');
            } else {
                $('#application_fee_detailed').attr('disabled', true);

            }
        });
</script>
@endpush
