<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($setting->favicon_image) }}">
        <title>@yield('title')</title>
        @php
            $setting = App\Models\Setting::first();
        @endphp
        {{-- meta --}}
        @yield('meta')
        {{-- style --}}
        @include('frontend.layouts.header_script')

        <style>
            :root {
                --primary: {{ $setting->frontend_primary_color }};
            }

            .user_dashboard .nav-tabs .nav-item.show .nav-link,
            .user_dashboard .nav-tabs .nav-link.active a {
                background: {{ $setting->frontend_primary_color }};
            }
            .user_dashboard .nav-tabs .nav-item.show .nav-link:hover, .user_dashboard .nav-tabs .nav-link:hover a {
                background: {{ $setting->frontend_primary_color }};
            }
            .ad_post_form.choose_category label:hover {
                background: {{ $setting->frontend_primary_color }};
            }
            .ad_post_form.choose_category .form-check-input:checked~label {
                background: {{ $setting->frontend_primary_color }};
            }
        </style>

        @stack('style')

        <input type="hidden" id="base_url" value="{{ URL('/') }}" />
    </head>
    <body>
        {{-- <div class="{{ Route::is('frontend.index') ? 'd-none d-md-block': '' }}"> --}}
        @include('frontend.layouts.header')
        {{-- </div> --}}

        {{-- main content --}}
        @yield('breadcrumb')
        @yield('content')
        @include('frontend.layouts.footer')
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
                            $("#wishlist_count").load(location.href + " #wishlist_count>*", "");
                            if (data.status == 'failed') {
                                toastr.error('Favorite removed successfully')
                            } else {
                                toastr.success('Favorite added successfully')

                            }

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
                var full_url = base_url + '/ads/' + country
                if (category != '') {
                    full_url += '/' + category;
                }
                if (subcategory != '') {
                    full_url += '/' + subcategory;
                }

                if (city != '') {
                    full_url += '?city=' + city;
                }

                window.location.replace(full_url);


                // $('#searchForm').submit();

            }
        </script>

        {{-- custom script --}}
        @stack('script')
    </body>
</html>
