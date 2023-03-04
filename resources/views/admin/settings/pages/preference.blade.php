@extends('admin.settings.setting-layout')
@section('title')
    {{ __('preferences') }}
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
                <li class="breadcrumb-item active">{{ __('preferences') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            {{ __('website_configuration') }}
        </h3>
    </div>
    <div class="card-body">
            <div class="col-sm-12">
                <div class="alert alert-warning">
                    {{ __('leave_the_social_media_input_field_empty_to_remove_the_link_from_website') }}
                </div>
            </div>
            <form class="form-horizontal" action="{{ route('settings.website.configuration.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row ">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <x-forms.label name="facebook" :required="false" />
                                    <input type="text" name="facebook" class="form-control"
                                        value="{{ $settings->facebook }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <x-forms.label name="twitter" :required="false" />
                                    <input type="text" name="twitter" class="form-control"
                                        value="{{ $settings->twitter }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <x-forms.label name="instagram" :required="false" />
                                    <input type="text" name="instagram" class="form-control"
                                        value="{{ $settings->instagram }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <x-forms.label name="youtube" :required="false" />
                                    <input type="text" name="youtube" class="form-control"
                                        value="{{ $settings->youtube }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <x-forms.label name="linkdin" :required="false" />
                                    <input type="text" name="linkdin" class="form-control"
                                        value="{{ $settings->linkdin }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <x-forms.label name="Whatsapp" :required="false" />
                                    <input type="text" name="whatsapp" class="form-control"
                                        value="{{ $settings->whatsapp }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        @if (userCan('setting.update'))
                            <div class="form-group row text-center justify-content-center">
                                <button type="submit" class="btn btn-success" id="setting_button">
                                    <i class="fas fa-sync"></i>
                                    {{ __('update') }}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        {{-- <div class="col-lg-6 col-12">
            <!-- Application Mode -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('application_mode') }}
                    </h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('settings.system.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="d-flex justify-content-between">
                            <div class="col-md-4">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="live-mode" name="app_mode" class="custom-control-input"
                                        value="live" {{ config('app.mode') == 'live' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="live-mode">
                                        {{ __('live_mode') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="maintenance-mode" name="app_mode" class="custom-control-input"
                                        value="maintenance" {{ config('app.mode') == 'maintenance' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="maintenance-mode">
                                        {{ __('maintenance_mode') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="comingsoon-mode" name="app_mode"
                                        class="custom-control-input" value="comingsoon"
                                        {{ config('app.mode') == 'comingsoon' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="comingsoon-mode">
                                        {{ __('coming_soon_mode') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            @if (userCan('setting.update'))
                                <div class="form-group row text-center justify-content-center">
                                    <button type="submit" class="btn btn-success" id="setting_button">
                                        <i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        {{-- <div class="col-lg-6 col-12">
            <!-- MAp -->
            <div class="card">
                <form id="" class="form-horizontal" action="{{ route('module.map.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="from_preference" value="true">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title" style="line-height: 36px;">{{ __('map_configuration') }}
                            </h3>
                        </div>
                    </div> --}}
                    <!-- ============== for text =============== -->
                    {{-- <div class="card-body card-body-pt">
                        <div class="justify-content-center">
                            <div id="text-card" class="card-body">
                                <div class="form-group">
                                    <x-forms.label name="map_type" class="" />
                                    <div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input onclick="changeMapType()" type="radio" id="leaflet-map"
                                                name="map_type" class="custom-control-input" value="leaflet"
                                                {{ setting('default_map') == 'leaflet' ? 'checked' : '' }}>
                                            <label class="custom-control-label"
                                                for="leaflet-map">{{ __('leaflet') }}</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input onclick="changeMapType()" type="radio" id="mapp-box"
                                                name="map_type" class="custom-control-input" value="map-box"
                                                {{ setting('default_map') == 'map-box' ? 'checked' : '' }}>
                                            <label class="custom-control-label"
                                                for="mapp-box">{{ __('map_box') }}</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input onclick="changeMapType()" type="radio" id="google-mapp"
                                                name="map_type" class="custom-control-input" value="google-map"
                                                {{ setting('default_map') == 'google-map' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="google-mapp">
                                                {{ __('google_map') }}
                                            </label>
                                        </div>
                                    </div> --}}
                                    {{-- <select name="map_type"
                                        class="form-control @error('watermark_type') is-invalid @enderror"
                                        id="">
                                        <option {{ setting('default_map') == 'map-box' ? 'selected' : '' }}
                                            value="map-box">
                                            {{ __('map_box') }}
                                        </option>
                                        <option {{ setting('default_map') == 'google-map' ? 'selected' : '' }}
                                            value="google-map">
                                            {{ __('google_map') }}
                                        </option>
                                    </select>
                                    @error('map_type')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror --}}
                                {{-- </div>
                                <!-- map-box key  -->
                                <div id="mapbox_key"
                                    class="form-group {{ setting('default_map') == 'map-box' ? '' : 'd-none' }} ">
                                    <div class="pt-2">
                                        <x-forms.label name="map_box_key" class="" />
                                        <input value="{{ setting('map_box_key') }}" name="map_box_key" type="text"
                                            class="form-control @error('map_box_key') is-invalid @enderror"
                                            autocomplete="off" placeholder="{{ __('map_box_key') }}">
                                        @error('map_box_key')
                                            <span class="text-left invalid-feedback"
                                                role="alert"><span>{{ $message }}</span></span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- google map key  -->
                                <div id="googlemap_key"
                                    class="form-group {{ setting('default_map') == 'google-map' ? '' : 'd-none' }}">
                                    <div class="pt-2">
                                        <x-forms.label name="google_map_key" class="" />
                                        <input value="{{ setting('google_map_key') }}" name="google_map_key"
                                            type="text"
                                            class="form-control @error('google_map_key') is-invalid @enderror"
                                            autocomplete="off" placeholder="{{ __('google_map_key') }}">
                                        @error('google_map_key')
                                            <span class="text-left invalid-feedback"
                                                role="alert"><span>{{ $message }}</span></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div> --}}
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
        $('[data-toggle="tooltip"]').tooltip()

        $("#app_debug").bootstrapSwitch();
        $("#facebook_pixel").bootstrapSwitch();
        $("#google_analytics").bootstrapSwitch();
        $("#language_changing").bootstrapSwitch();
        $("#currency_changing").bootstrapSwitch();
        $("#search_engine_indexing").bootstrapSwitch();
        $("#maintenance_mode").bootstrapSwitch();
        $("#commingsoon_mode").bootstrapSwitch();
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    </script>
    <script>
        function changeMapType(value) {
            var value = $("[name='map_type']:checked").val();

            if (value == 'google-map') {
                $('#googlemap_key').removeClass('d-none');
                $('#mapbox_key').addClass('d-none');
            } else if (value == 'map-box') {
                $('#mapbox_key').removeClass('d-none');
                $('#googlemap_key').addClass('d-none');
            } else {
                $('#mapbox_key').addClass('d-none');
                $('#googlemap_key').addClass('d-none');
            }
        }

        // $('select[name="map_type"]').on('change', function() {
        //     var value = $(this).val();
        //     if (value == 'google-map') {
        //         $('#googlemap_key').removeClass('d-none');
        //         $('#mapbox_key').addClass('d-none');
        //     } else {
        //         $('#mapbox_key').removeClass('d-none');
        //         $('#googlemap_key').addClass('d-none');
        //     }
        // })
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <style>
        .card-body-pt {
            padding-top: 0 !important;
        }

        #searchInput {
            font-family: 'Roboto';
            background-color: #fff;
            font-size: 16px;
            text-overflow: ellipsis;
            margin-left: 16px;
            font-weight: 400;
            width: 30%;
            padding: 0 11px 0 13px;
        }

        #searchInput:focus {
            border-color: #4d90fe;
        }

        .tooltip-inner {
            background: #2a2626;
            max-width: 350px;
            width: 350px;
        }
    </style>
    <!-- >=>Mapbox<=< -->
@endsection
