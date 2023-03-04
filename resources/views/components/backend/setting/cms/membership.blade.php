<form class="form-horizontal" action="{{ route('admin.getmembership.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-header">{{ __('membership') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="get_membership_background" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $cms->get_membership_background }}" name="get_membership_background"
                            autocomplete="image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="get_membership_image" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $cms->get_membership_image }}" name="get_membership_image"
                            autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                            accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-sync"></i> {{ __('upate_membership_settings') }}
                </button>
            </div>
        </div>
    </div>
</form>
