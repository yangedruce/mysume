@extends('layouts.navbar')

@section('title', 'Edit Profile')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-12 col-xl-6">
        <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
            <div>
                <h1 class="text-dark fs-4 ff-days-one">
                    My Profile
                </h1>
                <p class="ff-monserrat d-block text-grey-dark small">Profile details will be displayed on resume</p>
            </div>
            <a href="{{ route('password.edit') }}">
                <button type="button" class="btn btn-main btn-width text-white ff-montserrat"><small>Update Password</small></button>
            </a>
        </div>

        {{-- edit profile --}}
        <div class="justify-content-center mt-5">
            <div class="main-container justify-content-center">

                @include('profile.forms.profile')
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    @include('profile.partials.script')
@endpush