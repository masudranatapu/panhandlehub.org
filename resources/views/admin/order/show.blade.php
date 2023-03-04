@extends('admin.layouts.app')

@section('title')
    {{ __('orders_details') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body ">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>
                                    {{ __('orders_details') }}: #{{ $transaction->order_id }}
                                </h5>
                                <h5>
                                    {{ __('transaction_no') }}: {{ $transaction->transaction_id }}
                                </h5>
                                <p class="">
                                    {{ Carbon\Carbon::parse($transaction->created_at)->format('F d, Y, H:i A') }}
                                </p>

                                @if ($transaction->payment_status == 'paid')
                                    <span class="badge badge-pill bg-success text-capitalize">{{ __('paid') }}</span>
                                @else
                                    <span class="badge badge-pill bg-warning text-capitalize">{{ __('unpaid') }}</span>
                                @endif
                            </div>
                            <form action="{{ route('admin.transaction.invoice.download', $transaction->id) }}" method="POST"
                                id="invoice_download_form">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    <b>
                                        <i class="fas fa-download"></i>
                                        {{ __('download_invoice') }}
                                    </b>
                                </button>
                                @if ($transaction->payment_status == 'unpaid')
                                    <div class="mt-5">
                                        <a onclick="return confirm('{{ __('are_you_sure') }}')"
                                            href="{{ route('manual.payment.mark.paid', $transaction->id) }}">
                                            {{ __('mark_as_paid') }}
                                        </a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                                <h5 class="mb-3">{{ __('billing_address') }}</h5>
                                <h6 class="mb-2 text-capitalize">{{ $transaction->customer->name }}</h6>
                                <p class="mb-0 text-capitalize"> <strong>{{ __('email') }}: </strong><a
                                        href="mailto:{{ $transaction->customer->email }}">{{ $transaction->customer->email }}</a>
                                </p>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <h5 class="mb-3">{{ __('payment_method') }}</h5>
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <h6 class="mb-0">{{ __('method') }}: <strong>
                                                @if ($transaction->payment_provider == 'offline')
                                                    Offline
                                                    @if (isset($transaction->manualPayment) && isset($transaction->manualPayment->name))
                                                        (<b>{{ $transaction->manualPayment->name }}</b>)
                                                    @endif
                                                @else
                                                    {{ ucfirst($transaction->payment_provider) }}
                                                @endif
                                            </strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($transaction->payment_type != 'per_job_based')
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <h5 class="mb-3">{{ __('plan_details') }}</h5>
                                    <h6 class="mb-2">{{ __('name') }}:
                                        <strong>{{ $transaction->plan->label }}</strong>
                                    </h6>
                                    <p class="mb-1">{{ __('description') }}: {{ $transaction->plan->description }}</p>
                                    <p class="mb-0">{{ __('price') }}:
                                        <strong>{{ $transaction->currency_symbol }}{{ $transaction->amount }}</strong>
                                    </p>
                                </div>

                                <div class="col-md-12 col-lg-12 mt-5">
                                    <h5 class="mb-3">{{ __('plan_benefits') }}</h5>
                                    <h6 class="mb-2">
                                        {{ __('ads_limit') }}:
                                        <strong>{{ $transaction->plan->ad_limit }}</strong>
                                    </h6>
                                    <p class="mb-1">
                                        {{ __('featured_ads_limit') }}:
                                        <strong>{{ $transaction->plan->featured_limit }}</strong>
                                    </p>
                                    <p class="mb-1">
                                        {{ __('premium_badge') }}:
                                        <strong>
                                            @if ($transaction->plan->badge)
                                                <x-svg.check-icon width="22" height="22"
                                                    stroke="{{ $setting->frontend_primary_color }}" />
                                            @else
                                                <x-svg.cross-icon width="22" height="22" stroke="#dc3545" />
                                            @endif
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('style')
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #343a40;
        }

        .nav-pills .nav-link:not(.active):hover {
            color: #343a40;
        }
    </style>
@endsection
