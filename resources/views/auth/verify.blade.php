
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Confirm Email | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/hyper/assets/images/favicon.ico">

        <!-- App css -->
        <link href="/hyper/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/hyper/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="/hyper/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

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
                                
                                <div class="text-center m-auto">
                                    <img src="/hyper/assets/images/mail_sent.svg" alt="mail sent image" height="64" />
                                    <h4 class="text-dark-50 text-center mt-4 fw-bold">Please check your email</h4>
                                    @if(session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                      {{ session('success') }}
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    <p class="text-muted mb-4">
                                        A email has been send to .
                                        Please check for an email from company and click on the included link to
                                        reset your password. 
                                    </p>
                                    <a href="{{ route('user.verify', $token) }}">Verify Email</a>
                                </div>

                                {{-- <form action="/email/verification-notification" method="POST">
                                    @csrf
                                    <div class="mb-0 text-center">
                                        <p>If you did not receive the email</p>
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-home me-1"></i> Click here to request another one</button>
                                    </div>
                                </form> --}}

                            </div> <!-- end card-body-->
                        </div>
                        <!-- end card-->
                        
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            2022 © Simanwai
        </footer>

        <!-- bundle -->
        <script src="/hyper/assets/js/vendor.min.js"></script>
        <script src="/hyper/assets/js/app.min.js"></script>
        
    </body>
</html>
