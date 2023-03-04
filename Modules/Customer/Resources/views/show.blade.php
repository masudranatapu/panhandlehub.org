@extends('admin.layouts.app')
@section('title')
    {{ __('customer_details') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 mb-3">
                <div class="card card-widget widget-user shadow">
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">{{ $customer->name }}</h3>
                        <h5 class="widget-user-desc">{{ $customer->email }}</h5>
                    </div>
                    {{-- <div class="widget-user-image">
                        @if ($customer->image)
                            <img class="img-circle elevation-2" src="{{ asset($customer->image) }}" alt="Customer Image">
                        @else
                            <img class="img-circle elevation-2" src="{{ asset('backend/image/thumbnail.jpg') }}"
                                alt="Customer Image">
                        @endif
                    </div> --}}
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ __('username') }}</h5>
                                    <span class="description-text">{{ $customer->username }}</span>
                                </div>
                            </div>
                            {{-- <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ __('phone') }}</h5>
                                    <span class="description-text">{{ $customer->phone }}</span>
                                </div>
                            </div>
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ __('website') }}</h5>
                                    <span class="description-text">{{ $customer->web ? $customer->web : '-' }}</span>
                                </div>
                            </div> --}}
                            <div class="col-sm-6">
                                <div class="description-block">
                                    <h5 class="description-header">{{ __('registered_at') }}</h5>
                                    <span
                                        class="description-text">{{ date('M d, Y', strtotime($customer->created_at)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{-- category wise ads --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('customer') }} {{ __('Details') }}
                        </h3>
                        <a href="{{ route('module.customer.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <x-backend.ad-manage :ads="$ads" :showCustomer="false" />
                    </div>
                </div>

                {{-- purchase plan --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('Purchase Transaction') }}</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Ad Title') }}</th>
                                    <th>{{ __('Ad Type') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Sub Category') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('payment_provider') }}</th>
                                    <th>{{ __('Payment Status') }}</th>
                                    <th>{{ __('created_time') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($transactions) && $transactions->count() > 0)
                                    @forelse ($transactions as $key => $transaction)
                                        <tr>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td class="text-muted">
                                                {{ Str::limit($transaction->ad->title, 40, '...') }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $transaction->ad->ad_type->name }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $transaction->ad->category->name }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $transaction->ad->subCategory->name }}
                                            </td>
                                            <td class="text-muted">
                                                ${{ number_format($transaction->amount, 2, '.', ',') }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $transaction->payment_provider }}
                                            </td>
                                            <td class="text-muted">
                                                @if($transaction->payment_status == 'paid')
                                                    <span class="badge bg-success">Paid</span>
                                                @else
                                                <span class="badge bg-danger">Unpaid</span>    
                                                @endif
                                            </td>
                                            <td class="text-muted">
                                                {{ date('d M Y',strtotime($transaction->created_at)) }}
                                            </td>
                                        </tr>
                                     @empty
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                <span class="">{{ __('no_transactions_found') }}...</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .widget-user .widget-user-image>img {
            width: 110px;
        }

        .widget-user .card-footer {
            padding-top: 80px;
        }
    </style>
@endsection
