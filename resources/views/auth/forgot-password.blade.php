@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="row g-0">
    <div class="col-12 col-xl-6 order-2 order-xl-1 auth position-relative">
        <div class="d-flex justify-content-center align-items-center p-3 w-100 h-100 position-relative">
            <x-icons.forgot></x-icons.forgot>
        </div>
    </div>
    <div class="col-12 col-xl-6 order-1 order-xl-2 auth bg-purple-dark py-5 py-xl-0">
        <div class="d-flex justify-content-center align-items-center h-100 w-100">
            <div class="col-10 col-xl-8">
                <h2 class="text-center fs-1 ff-days-one mb-5 text-blue-light">
                    mysume
                </h2>
                
                {{-- messages/alerts --}}
                <x-forgot-message></x-forgot-message>
                
                {{-- forgot password --}}
                @include('auth.forms.forgot')
            </div>
        </div>
    </div>
</div>
@endsection