<div class="py-5">
    <div class="profile-img-container position-relative mx-auto p-0">
        <div class="d-flex justify-content-center align-items-center profile-circle-3 w-100 h-100 mt-3 mt-xl-0">
            @if(Route::is('resume.preview-resume'))
                <img src="{{ asset('assets/img').'/0000_avatar.jpeg' }}" alt="" class="w-auto h-100 d-block">
            @else
                @if($user->profile_picture==null)
                    <x-icons.person></x-icons.person>
                @else
                    <img src="{{ asset('storage/profilepicture').'/'.$user->profile_picture }}" alt="" class="w-auto h-100 d-block">
                @endif
            @endif
        </div>
    </div>
</div>