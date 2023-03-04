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
{{ __('about') }}
@endsection
@section('breadcrumb')
    <ul>
        <li>{{ __('about') }}</li>
    </ul>
@endsection

@section('content')
<div class="breadcrumb_sec mt-5">
        <div class="container">
            <div class="breadcrumb_nav text-center">
                <h2>About Us</h2>
            </div>
        </div>
    </div>
    <div class="main_template">
        <div class="container">
            <div class="single_product mt-5 mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-9">
                        <div class="about_content">
                            <div class="mb-4 text-center">
                                <img src="{{ asset($cms->about_background) }}" class="w-100 rounded border shadow-sm"
                                    alt="">
                            </div>
                            <div class="content">
                                <p>{!! $cms->about_body !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
           @include('frontend.layouts.footer')

    </div>
@endsection

@push('script')
@endpush
