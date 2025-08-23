<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Login | Light Able Admin & Dashboard Template</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Light Able admin and dashboard template offer a variety of UI elements and pages, ensuring your admin panel is both fast and effective." />
    <meta name="author" content="phoenixcoded" />
    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('dist/assets/images/favicon.svg') }}" type="image/x-icon" />
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
    <!-- [ Pre-loader ] End -->
    <div class="auth-main v1 ">
        <div class="auth-wrapper ">
            <form action="{{ route('login') }}" method="post" class="auth-form">
                @csrf
                <div class="card my-5 p-3">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('img/logo-POS.png') }}" alt="images" width="100px"
                                class="img-fluid mb-3" />
                            <h4 class="f-w-700 mb-4" style="font-family: poppins;letter-spacing: 1px;font-size: 2rem;">
                                Point Of Sales
                            </h4>
                        </div>
                        <div class="mb-3">
                            <input type="email" autocomplete="off" value="admin@test.com" autofocus
                                class="form-control mb-2" id="floatingInput" placeholder="Email Address"
                                name="email" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control mb-2" autocomplete="off" id="floatingInput1"
                                placeholder="Password" name="password" />
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- [ Main Content ] end --><!-- Required Js -->
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
