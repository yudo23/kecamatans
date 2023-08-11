<!doctype html>
<html lang="en">

    <head>
        @include("dashboard.layouts.head")
    </head>

    <body data-layout="detached" data-topbar="colored">
        
        @include('sweetalert::alert')
        
        <div class="container-fluid">
            <!-- Begin page -->
            <div id="layout-wrapper">

            @include("dashboard.layouts.topbar")
            @include("dashboard.layouts.sidebar")

                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="main-content">

                    <div class="page-content">

                        @yield("breadcumb")
                        @yield("content")

                    </div>
                    <!-- End Page-content -->

                    @include("dashboard.layouts.footer")
                </div>
                <!-- end main content-->

            </div>
            <!-- END layout-wrapper -->

        </div>
        <!-- end container-fluid -->

        @include("dashboard.components.loader")
        @include("dashboard.layouts.script")

    </body>

</html>