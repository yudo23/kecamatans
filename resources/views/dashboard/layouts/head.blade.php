<meta charset="utf-8" />
<title>@yield("title")</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="{{!empty(\SettingHelper::settings('dashboard', 'favicon')) ? asset(\SettingHelper::settings('dashboard', 'favicon')) : URL::to('/').'/templates/dashboard/assets/images/favicon.ico'}}">
<!-- jquery.vectormap css -->
<link href="{{URL::to('/')}}/templates/dashboard/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
    type="text/css" />
<!-- Bootstrap Css -->
<link href="{{URL::to('/')}}/templates/dashboard/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{URL::to('/')}}/templates/dashboard/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{URL::to('/')}}/templates/dashboard/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<!-- Select2 -->
<link href="{{URL::to('/')}}/templates/dashboard/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<!-- Sweetalert2 -->
<link href="{{URL::to('/')}}/templates/dashboard/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<!-- Fontawesome -->
<link href="{{URL::to('/')}}/templates/dashboard/assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<style>
    .select2 {
        width: 100%;
    }

    .select2-container--default .select2-results__option--selected {
        background-color: #508aeb;
        color: white;
    }

    .select2-selection__rendered {
        line-height: calc(2.25rem + 2px) !important;
    }

    .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px) !important;
    }

    .select2-selection__arrow {
        height: calc(2.25rem + 2px) !important;
    }

    .dropdown-toggle:after { content: none }

    .swal2-container {
        z-index: 4444;
    }
</style>
@yield("css")