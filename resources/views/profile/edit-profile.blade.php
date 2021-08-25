@extends('layouts.navbar')

@section('title')
{{ __('Edit Profile') }}
@endsection

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
                <button type="button" class="btn btn-main btn-width text-white ff-montserrat"><small>{{ __('Update Password') }}</small></button>
            </a>
        </div>

        {{-- edit profile --}}
        <div class="justify-content-center mt-5">
            <div class="main-container justify-content-center">

                {{-- edit profile information --}}
                <form action="{{ route('user-profile-information.update') }}" method="POST" id="formText" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- profile picture --}}
                    <input type="file" name="image" id="img-file" class="img-upload d-none" accept="image/*" multiple>
                    <div class="profile-img-container position-relative mx-auto mb-4">
                        <div class="d-flex justify-content-center align-items-center profile-circle w-100 h-100">
                            @if(Auth::user()->profile_picture==null)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#4C4EAF" class="bi bi-person-fill w-75 m-auto" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            @else
                                <img src="{{ asset('storage/profilepicture').'/'.Auth::user()->profile_picture }}" alt="" class="profile-avatar mx-auto w-auto h-100 d-block">
                            @endif
                        </div>
                        <button class="btn profile-upload position-absolute bottom-0 end-0" type="button">
                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="upload-button m-auto">
                                <rect x="0.25" width="20.25" height="20.25" fill="url(#pattern0)"/>
                                <defs>
                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0" transform="scale(0.0416667)"/>
                                </pattern>
                                <image id="image0" width="24" height="24" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAA7UlEQVRIie2UTQ6CQAyFK/EWwE49CyfhTFyBEFe605XEi8BWEvUCn5tqJvzU4WenL2kgbec9+hpG5I85ABKgZhgVkMwRqAzyj8gcAQCm1kVEAqe5Y4eWauN87QqZtg3YYXqsH9V7btK4PmjzBFazcygCCuCpsQe2Tv0KlKOUW+RNjw0NEGpPCVwsHkug0NIBCDWOmst9eSyBp5ZCJxdr7v6Nx2cH7+aVR28HPgJnfWa6j0hEMs2dvJUMi3bAbWDJG18e8z/QxebAQ6PoI58sMAZTljwLa+e9FpF4iSnEuSDdCVKxb84x5OkCPL+CF9OR5j7WMhZaAAAAAElFTkSuQmCC"/>
                                </defs>
                            </svg>
                        </button>
                    </div>
                
                    {{-- messages/alerts --}}
                    @if(count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $message)
                                <li class="fw-bold alert alert-danger ff-montserrat small">{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif        

                    @if(session('success'))            
                        <div class="fw-bold alert alert-success ff-montserrat small">{{ session('success') }}</div>
                    @endif

                    <div class="form-group mt-4">
                        <label for="" class="text-dark ff-days-one"><small>Full Name</small></label>
                        <input type="text" class="form-control main-input ff-montserrat small" id="inputName" name="name" value="{{ Auth::user()->fullname }}" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="" class="text-dark ff-days-one"><small>Username</small></label>
                        <input type="text" onchange="checkUsername()" class="form-control main-input ff-montserrat small" id="userName" name="username" value="{{ Auth::user()->username }}" required>
                        <p class="text-danger d-none mt-1" id="usernameExist"><small>{{ __('Username has already existed. Please insert another username.')}}</small></p>
                    </div>
                    <div class="form-group mt-3">
                        <label for="" class="text-dark ff-days-one"><small>Phone No</small></label>
                        <input type="text" class="form-control main-input ff-montserrat small" id="phoneNo" name="phoneno" value="{{ Auth::user()->phone_no }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="" class="text-dark ff-days-one"><small>Email</small></label>
                        <input type="email" class="form-control main-input ff-montserrat small" id="userEmail" name="email" value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="" class="text-dark ff-days-one"><small>Location</small></label>
                        <input type="text" class="form-control main-input ff-montserrat small" id="userLocation" name="userlocation" value="{{ Auth::user()->location }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="" class="text-dark ff-days-one"><small>Website</small></label>
                        <input type="text" class="form-control main-input ff-montserrat small" id="userWebsite" name="userwebsite" value="{{ Auth::user()->website }}">
                    </div>
                    <div class="d-flex justify-content-center align-items-center mt-5 flex-column flex-md-row">
                        <button type="button" class="btn btn-main btn-width m-2 text-white" data-bs-toggle="modal" data-bs-target="#saveProfileModal"><small>{{ __('Save Profile') }}</small></button>
                        <a href="{{ route('profile.edit') }}">
                            <button type="button" class="btn btn-main-blue btn-width m-2 text-blue-dark"><small>{{ __('Cancel') }}</small></button>
                        </a>
                    </div>

                    {{-- save profile modal --}}
                    <div class="modal fade" id="saveProfileModal" tabindex="-1" aria-labelledby="saveProfileModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-center">
                                <div class="modal-body p-5">
                                    <p class="modal-title fw-bold fs-2 text-dark ff-days-one" id="saveProfileModalLabel">Are you sure to save your profile?</p>
                                    <button type="button" onclick="checkSubmit()" class="btn btn-main text-white mt-3 w-100"><small>{{ __('Save Profile') }}</small></button>
                                    <button type="button" class="btn btn-main-blue text-blue-dark mt-3 w-100" data-bs-dismiss="modal"><small>{{ __('Cancel') }}</small></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    // Profile picture
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".img-upload").on('change', function() {
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
        $(".img-upload").click();
    });

    // to check existing username and compare before can save/changing
    function checkUsername() {
        $.ajax({
            type: "GET",
            url: '{{ route("user.check-username-profile") }}',
            data: {'username': $('#userName').val()},
            success: function(response)
            {
                if(response) {
                    $('#usernameExist').removeClass('d-none');
                    $('#userName').val('');
                }else {
                    $('#usernameExist').addClass('d-none');
                }
            }
        });
    }

    function checkSubmit() {
        $('#loading').removeClass('d-none');
        $.ajax({
            type: "GET",
            url: '{{ route("user.check-username-profile") }}',
            data: {'username': $('#userName').val()},
            success: function(response)
            {
                if(response) {
                    $('#usernameExist').removeClass('d-none');
                    $('#userName').val('');
                    $('#loading').addClass('d-none');
                }else {
                    $('#usernameExist').addClass('d-none');
                    $('#formText').submit();
                }
            }
        });
    }
</script>
@endpush