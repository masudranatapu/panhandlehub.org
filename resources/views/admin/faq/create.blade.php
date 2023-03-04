@extends('admin.layouts.app')
@section('style')
    <!-- Bootstrap-Iconpicker -->
   
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('title')
    {{ __('FAQ Create') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('Faq') }}</h3>
                        <a href="{{ route('city.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('faq.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group row">
                                    <x-forms.label name="Question" required="true" class="col-sm-3 col-form-label" />
                                    <div class="col-sm-9">
                                        <input value="{{ old('question') }}" name="question" type="text"
                                            class="form-control @error('question') is-invalid @enderror"
                                            placeholder="{{ __('Question') }}">
                                        @error('question')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="Answer" required="true" class="col-sm-3 col-form-label" />
                                    <div class="col-sm-9">
                                        <textarea name="answer" id="answer" cols="30" rows="4" class="form-control @error('answer') is-invalid @enderror"></textarea>
                                        @error('answer')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-plus"></i>&nbsp; {{ __('create') }}
                                        </button>
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



@section('script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
$(document).ready(function() {
    $(".select2").select2();
});
@endsection
