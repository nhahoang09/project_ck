<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Home Page')</title>

    <base href="{{ asset('') }}">
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="frontend/assets/dest/css/font-awesome.min.css">
    <link rel="stylesheet" href="frontend/assets/dest/vendors/colorbox/example3/colorbox.css">
    <link rel="stylesheet" href="frontend/assets/dest/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="frontend/assets/dest/rs-plugin/css/responsive.css">
    <link rel="stylesheet" title="style" href="frontend/assets/dest/css/style.css">
    <link rel="stylesheet" href="frontend/assets/dest/css/animate.css">
    <link rel="stylesheet" title="style" href="frontend/assets/dest/css/huong-style.css">

    {{-- css --}}
    @include('layouts.css')
</head>
<body>
    {{-- header --}}
    @include('layouts.header')

    {{-- slide --}}

    @include('layouts.slide')

    {{-- menu --}}
    @include('layouts.menu')

    {{-- content --}}
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- footer --}}
    @include('layouts.footer')

    {{-- js --}}
    @include('layouts.js')

     <!-- include js files -->
     <script src="frontend/assets/dest/js/jquery.js"></script>
     <script src="frontend/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
     <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
     <script src="frontend/assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
     <script src="frontend/assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
     <script src="frontend/assets/dest/vendors/animo/Animo.js"></script>
     <script src="frontend/assets/dest/vendors/dug/dug.js"></script>
     <script src="frontend/assets/dest/js/scripts.min.js"></script>
     <script src="frontend/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
     <script src="frontend/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
     <script src="frontend/assets/dest/js/waypoints.min.js"></script>
     <script src="frontend/assets/dest/js/wow.min.js"></script>
     <!--customjs-->
     <script src="frontend/assets/dest/js/custom2.js"></script>
     <script>
         $(document).ready(function($) {
         $(window).scroll(function(){
             if($(this).scrollTop()>150){
             $(".header-bottom").addClass('fixNav')
             }else{
                 $(".header-bottom").removeClass('fixNav')
             }}
         )
     })
     </script>

</body>
</html>
