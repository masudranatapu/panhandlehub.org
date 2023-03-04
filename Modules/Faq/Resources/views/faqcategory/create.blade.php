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
                        <a href="{{ route('module.faq.category.index') }}"
                            class="btn bg-success float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}
                        </a>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="container">
                            <form method="POST" action="{{ route('module.faq.category.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('name') }}<small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">{{ __('icon') }}<small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="icon" value="{{ old('icon') }}" id="icon"
                                            class="@error('icon') is-invalid @enderror" />
                                        <div id="target"></div>
                                        @error('icon')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
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
            </div>
        </div>
    </div>
@endsection
