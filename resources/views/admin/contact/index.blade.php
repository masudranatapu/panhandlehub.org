@php
$user = auth()->user();
@endphp

@extends('admin.layouts.app')

@section('title')
    {{ __('Contact') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title" style="line-height: 36px;">{{ __('Contact list') }}</h3>
                            <div>
                                {{-- <a href="{{ route('city.create') }}"
                                         class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-plus"></i>&nbsp; {{ __('City') }}</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>{{ __('Sl.No') }}</th>
                                    <th>{{ __('Contact Name') }}</th>
                                    <th>{{ __('Contact Email') }}</th>
                                    <th>{{ __('Contact Phone') }}</th>
                                    <th>{{ __('Contact Details') }}</th>
                                    <th>{{ __('Contact Date') }}</th>
                                    <th>{{ __('Action') }}</th>

                                </tr>
                            </thead>
                            <tbody id="sortable">
                                @foreach($users as $key => $value)
                                    <tr class="text-center">
                                        <td>{{  $users->firstItem() + $key  }}</td>
                                        <td>{{ $value->name}}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ Str::limit($value->message, 40, '...') }}</td>
                                       <td>{{ date('d M Y',strtotime($value->created_at)) }}</td>
                                        <td>
                                            @if(Auth::user()->can('contact.view'))
                                            <a href="{{ route('contact.view',$value->id) }}" class="btn btn-secondary"><i class="fa fa-eye"></i></a>
                                            @endif
                                            @if(Auth::user()->can('contact.delete'))
                                                <form action="{{ route('contact.delete', $value->id) }}"
                                                        method="POST" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('Delete Ad Type') }}"
                                                            onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                                                            class="btn bg-danger mr-1"><i class="fas fa-trash"></i></button>
                                                </form>
                                          @endif  
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                        <div class="card-footer ">
                            <div class="d-flex justify-content-center">
                                {{ $users->links() }}
                            </div>
                        </div>
                </div>
            </div>
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
