@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container-fluid bg-purple-dark register-page">
    <div class="row justify-content-center h-100 py-5">
        <div class="col-12 col-xl-6">
            <div class="form-container p-5">
                <div class="text-center">
                    <h1 class="ff-days-one text-blue-light mb-3">mysume</h1>
                    <x-icons.register></x-icons.register>
                </div>

                <x-register-message></x-register-message>
                
                {{-- register --}}
                @include('auth.forms.register')
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    @include('auth.partials.script')
@endpush