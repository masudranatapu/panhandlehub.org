<form class="form-horizontal" action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-header">{{ __('about') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <x-forms.label name="about_video_thumb" />
                        <div class="">
                            <input type="file" class="form-control dropify"
                                data-default-file="{{ $aboutVideoThumb }}" name="about_video_thumb" autocomplete="image"
                                data-allowed-file-extensions="jpg png jpeg" accept="image/png, image/jpg, image/jpeg">
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <x-forms.label name="about_background" />
                        <div class="">
                            <input type="file" class="form-control dropify"
                                data-default-file="{{ $aboutBackground }}" name="about_background" autocomplete="image"
                                data-allowed-file-extensions="jpg png jpeg" accept="image/png, image/jpg, image/jpeg">
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <x-forms.label name="about_body" />
                        <div class="">
                            <textarea id="about_ck" class="form-control" name="about_body" placeholder="{{ __('write_the_answer') }}">{{ $aboutcontent }}</textarea>
                            @error('about_body')
                                <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-sync"></i> {{ __('update_about_setting') }}
                </button>
            </div>
        </div>
    </div>
</form>
