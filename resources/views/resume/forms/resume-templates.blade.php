{{-- checking either it is create new resume or edit resume settings --}}
@if($resume ?? '')
<form action="{{ route('resume.update-resume-settings', $resume) }}" method="POST">
@else
<form action="{{ route('resume.create-new-resume') }}" method="POST">
@endif
@csrf

    {{-- resume create/edit --}}
    @if($resume ?? '')
        <input type="hidden" value="{{ $resume->id }}" name="resume_id">
    @endif
    <div class="main-container justify-content-center">
        @include('resume.partials.title')
        
        @include('resume.partials.templates')

        {{-- checking either it is create new resume or edit resume settings (save - edit) (continue-create new) --}}
        <div class="text-center mt-5">
            <button type="submit" class="btn btn-main btn-width text-white m-2">
                <small>

                @if($resume ?? '')
                    Save
                @else
                    Continue
                @endif

                </small>
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-main-blue btn-width text-decoration-none text-blue-dark m-2"><small>Cancel</small></a>
        </div>
    </div>
</form>