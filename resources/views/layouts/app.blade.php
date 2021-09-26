<!DOCTYPE html>
<html lang="en">
<head>
    @include('user.section.meta')
    @include('user.section.style')
</head>
<body class="animsition">
    @include('user.section.header')
    <!-- @include('user.section.sidebar') -->
    @include('user.section.header_cart')
    @yield('content')

    @include('user.section.footer')
    @include('user.section.script')

    @if(session()->has('sweet_success') || session()->has('sweet_error'))
<script>
    @if(session()->has('sweet_success'))
    app.showSuccessMessage("Successfull", "{{ session('sweet_success') }}")
     @endif

     @if(session()->has('sweet_error'))
    app.showErrorMessage("Sorry!", "{{ session('sweet_error') }}")
     @endif
</script>
@endif

    @yield('javascript')
</body>
</html>
