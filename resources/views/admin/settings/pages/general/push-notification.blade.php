@extends('admin.settings.pages.general.layout')

@section('general-setting')
<div class="card">
    <form class="form-horizontal" action="{{ route('settings.general.push-notification.update') }}"
        method="POST">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">
                    {{ __('firebase_push_notification_configuration') }}
                    <span class="red-tooltip" data-toggle="tooltip" title="Firebase Cloud Messaging gives you infrastructure to send messages across devices. Easily send messages and notifications across multiple platforms to engage your app users.
                            You can get your credentials in https://console.firebase.google.com/">
                        <x-svg.info-icon />
                    </span>
                </h3>
                <div>
                    <input type="checkbox" name="push_notification_status" data-on-color="success" class="form-control" data-on-text="{{ __('on') }}" data-off-color="default" data-off-text="{{ __('off') }}" data-bootstrap-switch value="1" {{ $setting->push_notification_status ? 'checked' : '' }}>
                </div>
            </div>
            @if ($setting->push_notification_status)
            <hr>
            <div class="card-body card-body-pt">
                <div class="justify-content-center">
                    <div class="form-group row">
                        <x-forms.label name="server_key" class="col-sm-5" />
                        <div class="col-sm-7">
                            <input value="{{ $setting->server_key }}" name="server_key" type="text"
                                class="form-control @error('server_key') is-invalid @enderror" autocomplete="off"
                                placeholder="{{ __('server_key') }}">
                            @error('server_key')
                            <span class="text-left invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label name="api_key" class="col-sm-5" />
                        <div class="col-sm-7">
                            <input value="{{ $setting->api_key }}" name="api_key" type="text"
                                class="form-control @error('api_key') is-invalid @enderror" autocomplete="off"
                                placeholder="{{ __('api_key') }}">
                            @error('api_key')
                            <span class="text-left invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label name="auth_domain" class="col-sm-5" />
                        <div class="col-sm-7">
                            <input value="{{ $setting->auth_domain }}" name="auth_domain" type="text"
                                class="form-control @error('auth_domain') is-invalid @enderror" autocomplete="off"
                                placeholder="{{ __('auth_domain') }}">
                            @error('auth_domain')
                            <span class="text-left invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label name="project_id" class="col-sm-5" />
                        <div class="col-sm-7">
                            <input value="{{ $setting->project_id }}" name="project_id" type="text"
                                class="form-control @error('project_id') is-invalid @enderror" autocomplete="off"
                                placeholder="{{ __('project_id') }}">
                            @error('project_id')
                            <span class="text-left invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label name="storage_bucket" class="col-sm-5" />
                        <div class="col-sm-7">
                            <input value="{{ $setting->storage_bucket }}" name="storage_bucket" type="text"
                                class="form-control @error('storage_bucket') is-invalid @enderror" autocomplete="off"
                                placeholder="{{ __('storage_bucket') }}">
                            @error('storage_bucket')
                            <span class="text-left invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label name="messaging_sender_id" class="col-sm-5" />
                        <div class="col-sm-7">
                            <input value="{{ $setting->messaging_sender_id }}" name="messaging_sender_id" type="text"
                                class="form-control @error('messaging_sender_id') is-invalid @enderror"
                                autocomplete="off" placeholder="{{ __('messaging_sender_id') }}">
                            @error('messaging_sender_id')
                            <span class="text-left invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label name="app_id" class="col-sm-5" />
                        <div class="col-sm-7">
                            <input value="{{ $setting->app_id }}" name="app_id" type="text"
                                class="form-control @error('app_id') is-invalid @enderror" autocomplete="off"
                                placeholder="{{ __('app_id') }}">
                            @error('app_id')
                            <span class="text-left invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label name="measurement_id" class="col-sm-5" />
                        <div class="col-sm-7">
                            <input value="{{ $setting->measurement_id }}" name="measurement_id" type="text"
                                class="form-control @error('measurement_id') is-invalid @enderror" autocomplete="off"
                                placeholder="{{ __('measurement_id') }}">
                            @error('measurement_id')
                            <span class="text-left invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @if (userCan('setting.update') && $setting->push_notification_status)
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



@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
        $('[data-toggle="tooltip"]').tooltip()

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    </script>
    <script>
        $('input[name="push_notification_status"]').on('switchChange.bootstrapSwitch', function(event, state) {

            var value = state ? 1 : 0;

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('settings.general.push-notification.status.update') }}",
                data: {
                    status: value,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(error) {
                    location.reload();
                }
            });
        });
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
