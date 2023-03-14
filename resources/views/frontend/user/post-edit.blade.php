@extends('frontend.layouts.app', ['nav' => 'yes'])
@section('meta')
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('image_uploader/dist/image-uploader.min.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
<style>
    .img-style {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        width: 160px;
        height: 120px
    }

    .img-style :hover {
        box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
    }

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
                <li class="breadcrumb-item active">{{ config('app.name') }}</li>
                >
                <li class="breadcrumb-item active">{{ $ad->ad_type->slug }}</li>
                >
                <li class="breadcrumb-item active">{{ $ad->category->slug }}</li>
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
            <form action="{{ route('user.post.update', $ad->slug) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ad_type" value="{{ $ad->ad_type->slug }}">
                <input type="hidden" name="ad_type_id" value="{{ $ad->ad_type->id }}">
                <input type="hidden" name="category_id" value="{{ $ad->category->id }}">
                <input type="hidden" name="subcategory_id" value="{{ $ad->subCategory->id }}">
                <h4 class="text-center mb-4 mt-4 bg-light">{{ $ad->subCategory->name }}</h4>
                @if ($ad->ad_type->slug == 'service-offered')
                <h5 class="mb-4"><strong>Please be certain your ad is legal, local, and conforms with our Terms of
                        Use</strong><a class="text-success" href="#">[?]</a></h5>
                <h6 class="mb-5">No URLs, links, or web addresses in your text or image please.</h6>
                @endif
                <div class="row">
                    <div class="
                            @if (
                                $ad->ad_type->slug == 'service-offered' ||
                                    $ad->ad_type->slug == 'housing-wanted' ||
                                    $ad->ad_type->slug == 'housing-offered' ||
                                    $ad->ad_type->slug == 'engagement-offered' ||
                                    $ad->ad_type->slug == 'community' ||
                                    $ad->ad_type->slug == 'job-offered' ||
                                    $ad->ad_type->slug == 'job-wanted') col-md-5
                            @else
                               col-md-4 @endif

                        ">
                        <div class="mb-3">
                            <label for="title" class="form-label text-success">posting title <small
                                    class="text-danger">*</small></label>
                            <input type="text" name="title" id="title" value="{{ $ad->title ?? old('title') }}"
                                class="form-control" required>
                        </div>
                    </div>
                    @if (
                    $ad->ad_type->slug == 'for-sale-by-owner' ||
                    $ad->ad_type->slug == 'for-sale-by-dealer' ||
                    $ad->ad_type->slug == 'wanted-by-owner' ||
                    $ad->ad_type->slug == 'wanted-by-dealer' ||
                    $ad->ad_type->slug == 'event-class')
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="price" class="form-label text-success">Price <small class="text-dark">{{
                                    env('APP_CURRENCY_SYMBOL') }}</small> </label>
                            <input type="number" name="price" id="price" value="{{ $ad->price ?? old('price') }}"
                                class="form-control" required>
                        </div>
                    </div>
                    @endif
                    <div class="
                                @if (
                                    $ad->ad_type->slug == 'service-offered' ||
                                        $ad->ad_type->slug == 'housing-wanted' ||
                                        $ad->ad_type->slug == 'housing-offered' ||
                                        $ad->ad_type->slug == 'engagement-offered' ||
                                        $ad->ad_type->slug == 'job-wanted' ||
                                        $ad->ad_type->slug == 'community' ||
                                        $ad->ad_type->slug == 'job-offered') col-md-5
                                @else
                                    col-md-4 @endif
                            ">
                        <div class="mb-3">
                            <label for="city" class="form-label">city ​​or neighborhood</label>
                            <select name="city" id="city" class="form-control select2">
                                @foreach($country->cities as $value)
                                <option value="{{ $value->slug }}" {{ $ad->city == $value->slug? "selected" : "" }}>{{
                                    $value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="postcode" class="form-label">Postal code </label>
                            <input type="number" name="postcode" id="postcode"
                                value="{{ $ad->postcode ?? old('postcode') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <span class="text-dark">Only one description per posting <small
                                    class="text-danger">*</small></span><br />
                            <label for="description" class="form-label text-success">description</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                style="height: 150px;" required>{{ $ad->description ?? old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="
                                    @if($ad->thumbnail)
                                        col-md-10
                                    @else
                                    col-md-12
                                    @endif
                                ">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload Thumb</label>
                                    <input class="form-control" type="file" name="thumbnail" id="formFile">
                                </div>
                            </div>
                            @if($ad->thumbnail)
                            <div class="col-md-2">
                                <div class="">
                                    <span class="text-dark">Thumbnail</span><br />
                                    <img class="img-style" src="{{ asset($ad->thumbnail) }}" alt="Paris">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="input-field mb-3">
                        <label class="active">{{ __('upload_photos') }}</label>
                        <div id="multiple_image_upload" class="input-images-2" style="padding-top: .5rem;"></div>

                    </div>
                </div>

                {{-- For Job --}}
                @if ($ad->ad_type->slug == 'job-offered')
                @include('frontend.post.pages_edit.job-offered', $ad)
                @endif
                <!-- gig/engagement offered -->

                @if ($ad->ad_type->slug == 'engagement-offered')
                @include('frontend.post.pages_edit.engagement-offered', $ad)
                @endif
                <!-- resume / job wanted -->
                @if ($ad->ad_type->slug == 'job-wanted')
                @include('frontend.post.pages_edit.job-wanted', $ad)
                @endif

                <!-- housing offered -->
                @if ($ad->ad_type->slug == 'housing-offered')
                @include('frontend.post.pages_edit.housing-offered', $ad)
                @endif

                <!-- housing wanted -->
                @if ($ad->ad_type->slug == 'housing-wanted')
                @include('frontend.post.pages_edit.housing-wanted', $ad)
                @endif
                <!-- for-sale-by-owner -->
                @if ($ad->ad_type->slug == 'for-sale-by-owner')
                @include('frontend.post.pages_edit.for-sale-by-owner', $ad)
                @endif

                {{-- for-sale-by-dealer --}}

                @if ($ad->ad_type->slug == 'for-sale-by-dealer')
                @include('frontend.post.pages_edit.for-sale-by-dealer', $ad)
                @endif
                @if ($ad->ad_type->slug == 'wanted-by-owner')
                @include('frontend.post.pages_edit.wanted-by-owner', $ad)
                @endif
                @if ($ad->ad_type->slug == 'wanted-by-dealer')
                @include('frontend.post.pages_edit.wanted-by-dealer', $ad)
                @endif
                @if ($ad->ad_type->slug == 'service-offered')
                @include('frontend.post.pages_edit.service-offered', $ad)
                @endif
                @if ($ad->ad_type->slug == 'community')
                @include('frontend.post.pages_edit.community', $ad)
                @endif
                @if ($ad->ad_type->slug == 'event-class')
                @include('frontend.post.pages_edit.event-class', $ad)
                @endif
                <div class="mt-5 text-center">
                    <button type="submit" class="btn btn-light">Update Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('image_uploader/dist/image-uploader.min.js') }}"></script>
<script>
    let preloaded = [
            @foreach ($ad->galleries as $galleries)

                {
                    id: "{{ $galleries->id }}",
                    src: "{{ asset($galleries->image) }}"
                },
            @endforeach
        ];
        $('.input-images-2').imageUploader({
            preloaded: preloaded,
            imagesInputName: 'images',
            preloadedInputName: 'old',
            maxFiles: 10

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
