@extends('frontend.layouts.app', ['nav' => 'yes'])
@section('meta')

@endsection
@section('title')
{{ __('Category') }}
@endsection
@push('style')
@endpush


@section('breadcrumb')
<div class="breadcrumb_section">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ __($ad_type->name) }} </li>
            </ol>
        </nav>
    </div>
</div>
@endsection
@section('content')
<div class="main_template mt-5">
    <div class="container">
        @if($subCategory && $subCategory->count() > 0)
        <div class="ad_post_form choose_category">
            <div class="mb-4">
                <h6><span>choose a category:</span> (see <a href="{{ route('frontend.ban') }}">ban</a> list before posting.)
                </h6>
            </div>
            <form action="{{ route('frontend.post.create') }}" method="get" id="create-post-frm">
                <input type="hidden" value="{{ $ad_type->slug }}" name="ad_type" />
                @foreach($subCategory as $key => $value)
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="{{ $value ->slug}}" name="category"
                        id="category_{{ $value ->id}}" required>
                    <label class="form-check-label" for="category_{{ $value ->id}}">
                        {{ __($value->name )}}
                    </label>
                    @error('category')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                @endforeach
            </form>
        </div>
        @else
        <div class="ad_post_form">
            <div class="mb-4">
                <h6><span>There is a no category </span> (<a href="{{ route('frontend.index') }}"> Please you should
                        contact admin</a>) </h6>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('script')
<script>
    $("input[name='category']").click(function(){

    var ad_type = $('input[name="ad_type"]').val();
    var category = $('input[name="category"]:checked').val();
    var action = $('#create-post-frm').attr('action');
    var url = action + '/'+ad_type+'/'+category;
    window.location.href = url;


    })

</script>

@endpush
