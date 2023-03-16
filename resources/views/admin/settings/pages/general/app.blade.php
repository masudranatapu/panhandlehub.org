@extends('admin.settings.pages.general.layout')

@section('general-setting')
<div class="card">
    <form action="{{ route('settings.general.app.config.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <h6>{{ __('app_configuration') }}</h6>
            <hr>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <x-forms.label name="{{ __('timezone') }}" />
                        <select name="timezone"
                            class="select2bs4 @error('timezone') is-invalid @enderror timezone-select form-control">
                            @foreach ($timezones as $timezone)
                            <option {{ config('app.timezone') == $timezone->value ? 'selected' : '' }}
                                value="{{ $timezone->value }}">
                                {{ $timezone->value }}
                            </option>
                            @endforeach
                            @error('timezone')
                            <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </select>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <x-forms.label name="{{ __('set_default_language') }}" />--}}
{{--                        <select class="select2bs4 form-control @error('code') is-invalid @enderror" name="code"--}}
{{--                            id="default_language">--}}
{{--                            @foreach ($languages as $language)--}}
{{--                            <option {{ $language->code == env('APP_DEFAULT_LANGUAGE') ? 'selected' : '' }}--}}
{{--                                value="{{ $language->code }}">--}}
{{--                                {{ $language->name }}({{ $language->code }})--}}
{{--                            </option>--}}
{{--                            @endforeach--}}
{{--                            @error('code')--}}
{{--                            <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>--}}
{{--                            @enderror--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    {{-- <div class="form-group">
                        <x-forms.label name="{{ __('set_default_currency') }}" for="inlineFormCustomSelect" />
                        <select name="currency" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                            <option value="" disabled selected>{{ __('Currency') }}
                            </option>
                            @foreach ($currencies as $key => $currency)
                            <option {{ env('APP_CURRENCY') == $currency->code ? 'selected' : '' }}
                                value="{{ $currency->id }}">
                                {{ $currency->name }} ( {{ $currency->code }} )
                            </option>
                            @endforeach
                        </select>
                    </div> --}}
                    {{-- <div class="form-group">
                        <x-forms.label name="free_ad_limit" required="true" />
                        <x-forms.input type="number" name="free_ad_limit" value="{{ $setting->free_ad_limit }}"
                            placeholder="{{ __('free_ad_limit') }}" />
                    </div>
                    <div class="form-group">
                        <x-forms.label name="free_ad_featured_limit" required="true" />
                        <x-forms.input type="number" name="free_featured_ad_limit"
                            value="{{ $setting->free_featured_ad_limit }}"
                            placeholder="{{ __('free_ad_featured_limit') }}" />
                    </div>
                    <div class="form-group">
                        <x-forms.label name="maximum_ad_image_limit" required="true" />
                        <x-forms.input type="number" name="maximum_ad_image_limit"
                            value="{{ $setting->maximum_ad_image_limit }}"
                            placeholder="{{ __('maximum_ad_image_limit') }}" />
                    </div> --}}
                    {{-- <div class="form-group">
                        <x-forms.label name="default_subscription_type" required="true" />
                        <select name="subscription_type" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                            <option {{ $setting->subscription_type == 'one_time' ? 'selected' : '' }} value="one_time">
                                {{ __('one_time') }}
                            </option>
                            <option {{ $setting->subscription_type == 'recurring' ? 'selected' : '' }}
                                value="recurring">
                                {{ __('recurring') }}
                            </option>
                        </select>
                    </div> --}}
                </div>


                <div class="col-6">
{{--                    <div class="form-group">--}}
{{--                        <x-forms.label name="{{ __('app_debug') }}" />--}}
{{--                        <div>--}}
{{--                            <input type="hidden" name="app_debug" value="0" />--}}
{{--                            <input type="checkbox" id="app_debug" {{ env('APP_DEBUG') ? 'checked' : '' }}--}}
{{--                                name="app_debug" data-bootstrap-switch data-on-color="success"--}}
{{--                                data-on-text="{{ __('on') }}" data-off-color="default" data-off-text="{{ __('off') }}"--}}
{{--                                data-size="small" value="1">--}}
{{--                            <x-forms.error name="app_debug" />--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    {{-- <div class="form-group">
                        <x-forms.label name="{{ __('frontend_language_switcher') }}" :required="true" />
                        <div>
                            <input type="hidden" name="language_changing" value="0" />
                            <input type="checkbox" id="language_changing"
                                {{ $setting->language_changing ? 'checked' : '' }} name="language_changing"
                                data-on-color="success" data-bootstrap-switch data-on-text="{{ __('show') }}"
                                data-off-color="default" data-off-text="{{ __('hide') }}" data-size="small" value="1">
                            <x-forms.error name="language_changing" />
                        </div>
                    </div> --}}
                    {{-- <div class="form-group">
                        <x-forms.label name="{{ __('frontend_currency_switcher') }}" :required="true" />
                        <div>
                            <input type="hidden" name="currency_changing" value="0" />
                            <input type="checkbox" id="currency_changing"
                                {{ $setting->currency_changing ? 'checked' : '' }} name="currency_changing"
                                data-on-color="success" data-bootstrap-switch data-on-text="{{ __('show') }}"
                                data-off-color="default" data-off-text="{{ __('hide') }}" data-size="small" value="1">
                            <x-forms.error name="currency_changing" />
                        </div>
                    </div> --}}
{{--                    @dd($setting->email_verification)--}}
                    <div class="form-group">
                        <x-forms.label name="{{ __('customer_email_verification') }}" :required="true" />
                        <div>
{{--                            <input type="hidden" name="email_verification" value="0" />--}}
                            <input type="checkbox" id="email_verification"
                                {{ $setting->email_verification == 1 ? 'checked' : '' }} name="email_verification"
                                data-on-color="success" data-bootstrap-switch data-on-text="{{ __('on') }}"
                                data-off-color="default" data-off-text="{{ __('off') }}" data-size="small" value="1">
                            <x-forms.error name="email_verification" />
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <x-forms.label name="website_loader" required="true" class="d-block" />
                        <input type="checkbox" name="website_loader" {{ $setting->website_loader ? 'checked' : '' }}
                            data-bootstrap-switch value="1">
                    </div>
                    <div class="form-group">
                        <x-forms.label name="show_featured_ads_on_homepage" required="true" class="d-block" />
                        <input type="checkbox" name="featured_ads_homepage"
                            {{ $setting->featured_ads_homepage ? 'checked' : '' }} data-bootstrap-switch value="1">
                    </div> --}}
                    {{-- <div class="form-group">
                        <x-forms.label name="show_regular_ads_on_homepage" required="true" class="d-block" />
                        <input type="checkbox" name="regular_ads_homepage"
                            {{ $setting->regular_ads_homepage ? 'checked' : '' }} data-bootstrap-switch value="1">
                    </div>
                    <div class="form-group">
                        <x-forms.label name="customer_email_verification" required="true" class="d-block" />
                        <input type="checkbox" name="customer_email_verification"
                            {{ $setting->customer_email_verification ? 'checked' : '' }} data-bootstrap-switch
                            value="1">
                    </div> --}}
                    {{-- <div class="form-group">
                        <x-forms.label name="ads_admin_approval" required="true" class="d-block" />
                        <input type="checkbox" name="ads_admin_approval"
                            {{ $setting->ads_admin_approval ? 'checked' : '' }} data-bootstrap-switch value="1">
                    </div> --}}
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
<style>
    .custom-file-label::after {
        left: 0;
        right: auto;
        border-left-width: 0;
        border-right: inherit;
    }
    span.bootstrap-switch-handle-off.bootstrap-switch-default{
        height: 35px !important;
    }
</style>
@endsection

@section('script')
<script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
    $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script>
    $('.custom-file input').change(function (e) {
        var files = [];
        for (var i = 0; i < $(this)[0].files.length; i++) {
            files.push($(this)[0].files[i].name);
        }
        $(this).next('.custom-file-label').html(files.join(', '));
    });
</script>
<script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
@endsection
