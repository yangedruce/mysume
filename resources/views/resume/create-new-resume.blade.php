@extends('layouts.navbar')

@section('title', 'Create New Resume')

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
            @include('resume.forms.resume-templates')
        </div>
    </div>
</div>
@endsection