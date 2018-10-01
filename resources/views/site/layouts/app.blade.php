<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="QUOTE - Request a quote for every type of companies">
    <meta name="author" content="Ansonika">
    <title>Best Insurance Quoting</title>
    
    <!-- Favicons-->
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{asset('assets/img/apple-touch-icon-57x57-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('assets/img/apple-touch-icon-72x72-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('assets/img/apple-touch-icon-114x114-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('assets/img/apple-touch-icon-144x144-precomposed.png')}}">
    
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    
    <!-- BASE CSS -->
    <link href="{{asset('assets/layerslider/css/layerslider.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/icon_fonts/css/all_icons_min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/magnific-popup.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/skins/square/yellow.css')}}" rel="stylesheet">
    
    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">

</head>

<body>

<div id="loader_form">
    <div data-loader="circle-side-2"></div>
</div><!-- /Loader_form -->

@include('site.partials.header')

@include('site.partials.layerslider')

<div id="main_container">
    
    <div id="header_in">
        <a href="#0" class="close_in "><i class="pe-7s-close-circle"></i></a>
    </div>
    
    <div class="wrapper_in">
        <div class="container-fluid">
            
            @yield('content')
            
        </div><!-- /container-fluid -->
    </div><!-- /wrapper_in -->
</div><!-- /main_container -->

@include('site.partials.footer-menu')
@include('site.modals.terms')

<!-- SCRIPTS -->
<!-- Jquery-->
<script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
<!-- Layer slider -->
<script src="{{asset('assets/layerslider/js/greensock.js')}}"></script>
<script src="{{asset('assets/layerslider/js/layerslider.transitions.js')}}"></script>
<script src="{{asset('assets/layerslider/js/layerslider.kreaturamedia.jquery.js')}}"></script>
<script src="{{asset('assets/js/slider_func.js')}}"></script>
<!-- Common script -->
<script src="{{asset('assets/js/common_scripts_min.js')}}"></script>
<!-- Theme script -->
<script src="{{asset('assets/js/functions.js')}}"></script>
<!-- Google map -->
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="{{asset('assets/js/mapmarker.jquery.js')}}"></script>
<script src="{{asset('assets/js/mapmarker_func.jquery.js')}}"></script>

</body>

</html>