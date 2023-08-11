<!doctype html>
<html lang="en">

<head>

    @include("dashboard.auth.layouts.head")

</head>

<body>
    
    @include('sweetalert::alert')

    <div class="account-pages my-2 pt-sm-5">
        <div class="container">
            @yield("content")
        </div>
    </div>

    @include("dashboard.auth.layouts.script")

</body>

</html>