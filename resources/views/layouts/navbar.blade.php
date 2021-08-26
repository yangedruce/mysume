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
    <link href="{{ asset('assets/css') }}/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Days+One&family=Montserrat&display=swap" rel="stylesheet">    
    
    {{-- Custom CSS --}}
    <link href="{{ asset('assets/css') }}/style.css" rel="stylesheet">

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

    {{-- logout --}}
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center">
                    <div class="modal-body p-5">
                        <p class="modal-title fw-bold fs-2 text-dark ff-days-one" id="logoutModalLabel">Are you sure to logout?</p>
                        <button type="submit" class="btn btn-main text-white mt-3 w-100"><small>{{ __('Logout') }}</small></button>
                        <button type="button" class="btn btn-main-blue text-blue-dark mt-3 w-100" data-bs-dismiss="modal"><small>{{ __('Cancel') }}</small></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg bg-purple-dark sticky-top">
        <div class="container-fluid d-flex justify-content-between w-100">
            <a class="navbar-brand fs-3 text-blue-light ff-days-one text-decoration-none" href="{{ route('home') }}">mysume</a>
            <button class="navbar-toggler m-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.75 13C0.75 12.8011 0.829018 12.6103 0.96967 12.4697C1.11032 12.329 1.30109 12.25 1.5 12.25H16.5C16.6989 12.25 16.8897 12.329 17.0303 12.4697C17.171 12.6103 17.25 12.8011 17.25 13C17.25 13.1989 17.171 13.3897 17.0303 13.5303C16.8897 13.671 16.6989 13.75 16.5 13.75H1.5C1.30109 13.75 1.11032 13.671 0.96967 13.5303C0.829018 13.3897 0.75 13.1989 0.75 13ZM0.75 7C0.75 6.80109 0.829018 6.61032 0.96967 6.46967C1.11032 6.32902 1.30109 6.25 1.5 6.25H16.5C16.6989 6.25 16.8897 6.32902 17.0303 6.46967C17.171 6.61032 17.25 6.80109 17.25 7C17.25 7.19891 17.171 7.38968 17.0303 7.53033C16.8897 7.67098 16.6989 7.75 16.5 7.75H1.5C1.30109 7.75 1.11032 7.67098 0.96967 7.53033C0.829018 7.38968 0.75 7.19891 0.75 7ZM0.75 1C0.75 0.801088 0.829018 0.610322 0.96967 0.46967C1.11032 0.329018 1.30109 0.25 1.5 0.25H16.5C16.6989 0.25 16.8897 0.329018 17.0303 0.46967C17.171 0.610322 17.25 0.801088 17.25 1C17.25 1.19891 17.171 1.38968 17.0303 1.53033C16.8897 1.67098 16.6989 1.75 16.5 1.75H1.5C1.30109 1.75 1.11032 1.67098 0.96967 1.53033C0.829018 1.38968 0.75 1.19891 0.75 1Z" fill="#CBE9FE"/>
                    </svg>                        
                </span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav align-items-center">
                    <a class="nav-link text-white text-decoration-none active small" aria-current="page" href="{{ route('home') }}">Dashboard</a>
                    <a class="nav-link text-white text-decoration-none small" href="{{ route('profile.edit') }}">My Profile</a>
                    <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#logoutModal"><small>{{ __('Logout') }}</small></button>
                </div>
            </div>
        </div>
    </nav>

    {{-- navbar --}}
    <div class="container py-5 min-vh-100">
        @yield('content')
    </div>

    {{-- footer --}}
    <footer class="text-center bg-purple-dark w-100 bottom-0">
        <div class="text-center text-white p-4 small">
            © 2021
            <span class="text-blue-light">www.mysume.com<span class="text-white"> | Design & Developed By </span><a href="https://www.yangedruce.com" class="text-decoration-none text-blue-light">Yang Edruce</a></span>
        </div>
    </footer>

    <script src="{{ asset('assets/js') }}/popper.min.js"></script>
    <script src="{{ asset('assets/js') }}/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js') }}/script.js"></script>
    @stack('js')
</body>
</html>