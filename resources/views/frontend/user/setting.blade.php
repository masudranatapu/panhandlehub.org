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
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Username</strong> : {{ $user->username ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Email</strong> : {{ $user->email }}</li>
                <li class="list-group-item">
                    <strong>Password</strong> :
                    @if($user->password === NULL)
                    you have a passwordless account - <a href="{{ route('user.password.reset') }}">[Set Password]</a>
                    @else
                    <a href="{{ route('user.password.reset') }}">[Change Password]</a>
                    @endif

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
