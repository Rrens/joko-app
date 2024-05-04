<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOKO - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
    <link rel="shortcut icon" href="http://reztopia.my.id:8000/assets/images/logo/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png">
</head>

<body>
    @include('sweetalert::alert')
    <div id="auth">

        @yield('container')
        <div id="auth-left">
            <div class="auth-logo">
                <a href="#"><img src="{{ asset('assets/images/logo/logo.svg') }}" alt="Logo"></a>
            </div>
        </div>
    </div>
</body>

</html>
