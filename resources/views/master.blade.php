<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>
        Wings
        @yield('title')
    </title>

    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/toastr/toastr.min.css') }}">
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

    <link rel="icon" type="image/x-icon" href="{{ asset('/img/wings.png') }}">
</head>

<body>
    @yield('content')

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
