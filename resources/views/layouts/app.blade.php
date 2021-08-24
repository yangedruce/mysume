<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{ __('Mysume') }}</title>

    {{-- Bootstrap CSS --}}
    <link href="{{ asset('assets/css') }}/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Days+One&family=Montserrat&display=swap" rel="stylesheet">    
    
    {{-- Custom CSS --}}
    <link href="{{ asset('assets/css') }}/style.css" rel="stylesheet">

</head>
<body>
    <div class="position-fixed vw-100 vh-100 d-none loading" id="loading">
        <div class="d-flex justify-content-center align-items-center w-100 h-100">
            <div class="spinner-border text-purple-dark" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    @yield('content')
    
    <script src="{{ asset('assets/js') }}/popper.min.js"></script>
    <script src="{{ asset('assets/js') }}/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js') }}/script.js"></script>
    @stack('js')
</body>
</html>