@extends('frontend.layouts.app', ['nav' => 'yes'])

@push('style')
<style>
    td {
        border: 1px solid #EEE !important;
        vertical-align: middle;
    }

    tr th {
        border: 1px solid #cdc9c9 !important;
        background: #d8d8d8 !important;
    }
</style>
@endpush

@section('breadcrumb')
<ul>
    <li>User Profile > </li>
    <li>{{ $user->name }}</li>
</ul>
@endsection

@section('content')
<div class="main_template mt-5">
    <div class="container-fluid">


        <div class="user_dashboard mb-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="posting-tab" data-bs-toggle="tab" data-bs-target="#posting-tab-pane"
                        type="button" role="tab" aria-controls="posting-tab-pane" aria-selected="true"><a
                            href="{{ route('user.profile') }}">Published Ad</a></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="drafts-tab" data-bs-toggle="tab" data-bs-target="#drafts-tab-pane"
                        type="button" role="tab" aria-controls="drafts-tab-pane" aria-selected="false"><a
                            href="{{ route('user.drafts') }}">Unpublished Ad</a></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="searches-tab" data-bs-toggle="tab" data-bs-target="#searches-tab-pane"
                        type="button" role="tab" aria-controls="searches-tab-pane" aria-selected="false"><a
                            href="{{ route('user.favourite') }}">Favourites</a></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="searches-tab" data-bs-toggle="tab" data-bs-target="#searches-tab-pane"
                        type="button" role="tab" aria-controls="searches-tab-pane" aria-selected="false"><a
                            href="{{ route('user.favourite') }}">Transaction</a></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="searches-tab" data-bs-toggle="tab" data-bs-target="#searches-tab-pane"
                        type="button" role="tab" aria-controls="searches-tab-pane" aria-selected="false"><a
                            href="{{ route('user.transaction') }}">Transaction</a></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="setting-tab" data-bs-toggle="tab"
                        data-bs-target="#setting-tab-pane" type="button" role="tab" aria-controls="setting-tab-pane"
                        aria-selected="false"><a href="{{ route('user.setting') }}">Settings</a></button>
                </li>
            </ul>
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
   @include('frontend.layouts.footer')

@endsection


