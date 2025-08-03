<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>@yield('title')</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="mhd_firdaus" />
    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('dist/assets/images/favicon.svg') }}" type="image/x-icon" />
    <!-- map-vector css -->
    <link rel="stylesheet" href="{{ asset('dist/assets/css/plugins/jsvectormap.min.css') }}" />
    <!-- [Google Font : Public Sans] icon -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="{{ asset('dist/assets/fonts/phosphor/duotone/style.css') }}" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('dist/assets/fonts/tabler-icons.min.css') }}" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('dist/assets/fonts/feather.css') }}" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('dist/assets/fonts/fontawesome.css') }}" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('dist/assets/fonts/material.css') }}" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('dist/assets/css/style.css') }}" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('dist/assets/css/style-preset.css') }}" />
</head><!-- [Head] end --><!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr"
    data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End --><!-- [ Sidebar Menu ] start -->
    @include('layouts.sidebar')
    <!-- [ Sidebar Menu ] end --><!-- [ Header Topbar ] start -->
    @include('layouts.header')
    <!-- [ Header ] end --><!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            @yield('content')
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- [ Off Canvas ] Start -->
    @include('layouts.off-canvas')
    <!-- [ Off Canvas ] End -->

    <!-- [Page Specific JS] start -->
    <script src="{{ asset('dist/assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/plugins/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/plugins/world.js') }}"></script>
    <script src="{{ asset('dist/assets/js/plugins/world-merc.js') }}"></script>
    <script src="{{ asset('dist/assets/js/widgets/earnings-users-chart.js') }}"></script>
    <script src="{{ asset('dist/assets/js/widgets/world-map-markers.js') }}"></script>
    <!--  --><!-- [Page Specific JS] end --><!-- Required Js -->
    <script src="{{ asset('dist/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/plugins/i18next.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/plugins/i18nextHttpBackend.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/icon/custom-font.js') }}"></script>
    <script src="{{ asset('dist/assets/js/script.js') }}"></script>
    <script src="{{ asset('dist/assets/js/theme.js') }}"></script>
    <script src="{{ asset('dist/assets/js/multi-lang.js') }}"></script>
    <script src="{{ asset('dist/assets/js/plugins/feather.min.js') }}"></script>
    <script>
        layout_change("light");
    </script>
    <script>
        layout_sidebar_change("light");
    </script>
    <script>
        change_box_container("false");
    </script>
    <script>
        layout_caption_change("true");
    </script>
    <script>
        layout_rtl_change("false");
    </script>
    <script>
        preset_change("preset-1");
    </script>
</body>
<!-- [Body] end -->

</html>
