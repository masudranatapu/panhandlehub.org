@extends('admin.layouts.app')
@section('title')
    {{ __('create') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('create') }}</h3>
                        <a href="{{ route('module.faq.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('module.faq.store') }}" method="POST">
                                @csrf
                                <div class="form-group row mb-15">
                                    <label class="col-sm-3 form-label">{{ __('language') }}
                                        <small class="text-danger">*</small>
                                    </label>
                                    <div class="col-sm-9">
                                        <div class="d-flex">
                                            @foreach ($app_languages as $lang)
                                                <div class="custom-control custom-radio">
                                                    <input class="d-none" type="radio" id="lang_code_{{ $lang->id }}"
                                                        name="code" {{ $lang->code == old('code') ? 'checked' : '' }}
                                                        value="{{ $lang->code }}">
                                                    <label onclick="pushClass('lang_code_button_{{ $lang->id }}')"
                                                        for="lang_code_{{ $lang->id }}">
                                                        <span type="button" id="lang_code_button_{{ $lang->id }}"
                                                            class="c-btn btn btn-sm btn-outline-primary">
                                                            {{ $lang->name }}
                                                        </span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('code')
                                            <div class="text-danger font-size-13">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-15">
                                    <label class="col-sm-3 form-label">{{ __('select_one') }}<small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <select name="faq_category_id"
                                            class="form-control @error('faq_category_id') is-invalid @enderror w-100-p">
                                            @foreach ($faq_categories as $faq_category)
                                                <option value="{{ $faq_category->id }}"> {{ $faq_category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('faq_category_id')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('question') }}<small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input value="{{ old('question') }}" name="question" type="text"
                                            class="form-control @error('question') is-invalid @enderror"
                                            placeholder="{{ __('enter') }} {{ __('question') }}">
                                        @error('question')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('answer') }}<small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <textarea id="editor2" type="text" class="form-control" name="answer"
                                            placeholder="{{ __('enter') }} {{ __('answer') }}... ">{{ old('answer') }}</textarea>
                                        @error('answer')
                                            <span class="text-danger font-size-13">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;
                                            {{ __('create') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .ck-editor__editable_inline {
            min-height: 170px;
        }

        .c-btn {
            padding-left: 22px;
            padding-right: 22px;
            border-radius: 15px;
        }

        .custom-control {
            position: relative;
            z-index: 1;
            display: block;
            min-height: 1.5rem;
            padding-left: 0;
            padding-right: 1.5rem;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
    </style>
@endsection

@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });

        function pushClass(arg) {
            $('.c-btn').removeClass('btn-primary text-white');
            $('#' + arg).addClass('btn-primary text-white');
        }
    </script>
@endsection
