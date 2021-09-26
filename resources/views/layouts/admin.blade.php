<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="cstf_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>@yield('title')</title>

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@yield('styles')

</head>

<body class="fixed-navbar">
    <div class="page-wrapper">

@include('admin.section.top-nav')
<!-- @include('admin.section.sidebar') -->
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
            @yield('content')
    </div>
</div>


    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
<script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
@if(session()->has('sweet_success') || session()->has('sweet_error'))
<script>
    @if(session()->has('sweet_success'))
    admin.showSuccessMessage("Successfull", "{{ session('sweet_success') }}")
     @endif

     @if(session()->has('sweet_error'))
    admin.showErrorMessage("Sorry!", "{{ session('sweet_error') }}")
     @endif
</script>
@endif
@yield('script')
</body>

</html>
