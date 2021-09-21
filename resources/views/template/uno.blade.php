<!doctype html>
<html lang="en">
    <head>
        {{-- Required meta tags --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Bootstrap CSS --}}
        <link href="{{ asset('assets/css') }}/bootstrap.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Days+One&family=Montserrat&display=swap" rel="stylesheet">    

        {{-- Custom CSS --}}
        <link href="{{ asset('assets/css') }}/style.css" rel="stylesheet">

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
                        <div class="col-12 col-xl-8">
                            <h1 class="ff-days-one text-dark mb-0">{{ $user->fullname }}</h1>
                            <p class="ff-montserrat text-dark fs-5 mb-0">{{ $resume->title }}</p>
                            <small class="ff-montserrat mt-3">
                                <span class="text-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt me-3" viewBox="0 0 16 16">
                                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg>
                                    {{ $user->location }}
                                </span>
                                <br><br>
                                <span class="text-grey-dark text-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone me-3" viewBox="0 0 16 16">
                                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                                    </svg>
                                    {{ $user->phone_no }}
                                </span>
                                <br>
                                <span class="text-grey-dark text-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope me-3" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                                    </svg>
                                    {{ $user->email }}
                                </span>
                                <br>
                                <span class="text-grey-dark text-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe2 me-3" viewBox="0 0 16 16">
                                        <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855-.143.268-.276.56-.395.872.705.157 1.472.257 2.282.287V1.077zM4.249 3.539c.142-.384.304-.744.481-1.078a6.7 6.7 0 0 1 .597-.933A7.01 7.01 0 0 0 3.051 3.05c.362.184.763.349 1.198.49zM3.509 7.5c.036-1.07.188-2.087.436-3.008a9.124 9.124 0 0 1-1.565-.667A6.964 6.964 0 0 0 1.018 7.5h2.49zm1.4-2.741a12.344 12.344 0 0 0-.4 2.741H7.5V5.091c-.91-.03-1.783-.145-2.591-.332zM8.5 5.09V7.5h2.99a12.342 12.342 0 0 0-.399-2.741c-.808.187-1.681.301-2.591.332zM4.51 8.5c.035.987.176 1.914.399 2.741A13.612 13.612 0 0 1 7.5 10.91V8.5H4.51zm3.99 0v2.409c.91.03 1.783.145 2.591.332.223-.827.364-1.754.4-2.741H8.5zm-3.282 3.696c.12.312.252.604.395.872.552 1.035 1.218 1.65 1.887 1.855V11.91c-.81.03-1.577.13-2.282.287zm.11 2.276a6.696 6.696 0 0 1-.598-.933 8.853 8.853 0 0 1-.481-1.079 8.38 8.38 0 0 0-1.198.49 7.01 7.01 0 0 0 2.276 1.522zm-1.383-2.964A13.36 13.36 0 0 1 3.508 8.5h-2.49a6.963 6.963 0 0 0 1.362 3.675c.47-.258.995-.482 1.565-.667zm6.728 2.964a7.009 7.009 0 0 0 2.275-1.521 8.376 8.376 0 0 0-1.197-.49 8.853 8.853 0 0 1-.481 1.078 6.688 6.688 0 0 1-.597.933zM8.5 11.909v3.014c.67-.204 1.335-.82 1.887-1.855.143-.268.276-.56.395-.872A12.63 12.63 0 0 0 8.5 11.91zm3.555-.401c.57.185 1.095.409 1.565.667A6.963 6.963 0 0 0 14.982 8.5h-2.49a13.36 13.36 0 0 1-.437 3.008zM14.982 7.5a6.963 6.963 0 0 0-1.362-3.675c-.47.258-.995.482-1.565.667.248.92.4 1.938.437 3.008h2.49zM11.27 2.461c.177.334.339.694.482 1.078a8.368 8.368 0 0 0 1.196-.49 7.01 7.01 0 0 0-2.275-1.52c.218.283.418.597.597.932zm-.488 1.343a7.765 7.765 0 0 0-.395-.872C9.835 1.897 9.17 1.282 8.5 1.077V4.09c.81-.03 1.577-.13 2.282-.287z"/>
                                    </svg>
                                    {{ $user->website }}
                                </span>
                            </small>
                        </div>

                        {{-- profile picture --}}
                        <div class="col-12 col-xl-4 profile-img-container position-relative mx-auto p-0">
                            <div class="d-flex justify-content-center align-items-center profile-circle-2 w-100 h-100 mt-3 mt-xl-0">
                                @if(Route::is('resume.preview-resume'))
                                    <img src="{{ asset('assets/img').'/0000_avatar.jpeg' }}" alt="" class="w-auto h-100 d-block">
                                @else
                                    @if($user->profile_picture==null)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#4C4EAF" class="bi bi-person-fill w-75 m-auto" viewBox="0 0 16 16">
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                        </svg>
                                    @else
                                        <img src="{{ asset('storage/profilepicture').'/'.$user->profile_picture }}" alt="" class="w-auto h-100 d-block">
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row">

                        {{-- jobs --}}
                        @if(count($jobs)>0)
                            <div class="col-12 col-xl-3">
                                <p class="text-grey-dark text-uppercase text-12 fw-bold mb-0">Job Experience</p>
                            </div>
                            <div class="col-12 col-xl-9">
                                @foreach($jobs as $no => $job)
                                        <p class="ff-days-one text-dark fw-bold text-uppercase small mb-0">{{ $job->company_name }}</p>
                                        <p class="ff-montserrat text-grey-dark fw-bold text-12 mb-3">{{ $job->title }}</p>

                                        {{-- job tasks --}}
                                        @if(count($job->tasks)>0)
                                            <p class="ff-montserrat text-grey-dark fw-bold text-10 mb-0">Tasks/Responsibilities</p>
                                            <ul class="my-2">
                                                @foreach($job->tasks as $task)
                                                    <li class="ff-montserrat text-dark text-12">
                                                        {{ $task->task_name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        {{-- job achievements --}}
                                        @if(count($job->achievements)>0)
                                                <p class="ff-montserrat text-grey-dark fw-bold text-10 mb-0">Achievements</p>
                                                <ul class="my-2">
                                                    @foreach($job->achievements as $achievement)
                                                        <li class="ff-montserrat text-dark text-12">
                                                            {{ $achievement->achievement_name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        
                                        {{-- job preiod - currently work --}}
                                        @php
                                            $start_date     = $job->start_year.'-'.sprintf('%02d', $job->start_month).'-01 00:00:00';
                                            $start_month    = date('F', strtotime($start_date));
                                            $start_year     = date('Y', strtotime($start_date));
                                            $end_date       = $job->end_year.'-'.sprintf('%02d', $job->end_month).'-01 00:00:00';
                                            $end_month      = date('F', strtotime($end_date));
                                            $end_year       = date('Y', strtotime($end_date));
                                        @endphp

                                        <p class="ff-montserrat text-grey-dark fw-bold text-10 mb-3 mb-0">
                                            {{ $start_month." ".$start_year }}
                                            {{ " - " }}
                                            @if(!$job->currently_work)
                                                {{ $end_month." ".$end_year }}
                                            @else
                                                {{ 'Present' }}
                                            @endif | {{ $job->location}}
                                        </p>

                                        @if(($no+1)!=count($jobs))
                                            <hr class="text-secondary">
                                        @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <hr class="my-4">
                    <div class="row">

                        {{-- educations --}}
                        @if(count($educations)>0)
                            <div class="col-12 col-xl-3">
                                <p class="text-grey-dark text-uppercase text-12 fw-bold mb-0">Education</p>
                            </div>
                            <div class="col-12 col-xl-9">
                                @foreach($educations as $no => $education)
                                        <p class="ff-days-one text-dark fw-bold text-uppercase small mb-0">{{ $education->school }}</p>
                                        <p class="ff-montserrat text-grey-dark fw-bold text-12 mb-3">{{ $education->degree }}</p>

                                        {{-- education achievements --}}
                                        @if(count($education->achievements)>0)
                                            <p class="ff-montserrat text-grey-dark fw-bold text-10 mb-0">Achievements</p>
                                            <ul class="my-2">
                                                @foreach($education->achievements as $achievement)
                                                    <li class="ff-montserrat text-dark text-12">
                                                        {{ $achievement->achievement_name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        
                                        {{-- education period --}}
                                        @php
                                            $start_date     = $education->start_year.'-'.sprintf('%02d', $education->start_month).'-01 00:00:00';
                                            $start_month    = date('F', strtotime($start_date));
                                            $start_year     = date('Y', strtotime($start_date));
                                            $end_date       = $education->end_year.'-'.sprintf('%02d', $education->end_month).'-01 00:00:00';
                                            $end_month      = date('F', strtotime($end_date));
                                            $end_year       = date('Y', strtotime($end_date));
                                        @endphp

                                        <p class="ff-montserrat text-grey-dark fw-bold text-10 mb-3 mb-0">
                                            {{ $start_month." ".$start_year }}
                                            {{ " - " }}
                                            {{ $end_month." ".$end_year }} | Result: {{ $education->result }}
                                        </p>
                                        
                                        @if(($no+1)!=count($educations))
                                            <hr class="text-secondary">
                                        @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        <script>
            // trigger print
            function triggerPrint() {
                $('#print').addClass('d-none');
                window.print();
                $('#print').removeClass('d-none');
            }
        </script>
    </body>
</html>