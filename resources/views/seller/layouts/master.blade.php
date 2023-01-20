<!doctype html>
<html lang="en">


<!-- Mirrored from www.wrraptheme.com/templates/lucid/html/light/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 Nov 2021 17:34:22 GMT -->
<head>
@include('seller.layouts.header')

</head>
<body class="theme-cyan">

    <!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="{{asset('backend/assets/images/lodar.gif')}}" width="120" height="100" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div> 
<!-- Overlay For Sidebars -->

<div id="wrapper">

    @include('seller.layouts.nav')

    @include('seller.layouts.sidebar')

    @yield('content')
    
</div>

@include('seller.layouts.footer')

</body>

<!-- Mirrored from www.wrraptheme.com/templates/lucid/html/light/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 Nov 2021 17:34:22 GMT -->
</html>
