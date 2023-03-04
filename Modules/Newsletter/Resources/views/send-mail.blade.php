@extends('admin.layouts.app')
@section('title')
    {{ __('send_mail') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>{{ __('send_mail') }}</h3>
                                <p>
                                    {{ __('you_can_send_a_mail_to_multiple_email_addresses') }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('module.newsletter.index') }}"
                                    class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                    <i class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('module.newsletter.submit_mail') }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <x-forms.label name="to" required="true" class="col-sm-2" />
                                <div class="col-sm-10">
                                    <select name="emails[]" class="select2bs4 @error('emails') is-invalid @enderror"
                                        style="width: 100%;" multiple
                                        data-placeholder="{{ __('start_typing_for_search') }}">
                                        @foreach ($emails as $email)
                                            <option {{ collect(old('emails'))->contains($email->id) ? 'selected' : '' }}
                                                value="{{ $email->email }}">{{ $email->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('emails')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <x-forms.label name="subject" required="true" class="col-sm-2" />
                                <div class="col-sm-10">
                                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}"
                                        placeholder="{{ __('write_the_subject_here') }}">
                                    @error('subject')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <x-forms.label name="body" required="true" class="col-sm-2" />
                                <div class="col-sm-10">
                                    <textarea id="editor2" type="text" class="form-control" name="body">
                                        {{ old('body') }}
                                    </textarea>
                                    @error('body')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-success">
                                        <i class="far fa-paper-plane"></i>
                                        &nbsp;{{ __('send_now') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
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

    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
