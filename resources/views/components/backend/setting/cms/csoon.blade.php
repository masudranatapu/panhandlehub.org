<form class="form-horizontal" action="{{ route('admin.comingsoon.update') }}" method="POST">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-header">
            {{ __('coming_soon') }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="coming_soon_title" />
                        <input type="text" class="form-control" name="coming_soon_title" id="coming_soon_title"
                            value="{{ old('coming_soon_title', $cms->coming_soon_title) }}">
                        @error('coming_soon_title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="coming_soon_subtitle" />
                        <input type="text" class="form-control" name="coming_soon_subtitle" id="coming_soon_subtitle"
                            value="{{ old('coming_soon_subtitle', $cms->coming_soon_subtitle) }}">
                        @error('coming_soon_subtitle')
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
