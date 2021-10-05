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