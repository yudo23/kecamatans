<title>@yield("title")</title>
<meta charset="UTF-8">
<meta name="description" content="AuCreative theme tempalte">
<meta name="author" content="AuCreative">
<meta name="keywords" content="AuCreative theme template">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->
<link rel="icon" type="image/png" href="{{!empty(\SettingHelper::settings('landing_page', 'favicon')) ? asset(\SettingHelper::settings('landing_page', 'favicon')) : URL::to('/').'/templates/landing-page/images/icons/favicon.png'}}"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->	
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/vendor/revolution/css/layers.css">
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/vendor/revolution/css/navigation.css">
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/vendor/revolution/css/settings.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/vendor/slick/slick.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/vendor/animate/animate.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/vendor/animsition/dist/css/animsition.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/css/util.css">
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/css/main.css">
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/templates/landing-page/css/color.css">
@yield("css")