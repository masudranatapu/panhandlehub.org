@extends('frontend.layouts.app', ['nav' => 'yes'])
@section('meta')
@endsection
@push('style')
    <style>
        .payment-style {width: 35px;padding: 1px;}
        h2.pay_to_publish {text-align: center;font-size: 25px;margin-bottom: 15px;}
    </style>
@endpush
@section('title')
    {{ __('Payment post') }}
@endsection
@section('breadcrumb')
    <ul>
        <li>{{ $ad->ad_type->name }} ></li>
        <li>{{ $ad->category->name }} ></li>
        <li>{{ $ad->subcategory->name }}</li>
    </ul>
@endsection

@section('content')
    <div class="main_template mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="pay_to_publish">{{__('pay_to_publish')}}</h2>
                    <div class="card p-4 w-100 mb-5">
                        <table class="table table-striped table-bordered dt-responsive nowrap">
                            <tr>
                                <td>{{__('post_title')}}:</td>
                                <td>{{ $ad->title }}</td>
                            </tr>
                            <tr>
                                <td>{{__('ad_type')}}:</td>
                                <td>{{ $ad->ad_type->name }}</td>
                            </tr>
                            <tr>
                                <td>{{__('category')}}:</td>
                                <td>{{ $ad->category->name }}</td>
                            </tr>
                            <tr>
                                <td>{{__('amount')}}:</td>
                                <td>${{ $ad->ad_type->amount }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (config('paypal.mode') == 'sandbox')
                    @if (config('paypal.active') && config('paypal.sandbox.client_id') && config('paypal.sandbox.client_id'))
                        <div class="col-md-6">
                            <div class="card p-4 w-100">
                                <h5>
                                    <img class="payment-style" src="{{ asset('frontend/paypal.png') }}" alt="">
                                    Paypal Payment
                                </h5>
                                <div class="card-body mt-5 mb-0">
                                    <form action="{{ route('paypal.post') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="price" value="{{ $ad->ad_type->amount }}">
                                        <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                                        <button type="submit" class="btn btn-info">Pay Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                @if (config('paypal.active') && config('paypal.live.client_id') && config('paypal.live.client_secret'))
                <div class="col-md-6">
                        <div class="card p-4 w-100">
                            <h5>
                                <img class="payment-style" src="{{ asset('frontend/paypal.png') }}" alt="">
                                Paypal Payment
                            </h5>
                            <div class="card-body mt-5 mb-0">
                                <form action="{{ route('paypal.post') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="price" value="{{ $ad->ad_type->amount }}">
                                    <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                                    <button type="submit" class="btn btn-info">Pay Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                @endif
                @if (config('zakirsoft.stripe_active') && config('zakirsoft.stripe_key') && config('zakirsoft.stripe_secret'))
                    <div class="col-md-6">
                        <div class="card p-4 w-100">
                            <h5>
                                <img class="payment-style" src="{{ asset('frontend/stripe.png') }}" alt="">
                                Stripe Payment
                            </h5>
                            <div class="card-body mt-5 mb-0">
                                <button class="btn btn-info" id="stripe_btn">Pay Now</button>
                            </div>
                        </div>
                    </div>
              @endif
            </div>
        </div>
    </div>
@if (config('zakirsoft.stripe_active') && config('zakirsoft.stripe_key') && config('zakirsoft.stripe_secret'))
    <form action="{{ route('stripe.post') }}" method="POST" class="d-none">
        @csrf
        <input type="hidden" name="ad_id" value="{{ $ad->id  }}">
        <input type="hidden" name="price" value="{{ $ad->ad_type->amount }}">
        <script id="stripe_script" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ config('zakirsoft.stripe_key') }}" data-ad_id="{{ $ad->id }}" data-amount="{{ $ad->ad_type->amount * 100 }}"
                data-name="{{ config('app.name') }}" data-description="Money pay with stripe"
                data-locale="{{ app()->getLocale() == 'default' ? 'en' : app()->getLocale() }}" data-currency="USD"></script>
    </form>
@endif
@endsection

@push('script')
    <script type="text/javascript">
        $('#stripe_btn').on('click', function(e) {
            e.preventDefault();
            $('.stripe-button-el').click();
        });
    </script>

@endpush
