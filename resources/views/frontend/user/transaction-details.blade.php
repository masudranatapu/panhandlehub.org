@extends('frontend.layouts.app', ['nav' => 'yes'])

@push('style')
@endpush


@section('breadcrumb')
<div class="breadcrumb_section">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">User Transaction Details</li>
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
            <div class="row m-2">
                <div class="col-md-12 ">
                    <div class="card p-4 w-100 mb-5">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                            cellspacing="0" width="100%">
                            <tbody>
                                <tr class="mb-5">
                                    <th width="15%">{{ __('Customer Email') }}</th>
                                    <td width="80%">{{ $transactionDetails->customer->email ?? '' }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="15%">{{ __('Posting Title') }}</th>
                                    <td width="80%">{{ $transactionDetails->ad->title ?? 'N/A' }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="15%">{{ __('Add Type') }}</th>
                                    <td width="80%">{{ $transactionDetails->ad->ad_type->name ?? 'N/A' }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="15%">{{ __('Category') }}</th>
                                    <td width="80%">{{ $transactionDetails->ad->category->name ?? 'N/A' }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="15%">{{ __('Sub Category') }}</th>
                                    <td width="80%">{{ $transactionDetails->ad->subCategory->name ?? 'N/A' }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="15%">{{ __('Order ID') }}</th>
                                    <td width="80%">{{ $transactionDetails->order_id }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="15%">{{ __('Transaction ID') }}</th>
                                    <td width="80%">{{ $transactionDetails->transaction_id }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="15%">{{ __('Amount') }}</th>
                                    <td width="80%">
                                        {{ $transactionDetails->currency_symbol }}{{ $transactionDetails->amount }}
                                    </td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="15%">{{ __('Payment Method') }}</th>
                                    <td width="80%">{{ $transactionDetails->payment_provider }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="15%">{{ __('Area') }}</th>
                                    <td width="80%">{{ $transactionDetails->ad->city ?? 'N/A' }}
                                        {{ isset($transactionDetails->ad->countries->name) ? ', ' .
                                        ucfirst(strtolower($transactionDetails->ad->countries->name)) : '' }}
                                    </td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="15%">{{ __('Payment Status') }}</th>
                                    <td width="80%">
                                        @if ($transactionDetails->payment_status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                        @else
                                        <span class="badge bg-danger">Uppaid</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="15%">{{ __('Transaction Date') }}</th>
                                    <td width="80%">{{ date('d M Y', strtotime($transactionDetails->created_at)) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer -->

@endsection
