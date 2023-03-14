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
                <li class="breadcrumb-item active" aria-current="page">Sign In</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('content')

<section class="signin_section m-5">
    <div class="container">
        <div class="signin_form">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-7 col-lg-5">
                    <div class="heading mb-4 pb-4">
                        <h3>Sign-in to your account</h3>
                        <p>Don't have an account? <a href="{{ route('user.signup') }}">Sign Up</a></p>
                    </div>
                    <form action="{{ route('user.signin') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email')is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="Email Address" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password')is-invalid @enderror" placeholder=" Password"
                                required>
                        </div>

                        <div class="d-flex mb-4" style="justify-content:space-between;">
                            <div class="remember_me">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="password_forgot">
                                <a href="{{ route('user.password.reset') }}">Forgot password?</a>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-100">Sign In</button>
                        </div>
                    </form>

                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <div class="login_img">
                        <img src="{{ asset('frontend/images/login-rafiki.svg') }}" class="w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>






@endsection
