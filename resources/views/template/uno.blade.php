<!doctype html>
<html lang="en">
    <head>
        {{-- Required meta tags --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Bootstrap CSS --}}
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Days+One&family=Montserrat&display=swap" rel="stylesheet">    
        
        {{-- Custom CSS --}}
        <link href="{{ asset('scss/style.css') }}" rel="stylesheet">
    
        {{-- Script --}}
        <script src="{{ asset('js/app.js') }}" defer></script>
    
        <title>{{ $user->fullname }} | {{ $resume->title }}</title>
    </head>
    <body>
        {{-- include trigger print resume --}}
        @include('layouts.print')

        {{-- uno template --}}
        <div class="container-fluid py-3">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">

                    {{-- resume information on uno template --}}
                    <div class="row main-container align-items-center">
                        @include('template.partials.information-uno')

                        {{-- profile picture --}}
                        @include('template.partials.picture-uno')
                    </div>
                    <hr class="my-4">
                    <div class="row">

                        {{-- jobs --}}
                        @include('template.partials.job-uno')
                    </div>
                    <hr class="my-4">
                    <div class="row">

                        {{-- educations --}}
                        @include('template.partials.education-uno')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>