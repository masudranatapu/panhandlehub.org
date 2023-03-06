@extends('frontend.layouts.app', ['nav' => 'yes'])

@section('title') {{ $data['title'] ?? 'Page header' }} @endsection
@section('meta')
<meta property="title" content="{{ $meta_title }}" />
<meta property="description" content="{{ $meta_description }}" />
<meta property="keywords" content="{{ $meta_keywords }}" />
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
<meta property="og:keywords" content="{{ $meta_keywords }}" />
<meta property="og:image" content="{{ asset($meta_image) }}" />
@endsection

@push('style') @endpush
@section('breadcrumb')
<div class="breadcrumb_section">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item pe-2"><a href="{{ route('frontend.index') }}">Home</a></li>
                >
                <li class="breadcrumb-item active" aria-current="page">Faq</li>
            </ol>
        </nav>
    </div>
</div>
@endsection
@section('content')

<div class="breadcrumb_sec mt-5">
    <div class="container">
        <div class="breadcrumb_nav text-center">
            <h2>Faq</h2>
        </div>
    </div>
</div>

<!-- ======================= faq start  ============================ -->
<div class="faq_sec section mt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="faq_list">
                <div class="accordion" id="accordionExample">
                    @foreach ($faqs as $key => $row)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading_{{ $key }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_{{ $key }}" aria-expanded="true"
                                aria-controls="collapse_{{ $key }}">
                                {{ $row->question }}
                            </button>
                        </h2>
                        <div id="collapse_{{ $key }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}"
                            aria-labelledby="heading_{{ $key }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>{{ $row->answer }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>


<!-- ======================= faq end  ============================ -->
@endsection

@push('script')

@endpush
