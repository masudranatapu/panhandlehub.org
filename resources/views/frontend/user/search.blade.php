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
                            <th width="5%">Sl No</th>
                            <th width="30%">Posting</th>
                            <th width="10%">Ad Type</th>
                            <th width="10%">Category</th>
                            <th width="10%">Sub Category</th>
                            <th width="10%">Date</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($wishlist as $key=> $item)

                        <tr>
                            <td>{{ $wishlist->firstItem() + $key }}</td>
                            <td>
                                <a href="{{route('frontend.details',$item->ad->slug?? "")}}"> {{$item->ad->title??
                                    ""}}</a>
                            </td>
                            <td>
                                {{ $item->ad->ad_type->name?? "" }}
                            </td>
                            <td>
                                {{ $item->ad->category->name?? "" }}
                            </td>
                            <td>
                                {{ $item->ad->subcategory->name?? "" }}
                            </td>
                            <td>
                                {{ $item->created_at->diffForHumans() }}
                            </td>
                            <td>
                                <a href="{{route('frontend.details', $item->ad->slug?? "")}}" title="View"
                                    class="btn btn-sm btn-dark">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="{{ route('user.favourite.delete', $item->id) }}" title="Delete"
                                    onclick="return confirm('Are you sure to remove from favorite?')"
                                    class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Not Found</td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer mb-5">
                <div class="d-flex justify-content-center">
                    {{ $wishlist->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('script')

@endpush
