<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>
        Wings Admin
        @yield('title')
    </title>

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.css') }}">

    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/moment/locales.min.js') }}"></script>


    <link rel="icon" type="image/x-icon" href="{{ asset('/img/wings.png') }}">

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="layout-navbar-fixed layout-fixed sidebar-mini sidebar-collapse">
    <div class="wrapper">

        {{-- NAVBAR --}}
        @include('admin.layout.navbar')

        {{-- SIDEBAR --}}
        @include('admin.layout.sidebar')

        <div class="content-wrapper">

            {{-- HEADER --}}
            <div class="content-header">
                <div class="container-fluid">
                    @yield('content_header')
                </div>
            </div>

            {{-- MAIN CONTENT --}}
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

        </div>

    </div>

    @yield('scriptjs')

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
</body>

</html>
