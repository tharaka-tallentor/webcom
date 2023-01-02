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
    @stack('styles')
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

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        @yield('content')
    </div>
    @stack('script')
    <script src="{{ asset('lib/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('lib/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/js/dashboard2.js') }}"></script>
    {{-- <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-analytics.js";
        
        const firebaseConfig = {
          apiKey: "AIzaSyCy8IgrPMCq-3nZJeA9yX10gf9oLw1hmoA",
          authDomain: "webcom-a4a3e.firebaseapp.com",
          projectId: "webcom-a4a3e",
          storageBucket: "webcom-a4a3e.appspot.com",
          messagingSenderId: "981642582948",
          appId: "1:981642582948:web:72fba6445e222113f53f31",
          measurementId: "G-FZ9LJ0BX3C"
        };
      
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);
    </script> --}}
</body>

</html>