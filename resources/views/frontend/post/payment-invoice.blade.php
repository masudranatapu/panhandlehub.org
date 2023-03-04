@extends('frontend.layouts.app', ['nav' => 'yes'])
@section('meta')
@endsection
@push('style')
    <style>
        .payment-style {
            width: 35px;
            padding: 1px;
        }
    </style>
@endpush
@section('title')
    {{ __('Payment Invoice') }}
@endsection
@section('breadcrumb')
    <ul>
        <li>{{ $transaction->ad->ad_type->name }} ></li>
        <li>{{ $transaction->ad->category->name }} ></li>
        <li>{{ $transaction->ad->subcategory->name }}</li>
    </ul>
@endsection

@section('content')
    <div class="main_template mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-4 w-100 mb-5">
                        <h5 class='font-weight-bold text-center mb-4 bg-success p-3 text-white'>Customer Invoice</h5>
                        <table class="table table-striped table-bordered dt-responsive nowrap">
                            <tbody>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('Customer Email') }}</th>
                                    <td width="80%">{{ $transaction->customer->email ?? '' }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('Posting Title') }}</th>
                                    <td width="80%">{{ $transaction->ad->title ?? '' }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('Add Type') }}</th>
                                    <td width="80%">{{ $transaction->ad->ad_type->name ?? '' }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('Category') }}</th>
                                    <td width="80%">{{ $transaction->ad->category->name ?? '' }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('Sub Category') }}</th>
                                    <td width="80%">{{ $transaction->ad->subCategory->name ?? '' }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('Order ID') }}</th>
                                    <td width="80%">{{ $transaction->order_id }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('Transaction ID') }}</th>
                                    <td width="80%">{{ $transaction->transaction_id }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('Amount') }}</th>
                                    <td width="80%">{{ $transaction->currency_symbol }}{{ $transaction->amount }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('Payment Method') }}</th>
                                    <td width="80%">{{ $transaction->payment_provider }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('Area') }}</th>
                                    <td width="80%">{{ $transaction->ad->city ?? '' }}
                                        {{ isset($transaction->ad->countries->name) ? ', ' . ucfirst(strtolower($transaction->ad->countries->name)) : '' }}
                                    </td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('Payment Status') }}</th>
                                    <td width="80%">
                                        @if ($transaction->payment_status == 'paid')
                                            <span class="badge bg-success">Paid</span>
                                        @else
                                            <span class="badge bg-danger">Uppaid</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('Transaction Date') }}</th>
                                    <td width="80%">{{ date('d M Y', strtotime($transaction->created_at)) }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
@endpush
