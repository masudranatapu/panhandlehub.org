@extends('frontend.layouts.app', ['nav' => 'yes'])
@section('meta')

@endsection
@push('style')
@endpush
@section('title')
{{ __('Sub Category') }}
@endsection
@section('breadcrumb')
    <ul>
        <li>{{ __($ad_type->slug) }} ></li>
        <li>{{ __($category->slug) }}</li>
    </ul>
@endsection

@section('content')
    <div class="main_template mt-5">
        <div class="container">
            <div class="ad_post_form">
                <div class="mb-4">
                    <h6><span>choose a Sub Category:</span> (see <a href="#">ban</a> list before posting.)
                    </h6>
                </div>
                <form action="{{ route('frontend.post.create') }}" method="get" id="create-post-frm">
                    <input type="hidden" value="{{ $ad_type->slug }}" name="ad_type" />
                    <input type="hidden" value="{{ $category->slug }}" name="category" />
                    @foreach($subCategory as $key => $value)
                    <div class="form-check">
            <input class="form-check-input" type="radio" value="{{ $value->slug}}" name="sub_category" id="category_{{ $value->id }}"
                            required>
                        <label class="form-check-label" for="category_{{ $value->id }}">
                            {{ __($value->slug) }}
                        </label>
                    </div>
                    @endforeach
                    <div class="mt-5">
                           <button type="button" class="btn btn-light">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    $("input[name='sub_category']").click(function(){

    var ad_type = $('input[name="ad_type"]').val();
    var category = $('input[name="category"]').val();
    var sub_category = $('input[name="sub_category"]:checked').val();
    var action = $('#create-post-frm').attr('action');
    var url = action + '/'+ad_type+'/'+category+'/'+sub_category;
    window.location.href = url;


    })

</script>

@endpush
