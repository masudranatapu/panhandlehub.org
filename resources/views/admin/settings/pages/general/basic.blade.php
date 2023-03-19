@extends('admin.settings.pages.general.layout')

@section('general-setting')
    <div class="card">
        <form class="form-horizontal" action="{{ route('settings.general.update') }}" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <h6>{{ __('brand_information') }}</h6>
                <hr>
                <div class="row ">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="" for="site_name"> {{ __('site_name') }} </label>
                            <input value="{{ config('app.name') }}" name="name" type="text" class="form-control "
                                placeholder="{{ __('enter') }} {{ __('site_name') }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Site Primary Color</label>
                            <input value="{{ $setting->frontend_primary_color }}" name="frontend_primary_color" type="color" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <x-forms.label name="{{ __('logo') }}" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $setting->logo_image_url }}" name="logo_image"
                            data-allowed-file-extensions='["jpg", "jpeg","png","svg"]'
                            accept="image/png, image/jpg,image/svg image/jpeg" data-max-file-size="3M">
                    </div>
                    {{-- <div class="col-sm-4 col-md-4">
                        <x-forms.label name="{{ __('white_logo') }}" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $setting->white_logo_url }}" name="white_logo"
                            data-allowed-file-extensions='["jpg", "jpeg","png","svg"]'
                            accept="image/png, image/jpg,image/svg image/jpeg" data-max-file-size="3M">
                    </div> --}}
                    <div class="col-sm-6 col-md-6">
                        <x-forms.label name="{{ __('favicon') }}" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $setting->favicon_image_url }}" name="favicon_image"
                            data-allowed-file-extensions='["ico","png"]' accept="image/png, image/ico"
                            data-max-file-size="1M">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endsection
