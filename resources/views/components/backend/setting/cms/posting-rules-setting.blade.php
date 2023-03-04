<form class="form-horizontal" action="{{ route('admin.posting.rules.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-header">{{ __('posting_rules') }}</div>
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="posting_rules_background" />
                        <input type="file" class="form-control dropify"
                            data-default-file="{{ $postingRulesBackground }}" name="posting_rules_background"
                            autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                            accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="posting_rules_body" />
                        <textarea id="rules" class="form-control" name="posting_rules_body" placeholder="{{ __('write_the_answer') }}">{{ $rules }}</textarea>
                        @error('posting_rules_body')
                            <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-sync"></i> {{ __('update_posting_rules_setting') }}
                </button>
            </div>
        </div>
    </div>
</form>
