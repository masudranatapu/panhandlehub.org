<form class="form-horizontal" action="{{ route('admin.footer.text.update') }}" method="POST">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-header">
            {{ __('footer_text') }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="footer_text" />
                        <textarea type="text" class="form-control" name="footer_text" id="footer_text">{{ old('footer_text', $cms->footer_text) }}</textarea>
                        @error('footer_text')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-sync"></i> {{ __('update_content') }}
                </button>
            </div>
        </div>
    </div>
</form>
