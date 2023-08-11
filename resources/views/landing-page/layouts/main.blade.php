<!DOCTYPE html>
<html lang="en">
<head>
    @include("landing-page.layouts.head")
</head>
<body class="animsition restyle-index">
	@include('sweetalert::alert')
	
	@include("landing-page.layouts.topbar")

	@yield("content")

	@include("landing-page.layouts.footer")

    @include("landing-page.layouts.script")
</body>
</html>