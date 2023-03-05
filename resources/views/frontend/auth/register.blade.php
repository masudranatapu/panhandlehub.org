@extends('frontend.layouts.app', ['nav' => 'yes'])

@push('style')

<style>
    .forgotpassword {
        text-decoration: underline !important;
        text-align: end;
        display: inherit;
        margin-top: 5px;
    }
</style>
@endpush
@section('title')
{{ __('Sign In') }}
@endsection

@section('breadcrumb')
<div class="breadcrumb_section">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item pe-2"><a href="{{ route('frontend.index') }}">Home</a></li>
                |
                <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')
<section class="signin_section mt-5">
    <div class="container">
        <div class="signin_form">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-7 col-lg-5">
                    <div class="heading mb-4 pb-4">
                        <h3>Register for a new account</h3>
                        <p>Already have an account? <a href="{{ route('signin') }}">Sign in</a></p>
                    </div>
                    <form action="{{ route('user.signup') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" id="username"
                                class="form-control @error('username')is-invalid @enderror"
                                value="{{ old('username') }}" placeholder="Enter your username" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email')is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="Enter your email address" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password')is-invalid @enderror"
                                placeholder="Enter your password" required>
                        </div>
                        <div class="mb-4">
                            <label for="confirm_password" class="form-label">Confirm Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" name="confirm_password" id="confirm_password"
                                class="form-control @error('confirm_password')is-invalid @enderror"
                                placeholder="Confirm your password" required>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        </div>
                    </form>

                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <div class="login_img">
                        <img src="{{ asset('frontend/images/register.svg') }}" class="w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
