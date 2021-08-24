@extends('layouts.navbar')

@section('title')
{{ __('Edit Password') }}
@endsection

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-12 col-xl-6">
        <h1 class="text-dark fs-4 ff-days-one">Update Password</h1>
        @if($errors->hasBag('updatePassword'))
            <ul>
                @foreach ($errors->updatePassword->all() as $message)
                    <li class="fw-bold alert alert-danger ff-montserrat small">{{ $message }}</li>
                @endforeach
            </ul>
        @endif        

        @if(session('status'))         
            <div class="fw-bold alert alert-success ff-montserrat small">{{ __('Your password has been updated.') }}</div>
        @endif
        <div class="justify-content-center mt-5">
            <form action="{{ route('user-password.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="main-container justify-content-center">
                    <div class="form-group mt-4">
                        <label for="inputPassword" class="text-dark ff-days-one"><small>Current Password</small></label>
                        <input type="password" class="form-control main-input ff-montserrat small" id="inputCurrentPassword" name="current_password" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="inputPassword" class="text-dark ff-days-one"><small>New Password</small></label>
                        <input type="password" class="form-control main-input ff-montserrat small" id="inputPassword" name="password" value="">
                    </div>
                    <div class="form-group mt-3">
                        <label for="inputConfirmPassword" class="text-dark ff-days-one"><small>Confirm Password</small></label>
                        <input type="password" class="form-control main-input ff-montserrat small" id="inputConfirmPassword" name="password_confirmation" required>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mt-5 flex-column flex-md-row">
                        <button type="submit" class="btn btn-main btn-width m-2 text-white"><small>{{ __('Update') }}</small></button>
                        <a href="{{ route('profile.edit') }}" class="m-2">
                            <button type="button" class="btn btn-main-blue btn-width text-blue-dark"><small>{{ __('Back') }}</small></button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection