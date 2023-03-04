@extends('admin.settings.pages.general.layout')

@section('general-setting')
<div class="card">
    <form id="recaptchaForm" class="form-horizontal" action="{{ route('settings.general.recaptcha.update') }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="card-title line-height-36">
                    {{ __('recaptcha_configuration') }}
                    (<small><a href="https://support.google.com/recaptcha" target="_blank">{{ __('get_help') }}</a></small>)
                </h6>
            </div>
            <hr>
            <div class="form-group row">
                <x-forms.label name="nocaptcha_sitekey" class="col-sm-5" />
                <div class="col-sm-7">
                    <input value="{{ config('captcha.sitekey') }}" name="nocaptcha_key" type="text"
                        class="form-control @error('nocaptcha_key') is-invalid @enderror" autocomplete="off">
                    @error('nocaptcha_key')
                    <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <x-forms.label name="nocaptcha_secret" class="col-sm-5" />
                <div class="col-sm-7">
                    <input value="{{ config('captcha.secret') }}" name="nocaptcha_secret" type="text"
                        class="form-control @error('nocaptcha_secret') is-invalid @enderror" autocomplete="off">
                    @error('nocaptcha_secret')
                    <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <x-forms.label name="{{ __('status') }}" :required="true" class="col-sm-5"/>
                <div class="col-sm-7">
                    <input type="hidden" name="status" value="0" />
                    <input type="checkbox" id="status"
                        {{ config('captcha.active') ? 'checked' : '' }} name="status"
                        data-on-color="success" data-bootstrap-switch data-on-text="{{ __('on') }}"
                        data-off-color="default" data-off-text="{{ __('off') }}"
                        value="1">
                    <x-forms.error name="status" />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-7 offset-sm-5">
                    <div class="input-group text-center">
                        {!! NoCaptcha::display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="text-danger text-sm">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                        @endif
                    </div>
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

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
         $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>
@endsection
