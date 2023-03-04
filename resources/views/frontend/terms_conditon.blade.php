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
@endpush
@section('title')
{{ __('Terms & Conditon') }}
@endsection
@section('breadcrumb')
    <ul>
        <li>{{ __('terms & conditions') }}</li>
    </ul>
@endsection

@section('content')
<div class="breadcrumb_sec mt-5">
        <div class="container">
            <div class="breadcrumb_nav text-center">
                <h2>Terms & Condition</h2>
            </div>
        </div>
    </div>
    <div class="main_template">
        <div class="container">
            <div class="single_product mt-5 mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-9">
                        <div class="page_content">
                            <div class="content">
                                <p>{!! $cms->terms_body !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
          @include('frontend.layouts.footer')

@endsection

@push('script')
@endpush
