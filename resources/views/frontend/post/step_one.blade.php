@extends('frontend.layouts.app')
@section('meta')

@endsection
@section('title')
{{ __('Post Type') }}
@endsection
@push('style')
@endpush

@section('breadcrumb')
<ul>
    {{-- <li>{{__('panhandlehub')}}</li> --}}
</ul>
@endsection

@section('content')
<div class="main_template mt-5">
    <div class="container">
        <div class="ad_post_form choose_category">
            <div class="mb-5">
                <p>please limit each posting to a single area and category, once per 48 hours</p>
                <h6><span>what type of posting is this:</span> (see <a href="{{ route('frontend.ban') }}">ban</a> list before posting.)
                </h6>
            </div>
            <form action="{{ route('frontend.post.create') }}" method="get" id="create-post-frm">
                @foreach($add_types as $key => $value)
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="{{ $value ->slug}}" name="ad_type"
                        id="category_{{ $value->id }}" required>
                    <label class="form-check-label" for="category_{{ $value->id }}">
                        {{ __($value->name) }} <small><strong>
                                @if($value->is_paid == 1)
                                (${{ $value->amount }} Per Post)
                                @endif
                            </strong></small>
                    </label>
                    @error('ad_type')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                @endforeach
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $("input[name='ad_type']").click(function(){

    var ad_type = $('input[name="ad_type"]:checked').val();
    var action = $('#create-post-frm').attr('action');
    var url = action + '/'+ad_type;
    window.location.href = url;


    })

</script>

@endpush
