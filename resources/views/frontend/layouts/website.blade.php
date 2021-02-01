<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="An interactive getting started guide for Brackets.">
    <link rel="stylesheet" href="{{secure_asset('css/website.css')}}">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- start wrapper -->
<div class="wrapper">
    @yield('content')
</div>
<!-- end wrapper -->

{{--<script src="{{secure_asset('js/website.js')}}"></script>--}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{secure_asset('website/js/bootstrap.min.js')}}"></script>
<script src="{{secure_asset('website/js/owl.carousel.min.js')}}"></script>
<script src="{{secure_asset('website/js/wow.min.js')}}"></script>
<script src="{{secure_asset('website/js/plugin.js')}}"></script>
</body>

</html>
