<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags  -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token() }}">
    <title>{{env("APP_NAME")}}</title>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{url("assets/css/vendor.min.css")}}">
    <link rel="stylesheet" href="{{url("assets/vendor/bootstrap-icons/font/bootstrap-icons.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/style.min.css")}}">
    <link rel="stylesheet" href="{{url("assets/css/custom.css")}}">
    <link rel="stylesheet" href="{{url('assets/vendor/notify/colored-theme.min.css')}}"/>
    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{url('assets/vendor/notify/growl-notification.min.js')}}"></script>

</head>
<body>
<div class="page-loader is-hidden"></div>
@yield('content')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

</body>
</html>
