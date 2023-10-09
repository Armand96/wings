<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Wings
        @yield('title')
    </title>

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">


    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/axios/dist/axios.min.js') }}"></script>

    {{-- BIAR TIDAK REDUNDANT SETIAP AJAX CALL --}}
    <script>
        window.axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };
    </script>

    <link rel="icon" type="image/x-icon" href="{{ asset('/img/wings.png') }}">
</head>

<body class="sidebar-collapse">
    <div class="wrapper">
        {{-- NAVBAR --}}
        @include('client.layout.navbar')

        <div class="content">
            @yield('content')
        </div>
    </div>

    <script>
        // test
        @if (session('notif'))
            {!! 'toastrShow("Success", "' . session('notif') . '", "success")' !!}
        @endif

        @if ($errors->any())
            {!! 'toastrShow("Failed", "' . $errors->first() . '", "error")' !!}
        @endif

        function toastrShow(title, msg, bgColor) {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "10000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr[bgColor](msg, title);
        }
    </script>

    @yield('scriptjs')
</body>

</html>
