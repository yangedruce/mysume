<div class="d-flex justify-content-center align-items-center profile-circle w-100 h-100">
    @if(Auth::user()->profile_picture==null)
        <img src="{{ asset('assets/img').'/user.jpg'}}" alt="" class="profile-avatar mx-auto w-auto h-100 d-block">
    @else
        <img src="{{ asset('storage/profilepicture').'/'.Auth::user()->profile_picture }}" alt="" class="profile-avatar mx-auto w-auto h-100 d-block">
    @endif
</div>