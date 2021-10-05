<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/img') }}/favicon.ico" type="image/x-icon">
    <title>@yield('title') | {{ __('Mysume') }}</title>

    {{-- Bootstrap CSS --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Days+One&family=Montserrat&display=swap" rel="stylesheet">    
    
    {{-- Custom CSS --}}
    <link href="{{ asset('scss/style.css') }}" rel="stylesheet">

    {{-- Script --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>
    {{-- loading --}}
    <div class="position-fixed vw-100 vh-100 d-none loading" id="loading">
        <div class="d-flex justify-content-center align-items-center w-100 h-100">
            <div class="spinner-border text-purple-dark" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    {{-- content --}}
    @yield('content')
    
    @stack('js')
</body>
</html>