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
{{ __('Privacy Policy') }}
@endsection
@section('breadcrumb')
<div class="breadcrumb_section">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item pe-2"><a href="{{ route('frontend.index') }}">Home</a></li>
                |
                <li class="breadcrumb-item active" aria-current="page">{{ __('privacy_policy') }}</li>
            </ol>
        </nav>
    </div>
</div>
@endsection


@section('content')
<div class="breadcrumb_sec mt-5">
    <div class="container">
        <div class="breadcrumb_nav text-center">
            <h2>Privacy Policy</h2>
        </div>
    </div>
</div>
<div class="main_template">
    <div class="container">
        <div class="mt-5 mb-5">
            <div class="page_content">
                <div class="content">
                    <p>{!! $cms->privacy_body !!}</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('script')
@endpush