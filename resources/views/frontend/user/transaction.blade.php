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
                <li class="breadcrumb-item active">User Transaction</li>
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
                                {{ isset($value->ad->countries->name) ? ', ' .
                                ucfirst(strtolower($value->ad->countries->name)) : '' }}
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
                                <a href="{{ route('user.transaction.details', $value->id) }}" title="View"
                                    class="btn btn-sm btn-dark">
                                    <i class="fa fa-eye"></i>
                                </a>
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
