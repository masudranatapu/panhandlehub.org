@extends('frontend.layouts.app', ['nav' => 'yes'])

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .login_form h1 {
            font-size: 16px;
            font-family: Arial, sans-serif;
            padding: 8px 5px;
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

        .advice-list {
            list-style: disc inside none;
            margin-bottom: 1em;
            margin-top: 1em;
        }

        .my-ul-list ul {
            padding-left: 0 !important;
            display: block;
            list-style-type: disc;
            margin-block-start: 1em;
            margin-block-end: 1em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            padding-inline-start: 40px;
        }

        .advice-list li {
            display: list-item;
            text-align: -webkit-match-parent;
        }
    </style>
@endpush
@section('title')
    {{ __('Password Verified') }}
@endsection
@section('breadcrumb')
    <ul>
        <li>Set your password for account security</li>
    </ul>
@endsection

@section('content')
    <div class="main_template mt-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <form action="{{ route('user.signup.success.withoutpassword') }}" method="post"
                        class="login_form border p-3 rounded">
                        @csrf
                        <h1 class="accountform-banner-one">Continue without a password</h1>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-light">Go Passwordless</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row d-flex justify-content-center py-4">
                <div class="col-md-6 text-center">Or</div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <form action="{{ route('user.signup.success') }}" method="post" class="login_form border p-3 rounded">
                        @csrf
                        <h1 class="accountform-banner-one">Change your password</h1>
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
                            <button type="submit" class="btn btn-light">Change Password</button>
                        </div>
                        <small class="my-ul-list">
                            <ul class="advice-list">
                                <li>1. Try using a mixture of letters, numbers, and symbols.</li>
                                <li>2. Avoid using common words, phrases, or personal information.</li>
                            </ul>
                        </small>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
@endpush
