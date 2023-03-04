<form class="form-horizontal" action="{{ route('admin.privacy.update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-header">
            {{ __('privacy_policy') }}
        </div>
        <div class="card-body">
            <div class="row">
                {{-- <div class="col-md-12 mt-5">
                    <div class="form-group">
                        <x-forms.label name="privacy_background" />
                        <input type="file" class="form-control dropify" data-default-file="{{ $privacyBackground }}"
                            name="privacy_background" autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                            accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div> --}}
                <div class="col-md-12 -mt--5">
                    <div class="form-group">
                        <x-forms.label name="" :required="false" />
                        <input type="hidden" class="d-none" value="{{ request('lang_query') }}" name="language_code"
                            readonly>
                        {{-- <div class="d-flex flex-wrap">
                            @foreach ($languages as $language)
                                <a href="{{ route('admin.privacy.store', ['lang_query' => $language->code]) }}"
                                    class="a-color mt-2">
                                    <div class="filtertags close-tag pointer mr-2">
                                        <div
                                            class="single-tag {{ request('lang_query') == $language->code || (!request('lang_query') && $language->code == 'en') ? 'single-tag-active' : '' }}">
                                            {{ $language->name }}
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div> --}}
                    </div>
                    <div class="form-group">
                        <x-forms.label name="privacy_body" />
                        <textarea id="privacy_ck" class="form-control" name="privacy_body" placeholder="{{ __('write_the_answer') }}">
                                {{ $privacyContent ? $privacyContent->text : $privacy }}
                            </textarea>
                        @error('privacy_body')
                            <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                        @enderror
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
