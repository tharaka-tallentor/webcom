<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('lib/css/adminlte.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/css/fontawesome-free/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/css/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/lib/css/toastr.min.css') }}" />
    @stack('style')
    <script src="{{ asset('lib/js/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/js/toastr.min.js') }}"></script>
    <script src="{{ asset('lib/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('lib/css/fontawesome-free/js/fontawesome.min.js') }}"></script>
    <script type="text/javascript">
        let Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        @yield('content')
    </div>
    <script src="{{ asset('lib/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('lib/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/js/dashboard2.js') }}"></script>
    @stack('script')
</body>

</html>
