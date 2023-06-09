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
            <div class="table-responsive">
                <table class="table table-hover" style="min-width: 950px;">
                    <thead>
                        <tr>
                            <th style="width:5%">Sl No</th>
                            <th style="width:30%">Posting</th>
                            <th style="width:10%">Ad Type</th>
                            <th style="width:10%">Category</th>
                            <th style="width:10%">Sub Category</th>
                            <th style="width:10%">Area</th>
                            <th style="width:10%">Status</th>
                            <th style="width:15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ads as $key=> $ad)
                        <tr>
                            <td>{{ $ads->firstItem() + $key }}</td>
                            <td>
                                <a href="{{route('frontend.details', $ad->slug)}}"> {{Str::limit($ad->title,35,'....')}}</a>
                            </td>
                            <td>
                                {{$ad->ad_type->name}}
                            </td>
                            <td>
                                {{$ad->category->name}}
                            </td>
                            <td>
                                {{$ad->subCategory->name}}
                            </td>
                            <td>
                                {{$ad->city}} {{ isset($ad->countries->name) ? ', '
                                .ucfirst(strtolower($ad->countries->name)) : ''}}
                            </td>
                            <td>
                                @if($ad->is_payable == 1)
                                <a href="{{ route('frontend.payment.post', $ad->id) }}"
                                    onclick="return confirm('This ad is payable. Do you want to publish?')"
                                    class="btn btn-sm btn-danger">Unpublished</a>
                                @else
                                <a href="{{ route('user.post.statusUpdate', [$ad->id, 'active']) }}"
                                    class="btn btn-sm btn-danger">Unpublished</a>
                                @endif
                            </td>
                            <td>
                                {{-- <a href="{{route('frontend.details', $ad->slug)}}"
                                    class="btn btn-sm btn-success">View</a> --}}
                                <a href="{{ route('user.post.edit',$ad->slug) }}" title="Edit"
                                    class="btn btn-sm btn-dark">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>

                                <a href="{{ route('user.post.delete', $ad->id) }}"
                                    onclick="return confirm('Are you sure to delete?')" title="Delete"
                                    class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Not Found</td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer mb-5">
                <div class="d-flex justify-content-center">
                    {{ $ads->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
