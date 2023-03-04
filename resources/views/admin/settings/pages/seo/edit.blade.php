@extends('admin.settings.setting-layout')

@section('title')
    {{ __('edit') }}
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
                <li class="breadcrumb-item active">{{ __('edit_seo') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div width="100%" class="d-flex justify-content-between card-header1">
                            <h3 width="100%" class="card-title line-height-36">
                                {{ __('seo_page_list') }}
                                <div class="badge badge-primary ml-1">
                                    {{ Str::ucfirst($seo->page_slug) }}
                                </div>
                            </h3>
                            <a width="100%" class="btn bg-primary"
                                href="{{ route('settings.seo.index', ['lang_query' => request('lang_query')]) }}">
                                {{ __('back') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <form id="language_code_form" action="{{ route('settings.seo.content.create') }}" method="POST"
                                class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label name="Language" class="col-sm-2" />
                                    <div class="col-sm-10">
                                        <input type="hidden" class="d-none" name="page_id" value="{{ $seo->id }}">
                                        <input type="hidden" id="language_code_input" class="d-none" name="language_code"
                                            value="">
                                        @foreach ($languages as $key => $language)
                                            <button type="button" onclick="createContent('{{ $language->code }}')"
                                                class="c-btn btn btn-sm btn-outline-primary {{ request('lang_query') == $language->code ? 'btn-primary text-white' : 'btn-outline-primary' }}">
                                                {{ $language->name }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('settings.seo.content.update', $content->id) }}" class="form-horizontal"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <x-forms.label name="Title" class="col-sm-2" />
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" value="{{ $content->title }}" id="inputName"
                                            placeholder="{{ __('Title') }}">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <x-forms.label name="Keywords" class="col-sm-2" />
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('keywords') is-invalid @enderror" cols="4" rows="2"
                                            name="keywords" id="keywords" placeholder="{{ __('Keywords') }}">{{ $content->keywords }}</textarea>
                                        @error('keywords')
                                            <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="description" class="col-sm-2" for="inputExperience">
                                        <small class="d-block">
                                            {{ __('standard_seo_meta_descriptions_consist_160_165_characters_maximum') }}
                                            <a href="https://www.searchenginejournal.com/on-page-seo/optimize-meta-description"
                                                target="_blank">{{ __('learn_more') }}</a>
                                        </small>
                                    </x-forms.label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('description') is-invalid @enderror" cols="4" rows="4"
                                            name="description" id="description" placeholder="{{ __('Description') }}">{{ $content->description }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="Image" class="col-sm-2">
                                        <small class="d-block">
                                            {{ __('it_should_be_at_least_pixels_but_or_larger_is_preferred_up_to_mb') }}
                                        </small>
                                    </x-forms.label>
                                    <div class="col-sm-10">
                                        <input type="file" data-default-file="{{ asset($content->image) }}"
                                            class="form-control dropify" name="image" id="image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-info">{{ __('update') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="card-body card border table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>{{ __('translation_available_in') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contents as $content)
                                    <tr>
                                        <td>
                                            {{ $content->name }}
                                            ({{ Str::ucfirst($content->language_code) }})
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('settings.seo.edit', [$seo->id, 'lang_query' => $content->language_code]) }}">
                                                <button class="btn bg-info">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </a>
                                            @if ($content->language_code !== 'en')
                                                <form action="{{ route('module.seo.content.delete') }}" method="POST"
                                                    class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="page_id" value="{{ $seo->id }}">
                                                    <input type="hidden" name="content_id" value="{{ $content->id }}">
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete this item?');"
                                                        class="btn bg-danger"><i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            {{ __('no_data_found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
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
