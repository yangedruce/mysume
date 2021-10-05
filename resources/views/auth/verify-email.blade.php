@extends('layouts.app')

@section('title', 'Email Verification')

@section('content')
<div class="container-fluid bg-purple-dark register-page">
    <div class="row justify-content-center h-100 py-5">
        <div class="col-12 col-xl-6">
            <div class="form-container p-5">
                <div class="text-center">
                    <h1 class="ff-days-one text-blue-light mb-3">mysume</h1>
                    <x-icons.verify></x-icons.verify>
                </div> 

                <x-verify-status></x-verify-status>
                
                {{-- verify email --}}
                @include('auth.forms.verification')
                @include('auth.forms.logout')
            </div>
        </div>
    </div>
</div>
@endsection