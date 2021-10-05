@extends('layouts.navbar')

@section('title', 'Create New Resume')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-12 col-xl-6">
        <h1 class="text-dark fs-4 ff-days-one">
            {{ isset($resume) ? 'Edit Resume Settings' : 'Create New Resume' }}
        </h1>

        <div class="justify-content-center mt-5">
            @include('resume.forms.resume-templates')
        </div>
    </div>
</div>
@endsection
