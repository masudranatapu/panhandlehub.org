@extends('admin.settings.pages.general.layout')

@section('general-setting')
<div class="card">
    {{-- <form id="watermarkForm" class="form-horizontal" action="{{ route('settings.general.watermark.update') }}"
        method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
            <h6>{{ __('watermark_on_ads_images') }}</h6>
            <hr>
            <!-- ============== for text =============== -->
            <div>
                <div id="text-card" class="card-body">
                    <div class="form-group row">
                        <x-forms.label name="watermark_type" class="col-sm-5" />
                        <div class="col-sm-7">
                            <select name="watermark_type"
                                class="form-control @error('watermark_type') is-invalid @enderror" id="">
                                <option {{ setting('watermark_type') == 'text' ? 'selected' : '' }}
                                    value="text">
                                    {{ __('text') }}
                                </option>
                                <option {{ setting('watermark_type') == 'image' ? 'selected' : '' }}
                                    value="image">
                                    {{ __('image') }}
                                </option>
                            </select>
                            @error('watermark_type')
                                <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <!-- text -->
                    <div id="text-div" class="{{ setting('watermark_type') == 'text' ? '' : 'd-none' }}">
                        <div class="form-group row">
                            <x-forms.label name="text" class="col-sm-5" />
                            <div class="col-sm-7">
                                <input value="{{ setting('watermark_text') }}" name="text" type="text"
                                    class="form-control @error('text') is-invalid @enderror" autocomplete="off">
                                @error('text')
                                <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- image -->
                    <div id="image-div" class="{{ setting('watermark_type') == 'image' ? '' : 'd-none' }}">
                        <div class="form-group row">
                            <x-forms.label name="image" class="col-sm-5" />
                            <div class="col-sm-7">
                                <div class="custom-file">
                                    <input
                                        onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                        type="file" name="image"
                                        class="custom-file-input  @error('image') is-invalid @enderror"
                                        id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">
                                        {{ setting('watermark_image') }}
                                    </label>
                                </div>
                                @error('image')
                                <span class="text-md text-danger text-black" role=""><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                        </div>
                        <div class="pt-4 form-group row text-center d-flex align-items-center">
                            <div class="offset-6 col-sm-12 col-md-6">
                                <img id="image" width="100" src="{{ asset(setting('watermark_image')) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (userCan('setting.update'))
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary w-25">
                <i class="fas fa-sync"></i>
                {{ __('update') }}
            </button>
        </div>
        @endif
    </form> --}}
</div>
@endsection


@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>
        $('.dropify').dropify();
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $('input[name="watermark_type"]').on('switchChange.bootstrapSwitch', function(event, state) {

            var value = event.target.defaultValue;
            if (value == 'text') {
                $('#text-card').addClass('d-none');
                $('#image-card').removeClass('d-none');
                $('#imageInput').bootstrapSwitch('state', false);
            } else {
                $('#textInput').bootstrapSwitch('state', true);
                $('#text-card').removeClass('d-none');
                $('#image-card').addClass('d-none');
            }
        });

        $('select[name="watermark_type"]').on('change', function() {
            if ($(this).val() == 'image') {
                $('#text-div').addClass('d-none');
                $('#image-div').removeClass('d-none');
            } else {
                $('#text-div').removeClass('d-none');
                $('#image-div').addClass('d-none');
            }
        })


    </script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
@endsection
