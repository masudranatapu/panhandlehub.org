<form class="form-horizontal" action="{{ route('admin.maintenance.update') }}" method="POST">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-header">{{ __('maintenance') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="maintenance_title" />
                        <input type="text" class="form-control" name="maintenance_title" id="maintenance_title"
                            value="{{ old('maintenance_title', $cms->maintenance_title) }}">
                        @error('maintenance_title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="maintenance_subtitle" />
                        <input type="text" class="form-control" name="maintenance_subtitle" id="maintenance_subtitle"
                            value="{{ old('maintenance_subtitle', $cms->maintenance_subtitle) }}">
                        @error('maintenance_subtitle')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-sync"></i> {{ __('update_content') }}
                </button>
            </div>
        </div>
    </div>
</form>
