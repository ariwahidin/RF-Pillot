<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign In | RF Pillot</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="RF - Pillot" name="description" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('public') }}/jar/html/default/assets/images/yusen-kotak.jpg">
    <!--Swiper slider css-->
    <link href="{{ url('public') }}/jar/html/default/assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <!-- Layout config Js -->
    <script src="{{ url('public') }}/jar/html/default/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ url('public') }}/jar/html/default/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url('public') }}/jar/html/default/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ url('public') }}/jar/html/default/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ url('public') }}/jar/html/default/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <style>
        #logo {
            border-radius: 10%;
        }
    </style>
</head>

<style>
    /* CSS untuk latar belakang hitam transparan */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        /* Warna hitam dengan opasitas 0.7 */
        z-index: 9999;
        /* Menempatkan latar belakang di atas konten */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Kode CSS untuk animasi spinner yang Anda sebutkan sebelumnya */
    .lds-roller {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-roller div {
        animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        transform-origin: 40px 40px;
    }

    .lds-roller div:after {
        content: " ";
        display: block;
        position: absolute;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #fff;
        margin: -4px 0 0 -4px;
    }

    .lds-roller div:nth-child(1) {
        animation-delay: -0.036s;
    }

    .lds-roller div:nth-child(1):after {
        top: 63px;
        left: 63px;
    }

    .lds-roller div:nth-child(2) {
        animation-delay: -0.072s;
    }

    .lds-roller div:nth-child(2):after {
        top: 68px;
        left: 56px;
    }

    .lds-roller div:nth-child(3) {
        animation-delay: -0.108s;
    }

    .lds-roller div:nth-child(3):after {
        top: 71px;
        left: 48px;
    }

    .lds-roller div:nth-child(4) {
        animation-delay: -0.144s;
    }

    .lds-roller div:nth-child(4):after {
        top: 72px;
        left: 40px;
    }

    .lds-roller div:nth-child(5) {
        animation-delay: -0.18s;
    }

    .lds-roller div:nth-child(5):after {
        top: 71px;
        left: 32px;
    }

    .lds-roller div:nth-child(6) {
        animation-delay: -0.216s;
    }

    .lds-roller div:nth-child(6):after {
        top: 68px;
        left: 24px;
    }

    .lds-roller div:nth-child(7) {
        animation-delay: -0.252s;
    }

    .lds-roller div:nth-child(7):after {
        top: 63px;
        left: 17px;
    }

    .lds-roller div:nth-child(8) {
        animation-delay: -0.288s;
    }

    .lds-roller div:nth-child(8):after {
        top: 56px;
        left: 12px;
    }

    /* Sisipkan sisa kode CSS untuk animasi spinner di sini */

    @keyframes lds-roller {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div class="pLoading" style="display: none;">
    <div class="overlay">
        <div class="lds-roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>

<script>
    function stopLoading() {
        var divLoading = document.querySelector(".pLoading");
        divLoading.style.display = "none";
    }

    function startLoading() {
        var divLoading = document.querySelector(".pLoading");
        divLoading.style.display = "block";
    }
    startLoading();
</script>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="{{ url('public') }}/jar/html/default/assets/images/PilotLogoRevers.png" alt="" height="45">
                                </a>
                                &nbsp;
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="{{ url('public') }}/jar/html/default/assets/images/yusen-logistics.png" alt="" height="70">
                                </a>
                            </div>
                            <p class="mt-0 fs-15 fw-medium"></p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Login to your account with username and password</h5>
                                </div>
                                <div class="p-2 mt-4">
                                    <form id="formLogin">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required autofocus>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" name="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password" required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="submit" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>



                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Log In</button>
                                        </div>

                                        <div id="failedAlert" style="display: none;" class="mt-4">
                                            <div class="alert alert-danger mb-xl-0" role="alert">
                                                <strong> Login gagal! </strong> username atau password salah
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> PT. Puninar Yusen Logistics
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- jQuery -->
    <script src="{{ url('public/assets/plugins/jquery/jquery.min.js') }}"></script>

    <!-- JAVASCRIPT -->
    <!-- <script src="{{ url('public') }}/jar/html/default/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="{{ url('public') }}/jar/html/default/assets/libs/simplebar/simplebar.min.js"></script> -->
    <!-- <script src="{{ url('public') }}/jar/html/default/assets/libs/node-waves/waves.min.js"></script> -->
    <!-- <script src="{{ url('public') }}/jar/html/default/assets/libs/feather-icons/feather.min.js"></script> -->
    <!-- <script src="{{ url('public') }}/jar/html/default/assets/js/pages/plugins/lord-icon-2.1.0.js"></script> -->
    <!-- <script src="{{ url('public') }}/jar/html/default/assets/js/plugins.js"></script> -->
    <!--Swiper slider js-->
    <!-- <script src="{{ url('public') }}/jar/html/default/assets/libs/swiper/swiper-bundle.min.js"></script> -->
    <!-- swiper.init js -->
    <!-- <script src="{{ url('public') }}/jar/html/default/assets/js/pages/swiper.init.js"></script> -->
    <!-- password-addon init -->
    <!-- <script src="{{ url('public') }}/jar/html/default/assets/js/pages/password-addon.init.js"></script> -->

    <script>
        $(document).ready(function() {
            stopLoading();
            $('#formLogin').on('submit', function(e) {
                e.preventDefault();
                startLoading();
                let formLogin = $(this).serialize();
                $.ajax({
                    url: 'login',
                    type: 'POST',
                    data: formLogin,
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.success == true) {
                            // stopLoading();
                            window.location.href = 'dashboard';
                        } else {
                            stopLoading();
                            alert(response.message);
                        }
                    }
                });
            })
        })
    </script>
</body>

</html>