@extends('admin.layouts.app')
@section('title')
    {{ __('faq_category_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('faq_category_list') }}</h3>
                    </div>
                    <div class="">
                        <div class="row p-4" id="sortable">
                            @forelse ($faqCategories as $key => $faq_category)
                                <div class="ui-state-default col-12 col-sm-6 col-md-4" data-id="{{ $faq_category->id }}">
                                    <div class="card card-margin">
                                        <div class="card-body pt-0">
                                            <div class="widget-49">
                                                <div class="widget-49-title-wrapper mt-4 items-align-center">
                                                    <div class="widget-49-date-pridmary">
                                                        <div>
                                                            <i class="text--30px {{ $faq_category->icon }}"></i>
                                                        </div>
                                                    </div>
                                                    <div class="widget-49-meeting-info">
                                                        <span class="text-capitalize text--xl">
                                                            {{ $faq_category->name }}
                                                        </span>
                                                        <span class="widget-49-meeting-time -mt-5">
                                                            {{ date('M d, Y', strtotime($faq_category->created_at)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="widget-49-meeting-action">
                                                    <div class="handle btn-sm btn btn-success mt-0">
                                                        <i class="fas fa-hand-rock"></i>
                                                    </div>
                                                    @if (userCan('faq.update'))
                                                        <a href="{{ route('module.faq.category.edit', $faq_category->id) }}"
                                                            class="btn btn-sm btn-outline-primary mr-1">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    @if (userCan('faq.delete'))
                                                        <form
                                                            action="{{ route('module.faq.category.destroy', $faq_category->id) }}"
                                                            method="POST" class="d-inline mt-2">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button data-toggle="tooltip" data-placement="top"
                                                                title="{{ __('delete_tag') }}"
                                                                onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}')"
                                                                class="btn btn-sm btn-outline-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <x-not-found route="" word="Category" />
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                @if (request()->routeIs('module.faq.category.edit'))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title line-height-36">{{ __('edit') }}</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="container">
                                <form method="POST" action="{{ route('module.faq.category.update', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group col-12">
                                        <label class="col-form-label">
                                            {{ __('name') }}
                                            <small class="text-danger">*</small>
                                        </label>
                                        <input type="text" name="name"
                                            class="mr-5 form-control @error('name') is-invalid @enderror"
                                            value="{{ $item->name }}" placeholder="{{ __('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="col-form-label">{{ __('icon') }}
                                            <small class="text-danger">*</small>
                                        </label>
                                        <input type="hidden" name="icon" value="{{ $item->icon }}" id="icon"
                                            class="@error('icon') is-invalid @enderror" />
                                        <div id="target"></div>
                                        @error('icon')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-plus"></i>&nbsp; {{ __('update') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title line-height-36">{{ __('create') }}</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="container">
                                <form method="POST" action="{{ route('module.faq.category.store') }}">
                                    @csrf
                                    <div class="form-group col-12">
                                        <label class="col-form-label">
                                            {{ __('name') }}
                                            <small class="text-danger">*</small>
                                        </label>
                                        <input type="text" name="name"
                                            class="mr-5 form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="{{ __('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="col-form-label">{{ __('icon') }}
                                            <small class="text-danger">*</small>
                                        </label>
                                        <input type="hidden" name="icon" value="{{ old('icon') }}" id="icon"
                                            class="@error('icon') is-invalid @enderror" />
                                        <div id="target"></div>
                                        @error('icon')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-plus"></i>&nbsp; {{ __('create') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet"
        href="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css" />
    <x-admin.simple-card-design />
    <style>
        .text--xl {
            font-size: 30px;
            margin: 0;
        }

        .-mt-5 {
            margin-top: -5px;
        }

        .text--xl {
            font-size: 1.5rem !important;
        }

        .text--30px {
            font-size: 30px;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $(function() {
            $("#sortable").sortable({
                opacity: 0.4,
                update: function() {
                    sendTaskOrderToServer('.ui-state-default');
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
                    url: "{{ route('module.faq.category.updateOrder') }}",
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
    </script>
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.min.js"></script>

    <script>
        $('#target').iconpicker({
            align: 'left', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 11,
            footer: true,
            header: true,
            icon: "{{ request()->routeIs('module.faq.category.edit') ? $item->icon : 'fas fa-bomb' }}",
            iconset: 'fontawesome5',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 5,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-success',
            unselectedClass: ''
        });

        $('#target').on('change', function(e) {
            $('#icon').val(e.icon)
        });
    </script>
@endsection
