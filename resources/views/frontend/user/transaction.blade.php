@extends('frontend.layouts.app', ['nav' => 'yes'])

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
        <li>User Transactions > </li>
        {{-- <li>{{ $user->name }}</li> --}}
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
                        <button class="nav-link active" id="searches-tab" data-bs-toggle="tab"
                            data-bs-target="#searches-tab-pane" type="button" role="tab"
                            aria-controls="searches-tab-pane" aria-selected="false"><a
                                href="{{ route('user.transaction') }}">Transaction</a></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="setting-tab" data-bs-toggle="tab" data-bs-target="#setting-tab-pane"
                            type="button" role="tab" aria-controls="setting-tab-pane" aria-selected="false"><a
                                href="{{ route('user.setting') }}">Settings</a></button>
                    </li>
                </ul>
            </div>
            <div class="user_dashboard_wrap">
                <div class="table-responsive">
                    <table class="table table-hover" style="min-width: 950px;">
                        <thead>
                            <tr>
                                <th width="5%">Sl No</th>
                                <th width="15%">Posting</th>
                                <th width="10%">Ad Type</th>
                                <th width="10%">Category</th>
                                <th width="10%">Amount</th>
                                <th width="10%">Payment Method</th>
                                <th width="10%">Area</th>
                                <th width="10%">Payment Status</th>
                                <th width="10%">Date</th>
                                <th width="10%">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $key=> $value)
                                <tr>
                                    <td>{{ $transactions->firstItem() + $key }}</td>
                                    <td>
                                        <a href="{{ route('frontend.details', $value->ad->slug ?? '') }}">
                                            {{ Str::limit($value->ad->title ?? 'N/A', 35, '....') }}</a>
                                    </td>
                                    <td>
                                        {{ $value->ad->ad_type->name ?? 'N/A' }}
                                    </td>
                                    <td>
                                        {{ $value->ad->category->name ?? 'N/A' }}
                                    </td>
                                    <td>
                                        {{ $value->currency_symbol }}{{ $value->amount }}
                                    </td>
                                    <td>{{ $value->payment_provider }}</td>
                                    <td>
                                        {{ $value->ad->city ?? '' }}
                                        {{ isset($value->ad->countries->name) ? ', ' . ucfirst(strtolower($value->ad->countries->name)) : '' }}
                                    </td>
                                    <td>
                                        @if ($value->payment_status == 'paid')
                                            <span class="badge bg-success">Paid</span>
                                        @else
                                            <span class="badge bg-danger">Unpaid</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d M Y', strtotime($value->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('user.transaction.details', $value->id) }}"
                                            class="btn btn-sm btn-success">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Not Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer mb-5">
                    <div class="d-flex justify-content-center">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->

@endsection
