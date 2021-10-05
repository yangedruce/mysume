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

        {{-- dos template --}}
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">
                    <div class="row main-container h-100">
                        <div class="col-12 col-xl-3 bg-purple-dark">
                            {{-- profile picture --}}
                            @include('template.partials.picture-dos')

                            {{-- resume information on dos template --}}
                            @include('template.partials.information-dos')
                        </div>
                        <div class="col-12 col-xl-9 px-4">
                            <div class="py-3">
                                {{-- jobs --}}
                                @include('template.partials.job-dos')
                            </div>
                            <div class="py-3">
                                {{-- educations --}}
                                @include('template.partials.education-dos')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>