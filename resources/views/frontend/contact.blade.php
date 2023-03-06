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
<style>
    .error {
        color: red;
    }
</style>
@endpush
@section('title')
{{ __('Contact') }}
@endsection

@section('breadcrumb')
<div class="breadcrumb_section">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item pe-2"><a href="{{ route('frontend.index') }}">Home</a></li>
                |
                <li class="breadcrumb-item active" aria-current="page">{{ __('contact') }}</li>
            </ol>
        </nav>
    </div>
</div>
@endsection


@section('content')
<div class="breadcrumb_sec mt-5">
    <div class="container">
        <div class="breadcrumb_nav text-center">
            <h2>Contact us</h2>
        </div>
    </div>
</div>

<!-- ======================= contact start  ============================ -->
<div class="contact_sec mb-5 mt-5">
    <div class="container">
        <form action="{{ route('frontend.contact.submit') }}" method="post" class="contact_form submitForm"
            id="contactForm">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"
                                placeholder="Enter your name" required>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control"
                                placeholder="Enter your email" required>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="number" name="phone" id="phone" {{ old('phone') }} class="form-control"
                                placeholder="Enter your phone" required>
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="reason" class="form-label">Reason for Inquiry <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="reason" id="phone" {{ old('reason') }} class="form-control"
                                placeholder="Your Reason" required>
                            @error('reason')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-4">
                            <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea name="message" id="message" cols="30" rows="5" class="form-control" required
                                placeholder="Write your message" style="height:150px !important;"></textarea>
                            @error('message')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary send">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>


<!-- ======================= contact end  ============================ -->
@endsection

@push('script')
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script>
    $("#contactForm").validate({
            submitHandler: function(form) {
                $(form).find('.send').attr('disabled', true);
                $(form).find('.send').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...'
                );
                return true;
            }
        });
</script>
@endpush