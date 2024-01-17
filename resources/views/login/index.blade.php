<!doctype html>
<html lang="en" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>

    <!--plugins-->
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <title>TaniLine</title>
</head>

<body class="bg-white">

    <!--start wrapper-->
    <div class="wrapper">
        <div class="">
            <div class="row g-0 m-0">
                <div class="col-xl-6 col-lg-12">
                    <div class="login-cover-wrapper">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <div class="text-center">
                                    <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/logo-icon-2.png') }}" width="200px" height="200px" class="logo-icon"
                                            alt="logo icon">
                                    </a>
                                    <h4>Sign In</h4>
                                    <p>Sign In to your account</p>
                                </div>
                                <form method="POST" action="{{ route('auth') }}" class="form-body row g-3">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmail" name="email">
                                        @if(session()->has('loginError'))
                                        <div class="text-danger">
                                            <small> {{ session('loginError') }}</small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <label for="inputPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="inputPassword" name="password">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckRemember" name="remember" value="1">
                                            <label class="form-check-label" for="flexSwitchCheckRemember">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 text-end">
                                        <a href="authentication-reset-password-cover.html">Forgot Password?</a>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Sign In</button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12">
                                        <div class="position-relative border-bottom my-3">
                                            <div class="position-absolute seperator translate-middle-y">Taniline
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="position-absolute top-0 h-100 d-xl-block d-none login-cover-img">
                        <div class="text-white p-5 w-100">

                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end wrapper-->


</body>

</html>
