@extends('layouts.navbar')

@section('title')
{{ __('Edit Resume') }}
@endsection

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-12 col-xl-6">
        <div class="d-flex justify-content-between flex-column flex-md-row">
            <h1 class="text-dark fs-4 ff-days-one">Edit Resume</h1>
            <a href="{{ route('home') }}" class="align-self-center">
                <button type="button" class="btn btn-main btn-width text-white ff-montserrat"><small>{{ __('Return to Dashboard') }}</small></button>
            </a>
        </div>

        {{-- messages/alerts --}}
        @if(session('success'))            
            <div class="fw-bold alert alert-success ff-montserrat mt-3 small">{{ session('success') }}</div>
        @endif

        {{-- edit resume --}}
        <div class="main-box mt-4 w-100 p-3">
            <div class="d-flex justify-content-between w-100">
                <div class="d-flex w-100 justify-content-between">
                    <p class="text-dark ff-days-one mb-0 text-18">
                        {{ $resume->title }}
                        <span class="text-dark fs-6 ff-montserrat d-block">{{ $resume->template->name }}</span>
                        <span class="ff-montserrat d-block mt-4 text-grey-dark text-10">Last updated: {{ date('h:ia d F Y', strtotime($resume->updated_at)) }}</span>
                    </p>
                </div>
                <div>
                    <p class="ff-montserrat d-block text-10 text-blue-dark text-end">{{ $resume->status }}</p>
                    <div class="d-flex align-items-center">
                        <button type="button" class="bg-transparent border-0" onclick="triggerDelete({{ $resume->id }},'{{ $resume->title }}')" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <svg class="me-2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.83301 4.16675L8.24967 4.75008H5.33301V5.91675H5.91634V14.6667C5.91634 14.9721 6.02799 15.282 6.24902 15.5007C6.46777 15.7218 6.77767 15.8334 7.08301 15.8334H12.9163C13.2217 15.8334 13.5316 15.7218 13.7526 15.5007C13.9714 15.282 14.083 14.9721 14.083 14.6667V5.91675H14.6663V4.75008H11.7497L11.1663 4.16675H8.83301ZM7.08301 5.91675H12.9163V14.6667H7.08301V5.91675ZM8.24967 7.08342V13.5001H9.41634V7.08342H8.24967ZM10.583 7.08342V13.5001H11.7497V7.08342H10.583Z" fill="#4C4EAF"/>
                                <rect x="0.5" y="0.5" width="19" height="19" rx="3.5" stroke="#4C4EAF"/>
                            </svg>  
                        </button>                     
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg width="4" height="16" viewBox="0 0 4 16" fill="#000000" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="2" cy="2" r="2" fill="black"/>
                                    <circle cx="2" cy="8" r="2" fill="black"/>
                                    <circle cx="2" cy="14" r="2" fill="black"/>
                                </svg>                            
                            </button>
                            <ul class="dropdown-menu bg-transparent py-0" aria-labelledby="dropdownMenuButton" style="border: none;">
                                
                                @if($resume->status=='Published')
                                    <li class="w-75">
                                        <a class="dropdown-item dropdown-box" href="{{ route('resume.view-resume', ['username' => Auth::user()->username, 'resume_id' => $resume->id]) }}" target="_blank"><small>View</small></a>
                                    </li>
                                @endif

                                <li class="w-75">
                                    @if($resume->status=='Published')
                                        <button type="button" class="dropdown-item dropdown-box" onclick="triggerChangeStatus('Draft')" data-bs-toggle="modal" data-bs-target="#statusModal"><small>Make Draft</small></button>
                                    @else
                                        <button type="button" class="dropdown-item dropdown-box" onclick="triggerChangeStatus('Published')" data-bs-toggle="modal" data-bs-target="#statusModal"><small>Publish</small></button>  
                                    @endif
                                </li>
                                <li class="w-75"><a class="dropdown-item dropdown-box" href="{{ route('resume.view-edit-resume-settings', $resume->id) }}"><small>Settings</small></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="input-group mt-3">
                    <input type="text" class="form-control py-1 ff-montserrat border-end-0 copy-link" id="url" value="{{ route('resume.view-resume', ['username' => Auth::user()->username, 'resume_id' => $resume->id]) }}">
                    <span class="input-group-text py-1 bg-transparent m-0 p-0 border-start-0 copy-link-2">
                        <button type="button" onclick="copyLink()" class="btn text-blue-dark fw-bold ff-montserrat"><small>{{ __('Copy link') }}</small></button>
                    </span>
                </div>

                @if($resume->status!='Published')
                    <p class="text-danger mt-1 mb-0 text-12">Your resume must be published before you can view it using the link above.</p>
                @endif
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-5">
            <h1 class="text-dark fs-4 ff-days-one">Job Experience</h1>
            <button type="button" class="btn text-blue-dark fw-bold ff-montserrat" onclick="triggerAddJob()">
                <small>
                    <span class="me-2">+</span>
                    {{ __('Add Job') }}
                </small>
            </button>
        </div>

        {{-- Add job experience --}}
        <div class="main-box mt-3 w-100 d-none" id="addJob">
            <div class="justify-content-center mt-5 p-3">
                <form action="{{ route('resume.add-job') }}" method="POST">
                    @csrf
                    <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                    <div class="main-container justify-content-center">
                        <p class="text-grey-dark fw-bold text-uppercase text-12 ff-montserrat">Add Job Experience</p> 
                        <div class="form-group mt-4 mb-3">
                            <label for="" class="text-dark ff-days-one"><small>Company Name</small></label>
                            <input type="text" class="form-control main-input ff-montserrat small" id="companyName" name="company_name" value="" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="text-dark ff-days-one"><small>Title</small></label>
                            <input type="text" class="form-control main-input ff-montserrat small" id="title" name="title" value="" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="text-dark ff-days-one"><small>Location</small></label>
                            <input type="text" class="form-control main-input ff-montserrat small" id="location" name="location" value="" required>
                        </div>
                        <div class="row g-3 align-items-center">
                            <label for="" class="text-dark ff-days-one mt-5"><small>Start Date</small></label>
                            <div class="col-10">
                                <select class="form-select main-input" aria-label="Month" name="start_month" required>
                                    <option selected>Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control main-input ff-montserrat small" id="startYear" name="start_year" value="" required>
                            </div>
                            <div class="form-check mx-2 mt-1">
                                <input type="checkbox" class="form-check-input" id="checkboxCurrent-0" name="current" onchange="triggerCheckBox(0)">
                                <label class="form-check-label ff-montserrat text-dark text-10" for="checkboxCurrent">{{ __('Currently Work Here') }}</label>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center" id="endDate-0">
                            <label for="" class="text-dark ff-days-one mt-4"><small>End Date</small></label>
                            <div class="col-10">
                                <select class="form-select main-input" aria-label="Month" name="end_month" id="endMonth-0" required>
                                    <option selected>Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control main-input ff-montserrat small" id="endYear-0" name="end_year" value="" required>
                            </div>
                        </div>

                        {{-- Add/cancel job task --}}
                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <small class="text-dark ff-days-one">Task</small>
                            <button type="button" class="btn text-blue-dark fw-bold ff-montserrat" onclick="addTask(0)">
                                <small>
                                    <span class="me-2">+</span>
                                    {{ __('Add Task') }}
                                </small>
                            </button>
                        </div>

                        <input type="hidden" id="addJobTaskNo-0" name="task_no" value="0">
                        <p class="main-input mt-4 w-100 text-center text-grey-dark ff-montserrat no-job-task-0 small">You have no job task yet. Please add a new job task.</p>

                        <div id="addJobTask-0"></div>
                        
                        {{-- Add/cancel job achievement --}}
                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <small class="text-dark ff-days-one">Achievement</small>
                            <button type="button" class="btn text-blue-dark fw-bold ff-montserrat" onclick="addJobAchievement(0)">
                                <small>
                                    <span class="me-2">+</span>
                                    {{ __('Add Achievement') }}
                                </small>
                            </button>
                        </div>

                        <input type="hidden" id="addJobAchievementNo-0" name="job_achievement_no" value="0">
                        <p class="main-input mt-4 w-100 text-center text-grey-dark ff-montserrat no-job-achievement-0 small">You have no job achievement yet. Please add a new job achievement.</p>

                        <div id="addJobAchievement-0"></div>
                    </div>
                    <div class="d-flex justify-content-center py-5">
                        <button type="submit" class="btn btn-main btn-width me-3 text-white"><small>{{ __('Add Job') }}</small></button>
                        <button type="button" class="btn btn-main-blue btn-width text-blue-dark" onclick="cancelAddJob()"><small>{{ __('Cancel') }}</small></button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit job experience --}}
        @if(count($jobs)>0)
            @foreach($jobs as $no => $job)
                <div class="main-box mt-3 w-100">
                    <div class="d-flex align-items-center justify-content-between p-3 w-100 existing-job" id="existingJob-{{ ++$no }}">
                        <div class="d-flex w-100 justify-content-between">
                            <p class="text-dark ff-days-one mb-0 text-18">

                                @php
                                    $start_date     = $job->start_year.'-'.sprintf('%02d', $job->start_month).'-01 00:00:00';
                                    $start_month    = date('F', strtotime($start_date));
                                    $start_year     = date('Y', strtotime($start_date));
                                    $end_date       = $job->end_year.'-'.sprintf('%02d', $job->end_month).'-01 00:00:00';
                                    $end_month      = date('F', strtotime($end_date));
                                    $end_year       = date('Y', strtotime($end_date));
                                @endphp

                                <small>{{ $job->company_name }}</small>
                                <span class="text-dark text-12 ff-montserrat d-block">{{ $job->title }}</span>
                                <span class="ff-montserrat d-block mt-4 text-grey-dark text-10">
                                    {{ $start_month." ".$start_year }}
                                    {{ " - " }}
                                    @if(!$job->currently_work)
                                        {{ $end_month." ".$end_year }}
                                    @else
                                        {{ 'Present' }}
                                    @endif
                                </span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center">                     
                            <button type="button" class="bg-transparent border-0" onclick="triggerEditJob({{$no}})">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.7415 4.16675C13.5911 4.16675 13.443 4.22371 13.3291 4.33765L4.75 12.9167V15.2501H7.08333L15.6624 6.67098C15.8903 6.44312 15.8903 6.07397 15.6624 5.84611L14.154 4.33765C14.04 4.22371 13.8919 4.16675 13.7415 4.16675ZM13.7415 5.57495L14.4251 6.25855L13.6709 7.01278L12.9873 6.32918L13.7415 5.57495ZM12.1624 7.15405L12.846 7.83765L6.60026 14.0834H5.91667V13.3998L12.1624 7.15405Z" fill="#4C4EAF"/>
                                    <rect x="0.5" y="0.5" width="19" height="19" rx="3.5" stroke="#4C4EAF"/>
                                </svg>                            
                            </button>
                            <button type="button" class="bg-transparent border-0" onclick="triggerDeleteJobEducation({{ $job->resume_id }}, {{ $job->id }}, '{{ $job->company_name }}', 'job')" data-bs-toggle="modal" data-bs-target="#deleteJobEducationModal">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.83301 4.16675L8.24967 4.75008H5.33301V5.91675H5.91634V14.6667C5.91634 14.9721 6.02799 15.282 6.24902 15.5007C6.46777 15.7218 6.77767 15.8334 7.08301 15.8334H12.9163C13.2217 15.8334 13.5316 15.7218 13.7526 15.5007C13.9714 15.282 14.083 14.9721 14.083 14.6667V5.91675H14.6663V4.75008H11.7497L11.1663 4.16675H8.83301ZM7.08301 5.91675H12.9163V14.6667H7.08301V5.91675ZM8.24967 7.08342V13.5001H9.41634V7.08342H8.24967ZM10.583 7.08342V13.5001H11.7497V7.08342H10.583Z" fill="#4C4EAF"/>
                                    <rect x="0.5" y="0.5" width="19" height="19" rx="3.5" stroke="#4C4EAF"/>
                                </svg>  
                            </button>
                        </div>
                    </div>
                    <div class="justify-content-center mt-5 p-3 edit-existing-job d-none" id="editExistingJob-{{$no}}">
                        <form action="{{ route('resume.edit-job') }}" method="POST">
                            @csrf
                            <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                            <input type="hidden" name="job_id" value="{{ $job->id }}">
                            <div class="main-container justify-content-center">
                                <p class="text-grey-dark fw-bold text-uppercase text-12 ff-montserrat">Edit Job Experience</p> 
                                <div class="form-group mt-4 mb-3">
                                    <label for="" class="text-dark ff-days-one"><small>Company Name</small></label>
                                    <input type="text" class="form-control main-input ff-montserrat small" id="companyName" name="company_name" value="{{ $job->company_name }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="text-dark ff-days-one"><small>Title</small></label>
                                    <input type="text" class="form-control main-input ff-montserrat small" id="title" name="title" value="{{ $job->title }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="text-dark ff-days-one"><small>Location</small></label>
                                    <input type="text" class="form-control main-input ff-montserrat small" id="location" name="location" value="{{ $job->location }}" required>
                                </div>
                                <div class="row g-3 align-items-center">
                                    <label for="" class="text-dark ff-days-one mt-5"><small>Start Date</small></label>
                                    <div class="col-10">
                                        <select class="form-select main-input" name="start_month" aria-label="Month" required>
                                            <option selected>Month</option>
                                            <option value="1" @if($job->start_month==1) selected @endif>January</option>
                                            <option value="2" @if($job->start_month==2) selected @endif>February</option>
                                            <option value="3" @if($job->start_month==3) selected @endif>March</option>
                                            <option value="4" @if($job->start_month==4) selected @endif>April</option>
                                            <option value="5" @if($job->start_month==5) selected @endif>May</option>
                                            <option value="6" @if($job->start_month==6) selected @endif>June</option>
                                            <option value="7" @if($job->start_month==7) selected @endif>July</option>
                                            <option value="8" @if($job->start_month==8) selected @endif>August</option>
                                            <option value="9" @if($job->start_month==9) selected @endif>September</option>
                                            <option value="10" @if($job->start_month==10) selected @endif>October</option>
                                            <option value="11" @if($job->start_month==11) selected @endif>November</option>
                                            <option value="12" @if($job->start_month==12) selected @endif>December</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <input type="number" class="form-control main-input ff-montserrat small" id="startYear" name="start_year" value="{{ $job->start_year }}" required>
                                    </div>
                                    <div class="form-check mx-2 mt-1">
                                        <input type="checkbox" class="form-check-input" id="checkboxCurrent-{{$no}}" name="current" onchange="triggerCheckBox({{$no}})" @if($job->currently_work) checked @endif>
                                        <label class="form-check-label ff-montserrat text-dark text-10" for="checkboxCurrent">{{ __('Currently Work Here') }}</label>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center @if($job->currently_work) d-none @endif" id="endDate-{{$no}}">
                                    <label for="" class="text-dark ff-days-one mt-4"><small>End Date</small></label>
                                    <div class="col-10">
                                        <select class="form-select main-input" id="endMonth-{{$no}}" name="end_month" aria-label="Month" @if($job->currently_work) disabled @endif>
                                            <option selected>Month</option>
                                            <option value="1" @if($job->end_month==1) selected @endif>January</option>
                                            <option value="2" @if($job->end_month==2) selected @endif>February</option>
                                            <option value="3" @if($job->end_month==3) selected @endif>March</option>
                                            <option value="4" @if($job->end_month==4) selected @endif>April</option>
                                            <option value="5" @if($job->end_month==5) selected @endif>May</option>
                                            <option value="6" @if($job->end_month==6) selected @endif>June</option>
                                            <option value="7" @if($job->end_month==7) selected @endif>July</option>
                                            <option value="8" @if($job->end_month==8) selected @endif>August</option>
                                            <option value="9" @if($job->end_month==9) selected @endif>September</option>
                                            <option value="10" @if($job->end_month==10) selected @endif>October</option>
                                            <option value="11" @if($job->end_month==11) selected @endif>November</option>
                                            <option value="12" @if($job->end_month==12) selected @endif>December</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <input type="number" class="form-control main-input ff-montserrat small" id="endYear-{{$no}}" name="end_year" value="{{ $job->end_year }}" @if($job->currently_work) disabled @endif>
                                    </div>
                                </div>

                                {{-- Add/delete job task --}}
                                <div class="d-flex justify-content-between align-items-center mt-5">
                                    <small class="text-dark ff-days-one">Task</small>
                                    <button type="button" class="btn text-blue-dark fw-bold ff-montserrat" onclick="addTask({{$no}})">
                                        <small>
                                            <span class="me-2">+</span>
                                            {{ __('Add Task') }}
                                        </small>
                                    </button>
                                </div>
                                
                                <input type="hidden" id="addJobTaskNo-{{$no}}" name="task_no" value="{{ count($job->task) }}">
                                <p class="main-input mt-4 w-100 text-center text-grey-dark ff-montserrat no-job-task-{{$no}} small
                                @if(count($job->task)>0)
                                    d-none
                                @endif
                                ">You have no job task yet. Please add a new job task.</p>
                                
                                <div id="addJobTask-{{$no}}">
                                    @foreach($job->task as $i => $task)
                                        <div class="input-group my-3" id="jobTask-{{$no}}-{{++$i}}">
                                            <input type="hidden" name="job_task_id_{{$i}}" value="{{ $task->id }}">
                                            <input type="text" class="form-control ff-montserrat border-end-0 py-1 input-delete small" id="inputJobTask-{{$no}}-{{$i}}" name="job_task_{{$i}}" value="{{ $task->task_name }}">
                                            <span class="input-group-text py-1 bg-transparent m-0 p-0 border-start-0 input-delete">
                                                <button type="button" class="btn" id="btnJobTask-{{$no}}-{{$i}}" onclick="removeTask({{$no}}, {{$i}})">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.83301 4.1665L8.24967 4.74984H5.33301V5.9165H5.91634V14.6665C5.91634 14.9718 6.02799 15.2817 6.24902 15.5005C6.46777 15.7215 6.77767 15.8332 7.08301 15.8332H12.9163C13.2217 15.8332 13.5316 15.7215 13.7526 15.5005C13.9714 15.2817 14.083 14.9718 14.083 14.6665V5.9165H14.6663V4.74984H11.7497L11.1663 4.1665H8.83301ZM7.08301 5.9165H12.9163V14.6665H7.08301V5.9165ZM8.24967 7.08317V13.4998H9.41634V7.08317H8.24967ZM10.583 7.08317V13.4998H11.7497V7.08317H10.583Z" fill="#4C4EAF"/>
                                                        <rect x="0.5" y="0.5" width="19" height="19" rx="3.5" stroke="#4C4EAF"/>
                                                    </svg>                                    
                                                </button>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Add/delete job achievement --}}
                                <div class="d-flex justify-content-between align-items-center mt-5">
                                    <small class="text-dark ff-days-one">Achievement</small>
                                    <button type="button" class="btn text-blue-dark fw-bold ff-montserrat" onclick="addJobAchievement({{$no}})">
                                        <small>
                                            <span class="me-2">+</span>
                                            {{ __('Add Achievement') }}
                                        </small>
                                    </button>
                                </div>

                                <input type="hidden" id="addJobAchievementNo-{{$no}}" name="job_achievement_no" value="{{ count($job->achievement) }}">
                                <p class="main-input mt-4 w-100 text-center text-grey-dark ff-montserrat no-job-achievement-{{$no}} small
                                @if(count($job->achievement)>0)
                                    d-none
                                @endif
                                ">You have no job achievement yet. Please add a new job achievement.</p>

                                <div id="addJobAchievement-{{$no}}">
                                    @foreach($job->achievement as $i => $achievement)
                                        <div class="input-group my-3" id="jobAchievement-{{$no}}-{{++$i}}">
                                            <input type="hidden" name="job_achievement_id_{{$i}}" value="{{ $achievement->id }}">
                                            <input type="text" class="form-control ff-montserrat border-end-0 py-1 input-delete small" id="inputJobAchievement-{{$no}}-{{$i}}" name="job_achievement_{{$i}}" value="{{ $achievement->achievement_name }}">
                                            <span class="input-group-text py-1 bg-transparent m-0 p-0 border-start-0 input-delete">
                                                <button type="button" class="btn" id="btnJobAchievement-{{$no}}-{{$i}}" onclick="removeJobAchievement({{$no}}, {{$i}})">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.83301 4.1665L8.24967 4.74984H5.33301V5.9165H5.91634V14.6665C5.91634 14.9718 6.02799 15.2817 6.24902 15.5005C6.46777 15.7215 6.77767 15.8332 7.08301 15.8332H12.9163C13.2217 15.8332 13.5316 15.7215 13.7526 15.5005C13.9714 15.2817 14.083 14.9718 14.083 14.6665V5.9165H14.6663V4.74984H11.7497L11.1663 4.1665H8.83301ZM7.08301 5.9165H12.9163V14.6665H7.08301V5.9165ZM8.24967 7.08317V13.4998H9.41634V7.08317H8.24967ZM10.583 7.08317V13.4998H11.7497V7.08317H10.583Z" fill="#4C4EAF"/>
                                                        <rect x="0.5" y="0.5" width="19" height="19" rx="3.5" stroke="#4C4EAF"/>
                                                    </svg>                                    
                                                </button>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-flex justify-content-center py-5">
                                <button type="submit" class="btn btn-main btn-width me-3 text-white"><small>{{ __('Save') }}</small></button>
                                <button type="button" class="btn btn-main-blue btn-width text-blue-dark" onclick="cancelEditJob({{$no}})"><small>{{ __('Cancel') }}</small></button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p class="main-box mt-4 w-100 text-center py-5 text-grey-dark ff-montserrat no-job small">You have no job yet. Please add a new job.</p>
        @endif

        <div class="d-flex justify-content-between align-items-center mt-5">
            <h1 class="text-dark fs-4 ff-days-one">Education</h1>
            <button type="button" class="btn text-blue-dark fw-bold ff-montserrat" onclick="triggerAddEducation()">
                <small>
                    <span class="me-2">+</span>
                    {{ __('Add Education ') }}
                </small>
            </button>
        </div>

        {{-- Add education --}}
        <div class="main-box mt-3 w-100 d-none" id="addEducation">
            <div class="justify-content-center mt-5 p-3">
                <form action="{{ route('resume.add-education') }}" method="POST">
                    @csrf
                    <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                    <div class="main-container justify-content-center">
                        <p class="text-grey-dark fw-bold text-uppercase text-12 ff-montserrat">Add Education</p> 
                        <div class="form-group mt-4 mb-3">
                            <label for="" class="text-dark ff-days-one"><small>School</small></label>
                            <input type="text" class="form-control main-input ff-montserrat small" id="school" name="school" value="" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="text-dark ff-days-one"><small>Degree</small></label>
                            <input type="text" class="form-control main-input ff-montserrat small" id="degree" name="degree" value="" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="text-dark ff-days-one"><small>Result</small></label>
                            <input type="text" class="form-control main-input ff-montserrat small" id="result" name="result" value="" required>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                            <label for="" class="text-dark ff-days-one mt-5"><small>Start Date</small></label>
                            <div class="col-10">
                                <select class="form-select main-input" name="start_month" aria-label="Month" required>
                                    <option selected>Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control main-input ff-montserrat small" id="startYear" name="start_year" value="" required>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <label for="" class="text-dark ff-days-one mt-4"><small>End Date/Expected End Date</small></label>
                            <div class="col-10">
                                <select class="form-select main-input" aria-label="Month" name="end_month" required>
                                    <option selected>Month</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control main-input ff-montserrat small" id="endYear" name="end_year" value="" required>
                            </div>
                        </div>

                        {{-- Add/cancel education achievement --}}
                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <small class="text-dark ff-days-one">Achievement</small>
                            <button type="button" class="btn text-blue-dark fw-bold ff-montserrat" onclick="addEducationAchievement(0)">
                                <small>
                                    <span class="me-2">+</span>
                                    {{ __('Add Achievement') }}
                                </small>
                            </button>
                        </div>

                        <input type="hidden" id="addEducationAchievementNo-0" name="education_achievement_no" value="0">
                        <p class="main-input mt-4 w-100 text-center text-grey-dark ff-montserrat no-education-achievement-0 small">You have no education achievement yet. Please add a new education achievement.</p>

                        <div id="addEducationAchievement-0"></div>
                    </div>
                    <div class="d-flex justify-content-center py-5">
                        <button type="submit" class="btn btn-main btn-width me-3 text-white"><small>{{ __('Add Education') }}</small></button>
                        <button type="button" class="btn btn-main-blue btn-width text-blue-dark" onclick="cancelAddEducation()"><small>{{ __('Cancel') }}</small></button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Edit education --}}
        @if(count($educations)>0)
            @foreach($educations as $no => $education)
                <div class="main-box mt-3 w-100">
                    <div class="d-flex align-items-center justify-content-between p-3 w-100 existing-education" id="existingEducation-{{ ++$no }}">
                        <div class="d-flex w-100 justify-content-between">
                            <p class="text-dark ff-days-one mb-0 text-18">

                                @php
                                    $start_date     = $education->start_year.'-'.sprintf('%02d', $education->start_month).'-01 00:00:00';
                                    $start_month    = date('F', strtotime($start_date));
                                    $start_year     = date('Y', strtotime($start_date));
                                    $end_date       = $education->end_year.'-'.sprintf('%02d', $education->end_month).'-01 00:00:00';
                                    $end_month      = date('F', strtotime($end_date));
                                    $end_year       = date('Y', strtotime($end_date));
                                @endphp

                                <small>{{ $education->school }}</small>
                                <span class="text-dark text-12 ff-montserrat d-block">{{ $education->degree }}</span>
                                <span class="ff-montserrat d-block mt-4 text-grey-dark text-10">
                                    {{ $start_month." ".$start_year }}
                                    {{ " - " }}
                                    {{ $end_month." ".$end_year }}
                                </span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center">                     
                            <button type="button" class="bg-transparent border-0" onclick="triggerEditEducation({{$no}})">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.7415 4.16675C13.5911 4.16675 13.443 4.22371 13.3291 4.33765L4.75 12.9167V15.2501H7.08333L15.6624 6.67098C15.8903 6.44312 15.8903 6.07397 15.6624 5.84611L14.154 4.33765C14.04 4.22371 13.8919 4.16675 13.7415 4.16675ZM13.7415 5.57495L14.4251 6.25855L13.6709 7.01278L12.9873 6.32918L13.7415 5.57495ZM12.1624 7.15405L12.846 7.83765L6.60026 14.0834H5.91667V13.3998L12.1624 7.15405Z" fill="#4C4EAF"/>
                                    <rect x="0.5" y="0.5" width="19" height="19" rx="3.5" stroke="#4C4EAF"/>
                                </svg>                            
                            </button>
                            <button type="button" class="bg-transparent border-0" onclick="triggerDeleteJobEducation({{ $education->resume_id }}, {{ $education->id }}, '{{ $education->school }}', 'education')" data-bs-toggle="modal" data-bs-target="#deleteJobEducationModal">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.83301 4.16675L8.24967 4.75008H5.33301V5.91675H5.91634V14.6667C5.91634 14.9721 6.02799 15.282 6.24902 15.5007C6.46777 15.7218 6.77767 15.8334 7.08301 15.8334H12.9163C13.2217 15.8334 13.5316 15.7218 13.7526 15.5007C13.9714 15.282 14.083 14.9721 14.083 14.6667V5.91675H14.6663V4.75008H11.7497L11.1663 4.16675H8.83301ZM7.08301 5.91675H12.9163V14.6667H7.08301V5.91675ZM8.24967 7.08342V13.5001H9.41634V7.08342H8.24967ZM10.583 7.08342V13.5001H11.7497V7.08342H10.583Z" fill="#4C4EAF"/>
                                    <rect x="0.5" y="0.5" width="19" height="19" rx="3.5" stroke="#4C4EAF"/>
                                </svg>  
                            </button>
                        </div>
                    </div>
                    <div class="justify-content-center mt-5 p-3 edit-existing-education d-none" id="editExistingEducation-{{$no}}">
                        <form action="{{ route('resume.edit-education') }}" method="POST">
                            @csrf
                            <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                            <input type="hidden" name="education_id" value="{{ $education->id }}">
                            <div class="main-container justify-content-center">
                                <p class="text-grey-dark fw-bold text-uppercase text-12 ff-montserrat">Edit Education</p> 
                                <div class="form-group mt-4 mb-3">
                                    <label for="" class="text-dark ff-days-one"><small>School</small></label>
                                    <input type="text" class="form-control main-input ff-montserrat small" id="school" name="school" value="{{ $education->school }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="text-dark ff-days-one"><small>Degree</small></label>
                                    <input type="text" class="form-control main-input ff-montserrat small" id="degree" name="degree" value="{{ $education->degree }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="text-dark ff-days-one"><small>Result</small></label>
                                    <input type="text" class="form-control main-input ff-montserrat small" id="result" name="result" value="{{ $education->result }}" required>
                                </div>
                                <div class="row g-3 align-items-center mb-3">
                                    <label for="" class="text-dark ff-days-one mt-5"><small>Start Date</small></label>
                                    <div class="col-10">
                                        <select class="form-select main-input" name="start_month" aria-label="Month" required>
                                            <option selected>Month</option>
                                            <option value="1" @if($education->start_month==1) selected @endif>January</option>
                                            <option value="2" @if($education->start_month==2) selected @endif>February</option>
                                            <option value="3" @if($education->start_month==3) selected @endif>March</option>
                                            <option value="4" @if($education->start_month==4) selected @endif>April</option>
                                            <option value="5" @if($education->start_month==5) selected @endif>May</option>
                                            <option value="6" @if($education->start_month==6) selected @endif>June</option>
                                            <option value="7" @if($education->start_month==7) selected @endif>July</option>
                                            <option value="8" @if($education->start_month==8) selected @endif>August</option>
                                            <option value="9" @if($education->start_month==9) selected @endif>September</option>
                                            <option value="10" @if($education->start_month==10) selected @endif>October</option>
                                            <option value="11" @if($education->start_month==11) selected @endif>November</option>
                                            <option value="12" @if($education->start_month==12) selected @endif>December</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control main-input ff-montserrat small" id="startYear" name="start_year" value="{{ $education->start_year }}" required>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center">
                                    <label for="" class="text-dark ff-days-one mt-4"><small>End Date/Expected End Date</small></label>
                                    <div class="col-10">
                                        <select class="form-select main-input" name="end_month" aria-label="Month" required>
                                            <option selected>Month</option>
                                            <option value="1" @if($education->end_month==1) selected @endif>January</option>
                                            <option value="2" @if($education->end_month==2) selected @endif>February</option>
                                            <option value="3" @if($education->end_month==3) selected @endif>March</option>
                                            <option value="4" @if($education->end_month==4) selected @endif>April</option>
                                            <option value="5" @if($education->end_month==5) selected @endif>May</option>
                                            <option value="6" @if($education->end_month==6) selected @endif>June</option>
                                            <option value="7" @if($education->end_month==7) selected @endif>July</option>
                                            <option value="8" @if($education->end_month==8) selected @endif>August</option>
                                            <option value="9" @if($education->end_month==9) selected @endif>September</option>
                                            <option value="10" @if($education->end_month==10) selected @endif>October</option>
                                            <option value="11" @if($education->end_month==11) selected @endif>November</option>
                                            <option value="12" @if($education->end_month==12) selected @endif>December</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control main-input ff-montserrat small" id="endYear" name="end_year" value="{{ $education->end_year }}" required>
                                    </div>
                                </div>

                                {{-- Add/delete education achievement --}}
                                <div class="d-flex justify-content-between align-items-center mt-5">
                                    <small class="text-dark ff-days-one">Achievement</small>
                                    <button type="button" class="btn text-blue-dark fw-bold ff-montserrat" onclick="addEducationAchievement({{$no}})">
                                        <small>
                                            <span class="me-2">+</span>
                                            {{ __('Add Achievement') }}
                                        </small>
                                    </button>
                                </div>

                                <input type="hidden" id="addEducationAchievementNo-{{$no}}" name="education_achievement_no" value="{{ count($education->achievement) }}">
                                <p class="main-input mt-4 w-100 text-center text-grey-dark ff-montserrat no-education-achievement-{{$no}} small
                                @if(count($education->achievement)>0)
                                    d-none
                                @endif
                                ">You have no education achievement yet. Please add a new education achievement.</p>

                                <div id="addEducationAchievement-{{$no}}">
                                    @foreach($education->achievement as $i => $achievement)
                                        <div class="input-group my-3" id="educationAchievement-{{$no}}-{{++$i}}">
                                            <input type="hidden" name="education_achievement_id_{{$i}}" value="{{ $achievement->id }}">
                                            <input type="text" class="form-control ff-montserrat border-end-0 py-1 input-delete small" id="inputEducationAchievement-{{$no}}-{{$i}}" name="education_achievement_{{$i}}" value="{{ $achievement->achievement_name }}">
                                            <span class="input-group-text py-1 bg-transparent m-0 p-0 border-start-0 input-delete">
                                                <button type="button" class="btn" id="btnEducationAchievement-{{$no}}-{{$i}}" onclick="removeEducationAchievement({{$no}}, {{$i}})">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.83301 4.1665L8.24967 4.74984H5.33301V5.9165H5.91634V14.6665C5.91634 14.9718 6.02799 15.2817 6.24902 15.5005C6.46777 15.7215 6.77767 15.8332 7.08301 15.8332H12.9163C13.2217 15.8332 13.5316 15.7215 13.7526 15.5005C13.9714 15.2817 14.083 14.9718 14.083 14.6665V5.9165H14.6663V4.74984H11.7497L11.1663 4.1665H8.83301ZM7.08301 5.9165H12.9163V14.6665H7.08301V5.9165ZM8.24967 7.08317V13.4998H9.41634V7.08317H8.24967ZM10.583 7.08317V13.4998H11.7497V7.08317H10.583Z" fill="#4C4EAF"/>
                                                        <rect x="0.5" y="0.5" width="19" height="19" rx="3.5" stroke="#4C4EAF"/>
                                                    </svg>                                    
                                                </button>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-flex justify-content-center py-5">
                                <button type="submit" class="btn btn-main btn-width me-3 text-white"><small>{{ __('Save') }}</small></button>
                                <button type="button" class="btn btn-main-blue btn-width text-blue-dark" onclick="cancelEditEducation({{$no}})"><small>{{ __('Cancel') }}</small></button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p class="main-box mt-4 w-100 text-center py-5 text-grey-dark ff-montserrat no-education small">You have no education yet. Please add a new education.</p>
        @endif
    </div>
</div>
{{-- Start delete modal --}}
<form action="{{ route('resume.delete') }}" method="POST">
    @csrf
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-body p-5">
                    <input type="hidden" id="deleteId" name="resume_id">
                    <p class="modal-title fw-bold fs-2 text-dark ff-days-one" id="deleteModalLabel">Are you sure to delete <span id="deleteTitle"></span>?</p>
                    <button type="submit" class="btn btn-main text-white mt-3 w-100"><small>{{ __('Delete') }}</small></button>
                    <button type="button" class="btn btn-main-blue text-blue-dark mt-3 w-100" data-bs-dismiss="modal"><small>{{ __('Cancel') }}</small></button>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- End delete modal --}}

{{-- Start delete job/education modal --}}
<form action="{{ route('resume.delete-job-education') }}" method="POST">
    @csrf
    <div class="modal fade" id="deleteJobEducationModal" tabindex="-1" aria-labelledby="deleteJobEducationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-body p-5">
                    <input type="hidden" id="deleteResumeId" name="resume_id">
                    <input type="hidden" id="deleteType" name="type">
                    <input type="hidden" id="deleteJobEducationId" name="id">
                    <p class="modal-title fw-bold fs-2 text-dark ff-days-one" id="deleteJobEducationModalLabel">Are you sure to delete <span id="deleteJobEducationTitle"></span>?</p>
                    <button type="submit" class="btn btn-main text-white mt-3 w-100"><small>{{ __('Delete') }}</small></button>
                    <button type="button" class="btn btn-main-blue text-blue-dark mt-3 w-100" data-bs-dismiss="modal"><small>{{ __('Cancel') }}</small></button>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- End delete modal --}}

{{-- Start change status modal --}}
<form action="{{ route('resume.update-resume-status') }}" method="POST">
    @csrf
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-body p-5">
                    <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                    <input type="hidden" id="status" name="status">
                    <p class="modal-title fw-bold fs-2 text-dark ff-days-one" id="statusModalLabel">Are you sure to <span id="statusTitle"></span> this resume?</p>
                    <button type="submit" class="btn btn-main text-white mt-3 w-100"><small id="statusBtn"></small></button>
                    <button type="button" class="btn btn-main-blue text-blue-dark mt-3 w-100" data-bs-dismiss="modal"><small>{{ __('Cancel') }}</small></button>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- End change status modal --}}
@endsection

@push('js')
<script>
    // Show and hide add job experience
    function triggerAddJob() {
        $('#addJob').removeClass('d-none');
        $('.no-job').addClass('d-none');
    }

    function cancelAddJob() {
        $('#addJob').addClass('d-none');
        $('.no-job').removeClass('d-none');
    }

    // Add and delete job task
    function addTask(id) {
        $('.no-job-task-'+id).addClass('d-none');

        var addJobTaskNo = parseInt($('#addJobTaskNo-'+id).val())+1;

        $('#addJobTaskNo-'+id).val(addJobTaskNo);

        var allJob = [];

        if(addJobTaskNo > 1) {
            for(var i = 1; i < addJobTaskNo; i++) {
                allJob.push($('#inputJobTask-'+id+'-'+i).val());
            }
        }

        var html = $('#addJobTask-'+id).html()+
                    '<div class="input-group my-3" id="jobTask-'+id+'-'+addJobTaskNo+'">'+
                        '<input type="text" class="form-control ff-montserrat border-end-0 py-1 small" style="border: 1px solid #C4C4C4;" id="inputJobTask-'+id+'-'+addJobTaskNo+'" name="job_task_'+addJobTaskNo+'" value="">'+
                        '<span class="input-group-text py-1 bg-transparent m-0 p-0 border-start-0" style="border: 1px solid #C4C4C4;">'+
                            '<button type="button" class="btn" onclick="removeTask('+id+', '+addJobTaskNo+')" id="btnJobTask-'+id+'-'+addJobTaskNo+'">'+
                                '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                                    '<path d="M8.83301 4.1665L8.24967 4.74984H5.33301V5.9165H5.91634V14.6665C5.91634 14.9718 6.02799 15.2817 6.24902 15.5005C6.46777 15.7215 6.77767 15.8332 7.08301 15.8332H12.9163C13.2217 15.8332 13.5316 15.7215 13.7526 15.5005C13.9714 15.2817 14.083 14.9718 14.083 14.6665V5.9165H14.6663V4.74984H11.7497L11.1663 4.1665H8.83301ZM7.08301 5.9165H12.9163V14.6665H7.08301V5.9165ZM8.24967 7.08317V13.4998H9.41634V7.08317H8.24967ZM10.583 7.08317V13.4998H11.7497V7.08317H10.583Z" fill="#4C4EAF"/>'+
                                    '<rect x="0.5" y="0.5" width="19" height="19" rx="3.5" stroke="#4C4EAF"/>'
                                '</svg>'+                                    
                            '</button>'+
                        '</span>'+
                    '</div>';

        $('#addJobTask-'+id).html(html);

        if(addJobTaskNo > 1) {
            for(var i = 1; i < addJobTaskNo; i++) {
                $('#inputJobTask-'+id+'-'+i).val(allJob[(i-1)]);
            }
        }
    }

    function removeTask(id, delete_task_no) {
        var addJobTaskNo   = parseInt($('#addJobTaskNo-'+id).val())-1;
        var totalJobTaskNo = parseInt($('#addJobTaskNo-'+id).val());

        $('#addJobTaskNo-'+id).val(addJobTaskNo);

        var html = '';
        var allJob = [];

        if(addJobTaskNo==0) {
            $('.no-job-task-'+id).removeClass('d-none');
        }else {
            for(var i = 1; i < totalJobTaskNo+1; i++) {
                if(i!=delete_task_no) {
                    allJob.push($('#inputJobTask-'+id+'-'+i).val());
                    html = html+
                            '<div class="input-group my-3" id="jobTask-'+id+'-'+i+'">'+
                                $('#jobTask-'+id+'-'+i).html()+
                            '</div>';
                }
            }
        }

        $('#addJobTask-'+id).html(html);

        for(var i = delete_task_no+1; i < totalJobTaskNo+1; i++) {
            $('#jobTask-'+id+'-'+i).attr('id', 'jobTask-'+id+'-'+(i-1));
            $('#inputJobTask-'+id+'-'+i).attr('name', 'job_task_'+(i-1));
            $('#inputJobTask-'+id+'-'+i).attr('id', 'inputJobTask-'+id+'-'+(i-1));
            $('#btnJobTask-'+id+'-'+i).attr('onclick', "removeTask("+id+", "+(i-1)+")");
            $('#btnJobTask-'+id+'-'+i).attr('id', 'btnJobTask-'+id+'-'+(i-1));
        }

        if(addJobTaskNo > 0) {
            for(var i = 1; i < addJobTaskNo+1; i++) {
                $('#inputJobTask-'+id+'-'+i).val(allJob[(i-1)]);
            }
        }
    }

    // Add and delete job achievement
    function addJobAchievement(id) {
        $('.no-job-achievement-'+id).addClass('d-none');

        var addJobAchievementNo = parseInt($('#addJobAchievementNo-'+id).val())+1;

        $('#addJobAchievementNo-'+id).val(addJobAchievementNo);

        var allJobAchievement = [];

        if(addJobAchievementNo > 1) {
            for(var i = 1; i < addJobAchievementNo; i++) {
                allJobAchievement.push($('#inputJobAchievement-'+id+'-'+i).val());
            }
        }

        var html = $('#addJobAchievement-'+id).html()+
                    '<div class="input-group my-3" id="jobAchievement-'+id+'-'+addJobAchievementNo+'">'+
                        '<input type="text" class="form-control ff-montserrat border-end-0 py-1 small" style="border: 1px solid #C4C4C4;" id="inputJobAchievement-'+id+'-'+addJobAchievementNo+'" name="job_achievement_'+addJobAchievementNo+'" value="">'+
                        '<span class="input-group-text py-1 bg-transparent m-0 p-0 border-start-0" style="border: 1px solid #C4C4C4;">'+
                            '<button type="button" class="btn" onclick="removeJobAchievement('+id+', '+addJobAchievementNo+')" id="btnJobAchievement-'+id+'-'+addJobAchievementNo+'">'+
                                '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                                    '<path d="M8.83301 4.1665L8.24967 4.74984H5.33301V5.9165H5.91634V14.6665C5.91634 14.9718 6.02799 15.2817 6.24902 15.5005C6.46777 15.7215 6.77767 15.8332 7.08301 15.8332H12.9163C13.2217 15.8332 13.5316 15.7215 13.7526 15.5005C13.9714 15.2817 14.083 14.9718 14.083 14.6665V5.9165H14.6663V4.74984H11.7497L11.1663 4.1665H8.83301ZM7.08301 5.9165H12.9163V14.6665H7.08301V5.9165ZM8.24967 7.08317V13.4998H9.41634V7.08317H8.24967ZM10.583 7.08317V13.4998H11.7497V7.08317H10.583Z" fill="#4C4EAF"/>'+
                                    '<rect x="0.5" y="0.5" width="19" height="19" rx="3.5" stroke="#4C4EAF"/>'
                                '</svg>'+                                    
                            '</button>'+
                        '</span>'+
                    '</div>';

        $('#addJobAchievement-'+id).html(html);

        if(addJobAchievementNo > 1) {
            for(var i = 1; i < addJobAchievementNo; i++) {
                $('#inputJobAchievement-'+id+'-'+i).val(allJobAchievement[(i-1)]);
            }
        }
    }

    function removeJobAchievement(id, delete_achievement_no) {
        var addJobAchievementNo   = parseInt($('#addJobAchievementNo-'+id).val())-1;
        var totalJobAchievementNo = parseInt($('#addJobAchievementNo-'+id).val());

        $('#addJobAchievementNo-'+id).val(addJobAchievementNo);

        var html = '';
        var allJobAchievement = [];

        if(addJobAchievementNo==0) {
            $('.no-job-achievement-'+id).removeClass('d-none');
        }else {
            for(var i = 1; i < totalJobAchievementNo+1; i++) {
                if(i!=delete_achievement_no) {
                    allJobAchievement.push($('#inputJobAchievement-'+id+'-'+i).val());
                    html = html+
                            '<div class="input-group my-3" id="jobAchievement-'+id+'-'+i+'">'+
                                $('#jobAchievement-'+id+'-'+i).html()+
                            '</div>';
                }
            }
        }

        $('#addJobAchievement-'+id).html(html);

        for(var i = delete_achievement_no+1; i < totalJobAchievementNo+1; i++) {
            $('#jobAchievement-'+id+'-'+i).attr('id', 'jobAchievement-'+id+'-'+(i-1));
            $('#inputJobAchievement-'+id+'-'+i).attr('name', 'job_achievement_'+(i-1));
            $('#inputJobAchievement-'+id+'-'+i).attr('id', 'inputJobAchievement-'+id+'-'+(i-1));
            $('#btnJobAchievement-'+id+'-'+i).attr('onclick', "removeJobAchievement("+id+", "+(i-1)+")");
            $('#btnJobAchievement-'+id+'-'+i).attr('id', 'btnJobAchievement-'+id+'-'+(i-1));
        }

        if(addJobAchievementNo > 0) {
            for(var i = 1; i < addJobAchievementNo+1; i++) {
                $('#inputJobAchievement-'+id+'-'+i).val(allJobAchievement[(i-1)]);
            }
        }
    }

    // Checkbox
    function triggerCheckBox(id) {
        if($('#checkboxCurrent-'+id).is(':checked')) {
            $('#endYear-'+id).attr('required', false);
            $('#endYear-'+id).attr('disabled', true);
            $('#endMonth-'+id).attr('required', false);
            $('#endMonth-'+id).attr('disabled', true);
            $('#endDate-'+id).addClass('d-none');
        }else {
            $('#endYear-'+id).attr('required', true);
            $('#endYear-'+id).attr('disabled', false);
            $('#endMonth-'+id).attr('required', true);
            $('#endMonth-'+id).attr('disabled', false);
            $('#endDate-'+id).removeClass('d-none');
        }
    }

    // Edit job
    function triggerEditJob(jobId) {
        $('.edit-existing-job').addClass('d-none');
        $('.existing-job').removeClass('d-none');
        $('#existingJob-'+jobId).addClass('d-none');
        $('#editExistingJob-'+jobId).removeClass('d-none');
    }

    // Cancel edit job
    function cancelEditJob(jobId) {
        $('.edit-existing-job').addClass('d-none');
        $('.existing-job').removeClass('d-none');
    }

    // Delete job/education
    function triggerDeleteJobEducation(resume_id, id, name, type) {
        $('#deleteJobEducationTitle').html(name);
        $('#deleteResumeId').val(resume_id);
        $('#deleteType').val(type);
        $('#deleteJobEducationId').val(id);
    }

    // Show and hide add job experience
    function triggerAddEducation() {
        $('#addEducation').removeClass('d-none');
        $('.no-education').addClass('d-none');
    }

    function cancelAddEducation() {
        $('#addEducation').addClass('d-none');
        $('.no-education').removeClass('d-none');
    }

    // Add and delete education achievement
    function addEducationAchievement(id) {
        $('.no-education-achievement-'+id).addClass('d-none');

        var addEducationAchievementNo = parseInt($('#addEducationAchievementNo-'+id).val())+1;

        $('#addEducationAchievementNo-'+id).val(addEducationAchievementNo);

        var allEducationAchievement = [];

        if(addEducationAchievementNo > 1) {
            for(var i = 1; i < addEducationAchievementNo; i++) {
                allEducationAchievement.push($('#inputEducationAchievement-'+id+'-'+i).val());
            }
        }

        var html = $('#addEducationAchievement-'+id).html()+
                    '<div class="input-group my-3" id="educationAchievement-'+id+'-'+addEducationAchievementNo+'">'+
                        '<input type="text" class="form-control ff-montserrat border-end-0 py-1 small" style="border: 1px solid #C4C4C4;" id="inputEducationAchievement-'+id+'-'+addEducationAchievementNo+'" name="education_achievement_'+addEducationAchievementNo+'" value="">'+
                        '<span class="input-group-text py-1 bg-transparent m-0 p-0 border-start-0" style="border: 1px solid #C4C4C4;">'+
                            '<button type="button" class="btn" onclick="removeEducationAchievement('+id+', '+addEducationAchievementNo+')" id="btnEducationAchievement-'+id+'-'+addEducationAchievementNo+'">'+
                                '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">'+
                                    '<path d="M8.83301 4.1665L8.24967 4.74984H5.33301V5.9165H5.91634V14.6665C5.91634 14.9718 6.02799 15.2817 6.24902 15.5005C6.46777 15.7215 6.77767 15.8332 7.08301 15.8332H12.9163C13.2217 15.8332 13.5316 15.7215 13.7526 15.5005C13.9714 15.2817 14.083 14.9718 14.083 14.6665V5.9165H14.6663V4.74984H11.7497L11.1663 4.1665H8.83301ZM7.08301 5.9165H12.9163V14.6665H7.08301V5.9165ZM8.24967 7.08317V13.4998H9.41634V7.08317H8.24967ZM10.583 7.08317V13.4998H11.7497V7.08317H10.583Z" fill="#4C4EAF"/>'+
                                    '<rect x="0.5" y="0.5" width="19" height="19" rx="3.5" stroke="#4C4EAF"/>'
                                '</svg>'+                                    
                            '</button>'+
                        '</span>'+
                    '</div>';

        $('#addEducationAchievement-'+id).html(html);

        if(addEducationAchievementNo > 1) {
            for(var i = 1; i < addEducationAchievementNo; i++) {
                $('#inputEducationAchievement-'+id+'-'+i).val(allEducationAchievement[(i-1)]);
            }
        }
    }

    function removeEducationAchievement(id, delete_achievement_no) {
        var addEducationAchievementNo   = parseInt($('#addEducationAchievementNo-'+id).val())-1;
        var totalEducationAchievementNo = parseInt($('#addEducationAchievementNo-'+id).val());

        $('#addEducationAchievementNo-'+id).val(addEducationAchievementNo);

        var html = '';
        var allEducationAchievement = [];

        if(addEducationAchievementNo==0) {
            $('.no-education-achievement-'+id).removeClass('d-none');
        }else {
            for(var i = 1; i < totalEducationAchievementNo+1; i++) {
                if(i!=delete_achievement_no) {
                    allEducationAchievement.push($('#inputEducationAchievement-'+id+'-'+i).val());
                    html = html+
                            '<div class="input-group my-3" id="educationAchievement-'+id+'-'+i+'">'+
                                $('#educationAchievement-'+id+'-'+i).html()+
                            '</div>';
                }
            }
        }

        $('#addEducationAchievement-'+id).html(html);

        for(var i = delete_achievement_no+1; i < totalEducationAchievementNo+1; i++) {
            $('#educationAchievement-'+id+'-'+i).attr('id', 'educationAchievement-'+id+'-'+(i-1));
            $('#inputEducationAchievement-'+id+'-'+i).attr('name', 'education_achievement_'+(i-1));
            $('#inputEducationAchievement-'+id+'-'+i).attr('id', 'inputEducationAchievement-'+id+'-'+(i-1));
            $('#btnEducationAchievement-'+id+'-'+i).attr('onclick', "removeEducationAchievement("+id+", "+(i-1)+")");
            $('#btnEducationAchievement-'+id+'-'+i).attr('id', 'btnEducationAchievement-'+id+'-'+(i-1));
        }

        if(addEducationAchievementNo > 0) {
            for(var i = 1; i < addEducationAchievementNo+1; i++) {
                $('#inputEducationAchievement-'+id+'-'+i).val(allEducationAchievement[(i-1)]);
            }
        }
    }

    // Edit education
    function triggerEditEducation(educationId) {
        $('.edit-existing-education').addClass('d-none');
        $('.existing-education').removeClass('d-none');
        $('#existingEducation-'+educationId).addClass('d-none');
        $('#editExistingEducation-'+educationId).removeClass('d-none');
    }

    // Cancel edit education
    function cancelEditEducation(educationId) {
        $('.edit-existing-education').addClass('d-none');
        $('.existing-education').removeClass('d-none');
    }

    // Change status
    function triggerChangeStatus(status) {
        $('#status').val(status);

        var title;
        var btn;

        if(status=='Draft') {
            title   = 'draft';
            btn     = 'Make Draft';
        }else {
            title   = 'publish';
            btn     = 'Publish';    
        }

        $('#statusTitle').html(title);
        $('#statusBtn').html(btn);
    }

    // Delete resume
    function triggerDelete(id, title) {
        $('#deleteTitle').html(title);
        $('#deleteId').val(id);
    }

    // Copy link
    function copyLink() {
        $('#url').select();

        document.execCommand('copy');
    }
</script>
@endpush