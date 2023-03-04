<form class="form-horizontal" action="{{ route('admin.faq.update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-header">{{ __('faq') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="faq_background" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $cms->faq_background }}" name="faq_background" autocomplete="image"
                            data-allowed-file-extensions="jpg png jpeg" accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="faq_content" />
                        <textarea class="form-control" name="faq_content" rows="4">{{ $cms->faq_content }}</textarea>
                        @error('faq_content')
                            <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-sync"></i> {{ __('update_faq_settings') }}
                </button>
            </div>
        </div>
    </div>
</form>
