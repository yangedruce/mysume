@extends('layouts.navbar')

@section('title')
{{ __('Create New Resume') }}
@endsection

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-12 col-xl-6">

        {{-- checking either it is create new resume or edit resume settings --}}
        @if($resume ?? '')
            <h1 class="text-dark fs-4 ff-days-one">Edit Resume Settings</h1> 
        @else
            <h1 class="text-dark fs-4 ff-days-one">Create New Resume</h1>
        @endif

        <div class="justify-content-center mt-5">
            {{-- checking either it is create new resume or edit resume settings --}}
            @if($resume ?? '')
                <form action="{{ route('resume.update-resume-settings') }}" method="POST">
            @else
                <form action="{{ route('resume.create-new-resume') }}" method="POST">
            @endif
                @csrf

                {{-- resume create/edit --}}
                @if($resume ?? '')
                    <input type="hidden" value="{{ $resume->id }}" name="resume_id">
                @endif
                <div class="main-container justify-content-center">
                    <div class="form-group mt-4 mb-4">
                        <label for="inputTitle" class="text-dark ff-days-one"><small>Title</small></label>

                        @if($resume ?? '')
                            <input type="text" class="form-control main-input ff-montserrat small" id="inputTitle" name="title" value="{{ $resume->title }}" required>
                        @else
                            <input type="text" class="form-control main-input ff-montserrat small" id="inputTitle" name="title" value="{{ old('title') }}" required>
                        @endif

                    </div>
                    <small class="text-dark ff-days-one">Choose Template</small>

                    @foreach($templates as $no => $template)
                        <div class="main-box p-4 mb-3">
                            <div class="form-check">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-block">
                                        <input class="form-check-input me-3" type="radio" name="template" id="inputTemplate{{$no}}" value="{{ $template->id }}" required
                                        @if($resume ?? '')
                                            @if($resume->template_id==$template->id)
                                                checked
                                            @endif
                                        @endif
                                        >
                                        <label class="form-check-label ff-montserrat fw-bold small" for="inputTemplate{{$no}}">
                                            {{ $template->name }}
                                        </label>
                                    </div>
                                    <a href="{{ route('resume.preview-resume', ['template' => $template->name]) }}" target="_blank">
                                        <button type="button" class="btn btn-main btn-width text-white ff-montserrat"><small>{{ __('Preview') }}</small></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- checking either it is create new resume or edit resume settings (save - edit) (continue-create new) --}}
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-main btn-width text-white m-2">
                            <small>

                            @if($resume ?? '')
                                {{ __('Save') }} 
                            @else
                                {{ __('Continue') }}
                            @endif

                            </small>
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-main-blue btn-width text-decoration-none text-blue-dark m-2"><small>Cancel</small></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection