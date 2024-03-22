<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $pageTitle }} - Unicode Academy</title>
    <link rel="stylesheet" href="{{asset('clients/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('clients/css/slick.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('clients/css/reset.css')}}" />
    <link rel="stylesheet" href="{{asset('clients/css/header.css')}}" />
    <link rel="stylesheet" href="{{asset('clients/css/home.css')}}" />
    <link rel="stylesheet" href="{{asset('clients/css/course.css')}}" />
    <link rel="stylesheet" href="{{asset('clients/css/footer.css')}}" />
    @yield('stylesheets')
</head>

<body>
    @include ('parts.clients.header')
    <main>
        @yield('content')
    </main>
    @include ('parts.clients.footer')
    @yield('scripts')
</body>
<script src="{{asset('clients/js/bootstrap.min.js')}}"></script>
<script src="{{asset('clients/js/jquery.min.js')}}"></script>
<script src="{{asset('clients/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('clients/js/slick.min.js')}}"></script>
<script src="{{asset('clients/js/slider-home.js')}}"></script>
<script src="{{asset('clients/js/home.js')}}"></script>

</html>