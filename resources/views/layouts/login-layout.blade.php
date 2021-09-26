<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="cstf_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <link href="./assets/css/pages/auth-light.css" rel="stylesheet" />
    <title>@yield('title')</title>

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@yield('styles')
</head>

    <body class="bg-silver-300">
    @yield('main-content')
    <script src="{{ asset('js/manifest.js') }}"></script>
<script src="{{ asset('js/vendor.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
@yield('script')

</body>

</html>
