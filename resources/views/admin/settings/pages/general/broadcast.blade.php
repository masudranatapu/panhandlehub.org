@extends('admin.settings.pages.general.layout')

@section('general-setting')
<div class="card">
    <form id="recaptchaForm" class="form-horizontal" action="{{ route('settings.general.broadcasting.update') }}"
        method="POST">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="card-title line-height-36">{{ __('pusher_configuration') }}</h6>
            </div>
            <hr>
            <div class="form-group row">
                <x-forms.label name="pusher_app_id" class="col-sm-5" />
                <div class="col-sm-7">
                    <input value="{{ config('zakirsoft.pusher_app_id') }}" name="pusher_app_id" type="text"
                        class="form-control @error('pusher_app_id') is-invalid @enderror" autocomplete="off"
                        placeholder="{{ __('pusher_app_id') }}">
                    @error('pusher_app_id')
                    <span class="text-left invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <x-forms.label name="pusher_app_key" class="col-sm-5" />
                <div class="col-sm-7">
                    <input value="{{ config('zakirsoft.pusher_app_key') }}" name="pusher_app_key" type="text"
                        class="form-control @error('pusher_app_key') is-invalid @enderror" autocomplete="off"
                        placeholder="{{ __('pusher_app_key') }}">
                    @error('pusher_app_key')
                    <span class="text-left invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <x-forms.label name="pusher_app_secret" class="col-sm-5" />
                <div class="col-sm-7">
                    <input value="{{ config('zakirsoft.pusher_app_secret') }}" name="pusher_app_secret" type="text"
                        class="form-control @error('pusher_app_secret') is-invalid @enderror" autocomplete="off"
                        placeholder="{{ __('pusher_app_secret') }}">
                    @error('pusher_app_secret')
                    <span class="text-left invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <x-forms.label name="pusher_app_cluster" class="col-sm-5" />
                <div class="col-sm-7">
                    <input value="{{ config('zakirsoft.pusher_app_cluster') }}" name="pusher_app_cluster"
                        type="text" class="form-control @error('pusher_app_cluster') is-invalid @enderror"
                        autocomplete="off" placeholder="{{ __('pusher_app_cluster') }}">
                    @error('pusher_app_cluster')
                    <span class="text-left invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                    @enderror
                </div>
            </div>
        </div>
        @if (userCan('setting.update'))
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary w-25">
                <i class="fas fa-sync"></i>
                {{ __('update') }}
            </button>
        </div>
        @endif
    </form>
</div>
@endsection
