@extends('frontend.layouts.app', ['nav' => 'yes'])

@push('style')
@endpush
@section('title')
    {{ __('Password Verified') }}
@endsection
@section('breadcrumb')
    <div class="breadcrumb_section">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item pe-2"><a href="{{ route('frontend.index') }}">Home</a></li>
                    |
                    <li class="breadcrumb-item active" aria-current="page">Password Change</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection
@section('breadcrumb')
    <ul class="mt-5">
        <li class="text-center">Set your password for account security</li>
    </ul>
@endsection

@section('content')
    <div class="main_template mt-5">
        <div class="container">
            <div class="signin_form">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-7 col-lg-5">
                        <div class="heading mb-4 pb-4">
                            <h3>Set your password for account security</h3>
                        </div>
                        <form action="{{ route('user.signup.success') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="New Password">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required
                                       placeholder="Confirm Password">
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                            <small class="my-ul-list">
                                <ul class="advice-list">
                                    <li>1. Try using a mixture of letters, numbers, and symbols.</li>
                                    <li>2. Avoid using common words, phrases, or personal information.</li>
                                </ul>
                            </small>
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

@push('script')

@endpush
