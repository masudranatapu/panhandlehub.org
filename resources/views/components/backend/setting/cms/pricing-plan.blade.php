<form class="form-horizontal" action="{{ route('admin.pricingplan.update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-header">{{ __('price_plan') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="pricing_plan_background" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $cms->pricing_plan_background }}" name="pricing_plan_background"
                            autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                            accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-sync"></i> {{ __('upate_pricing_plan_settings') }}
                </button>
            </div>
        </div>
    </div>
</form>
