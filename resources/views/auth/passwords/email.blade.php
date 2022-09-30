
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Recover Password | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/hyper/assets/images/favicon.ico">

        <!-- App css -->
        <link href="/hyper/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/hyper/assets/css/app-creative.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="/hyper/assets/css/app-creative-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <body class="authentication-bg" data-layout-config='{"darkMode":false}'>

        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">
                            <!-- Logo -->
                            <div class="card-header pt-4 pb-4 text-center bg-primary">
                                <a href="index.html">
                                    <span><img src="/hyper/assets/images/logo.png" alt="" height="18"></span>
                                </a>
                            </div>
                            
                            <div class="card-body p-4">

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  {{ session('success') }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif

                                @if(session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  {{ session('error') }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center mt-0 fw-bold">Reset Password</h4>
                                    <p class="text-muted mb-4">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                                </div>

                               
                                <form method="POST" action="{{ route('forget.password.post') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" type="email" id="emailaddress" required="" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-0 text-center">
                                        <button class="btn btn-primary" type="submit">Send Reset Password Link</button>
                                    </div>
                                </form>
                            </div> <!-- end card-body-->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Back to <a href="/login" class="text-muted ms-1"><b>Log In</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            2018 - 2021 © Hyper - Coderthemes.com
        </footer>

        <!-- bundle -->
        <script src="/hyper/assets/js/vendor.min.js"></script>
        <script src="/hyper/assets/js/app.min.js"></script>
        
    </body>
</html>
