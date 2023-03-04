@php
$user = auth()->user();
@endphp

@extends('admin.layouts.app')

@section('title')
    {{ __('Transaction') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('User Details') }}</h3>
                        <a href="{{ route('transaction.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>

                    <div class="row m-2">
                       
                        <div class="col-md-8 pt-4">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
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
                                        <th width="20%">{{ __('Payment Status') }}</th>
                                        <td width="80%">
                                            @if($transaction->payment_status == 'paid')
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-danger">Uppaid</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('User Date') }}</th>
                                        <td width="80%">{{ date('d M Y',strtotime($transaction->created_at)) }}</td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- category subcategories --}}
            {{-- <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">
                            {{ __('ad_wise') }}
                            {{ __('custom_fields') }}</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                            cellspacing="0" width="100%">
                            <tbody>
                                @foreach ($ad->productCustomFields as $field)
                                    <tr class="mb-5">
                                        <th width="20%">{{ $field->customField->name }}</th>
                                        @if ($field->customField->type == 'file')
                                            <td width="80%">
                                                <a href="javascript:void(0)" onclick="$('#image-download-form').submit()"
                                                    class="download-attachment">Download</a>
                                                <form class="d-none" id="image-download-form"
                                                    action="{{ route('frontend.attachment.download') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="field" value="{{ $field->id }}">
                                                </form>
                                            </td>
                                        @else
                                            <td width="80%">{{ $field->value }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
            <!-- map =====================  -->
            {{-- <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">
                            {{ __('location') }}
                        </h3>
                    </div>
                    <div class="">
                        @php
                            $map = setting('default_map');
                        @endphp
                        @if ($map == 'map-box')
                            <div class="map mymap" id='map-box'></div>
                        @elseif ($map == 'google-map')
                            <div class="map mymap" id="google-map"></div>
                        @elseif ($map == 'leaflet')
                            <div id="leaflet-map"></div>
                        @endif
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function() {
            $("#sortable").sortable({
                items: 'tr',
                cursor: 'move',
                opacity: 0.4,
                scroll: false,
                dropOnEmpty: false,
                update: function() {
                    sendTaskOrderToServer('#sortable tr');
                },
                classes: {
                    "ui-sortable": "highlight"
                },
            });
            $("#sortable").disableSelection();

            function sendTaskOrderToServer(selector) {
                var order = [];
                $(selector).each(function(index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('module.category.updateOrder') }}",
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                    }
                });
            }
        });

        $('.toggle-switch').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('module.category.status.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        })
    </script>
@endsection


@section('style')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 35px;
            height: 19px;
            /* width: 60px;
                                                                            height: 34px; */
        }

        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input.success:checked+.slider {
            background-color: #28a745;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(15px);
            -ms-transform: translateX(15px);
            transform: translateX(15px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection
