@extends('frontend.layouts.app', ['nav' => 'yes'])

@push('style')
    <style>
        td {
            border: 1px solid #EEE !important;
            vertical-align: middle;
        }

        tr th {
            font-size: 13px;
            text-align: center;
            border: 1px solid #EEE;
        }
        .img {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        width: 100px;
        height: 90px;
        }
    </style>
@endpush

@section('breadcrumb')
    <div class="breadcrumb_section">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">User Profile</li>
                    >
                    <li class="breadcrumb-item active">{{ $user->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="main_template mt-5">
        <div class="container">
            <div class="user_dashboard mb-4">
                @include('frontend.user.dashboard_nav')
            </div>
            <div class="user_dashboard_wrap">
                @if (Auth::user()->image)
                <img src="{{ asset(Auth::user()->image) }}" alt="Paris" class="img mb-2">
                @else 
                <img src="{{ asset('default-user.png') }}" alt="Paris" class="img mb-2">
                @endif
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Your Shop: </strong><a
                            href="{{ route('frontend.seller.shop', $user->username) }}">[Visit your shop]</a>
                    <li>
                        <li class="list-group-item"><strong>Update Profile: </strong><a
                            href="{{ route('user.userProfile') }}">[Update Your Profile Picture]</a>
                    <li>
                    <li class="list-group-item"><strong>Username</strong> : {{ $user->username ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Email</strong> : {{ $user->email }}</li>
                    <li class="list-group-item">
                        <strong>Change Password</strong> : <a href="{{ route('user.password.reset') }}">[Request a link]</a>

                    </li>
                    <li class="list-group-item">
                        <a href="javascript:;" class="text-danger"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('sign_out') }}
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
@endsection
