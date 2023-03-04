@extends('admin.settings.setting-layout')

@section('title')
    {{ __('seo') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('seo') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('website-settings')
    <div class="alert alert-warning mb-3">
        {{ __('improve_your_site_ranking_by_adding_seo_information_to_your_pages') }}
        <hr class="my-2">
        {{ __('seo_is_crucial_because_it_makes_your_website_more_visible_and_that_means_more_traffic_and_more_opportunities_to_convert_prospects_into_customers_check_out_the_seo_tools_you_can_use_for_optimal_ranking') }}
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-md-flex justify-content-between">
                <div class="row">
                    <h3 class="col-12 col-md-8 card-title line-height-36">{{ __('seo_page_list') }}</h3>
                    <div class="d-flex align-items-center col-md-4">
                        @foreach ($languages as $language)
                            <a href="{{ route('settings.seo.index', ['lang_query' => $language->code]) }}" class="a-color">
                                <div class="filtertags close-tag pointer mr-2">
                                    <div
                                        class="single-tag {{ request('lang_query') == $language->code || (!request('lang_query') && $language->code == 'en') ? 'single-tag-active' : '' }}">
                                        {{ $language->name }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="mt-2 mt-md-0">
                    <a href="{{ route('settings.generateSitemap') }}" class="btn btn-primary">
                        {{ __('generate_sitemap') }}
                    </a>
                    <a target="_blank" href="/sitemap.xml" class="btn btn-info">
                        {{ __('view_sitemap') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap table-bordered">
                <thead class="text-center">
                    <tr>
                        <th width="50">#</th>
                        <th style="max-width: 300px;"> {{ __('page_name') }} </th>
                        <th style="max-width: 300px;"> {{ __('meta_title') }} </th>
                        <th style="max-width: 300px;"> {{ __('Meta Keyword') }} </th>
                        <th style="max-width: 500px;">
                            {{ __('meta_description') }}
                            ({{ request('lang_query') ?? __('en') }})
                        </th>
                        <th width="250">{{ __('page_preview_image') }} </th>
                        <th width="100">{{ __('action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($seos->count() > 0)
                        @foreach ($seos as $seo)

                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <div class="badge badge-primary">
                                        {{ Str::ucfirst($seo->page_slug) }}
                                    </div>
                                </td>
                                <td style="max-width: 300px; white-space: normal">
                                    {{ $seo->contents->title ?? '' }}
                                </td>
                                <td style="max-width: 300px; white-space: normal">

                                        {{ $seo->contents->keywords ?? '' }}

                                </td>
                                <td style="max-width: 500px; white-space: normal">

                                    {{ $seo->contents->description  ?? '' }}

                                </td>
                                <td>

                                <img style="height: auto; width: 200px; object-fit: contain"
                                            src="{{ asset($seo->contents->image ?? '') }}" alt="">

                                </td>
                                <td>
                                    <a href="{{ route('settings.seo.edit', [$seo->id, 'lang_query' => request('lang_query') ?? 'en']) }}"
                                        class="btn btn-secondary mr-2">
                                        <i class="fas fa-cog"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">
                                <x-admin.not-found word="{{ __('seo') }}" route="settings.seo.index" method="GET" />
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            @if ($seos->total() > $seos->perPage())
                <div class="mt-3 d-flex justify-content-center">
                    {{ $seos->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('style')
    {{-- Image upload and Preview --}}
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .card-header1 {
            background-color: transparent;
            border-bottom: 1px solid rgba(52, 38, 38, 0.125);
            padding: 0.75rem 1.25rem;
            position: relative;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }

        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }

        .c-btn {
            padding-left: 22px;
            padding-right: 22px;
            border-radius: 15px;
            margin-right: 8px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/dropify.css">
@endsection

@section('script')
    {{-- Image upload and Preview --}}
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/dropify/dropify.min.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $('.dropify').dropify({
            messages: {
                'default': 'Add a Picture',
                'replace': 'New picture',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        function createContent(arg) {
            $('#language_code_input').val(arg);
            $('#language_code_form').submit();
        }
    </script>
@endsection
