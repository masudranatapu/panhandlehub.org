<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($setting->favicon_image) }}">
    <title>@yield('title')</title>
    {{-- meta --}}
    @yield('meta')
    {{-- style --}}
    @include('frontend.layouts.header_script')
    {{-- custom style --}}
    @stack('style')
    <input type="hidden" id="base_url" value="{{ URL('/') }}" />

</head>

<body>
{{--    <div class="{{ Route::is('frontend.index') ? 'd-none d-md-block': '' }}">--}}
        @include('frontend.layouts.header')
{{--    </div>--}}

    {{-- main content --}}
    @yield('content')
    {{-- footer script --}}
    @include('frontend.layouts.footer_script')

    <script>
        function AddWishlist2(item, user) {

                if (user) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('frontend.wishlist.create') }}",
                        data: {
                            id: item,
                            user: user,
                        },
                        success: function(data) {
                            if (data.status == 'failed') {
                                toastr.error('Favorite removed successfully')
                                $("#wishlist_count" ).load(location.href + " #wishlist_count>*", "");
                            } else {
                                toastr.success('Favorite added successfully')

                            }
                            $("#wishlist_count" ).load(location.href + " #wishlist_count>*", "");
                        }
                    });
                } else {
                    $('#wishlist_' + item).prop('checked', false)
                    toastr.error('Please login first');
                }
            }
    </script>
    <script>
        $(".select2").select2();
         $(".select_2").select2();
        function serachSubmit() {

            var city = $('#city').val();
            var category = $('#category').val();
            var subcategory = $('#subcategory').val();

            var base_url = $('#base_url').val();
            var country = $('#country').val();
            var full_url = base_url+'/ads/'+country
            if(category != ''){
                full_url += '/'+category;
            }
            if(subcategory != ''){
                full_url += '/'+subcategory;
            }

            if(city != ''){
                full_url += '?city='+city;
            }

            window.location.replace(full_url);



            // $('#searchForm').submit();

         }
    </script>

    {{-- custom script --}}
    @stack('script')
</body>

</html>