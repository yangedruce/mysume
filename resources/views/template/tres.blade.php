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

        {{-- tres template --}}
        <div class="container-fluid py-3">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">

                    {{-- resume information on dos template --}}
                    <div class="row">
                        @include('template.partials.information-tres')
                        <div class="col-12 col-xl-8 py-3">

                            {{-- jobs --}}
                            @include('template.partials.job-tres')
                        </div>
                        <div class="col-12 col-xl-4 py-3">

                            {{-- educations --}}
                            @include('template.partials.education-tres')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>