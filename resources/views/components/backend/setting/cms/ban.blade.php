<form class="form-horizontal" action="{{ route('admin.ban.update') }}" method="POST">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-header">
            {{ __('Ban Text') }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <x-forms.label name="ban_text" />
                        <textarea type="text" class="form-control" name="ban_text" id="ban_text">{{ old('ban_text', $cms->ban_text) }}</textarea>
                        @error('ban_text')
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
