@extends('frontend.layouts.app', ['nav' => 'yes'])

@push('style')
    <style>
        .login_form h1 {
            font-size: 16px;
            font-family: Arial, sans-serif;
            padding: 8px 5px;
        }

        .login_form p {
            font-size: 14px;
            color: #1C64AC;
            font-family: Arial, sans-serif;
        }

        .accountform-banner-one {
            border-radius: 2px;
            background-color: #d4d4d4;
            border: 1px solid #E4E4E4;
            font-weight: bold;
            padding: 8px 5px;
            text-align: center;
            margin-bottom: 16px;
        }
    </style>
@endpush
@section('title')
    {{ __('Forgot Password') }}
@endsection
@section('breadcrumb')
    <div class="breadcrumb_section">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item pe-2"><a href="{{ route('frontend.index') }}">Home</a></li>
                    |
                    <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="main_template mt-5">
        <div class="container">
            <div class="signin_form">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-7 col-lg-5">
                        <div class="heading mb-4 pb-4">
                            <h3>Account password reset</h3>
                            <p>Don't have an account? <a href="{{ route('user.signup') }}">Sign Up</a></p>
                        </div>
                        <form action="{{ route('user.password.mail') }}" method="post" >
                            @csrf
                            <div class="alert alert-sm alert-info" role="alert">
                                <p>Enter your account email address to reset your password.</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required placeholder="Email">
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary w-100">Reset Password</button>
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
    </div>
@endsection


