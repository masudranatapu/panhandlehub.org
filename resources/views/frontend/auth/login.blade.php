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
<ul>
    <li>Login & Register</li>
</ul>
@endsection

@section('content')

{{-- <div class="main_template mt-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-lg-5">
                <form action="{{ route('user.signin') }}" method="post" class="login_form border p-3 rounded">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required
                            value="{{ old('email') }}" placeholder="Email Address">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Password">
                        <a class="forgotpassword" href="{{ route('user.forgot.password') }}">Forgot password ?</a>
                    </div>
                    <div class="mb-3">
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-light">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row d-flex justify-content-center py-4">
            <div class="col-md-6 text-center">Or</div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-lg-5">
                <form action="{{ route('user.signup') }}" method="post" class="login_form border p-3 rounded">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="Email Address">
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-light">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}



<section class="signin_section">
    <div class="container">
        <div class="signin_form">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-7 col-lg-5">
                    <div class="heading mb-4 pb-4">
                        <h3>Sign-in to your account</h3>
                        <p>Don't have an account? <a href="register.html">Register</a></p>
                    </div>
                    <form action="{{ route('user.signin') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email')is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="Email Address">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password')is-invalid @enderror""
                                placeholder=" Password">
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
                                <a href="forgot-password.html">Forgot password?</a>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-100">Log In</button>
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