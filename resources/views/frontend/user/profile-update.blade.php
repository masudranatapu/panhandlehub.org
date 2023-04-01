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
                    <div class="col-12 col-lg-8 col-xl-9">
                        <div class="dashboard_wrapper">
                            <div class="recent_ads">
                                <div class="heading mb-3">
                                    <h5>Update Your Profile Picture</h3>
                                </div>
                                <div class="user_dashboard">
                                    <form action="{{ route('user.userProfile.update') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label for="image" class="form-label">Profile Image</label>
                                                <input type="file" name="image" id="image" class="form-control">
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </ul>
            </div>
        </div>
    </div>
@endsection
