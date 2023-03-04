    <link rel="icon" type="image/png" sizes="32x32" href="{{ $setting->favicon_image_url }}">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/flagicon/dist/css/flag-icon.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ mix('backend/css/vendor.min.css') }}">

    @yield('style')
    @stack('style')

    {!! $setting->header_css !!}
    {!! $setting->header_script !!}
    <style>
        :root {
            --sidebar-bg-color: {{ $setting->sidebar_color }};
            --sidebar-txt-color: {{ $setting->sidebar_txt_color }};
            --top-nav-bg-color: {{ $setting->nav_color }};
            --top-nav-txt-color: {{ $setting->nav_txt_color }};
            --main-color: {{ $setting->main_color }};
            --accent-color: {{ $setting->accent_color }};
        }
    </style>
    <style>
        .filtertags .single-tag {
            padding: 6px 16px 6px 16px;
            display: inline-block;
            font-size: 14px;
            line-height: 22px;
            color: var(--gray-700);
            background: var(--gray-50);
            border-radius: 30px;
            font-weight: 400;
            margin-right: 12px;
            transition: all 0.4s;
            background-color: #dadde6;
        }

        .a-color {
            color: var(--gray-700) !important;
        }

        .filtertags .single-tag:hover {
            background-color: var(--main-color) !important;
            color: white !important;
        }

        .single-tag-active {
            background-color: var(--main-color) !important;
            color: white !important;
        }


        .filtertags .single-tag .close-tag {
            margin-left: 7px;
        }

        .filtertags .single-tag .close-tag path {
            transition: all 0.4s;
        }

        .filtertags .single-tag:hover .close-tag path {
            fill: var(--primary-500);
            stroke: white;
        }

        .filtertags .single-tag:last-child {
            margin-right: 0px;
        }
    </style>
