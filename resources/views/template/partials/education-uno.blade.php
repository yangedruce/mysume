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