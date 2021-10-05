@extends('layouts.navbar')

@section('title', 'Edit Password')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-12 col-xl-6">
        <h1 class="text-dark fs-4 ff-days-one">Update Password</h1>

        <x-status></x-status>

        <div class="justify-content-center mt-5">
            @include('profile.forms.password')
        </div>
    </div>
</div>
@endsection
