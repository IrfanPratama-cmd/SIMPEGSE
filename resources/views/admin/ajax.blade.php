
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/hyper/assets/images/favicon.ico">

    <!-- third party css -->
    <link href="/hyper/assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="/hyper/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/hyper/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="/hyper/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

    <!-- Trix Editor -->
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>

</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <!-- Begin page -->
    <div class="wrapper">
        
        @include('admin.sidebar')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                @include('admin.topbar')
                <!-- end Topbar -->
                
                <!-- Start Content-->
                <div class="container-fluid">

                    
                    <!-- start page title -->
                    
                    <!-- end page title --
                   
                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <!-- Footer Start -->
            @include('admin.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Setting -->
    @include('admin.setting')
    
    <div class="rightbar-overlay"></div>
    <!-- /End-bar -->

    <!-- Script -->
    @include('admin.script')

    


    
   
</body>
</html>