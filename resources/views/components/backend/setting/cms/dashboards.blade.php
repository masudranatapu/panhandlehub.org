<form class="form-horizontal" action="{{ route('admin.dashboard.update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-header">{{ __('dashboard') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="dashboard_overview_background" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $cms->dashboard_overview_background }}"
                            name="dashboard_overview_background" autocomplete="image"
                            data-allowed-file-extensions="jpg png jpeg" accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="dashboard_post_ads_background" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $cms->dashboard_post_ads_background }}"
                            name="dashboard_post_ads_background" autocomplete="image"
                            data-allowed-file-extensions="jpg png jpeg" accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="dashboard_my_ads_background" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $cms->dashboard_my_ads_background }}"
                            name="dashboard_my_ads_background" autocomplete="image"
                            data-allowed-file-extensions="jpg png jpeg" accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="dashboard_favorite_ads_background" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $cms->dashboard_favorite_ads_background }}"
                            name="dashboard_favorite_ads_background" autocomplete="image"
                            data-allowed-file-extensions="jpg png jpeg" accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="dashboard_messenger_background" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $cms->dashboard_messenger_background }}"
                            name="dashboard_messenger_background" autocomplete="image"
                            data-allowed-file-extensions="jpg png jpeg" accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="dashboard_plan_background" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $cms->dashboard_plan_background }}" name="dashboard_plan_background"
                            autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                            accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
                <div class=" col-md-6">
                    <div class="form-group">
                        <x-forms.label name="dashboard_account_setting_background" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $cms->dashboard_account_setting_background }}"
                            name="dashboard_account_setting_background" autocomplete="image"
                            data-allowed-file-extensions="jpg png jpeg" accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-sync"></i> {{ __('update_home_settings') }}
                </button>
            </div>
        </div>
    </div>
</form>
