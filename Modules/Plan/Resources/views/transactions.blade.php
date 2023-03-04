@extends('admin.layouts.app')

@section('title')
    {{ __('transaction_history') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('transaction_history') }}</h3>
                        <a href="{{ url()->previous() }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('order_id') }}</th>
                                    <th>{{ __('transaction_id') }}</th>
                                    <th>{{ __('customer') }}</th>
                                    <th>{{ __('amount') }}</th>
                                    <th>{{ __('plan_name') }}</th>
                                    <th>{{ __('payment_provider') }}</th>
                                    <th>{{ __('payment_status') }}</th>
                                    <th>{{ __('created_time') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td class="text-muted">
                                            {{ $transaction->order_id }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $transaction->transaction_id ?? '--' }}
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('module.customer.show', $transaction->customer->username) }}">{{ $transaction->customer->name }}</a>
                                        </td>
                                        <td class="text-muted">
                                            {{ $transaction->currency_symbol }}{{ $transaction->amount }}
                                        <td class="text-muted">
                                            <span class="badge badge-primary">
                                                {{ $transaction->plan->label }}
                                            </span>
                                        </td>
                                        <td class="text-muted">
                                            @if ($transaction->payment_provider == 'offline')
                                                {{ __('offline') }}
                                                @if (isset($transaction->manualPayment) && isset($transaction->manualPayment->name))
                                                    (<b>{{ $transaction->manualPayment->name }}</b>)
                                                @endif
                                            @else
                                                {{ ucfirst($transaction->payment_provider) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->payment_status == 'paid')
                                                <span class="badge badge-pill bg-success">
                                                    {{ __('paid') }}
                                                </span>
                                            @else
                                                <span class="badge badge-pill bg-warning">{{ __('unpaid') }}</span> <br>
                                                <a onclick="return confirm('{{ __('are_you_sure') }} ?')"
                                                    href="{{ route('manual.payment.mark.paid', $transaction->id) }}">{{ __('mark_as_paid') }}</a>
                                            @endif
                                        </td>
                                        <td class="text-muted">{{ date('M d, Y', strtotime($transaction->created_at)) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <span class="">{{ __('no_transactions_found') }}...</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
